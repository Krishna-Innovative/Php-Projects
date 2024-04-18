'use strict';

$(document).ready(
            function() {
      angular.bootstrap(document, ['iaApp']);
    }
);

angular.module('iaApp', [
        'ngCookies',
        'ngSanitize',
        'ngRoute',
        'ngAnimate',
        'ngMessages',
        'removeWhitespace',
        'addEcpAlert',
        'iaApp.routes',
        'iaAvatar',
        'iaOffline',
        //'ngTouch',
        'iaTooltip',
        'ui.router',
        'ui.bootstrap',
        'ncy-angular-breadcrumb',
        'restangular',
        'iaSettings',
        'iaModal',
        'iaAccount',
        'iaAuth',
        'iaMember',
        'iaGuardian',                                                                                   
        'iaContact',
        'iaSupport',
        'iaBrowserLanguage',
        'iaStorage',
        'iaSocket',
        'iaBreadcrumb',
        'iaCaptcha',
        'iaAnalytic',
        'iaAlert',
        'iaDate',
        'iaCarousel',
        'iaPermission',
        'ngLocalize',
        'ngLocalize.Config',
        'ngLocalize.Events',
        'iaPersonName',
        'iaEvents',
        'iaGeolocation',
        'iaBetaLabel',
        'iaTabs',
    ])

    .constant('API_BASE', Config.API_BASE)
    .constant('WS_BASE', Config.WS_BASE)
    .constant('MEDIA_BASE', Config.MEDIA_BASE)
    .constant('CDN_BASE', Config.CDN_BASE)

    .config(['$sceProvider', function($sceProvider) {
        $sceProvider.enabled(false);
    }])

    .value('localeConf', {
        basePath: 'languages',
        defaultLocale: 'en-US',
        sharedDictionary: 'common',
        fileExtension: '.lang.json',
        persistSelection: true,
        cookieName: 'COOKIE_LOCALE_LANG',
        observableAttrs: new RegExp('^data-(?!ng-|i18n)'),
        delimiter: '::'
    })

    .value('localeSupported', [
        'en-US',
        'zh-CN'
    ])

    .value('localeFallbacks', {
        'en': 'en-US',
        'zh': 'zh-CN'
    })

    .config(['iaCacheProvider', 'SocketProvider', 'WS_BASE', function(iaCacheProvider, SocketProvider, WS_BASE) {
        iaCacheProvider.init();

        SocketProvider.init({
            WS_BASE : WS_BASE
        });
    }])

    .config(['$compileProvider', function ( $compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|file|maps|tel|ftp|geo|mailto|coui):/);
    }])

    /**
     * MNAuth module configuration
     */
    .config(['API_BASE', 'AuthProvider', function (API_BASE, AuthProvider) {
        AuthProvider.init({
            LOGIN_URL: API_BASE + '/login',
            AUTH_URL: API_BASE + '/auth'
        });
    }])

    /**
     *  Directive decorator for input, textarea and select box.
     */
    .config(['$provide', function ($provide) {

        $provide.decorator('inputDirective', ['$delegate', '$rootScope', function ($delegate, $rootScope) {
            var directive = $delegate[0],
                origLink = directive.link.pre;

            var newLink = function ($scope, $element, $attrs, ctrl) {

                if (angular.isUndefined($attrs.enable) && ($rootScope.viewMode) && $attrs.type !== 'hidden') {
                    $attrs.$set('disabled', 'disabled');
                }

                if (!ctrl) {
                    return;
                }

                $element.on('focus', function () {
                    if (!ctrl[0]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[0].$hasFocus = true;
                    });

                });

                $element.on('blur', function () {
                    if (!ctrl[0]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[0].$hasFocus = false;
                        ctrl[0].$hasVisited = true;
                    });
                });

                if ($rootScope.previewMode && $attrs.type === 'checkbox') {
                    $attrs.$set('disabled', 'disabled');
                    $element.addClass('hide');
                    $element.parent('.col-xs-1').addClass('hide');
                }

                origLink.apply(this, arguments);
                return;
            };

            directive.compile = function () {
                return newLink;
            };

            return $delegate;
        }]);

        $provide.decorator('textareaDirective', ['$delegate', '$rootScope', function ($delegate, $rootScope) {
            var directive = $delegate[0],
                origLink = directive.link.pre;

            var newLink = function ($scope, $element, $attrs, ctrl) {
                if (angular.isUndefined($attrs.enable) &&  ($rootScope.viewMode)) {
                    $attrs.$set('disabled', 'disabled');
                }

                if (!ctrl) {
                    return;
                }

                $element.on('focus', function () {
                    if (!ctrl[0]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[0].$hasFocus = true;
                    });
                });

                $element.on('blur', function () {
                    if (!ctrl[0]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[0].$hasFocus = false;
                        ctrl[0].$hasVisited = true;
                    });
                });

                origLink.apply(this, arguments);
                return;
            };

            directive.compile = function () {
                return newLink;
            };

            return $delegate;
        }]);

        $provide.decorator('selectDirective', ['$delegate', '$rootScope', function($delegate, $rootScope) {
            var directive = $delegate[0],
                origLink = directive.link;

            var newLink = function ($scope, $element, $attrs, ctrl) {
                if (angular.isUndefined($attrs.enable) &&  ($rootScope.viewMode)) {
                    $attrs.$set('disabled', 'disabled');
                }

                if (!ctrl) {
                    return;
                }

                $element.on('focus', function () {
                    if (!ctrl[1]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[1].$hasFocus = true;
                    });
                });

                $element.on('blur', function () {
                    if (!ctrl[1]) {
                        return;
                    }

                    $scope.$digest(function () {
                        ctrl[1].$hasFocus = false;
                        ctrl[1].$hasVisited = true;
                    });
                });

                $element.wrap('<label class="select-wrapper"></label>');

                origLink.apply(this, arguments);
                return;
            };

            directive.compile = function() {
                return newLink;
            };

            return $delegate;
        }]);
    }])

    .config(['$httpProvider', function ($httpProvider) {
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.cache = false;

        $httpProvider.interceptors.push(['$rootScope', '$q', '$filter', function($rootScope, $q, $filter) {
            return {

                request: function (config) {

                    // Define request timeout in case of API request
                    if (config.url.indexOf(Config.API_BASE) !== -1) {
                        config.timeout = Config.API_REQUEST_TIMEOUT || 0;
                    }

                    if (!$rootScope.globals) {
                        $rootScope.globals = {};
                    }

                    var showSpinner = $rootScope.redirecting ? false : true;

                    _.each(Config.excludeSpinner, function(link) {
                        if(config.url.match(link.uri) && config.method === link.method) {
                            showSpinner = false;
                            return false;
                        }
                    });

                    $rootScope.globals.showSpinner = showSpinner;
                    return config;
                },

                requestError: function(rejection) {
                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;

                    return $q.reject(rejection);
                },

                response: function (response) {

                    if (!$rootScope.loginTransition){
                        $rootScope.globals.showSpinner = false;
                    }

                    return response;
                },

                responseError: function(rejection) {
                    if (rejection.status === 0 || rejection.status === 408) {
                        rejection.data = rejection.data ? rejection.data : {};
                        rejection.data.error = {
                            type: 'requestTimedOut',
                            message: $filter('i18n')('common.requestTimedOut')
                        };
                    }

                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;

                    return $q.reject(rejection);
                }

            };
        }]);
    }])

    .config(['$breadcrumbProvider', function($breadcrumbProvider) {
        $breadcrumbProvider.setOptions({
            prefixStateName: 'base.home',
            templateUrl: 'partials/breadcrumb.html'
        });
    }])

    /**
     * Restangular provider configuration
     */
    .config(['API_BASE', 'RestangularProvider', function (API_BASE, RestangularProvider) {
        RestangularProvider.setBaseUrl(API_BASE);
        RestangularProvider.setDefaultHttpFields({ timeout: 5000 });

        RestangularProvider.setRequestInterceptor(function (data) {
            return data;
        });
        RestangularProvider.setResponseInterceptor(function (data) {
            return data;
        });
    }])

    .run(function ($rootScope) {
        $rootScope.accountProfileIsNotCompleted = accountProfileIsNotCompleted;

        function accountProfileIsNotCompleted (account) {
            return account &&
                !(account.nationality &&
                account.last_name &&
                account.first_name &&
                account.gender &&
                account.phone &&
                account.phone.code &&
                account.phone.number);
        }
    })

    .run(function ($rootScope, $location, $stateParams, $timeout, $controller, $state, $templateCache, $modal, $breadcrumb, Auth,$http, AuthToken, Restangular, Account, iaCache, iaSettings, locale, localeConf, localeEvents, Store, BrowserLanguage, CountriesUtils, Socket, Alert,$window,$cookies,$sce) {
        var preferredLanguage = Store.get('preferredLanguage');
        Restangular.setDefaultHttpFields({cache: iaCache('iceangel')});
       // Restangular.setDefaultHeaders({'Accept-Language': iaSettings.getLanguage()});

        $rootScope.CountriesUtils = CountriesUtils;

        if($location.search()['logout']==="1"){                
                $rootScope.aboutPagesRedirect = true;
                Auth.logout();
                Account.resetAccount();                          
            }
            else{
                $rootScope.aboutPagesRedirect = false;
            }

        $rootScope.getLocalizedField = function(field) {
            return field + (iaSettings.getLanguage() === 'en' ? '_en' : '_' + iaSettings.getLanguage());
        };

        if (!$rootScope.globals) {
            $rootScope.globals = {};
        }

        iaSettings.init();

        $rootScope.account = {};
        $rootScope.passwordVerified = false;
        $rootScope.userBanned = false;
        $rootScope.nomination = 'nomination';
        $rootScope.farewell = false;
        $rootScope.isPanic = false;
        $rootScope.landingpage = true;

        // Get login status.
        $rootScope.logged = Auth.isLogged();
        $rootScope.iphoneappdownloadurl = Config.IPHONE_APP_URL;
        $rootScope.iphoneappdownloadurlchina = Config.IPHONE_APP_URL_CHINA;
        $rootScope.androidappdownloadurl = Config.ANDROID_PLAYSTORE_APP_URL;
            if(navigator.userAgent.toLowerCase().match(/android/i) == "android" ){
                $rootScope.isandroidapp = true; 
            }

            if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone" || navigator.userAgent.toLowerCase().match(/ipad/i) == "ipad" || navigator.userAgent.toLowerCase().match(/mac/i) == "mac"){
                $rootScope.isiphoneapp = true;
            }

        var CountriesList = $rootScope.globals.settings.countries.toArray();
        $http({
        "url":Config.IP_LOCATION_URL,
        "method":"GET",
        }).then(function(response){
            //console.log(response.data.country.toLowerCase());
             $rootScope.getMapCountryCode = response.data.country.toLowerCase();

              angular.forEach(CountriesList, function(item){
                        if(item.iso.toLowerCase().indexOf( $rootScope.getMapCountryCode ) != -1){
                            
                             $rootScope.IPCountryCode = parseInt(item.id);
                    }
                }); 
        });


        function downloadScreenId(){
            $rootScope.showError = false;
             var token = AuthToken.get();
             var req = {
                         method: 'GET',
                         async: false,
                         url: Config.API_BASE+'/lockscreen',
                         headers: {
                           'X-Authorization':'Bearer ' + token,
                           'Accept-Language': iaSettings.getLanguage()
                        }
                       }
             $http(req)
                 .then(function(res)
                     {
                        $rootScope.downloadlockscreenidpath = res.data.url;
                        sessionStorage.setItem("lockscreenurldetail",$rootScope.downloadlockscreenidpath);                       
                    },
                     function(error)
                     {
                        $rootScope.showError = true;
                     });
         }

         function getCardIdUrl(){
            
            Account.getMember($rootScope.account.id)
             .then(function (member) {                
                var url = [Config.API_BASE, 'members', member.id, 'share?access_token=' + Auth.getToken()].join('/') + '&lang=' + iaSettings.getLanguage() + '&pdfcard=1&type=download-member-id';
                $rootScope.cardidurldetailval = $sce.trustAsUrl(url);
                sessionStorage.setItem("cardidurldetail",$rootScope.cardidurldetailval);
               
            });
         }

         function hidePopUpTermsText(){
            $rootScope.isAccordianPopUpPrivacy = false;
            $rootScope.isAccordianPopUpTerms = false;
        }
         $rootScope.closeConditionDetail = function() {
            hidePopUpTermsText();
         }

        $rootScope.cancelTermsPop = function(){
            hidePopUpTermsText();
            $rootScope.acceptPrivacyTermsPopUpdiv =  false;
            $rootScope.changePasswordPopUpdiv =  false;
            $rootScope.conditonsPasswordPopUpdiv =  false;
         }

         $rootScope.cancelPasswordPop = function(){
            sessionStorage.removeItem("passwordpopupsession");
            hidePopUpTermsText();
            $rootScope.acceptPrivacyTermsPopUpdiv =  false;
            $rootScope.changePasswordPopUpdiv =  false;
            $rootScope.conditonsPasswordPopUpdiv =  false;
         }
        $rootScope.getpopUpPrivacyDetail = function() {
            hidePopUpTermsText();
            $.ajax({
                    type: 'GET',
                    async: false,
                    url: Config.API_BASE + '/pages/privacy',
                    dataType: 'json',
                    contentType: "application/json",
                    success: function(result){
                        $rootScope.isAccordianPopUpPrivacy = true;
                        if(iaSettings.getLanguage() =="en"){
                           $rootScope.privacyPopHtml = result.body_en;
                        }
                        if(iaSettings.getLanguage() =="zh"){
                            $rootScope.privacyPopHtml = result.body_zh;
                        }
                    }
            })                      
        }

        $rootScope.getpopUpTermsDetail = function() {
            hidePopUpTermsText();
            $.ajax({
                    type: 'GET',
                    async: false,
                    url: Config.API_BASE + '/pages/terms',
                    dataType: 'json',
                    contentType: "application/json",
                    success: function(result){
                        $rootScope.isAccordianPopUpTerms = true;
                        if(iaSettings.getLanguage() =="en"){
                           $rootScope.termsPopUpHtml = result.body_en;
                        }
                        if(iaSettings.getLanguage() =="zh"){
                            $rootScope.termsPopUpHtml = result.body_zh;
                        }
                    }
            })

        }

        if(Auth.isLogged()){

        if(_.isNull(sessionStorage.getItem('lockscreenurldetail'))){
             downloadScreenId();
        }         
        else{
            $rootScope.downloadlockscreenidpath = sessionStorage.getItem('lockscreenurldetail');
        } 

        if(_.isNull(sessionStorage.getItem('cardidurldetail'))){
            getCardIdUrl();
        }
        else{
            $rootScope.cardidurldetailval = sessionStorage.getItem('cardidurldetail');
        }

        }

        $rootScope.showPartner = Auth.isPartner();

        if ($rootScope.logged) {
            Socket.connectSocket();
        }

        $rootScope.$on('account.login', function () {
            $rootScope.logged = Auth.isLogged();
            //Display alert history

            if ($rootScope.logged){                
                Account.get().then(function (value){
                    var page = 0;  
                    $rootScope.showPartner = Auth.isPartner();
                    page = page+1;
                    $rootScope.alerts = [];
                    Alert.getAlertHistory(value.id,page).then(function(res){
                            for (var i = res.alerts.length - 1; i >= 0; i--) {
                                if (res.alerts[i] !== undefined){
                                    if (! Alert.exist($rootScope.alerts, res.alerts[i])) {
                                        $rootScope.alerts.push(Alert.decorate(res.alerts[i]));
                                    }
                                }
                            }
                    });
                });
            }
            //Account.fetchNonViewedMessages();          
        });

        $rootScope.$on('authToken', function(event, value) {
            AuthToken.set(value);

            $rootScope.logged = Auth.isLogged();
        });

        //account.language
        $rootScope.$on('accountLanguage', function(event, value) {
            if (iaSettings.getLanguage() !== value) {
                setDefaultLocale(Config.SupportLanguage[value]);
            }
        });

        // Check whether access token is expired.
        if (!AuthToken.get()) {
            $rootScope.globals.newMessagesCount = null;
            Auth.logout();
            Account.resetAccount();
            $rootScope.account = {};
            $rootScope.member = null;
        }

        $rootScope.settings = {
            showAlert: false
        };

        $rootScope.$on(localeEvents.localeChanges, function() {
            Restangular.setDefaultHeaders({'Accept-Language': iaSettings.getLanguage()});
        });

        $rootScope.$on('showSpinner', function() {
            $rootScope.globals.showSpinner = true;
        });

        $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState) {
         // if(toState.states === "my-account"){    // for language issue in android and ios fromState is not correct 
         //    toState.name = "account.show";       // Need to check  why from state is correct (temporary solution)
         //  }
        var ua = navigator.userAgent.toLowerCase();
        var s= (/micromessenger/.test(ua)) ? true : false ;

        $rootScope.browserName =s;

        if((toState.name === 'base.partner' || toState.name === 'base.ptnmembers' || toState.name === 'base.ptnecpersons' ) && $rootScope.showPartner ){
            $rootScope.finLoading = false;
            $rootScope.openFINload = false;
            Account.get().then(function(res){
               $rootScope.partner_account_id  = res.id; 
               $rootScope.partner_first_name = res.first_name;   
               $rootScope.partner_last_name = res.last_name;   
               $rootScope.partner_middle_name = res.middle_name;   
               $rootScope.partner_email_value = res.email;   
               $rootScope.partner_ice_id = res;
               $rootScope.partner_premium_status = res.is_premium;
               
            });
            Account.getFriends().then(function(friends) {
                friends.contacts.forEach(function(friend){
                    friend.fullDate =  _.compact([friend.birth_date.year, friend.birth_date.month, friend.birth_date.day]).join('-');
                });
            $rootScope.friends = friends;
            $rootScope.finLoading = true;
            $rootScope.openFIN =  Config.MEDIA_BASE + 'media/qr/iCE_';
            $rootScope.openFINload= true;
            });
        }

           

            if(toState.name==="base.forgot-password.email" && fromState.name!=="base.forgot-password.email" && ($location.search()['source']==="ios" || $location.search()['source']==="android")){
                Auth.logout();
                Account.resetAccount();
                $rootScope.$broadcast('logout', 'base.login');
            }
            if(toState.name==="base.home" && fromState.name!=="base.home"  && ($location.search()['source']==="ios" || $location.search()['source']==="android")){
                Auth.logout();
                Account.resetAccount();
                fromState.name="base.home";
                $rootScope.$broadcast('logout', 'base.home','base.home');
            }

            // Save nomination code in storage.
            if (angular.isDefined($location.$$search.nomination)) {
                Store.put($rootScope.nomination, $location.$$search.nomination);
                if (angular.isDefined($location.$$search.nominee && $rootScope.logged)) {
                    $rootScope.nominee = $location.$$search.nominee;

                     Account.get().then(function (value){

                        $rootScope.currentEmail = value.email;

                          if($rootScope.currentEmail === $rootScope.nominee){
                            return;
                        }
                        else{
                            Auth.logout();
                            Account.resetAccount();
                            $rootScope.$broadcast('logout', 'base.login');
                            return;
                        }
                        
                     });
                }
            }

            if($cookies.downloadCardDetail)
            {
                $rootScope.showDownloadCard = false;
            }
            else
            {
                $rootScope.showDownloadCard = true;
            }
            $rootScope.globals.stateShowSpinner = true;
            $rootScope.showAlerts = !!toState.showAlerts;
            $rootScope.showAlertsHistory = !!toState.showAlertsHistory;
            $rootScope.showAddEcpAlert = !!toState.showAddEcpAlert;
            $rootScope.hideHeader = !!toState.hideHeader || $location.$$search.header === 'false';
            $rootScope.isHome = (toState.name === 'base.home');
            $rootScope.isMessage = (toState.name === 'account.messages');
            $rootScope.isEdit = (toState.name === 'account.edit');
            $rootScope.isSettings = (toState.name === 'account.settings');
            
            $rootScope.isaccountshowpage = (toState.name === 'account.show') || (toState.name === 'base.partner');
            $rootScope.settings = {
                showAlert: false
            };

            if(toState.name === 'account-active' || toState.name === 'base.reset-password'){
                Auth.logout();
                Account.resetAccount();
                $rootScope.$broadcast('logout', 'base.login');
                return;
            }
            
            if(toState.name === 'base.login'){
                $rootScope.isexpirelink = false;
                if (angular.isDefined($location.$$search.expireLink) && $location.$$search.expireLink) {
                    $rootScope.isexpirelink = true;
                    Auth.logout();
                    Account.resetAccount();
                }
            }

            if (toState.name === 'base.login' && fromState.name === 'account.show') {
                if (Auth.isLogged()) {
                    event.preventDefault();

                    if (angular.isDefined($location.$$search.emailUpdated) && $location.$$search.emailUpdated) {
                        Auth.logout();
                        Account.resetAccount();
                    }

                    $state.go('base.home');
                    return;
                }
            }

            // mark messages as read when leaving message centre
            if (toState.name === 'account.messages' && Auth.isLogged()) {
                    Account.viewedMessagesStatus();
            }

            if (toState.name !== 'base.home') {
                if (typeof toState.isLoggedIn === 'undefined') {
                    return;
                }

                if (toState.url === '/trigger-alert') {
                    return;
                }

                if (toState.isLoggedIn && !Auth.isLogged()) {

                    var params = $location.search();

                    params['redirect-to'] = $location.path();

                    event.preventDefault();

                    $state.go('base.login', params);
                }

                if (!toState.isLoggedIn && Auth.isLogged() && !toState.isTransferMem ) {
                    event.preventDefault();
                    $state.go('account.show');
                }else{
                    if(toState.isTransferMem && $rootScope.logged== true){
                        // reset account 
                        $rootScope.logged = false;
                        $rootScope.account = {};
                        $rootScope.member = null;

                        Auth.logout();
                        Account.resetAccount();

                        Alert.clearAll();
                        $rootScope.alerts = [];
                        $rootScope.friend_alerts = [];
            
                        Account.clearAllMessages();
                        $rootScope.globals.newMessagesCount = null;
                        sessionStorage.removeItem("LoginAccountId");
                        // reset account 
                        var params = $location.search();
                        $state.go('base.registration.register', params);
                    }
                }

                if (toState.isLoggedIn && toState.visibleUnsync) {
                    $rootScope.visibleUnsync = true;                   
                }
                else
                {
                     $rootScope.visibleUnsync = false; 
                }


                if (!toState.isPartner && Auth.isPartner()  && Auth.isLogged()) {
                    event.preventDefault();
                    $state.go('base.partner');
                }
                
                if (!Auth.isPartner() && toState.name === 'base.partner'  && Auth.isLogged()) {
                    event.preventDefault();
                    $state.go('account.show');
                } 
            }

        });

        $rootScope.$on('$stateChangeSuccess', function() {
            resetErrorMessagesAndOtherFlags();
            $timeout(function() {
                window.scrollTo(0, 0);
                $rootScope.settings = {
                    showAlert: true
                };
            }, 0);
        });

        $rootScope.$on('alerts.received', function(event, alerts) {
         //   if (alerts) {
             //   if (angular.isDefined(alerts.members)) {
                    angular.forEach(alerts.members, function (alert) {
                        Alert.addAlert(alert);
                        if (! Alert.exist($rootScope.alerts, alert)) {
                            $rootScope.alerts.push(Alert.decorate(alert));
                        }
                    });
             //   }

                if (angular.isDefined(alerts.friends)) {
                    angular.forEach(alerts.friends, function (alert) {
                        Alert.addAlert(alert);
                        Alert.addFriendAlert(alert);

                        if (! Alert.exist($rootScope.alerts, alert)) {
                            $rootScope.alerts.push(Alert.decorate(alert));
                        }

                        if (! Alert.exist($rootScope.friend_alerts, alert)) {
                            $rootScope.friend_alerts.push(Alert.decorate(alert));
                        }
                    });
                }
         //   }
        });

        $rootScope.alerts = Alert.getAlerts();
        $rootScope.friend_alerts = Alert.getFriendAlerts();
        $rootScope.alerts_limit = Alert.getLimit();
        $rootScope.alerts_limit_public = Alert.getLimit();
        $rootScope.alerts_default = Alert.getLimit();


        $rootScope.redirectEcpLocation = function(memberId){
                    // $state.transitionTo('account.viewMember', {member_id: memberId});
                   // setTimeout(function() {
                    //    debugger;
                     //   var target =  angular.element('#ecp').position().top;
                      //  $('html, body').animate({scrollTop : target}, 400);
                 //       angular.element('#add-ecp-btn').trigger('click');
//
              //      }, 100);
        }

         $rootScope.redirectEmergencyContacts = function(){
                    setTimeout(function() {
                        var target =  angular.element('#hide_div').position().top;
                        $('html, body').animate({scrollTop : target}, 400);
                    }, 100);
        }

        $rootScope.redirectEcpSection = function(memberId){
             setTimeout(function() {
            var target =  angular.element('#ecp').position().top;
            $('html, body').animate({scrollTop : target}, 400);
              }, 100);
        };

        $rootScope.toggleAlerts = function(){
            $rootScope.alerts_limit =  $rootScope.alerts.length !== $rootScope.alerts_limit ? 
                                        $rootScope.alerts.length : Alert.getLimit();
            setTimeout(function() {
                $('html, body').animate({scrollTop : 0}, 400);
            }, 100);
        };

        $rootScope.toggleAlertsOnPublic = function(){
            $rootScope.alerts_limit_public = $rootScope.alert_histories.length !== $rootScope.alerts_limit_public ?
            $rootScope.alert_histories.length : Alert.getLimit();
                setTimeout(function() {
                $('html, body').animate({scrollTop : 0}, 400);
                }, 100);
        };

        //Display alert history
        if ($rootScope.logged) {
            Account.get().then(function (value){
                var page = 0;

                $rootScope.loadMoreAlerts = function(){
                        page = page+1;
                        Alert.getAlertHistory(value.id, page).then(function(res){
                        for (var i = res.alerts.length - 1; i >= 0; i--) {
                            if (res.alerts[i] !== undefined){
                                if (! Alert.exist($rootScope.alerts, res.alerts[i])) {
                                    $rootScope.alerts.push(Alert.decorate(res.alerts[i]));
                                }
                            }
                        }

                        if($rootScope.member)
                        {
                            $rootScope.alert_histories =_.filter($rootScope.alerts, {member_id: parseInt($rootScope.member.id)});   
                        }
                        
                        });
                };
                if ($rootScope.logged) {
                    $rootScope.loadMoreAlerts();
                }
                Account.fetchNonViewedMessages();                     
            });
            // $rootScope.globals.newMessagesCount = Account.getNonViewedMessages().length || null; 
           
        }

        $rootScope.removeAlert = function($index) {
            $rootScope.alerts[$index].show = false;
        };

        $rootScope.$on('messages.received', function(event, messages) {
            Account.addMessages(messages.data);
            $rootScope.globals.newMessagesCount = Account.getNonViewedMessages().length || null;
        });

        $rootScope.$on('messages.viewed', function(event, messages) {
    
          // $rootScope.globals.newMessagesCount = messages.length || null;
          if(messages.length>0)
          {
            $rootScope.globals.newMessagesCount = Account.viewedMessagesStatus();
          }
         
        });

        $rootScope.$on('message.guardian.request.accepted', function(event, message_id) {

            Account.removeMessage(message_id);
        });

        $rootScope.$on('message.contact.request.accepted', function(event, message_id) {

            Account.removeMessage(message_id);
        });

        $rootScope.$on('message.sync.request.accepted', function(event, message_id) {

            Account.removeMessage(message_id);
        });

        $rootScope.$on('password.verified', function() {
            $rootScope.passwordVerified = true;
        });

        $rootScope.$on('message.guardian.request.declined', function(event, message_id) {

            Account.removeMessage(message_id);
        });

        $rootScope.$on('message.contact.request.declined', function(event, message_id) {

            Account.removeMessage(message_id);
        });

        $rootScope.$on('message.sync.request.declined', function() {
            //do nothing
        });

        Restangular.setErrorInterceptor(function (response) {

            var statusCode = response.status;

            switch(statusCode) {
                case 401:
                    if (response.config.method !== 'DELETE' && !$rootScope.publicMode && $rootScope.logged) {
                        $rootScope.$broadcast('logout');
                    }

                    break;
                case 403:
                    if (response.data.error.type === 'UserBannedException') {
                        $rootScope.userBanned = true;
                        $state.go('base.home');
                    }

                    break;
                default:
                    break;
            }
        });

        $rootScope.$on('logout', function(obj, next) {

            $rootScope.logged = false;
            $rootScope.account = {};
            $rootScope.member = null;

            Auth.logout();
            Account.resetAccount();

            Alert.clearAll();
            $rootScope.alerts = [];
            $rootScope.friend_alerts = [];

            Account.clearAllMessages();
            $rootScope.globals.newMessagesCount = null;
            sessionStorage.removeItem("LoginAccountId");
            if($rootScope.aboutPagesRedirect!==true)
                next ? $state.go(next) : $state.transitionTo('base.home', {});

        });
        $rootScope.addPtnSubClass = function(member_id){
            if($(".repeat_"+member_id).hasClass('ptn-ecp-open')){
                $(".repeat_"+member_id).removeClass('ptn-ecp-open');
                
            }
            else{
                $(".repeat_"+member_id).addClass('ptn-ecp-open');
                
            }
        };
        // Logout
        $rootScope.logout = function () {
            $rootScope.$broadcast('logout');
        };

        if (preferredLanguage) {
            setDefaultLocale(preferredLanguage);
        } else {
            BrowserLanguage.prefersChinese()
                .then(function (prefersChinese) {
                    if (!prefersChinese) {
                        setDefaultLocale('en-US');
                        return;
                    }

                    setDefaultLocale('zh-CN');
                });
        }

        $rootScope.$on(localeEvents.localeChanges, function (event, data) {
            setDefaultLocale(data);
        });

        function setDefaultLocale(lang) {
            localeConf.defaultLocale = lang;
            locale.setLocale(lang);

            $rootScope.globals.language = lang;
            Store.put('preferredLanguage', lang);
            iaSettings.setLanguage(lang);
        }

        function resetErrorMessagesAndOtherFlags() {
            $rootScope.farewell = false;
            $rootScope.globals.stateShowSpinner = false;
            $rootScope.passwordVerified = false;

            // Current View Mode.
            $rootScope.viewMode = false;
            $rootScope.previewMode = false;
            $rootScope.editMode = false;
            $rootScope.shareMode = false;
            $rootScope.thirdPartyMode = false;
            $rootScope.setEcpPermission = false;
            $rootScope.publicMode = false;
        }
    })

    /**
     * Main Controller
     */
    .controller('MainController',['$rootScope','$scope','iaSettings','Auth','$location','$window', function ($rootScope, $scope,iaSettings,Auth,$location,$window) {
       // if(!Auth.isLogged()){
         var promo = $location.search().promo;
         $rootScope.promo = promo;
           var lang = $location.search().lang;
            if(!_.isUndefined(lang)){
                $rootScope.globals.language =lang// 'zh-CN';'en-US'
                iaSettings.setLanguage(lang);
            }
      //  }
        
        $rootScope.isemailavailableformember= false;
        $rootScope.isemailalreadyexistformember= false;
        $rootScope.isemailactiveformember = false;
        $rootScope.isemailrequiredformember = false;

        $rootScope.isSafariPrivate = false;
        $scope.isVisible = function isElementInViewport (el) {

                if (typeof jQuery === "function" && el instanceof jQuery) {
                    el = el[0];
                }

                var rect = (!_.isUndefined(el))? el.getBoundingClientRect(): '';


                return (
                    rect.bottom <= (document.documentElement.clientHeight) + 100 /*or $(window).height() */
                );
            }

        if (!$rootScope.synced) {
            $rootScope.synced = {
                status: null,
                member: null
            };
        }

        //lazy load youtube iframes
        var youtube = document.querySelectorAll('.youtube');

        _.forEach(youtube, function (yt){

            // var source = "https://img.youtube.com/vi/"+yt.dataset.embed+"/sddefault.jpg";
            var source = "images/video_sdd"+yt.dataset.index+".jpg";
            var text = document.createTextNode(yt.dataset.title);
            var span = document.createElement('span');
                span.setAttribute('class', 'play-title');
                span.appendChild(text);

            var image = new Image();
                image.src = source;
                image.addEventListener("load", function(){
                    yt.appendChild(image);
                    yt.appendChild(span);
                }.bind(this));

            yt.addEventListener("click", function(){

                var iframe = document.createElement("iframe");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://www.youtube.com/embed/"+this.dataset.embed+"?rel=0&showinfo=0&autoplay=1");

                this.innerHTML = "";
                this.appendChild(iframe);

            });

        });
        
        //var browserDetail = navigator.userAgent;
        //if(browserDetail.indexOf('Edge') >0)
        //{
          //  $rootScope.isSafariPrivate = true;            
        //}


  if (typeof localStorage === 'object') {
    try {
        localStorage.setItem('localStorage', 1);
        localStorage.removeItem('localStorage');
        } catch (e) {
            Storage.prototype._setItem = Storage.prototype.setItem;
            Storage.prototype.setItem = function () { };
            $rootScope.isSafariPrivate = true;
            //alert('Your web browser does not support storing settings locally. In Safari, the most common cause of this is using "Private Browsing Mode". Some settings may not save or some features may not work properly for you.');
        }
    }
        $rootScope.globals.currentYear = moment().year();
    }])

    /**
     * Account Controller
     */
    .controller('AccountController', function ($state, $rootScope, $scope, $controller, Auth, Socket,Account,locale,MEDIA_BASE,$window,AuthToken,$http,iaSettings,Restangular,$cookies,$modal ) {
        
        /// disable coupon change validation
// $(document).ready(function(){ 
//     $('#couponSpinner').css('display','none');
//    $('#couponElement').focusout(function () {
//      $rootScope.redirecting=true; // to stop global spinner
//      $('#couponSpinner').css('display','block');
//     if($('#couponElement')[0].value.length>2){
//         $('#couponCheck').css('display','block');
//         $('#couponCross').css('display','none');
//     }
//     else
//     {
//         $('#couponCheck').css('display','none');
//         $('#couponCross').css('display','block');
//     }
//         Restangular.one("partners/key").get()
//                .then(function(res) {
//                     $rootScope.redirecting=false; // to stop global spinner
//            $('#couponSpinner').css('display','none');
//                },
//                function(error) {
//                  $rootScope.redirecting=false; // to stop global spinner
//            $('#couponSpinner').css('display','none');
//             });
    
    
//  });
             
//  });
        $rootScope.isEditPage= false;
        $scope.miniloader = function(){
            $scope.isPrintLoading = true;
            setTimeout(
            function() {
              $scope.isPrintLoading = false;
            }, 2000);
        }

        $scope.addClass = function(){
            if ($(".ecp_list_details").hasClass("slideup"))
                $(".ecp_list_details").removeClass("slideup").addClass("slidedown");
            else
               $(".ecp_list_details").removeClass("slidedown").addClass("slideup");
        }
        $scope.addSubClass = function(member_id){
            if($(".tr_"+member_id).hasClass('members_sub')){
                $(".tr_"+member_id).removeClass('members_sub');
                $(".tr_"+member_id).closest('tr').next('tr').find('span .more_txt_function').removeClass('hide');
                if(!($rootScope.isandroidapp || $rootScope.isiphoneapp))
                    $(".tr_"+member_id).closest('tbody').find('.white-margin').remove();
            }
            else{
                $(".tr_"+member_id).addClass('members_sub');
                $(".tr_"+member_id).closest('tr').next('tr').find('span .more_txt_function').addClass('hide');
                if(!($rootScope.isandroidapp || $rootScope.isiphoneapp))
                    $(".tr_"+member_id).closest('tbody').append('<tr class="white-margin"><td colspan="6"></td></tr>');
            }
        }
        

        $rootScope.openFIN =  Config.MEDIA_BASE + 'media/qr/iCE_';

        $scope.downloadScreen = function(member_idVal){
            if( $rootScope.reqLoading){
                return false;
            }

            $rootScope.redirecting=true; // to stop global spinner
            $rootScope.reqLoading = true;
            $scope.showError = false; 
            var token = AuthToken.get();
            var req = {
                        method: 'GET',
                        url: Config.API_BASE+'/lockscreen?memberid='+member_idVal,
                        headers: {
                          'X-Authorization':'Bearer ' + token,
                          'Accept-Language': iaSettings.getLanguage()
                        } 
                      }
            $http(req)
                .then(function(res)
                    {

				//  if (navigator.appVersion.toString().indexOf('.NET') > 0){

				//          window.navigator.msSaveBlob(res.data.url, 'image/jpg');
				//  }
				// else
                $rootScope.lockScreenUrl = res.data.url;
                if(navigator.userAgent.toLowerCase().match(/MicroMessenger/i) == "micromessenger"){
                   
                    var modalwechatpdfInstance = $modal.open({
                        backdrop: false,
                        backdropClick: false,
                        dialogFade: false,
                        keyboard: true,
                        size: 'sm',
                        templateUrl: 'partials/modal/show-lockscreen.html',
                        scope: $scope,
                        controller: function () {
                            $scope.cancelpdflinkpopup = function () {
                                modalwechatpdfInstance.close();
                            };

                            $scope.cancel = function () {
                                modalwechatpdfInstance.close();
                            };
                        }
                    });

                }else{
				        var anchor = angular.element('<a/>');
                            anchor.css({display: 'none'});
                            angular.element(document.body).append(anchor);
                            anchor.attr({
                                href: res.data.url,
                                target: '_self',
                                download: 'iCE_wallpaper.jpg'
                            })[0].click();                                
                            anchor.remove();
                        }
                        $rootScope.redirecting=false;
                        $rootScope.reqLoading = false;
                    }, 
                    function(error)
                    {
                        $rootScope.reqLoading = false;
                        $scope.showError = true;              
                    });
        }

        $scope.resendContactNomination = function(member_id, contact_email){
            Account.resendContactNomination(member_id, contact_email).then(function(res) {
                    var token = 'messages.resendNominationSuccess';

                    if (locale.isToken(token)) {
                        locale.ready(locale.getPath(token)).then(function () {
                            setTimeout(function() {
                                window.alert(locale.getString(token, {}));
                            }, 500);
                        });
                    }
                });
        }

        $scope.goPermissionPage = function(account_id, member_id, contact){
                if ($rootScope.previewMode) {
                    return false;
                }
                
                if (account_id == contact.id) {
                    return false;
                } else {
                    
                    if (contact.status == 'accepted') {
                        $state.transitionTo('account.setEcpPermission', {member_id: member_id, contact_id: contact.id});
                    } else {
                        return false;
                    }
                }
        }

         $scope.propertyName = 'ice_id';
 		 $scope.reverse = true;
  		 $scope.showFinEcp = false;

        $scope.sortBy = function(propertyName) {
		    $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
    		$scope.propertyName = propertyName;
        };
        if($cookies.downloadCardDetail)
        {
            $scope.showDownloadCard = false;
        }
    })

    /**
     * Reset password controller.
     **/
    .controller('ResetPasswordController', ['$rootScope', '$scope', '$state', '$stateParams', 'Account', function($rootScope, $scope, $state, $stateParams, Account) {
        var errors = [];
        $scope.resetPasswordSuccess = false;
        $scope.new_password = null;
        $scope.repeat_password = null;

        $scope.errors = [];

        $scope.resetPassword = function(form, password) {
            Account.resetPassword(password, $stateParams.reset_code).then(
                function() {
                    $scope.errors = [];
                    $scope.resetPasswordSuccess = true;
                    $scope.new_password = null;
                    $scope.repeat_password = null;
                    form.$setPristine();
                },
                function(err) {
                    errors = [];
                    errors.push(err.data.error);
                    $scope.errors = errors;
                }
            );
        };
    }])

    .controller('PagesController', ['$scope', '$compile', '$state', '$location', 'iaSettings', 'pages', function($scope, $compile, $state, $location, iaSettings, pages) {
        $scope.page = {
            title: pages['title_' + iaSettings.getLanguage()],
            content: pages['body_' + iaSettings.getLanguage()]
        };
    }])
    .controller('AndroidDeviceAppController', ['$rootScope', '$scope', '$compile', '$state', '$location', 'iaSettings', function($rootScope,$scope, $compile, $state, $location, iaSettings) {
        $rootScope.androidchinaapppath = Config.ANDROID_PLAYSTORE_APP_URL+'&hl=zh-CN';
        $rootScope.androidplaystoreapppath = Config.ANDROID_PLAYSTORE_APP_URL+'&hl=en-US';
        $rootScope.iphoneappdownloadurl = Config.IPHONE_APP_URL;
        $rootScope.iphoneappdownloadurlchina = Config.IPHONE_APP_URL_CHINA;
     }]);
