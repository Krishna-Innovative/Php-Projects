(function () {
    'use strict';


    angular.module('iaAuth', [])

        .factory('AuthToken', ['$q', '$window', '$rootScope', 'Store',  function ($q, $window, $rootScope, Store) {

            var accountKey = 'auth-account';
            var tokenKey = 'auth-token';
            var cachedAccount,cachedToken;

            function isExpired(current, expires_at) {
                return current > expires_at;
            }

            return {
                set: function (token) {
                    cachedToken = token;
                    return Store.put(tokenKey, token);
                },

                setAccount: function(account){
                    cachedAccount = account;
                    return Store.put(accountKey, account);
                },

                get: function () {
                  var url = $window.location.href;
                  var startToken = url.indexOf("auth/");
                  var endToken =url.lastIndexOf("?redirect-to"); 
                  var newToken = url.substring(startToken+5,endToken);
                           
                    if (cachedToken) {               
                         return isExpired(moment().format('X'), cachedToken['expires_at']) ? null: cachedToken['token'];
                    }

                    if (Store.get(tokenKey) && angular.isDefined(Store.get(tokenKey)['token'])) {
                        return isExpired(moment().format('X'), Store.get(tokenKey)['expires_at']) ? null: Store.get(tokenKey)['token'];
                    }

                    return null;
                },

                getAccount: function(){
                    if (cachedAccount) {
                        return isExpired(moment().format('X'), cachedAccount['expires_at']) ? null: cachedAccount['is_partner'];
                    }

                    if (Store.get(accountKey) && angular.isDefined(Store.get(accountKey)['is_partner'])) {
                        return isExpired(moment().format('X'), Store.get(accountKey)['expires_at']) ? null: Store.get(accountKey)['is_partner'];
                    }

                    return null;
                },

                clear: function () {
                    cachedAccount=null;
                    cachedToken = null;
                    Store.remove(accountKey);
                    return Store.remove(tokenKey);
                }
            };

        }])

        .provider('Auth', function () {

            this.init = function (config) {

                if (!config.LOGIN_URL) {
                    throw Error('Login URI is required.');
                }

                if (!config.AUTH_URL) {
                    throw Error('Auth URI is required.');
                }

                this.LOGIN_URL = config.LOGIN_URL;
                this.AUTH_URL = config.AUTH_URL;

            };

            this.$get = function ($rootScope, $http, AuthToken, iaSettings, Store) {
                var auth = this;

                auth.isAuthenticated = false;

                auth.login = function (credentials, successCallback, errorCallback) {

                    if (Store.get($rootScope.nomination)) {
                        credentials.nomination = Store.get($rootScope.nomination);
                    }

//                  return $http.post(auth.LOGIN_URL, credentials, {headers: {'Accept-Language': iaSettings.getLanguage(), 'Access-Control-Allow-Credentials': true}, withCredentials:true})
                    return $http.post(auth.LOGIN_URL, credentials, {headers: {'Accept-Language': iaSettings.getLanguage()}})
                        .success(function (res) {

                            AuthToken.set(res);

                            auth.isAuthenticated = true;

                            //Remove nomination localStorage
                            Store.remove($rootScope.nomination);

                            if (angular.isFunction(successCallback)) {
                                successCallback.call(res);
                            }
                        })
                        .error(function (err) {

                            AuthToken.clear();
                            if (angular.isFunction(errorCallback)) {
                                errorCallback.call(err);
                            }
                        });
                };

                auth.authenticate = function (token, successCallback, errorCallback) {

                    return $http.get(auth.AUTH_URL, {params: token, headers: {'Accept-Language': iaSettings.getLanguage()}})
                        .success(function (res) {

                            AuthToken.set(res);

                            auth.isAuthenticated = true;
                            
                            //Remove nomination localStorage
                            Store.remove($rootScope.nomination);

                            if (angular.isFunction(successCallback)) {
                                successCallback.call(res);
                            }
                        })
                        .error(function (err) {

                            AuthToken.clear();
                            if (angular.isFunction(errorCallback)) {
                                errorCallback.call(err);
                            }
                        });
                };

                auth.logout = function () {
                    auth.isAuthenticated = false;
                    AuthToken.clear();
                };

                auth.getToken = function () {
                    return AuthToken.get();
                };

                auth.isLogged = function () {
                    return AuthToken.get() ? true : false;
                };

                auth.isPartner = function(){
                    return AuthToken.getAccount() ? true : false;
                }

                return auth;
            };
        })

        .factory('AuthInterceptor', ['$rootScope', '$q', '$log', 'AuthToken', function ($rootScope, $q, $log, AuthToken) {
            return {
                request: function (config) {
                    var token = AuthToken.get();

                    if (token) {
                        config.headers = config.headers || {};
                        config.headers.Authorization = 'Bearer ' + token;
                    }
                    return config;
                },
                response: function (response) {

                    if (response.status === 401) {
                        $log.warn('user not authenticated', response);
                        $rootScope.$broadcast('user.unauthorized');
                    } else if (response.status === 403) {
                        $log.warn('user not allowed', response);
                        $rootScope.$broadcast('user.forbidden');
                    }
                    return response || $q.when(response);
                }
            };
        }])

        .config(['$httpProvider', function ($httpProvider) {
            $httpProvider.interceptors.push('AuthInterceptor');
        }])

        .controller('AuthController', ['$rootScope', '$window', '$scope', '$state', '$location', 'Auth', 'Socket', 'Account', function ($rootScope, $window, $scope, $state, $location, Auth, Socket, Account) {
            var errors;
            var credentials;
            var pattern = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            $scope.remember = false;
            $scope.$parent.account = null;
            $scope.errors = [];
            $rootScope.logged = false;

            $rootScope.isemailavailableformember= false;
            $rootScope.isemailalreadyexistformember= false;
            $rootScope.isemailactiveformember = false;
            $rootScope.isemailrequiredformember = false;

            var redirectTo = $state.params['redirect-to'];
            var searchParams = {};

            if (!_.isUndefined($state.params['ref'])){
                searchParams ={'ref': $state.params['ref']};
            }

            if ($location.$$search.emailUpdated) {
                $scope.emailUpdated = true;
            }

            $scope.login = function (username, password) {
                $scope.errors = [];
                username = username.toLowerCase();
                credentials = $scope.remember ?
                    (pattern.test(username) ? {email: username, password: password, remember: true} : {ice_id: username, password: password, remember: true}) :
                    (pattern.test(username) ? {email: username, password: password} : {ice_id: username, password: password});


                $rootScope.loginTransition = true;
                return Auth.login(credentials).then(
                        function (res) {

                        $scope.errors = [];
                        // Socket.getConnection();

                        // Fire logged events
                        $rootScope.$broadcast('account.login', res.data);

                        Account.get()
                            .then(function(res) {
                                sessionStorage.setItem("LoginAccountId", res.id);
                                if(!res.last_name || !res.phone)
                                {
                                    if(res.is_partner){
                                        if(res.password_update ===0){
                                            sessionStorage.setItem("passwordpopupsession",true);
                                        }
                                     
                                        Account.getApiKeyForPartner()
                                        .then(function(){
                                        });
                                    }
                                      $state.transitionTo('account.edit', {});
                                }
                                else
                                {
                                if (redirectTo) {
                                  $location.path(redirectTo).search(searchParams).replace();                                     
                                  $window.location.reload();  // we chat click on account page after login not showing username need to refresh fixed
                                } else if (res.is_partner) {
                                    if(res.password_update ===0){
                                        sessionStorage.setItem("passwordpopupsession",true);
                                    }
                                   
                                    Account.getApiKeyForPartner()
                                    .then(function(){
                                         $state.transitionTo('base.dashboard', {});
                                     }, function (e) {
                                        $state.transitionTo('base.partner', {});
                                    });                               
                                }                                   
                                else{
                                    $state.transitionTo('account.show', {});
                                      //$window.location.reload(); 
                                }
                              }
                                $rootScope.loginTransition = false;
                            });
                            $rootScope.redirecting = false;
                    },
                    function (err) {
                        errors = [];
                        if (err.data && err.data.error) {
                            errors.push(err.data.error);
                        }
                        $scope.errors = errors;
                        $rootScope.redirecting = false;
                    });                   

                };
            }])

        .controller('AuthTokenController', ['$rootScope', '$window', '$scope', '$state', '$location', 'Auth', 'Socket', 'Account','Store','AuthToken','iaSettings', function ($rootScope, $window, $scope, $state, $location, Auth, Socket, Account,Store,AuthToken,iaSettings) {
            var redirectTo = $state.params['redirect-to'];
            var token = $state.params['token'];
            $rootScope.tokenKey = token;
            var tokenKey = 'auth-token';
            var tokenKeyInfo = Store.get(tokenKey);
            $rootScope.logged = false;
            if(tokenKeyInfo!==null &&(tokenKeyInfo.token!==$rootScope.tokenKey)){
                $rootScope.logged=false;
                Store.put(tokenKey, token);
            }

            if ($rootScope.logged){
                $location.url(redirectTo);
                return;
            }

            var errors;
            $scope.$parent.account = null;
            $scope.errors = [];
            $rootScope.alerts = [];
            $rootScope.logged = false;            
           
            if ($location.$$search.emailUpdated) {
                $scope.emailUpdated = true;
            }

         
                $scope.errors = [];

                return Auth.authenticate({'access_token': token}).then(
                        function (res) {

                        $rootScope.redirecting = true;
                        $scope.errors = [];
                        //$rootScope.alerts = [];
                        // Socket.getConnection();

                        // Fire logged events
                       // AuthToken.setAccount(null);
                     Account.resetAccountForTokenLogin();                

                        Account.get()
                            .then(function() {
                                 Account.fetchNonViewedMessages().then(function(){
                                    $rootScope.$broadcast('account.login', res.data);
                                    if (redirectTo) {
                                    $location.url(redirectTo).replace();
                                    //$window.location.reload();
                                } else {
                                    $state.transitionTo('account.show', {});
                                }
                            })                                
                        });
                    },
                    function (err) {
                        errors = [];
                        if (err.data && err.data.error) {
                            errors.push(err.data.error);
                        }
                        $scope.errors = errors;
                        $location.url('/login');
                    });
        }]);

})();
