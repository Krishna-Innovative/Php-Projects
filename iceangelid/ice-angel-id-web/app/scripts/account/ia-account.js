(function () {
    'use strict';

    angular.module('iaAccount', ['ngImgCrop','ngclipboard','zingchart-angularjs'])

    .run(function ($rootScope, Auth, Account, $window) {
        if (Auth.isLogged()) {
            $rootScope.logged = true;
            Account.get();
            if(Auth.isPartner()){
                Account.getApiKeyForPartner();
            }
        }
        $window.localStorage.removeItem(Config.API_BASE + '/pages/about');
        $window.localStorage.removeItem(Config.API_BASE + '/pages/privacy');
        $window.localStorage.removeItem(Config.API_BASE + '/pages/faq');
        $window.localStorage.removeItem(Config.API_BASE + '/pages/terms');
        $rootScope.$on('events.received', Account.get);

        angular.element(document).ready(function () {
           if(jQuery.browser && jQuery.browser.mobile){
            $rootScope.isMobile = true;
        }
    });
    }) 

    .factory('Account', function ($http,$rootScope, $q, $filter, Restangular, RequestCache, Store, iaSettings, API_BASE,AuthToken,MEDIA_BASE,$timeout,Alert) {
        var account = null,
        guardians = [],
        contacts = null,
        friends = null,
        messages = [],
        nonViewedMessages = [],
        accountAccess = false,
        attempts = 0,
        needHelp = false,
        changeSecurityAttempts = 0,
        language = null,
        accountPromise = null;

            // This will keep the account in the $rootScope always updated.
            $rootScope.$watch(function () { return account; }, function () {
                $rootScope.account = account;
            });

            return {
                // Account CRUD
                register: register,

                get: get,
                getApiKeyForPartner:getApiKeyForPartner,
                update: update,
                updateLanguage: updateLanguage,
                destroy: destroy,
                accountUpdated: accountUpdated,
                transfer: transfer,
                resetAccount: resetAccount,
                resetLanguage: resetLanguage,
                resetAccountForTokenLogin: resetAccountForTokenLogin,
                registerDeviceToken: registerDeviceToken,
                getAccountNeedHelp: getAccountNeedHelp,
                updateAccountEmail: updateAccountEmail,
                validatePhoneNumber: validatePhoneNumber,
                // Members
                addMember: addMember,
                getMember: getMember,
                getMemberHistory: getMemberHistory,
                updateMember: updateMember,
                removeMember: removeMember,
                validateMemberEmail: validateMemberEmail,
                validateEmailAvailable: validateEmailAvailable,
                validateProduct:validateProduct,
                validateVaccineProduct:validateVaccineProduct,

                // Account guardians CRUD
                getAllGuardians: getAllGuardians,
                sendGuardianEmailNomination: sendGuardianEmailNomination,
                cancelGuardianRequest: cancelGuardianRequest,
                removeGuardian: removeGuardian,
                acceptGuardianRequest: acceptGuardianRequest,
                declineGuardianRequest: declineGuardianRequest,
                resendGuardianNomination: resendGuardianNomination,

                // Account contact CRUD
                getAllContacts: getAllContacts,
                nominateSelfContact: nominateSelfContact,
                sendContactEmailNomination: sendContactEmailNomination,
                cancelContact: cancelContact,
                removeContact: removeContact,
                acceptContactRequest: acceptContactRequest,
                declineContactRequest: declineContactRequest,
                resendContactNomination: resendContactNomination,

                // Account messages
                getAccountMessages: getAccountMessages,
                getCurrentMessages: getCurrentMessages,
                addMessages: addMessages,
                removeMessage: removeMessage,
                getNonViewedMessages: getNonViewedMessages,
                fetchNonViewedMessages: fetchNonViewedMessages,
                updateMessagesStatus: updateMessagesStatus,
                viewedMessagesStatus: viewedMessagesStatus,
                viewMessages: viewMessages,
                clearAllMessages: clearAllMessages,

                // Account Friends
                getFriends: getFriends,

                // Account Guardian / Contact For.
                removeGuardianFor: removeGuardianFor,
                removeContactFor: removeContactFor,

                // Login Help
                sendHelp: sendHelp,

                // Profile
                getSharedProfile: getSharedProfile,
                getEmergencyContactPermission: getEmergencyContactPermission,
                setEmergencyContactPermission: setEmergencyContactPermission,
                updateShareProfilePermission: updateShareProfilePermission,
                memberShareEvent: memberShareEvent,

                // Share
                shareByEmail: shareByEmail,
                forwardByEmail: forwardByEmail,

                // Password
                resetPassword: resetPassword,
                changePassword: changePassword,
                checkPassword: checkPassword,
                verifiedPassword: verifiedPassword,

                // Forget Password Security Questions
                getSecurityQuestions: getSecurityQuestions,
                getAccountSecurityQuestions: getAccountSecurityQuestions,
                forgetPasswordSecurityQuestionVerification: forgetPasswordSecurityQuestionVerification,
                resetAttempts: resetAttempts,
                getForgetPasswordSecurityQuestionAttempts: getForgetPasswordSecurityQuestionAttempts,

                // Resend Active Account
                resendActiveEmail: resendActiveEmail,

                // Change Security Question
                getChangeSecurityQuestionsAttempts: getChangeSecurityQuestionsAttempts,
                resetChangeSecurityQuestionAttempts: resetChangeSecurityQuestionAttempts,
                checkSecurityQuestion: checkSecurityQuestion,

                // Sync Devices
                sync: sync,
                unsync: unsync,
                acceptSync: acceptSync,
                declineSync: declineSync,

                // Events
                updateEcp: updateEcp,
                removeFinGuardian: removeFinGuardian,
                removeFinEcp: removeFinEcp,
                updateGuardian: updateGuardian,

                //ECP
                addPartnerAccount:addPartnerAccount,
                removeECPFromPartner:removeECPFromPartner,

                //Stripe
                subscribePayment:subscribePayment,
                //StripeCoupon
                subscribePaymentAfterCoupon:subscribePaymentAfterCoupon,
                //StripeAlipay
                subscribePaymentAlipay:subscribePaymentAlipay,
                createAlipaySource : createAlipaySource
            };

            /**
             * Unset all account information
             */
             function resetAccount () {
                account = null;
                guardians = [];
                contacts = null;
                friends = null;
                messages = [];
                accountAccess = false;
                nonViewedMessages = [];
                attempts = 0;
                changeSecurityAttempts = 0;
                needHelp = false;
                accountPromise = null;
                language = null;
                clearCache();
            }

            function resetLanguage (){
               // account = null;
                //messages = [];
               // accountAccess = false;
                //nonViewedMessages = [];
               // accountPromise = null;
               language = null;
           }

           function resetAccountForTokenLogin () {
            account = null;
            guardians = [];
            contacts = null;
            friends = null;
            messages = [];
            accountAccess = false;
            nonViewedMessages = [];
            attempts = 0;
            changeSecurityAttempts = 0;
            needHelp = false;
            accountPromise = null;
            language = null;
            RequestCache.clear('/account', {});
        }

        function clearCache() {
            var contents = Store.get(API_BASE + '/contents');
            var about = Store.get(API_BASE + '/pages/about');
            var faq = Store.get(API_BASE + '/pages/faq');
            var terms = Store.get(API_BASE + '/pages/terms');
            var privacy = Store.get(API_BASE + '/pages/privacy');
            var privacypolicy = Store.get(API_BASE + '/pages/privacypolicy');
            var device = Store.get('device');
            var isNotFirstTimeLaunch = Store.get('isNotFirstTimeLaunch');

            RequestCache.removeAll();

                // Reset the long time caches
                device && Store.put('device', device);
                isNotFirstTimeLaunch && Store.put('isNotFirstTimeLaunch', isNotFirstTimeLaunch);
                contents && Store.put(API_BASE + '/contents', contents);
                about && Store.put(API_BASE + '/pages/about', about);
                faq && Store.put(API_BASE + '/pages/faq', faq);
                terms && Store.put(API_BASE + '/pages/terms', terms);
                privacy && Store.put(API_BASE + '/pages/privacy', privacy);
                privacypolicy && Store.put(API_BASE + '/pages/privacypolicy', privacypolicy);
            }

            /**
             * Account register
             *
             * @param data
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function register (data) {
                var deferred = $q.defer();

                if (Store.get($rootScope.nomination)) {
                    data.nomination = Store.get($rootScope.nomination);
                }

                data.language = iaSettings.getLanguage() || iaSettings.getLanguage();

                Restangular.all('account').all('register').post(data).then(
                    function (res) {
                        account = res.account;

                        //Remove nomination storage.
                        Store.remove($rootScope.nomination);
                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/account', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Get account via auth-token
             *
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function get () {

                var aliPayPaymentStatus = sessionStorage.getItem("alipayPaymentSuccess");
                var refreshAccountVal = sessionStorage.getItem("refreshAccountDetails");
                if( aliPayPaymentStatus === "true")
                {
                    account = null;
                    sessionStorage.setItem("alipayPaymentSuccess", null);
                }

                if(refreshAccountVal === "true"){
                    account = null;
                    sessionStorage.setItem("refreshAccountDetails", null);
                }
                if (account) {
                    return $q(function (resolve) {
                        resolve(account);
                    });
                }
                
                if (accountPromise) {
                    return accountPromise;
                }

                accountPromise = Restangular.one('account').withHttpConfig({ cache: false}).get()
                .then(function(account) {
                    Alert.clearAll();
                    AuthToken.setAccount(account);                    
                    $rootScope.$broadcast('accountLanguage', account.language || iaSettings.getLanguage());
                    $rootScope.openImage =  MEDIA_BASE + 'media/qr/iCE_' +account.ice_id+'.png';
                    $rootScope.openImageLoad = false;
                    checkQrImage($rootScope.openImage);
                    onAccountRetrieved(account);
                    return account;
                })
                .catch(function (err) {
                    RequestCache.clear('/account', {});
                    return err;
                })
                .finally(function () {
                    accountPromise = null;
                });
                
                return accountPromise;

                function onAccountRetrieved (newAccount) {
                    account = newAccount;
                    angular.forEach(account.members, function(member, index) {
                        account.members[index].synced = !!member.devices.length;
                        if((member.birth_date.year && member.birth_date.year !=='') && (member.birth_date.month && member.birth_date.month !=='') && (member.birth_date.day && member.birth_date.day !=='')){
                            account.members[index].getfulldob = new Date(member.birth_date.year+'-'+member.birth_date.month+'-'+member.birth_date.day);
                        }
                        else{
                            account.members[index].getfulldob = new Date('1200-1-1');
                        }
                    });

                    return account;
                }
            }

            function checkQrImage(src)
            {
                var deferred = $q.defer();
                var image = new Image();
                image.onerror = function() {
                    //window.console.clear();
                    deferred.resolve(false);
                    $rootScope.openImageLoad = false;
                };
                image.onload = function() {
                    //window.console.clear();
                    deferred.resolve(true);
                    $rootScope.openImageLoad = true;
                };
                image.src = src;
                //window.console.clear();
                return deferred.promise;
            }
            /**
             * Get Partner Api key via auth-token
             *
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function getApiKeyForPartner () {
               var deferred = $q.defer();

               Restangular.one("partners/key").get()
               .then(function(res) {
                   $rootScope.apiKey = res.key;
                   deferred.resolve(res);
               },
               function(error) {
                RequestCache.clear('/account', {});

                deferred.reject(error);
            });

               return deferred.promise;

           }

            /**
             * Update user account.
             *
             * @param data
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function update (data) {



                var deferred = $q.defer();

                Restangular.one('account').customPUT(data).then(
                    function(res) {

                        angular.extend(account, res);

                        language = res.language;

                        $rootScope.$broadcast('accountLanguage', language || 'en');

                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function(error) {
                        RequestCache.clear('/account', {});

                        deferred.reject(error);
                    });

                return deferred.promise;
            }

            /**
             * Update account language in http cache.
             *
             * @param lang
             */
             function updateLanguage (lang) {
                language = lang.split('-')[0];
            }

            /**
             * Delete user account.
             *
             * @param data
             * @returns {*|Array}
             */
             function destroy (data) {
                var deferred = $q.defer();

                var eventProperties = {};

                if ('reason' in data){
                    eventProperties.reason_index = 0;
                    eventProperties.reason = '0-' + data.reason;
                }else{
                    eventProperties.reason_index = data.type;
                    eventProperties.reason = data.type + '-' + $filter('i18n')('common.deleteAccountReason'+data.type);
                }

                Restangular.all('account').remove({password: data.password, reason: eventProperties.reason_index}).then(
                    function (res) {
                        eventProperties.failed = false;
                        RequestCache.removeAll();
                        deferred.resolve(res);
                    },
                    function(err) {
                        eventProperties.failed = true;                        
                        deferred.reject(err);
                    }
                    );

                return deferred.promise;
            }

            function accountUpdated (response) {
                account = response.data;

                _.forEach(account.members, function (member) {
                    member.synced = _.any(member.devices, {'status': 1});
                })

                $rootScope.account = response.data;
            }

            /**
             * Transfer member to be account holder.
             *
             * @param member_id
             * @returns {*}
             */
             function transfer (member_id, email) {
                return Restangular.one('members', member_id).one('transfer').customPOST({email: email});
            }

            /**
             * Register device token.
             *
             * @param token
             * @param type
             * @returns {*}
             */
             function registerDeviceToken (token, type) {
                if (account) {
                    return Restangular.one('account', 'deviceTokens').customPOST({
                        token: token || null,
                        type: type || 'ios'
                    });
                }
            }

            /**
             * Get whether account need help.
             *
             * @returns {boolean}
             */
             function getAccountNeedHelp () {
                return needHelp;
            }

            /**
             * Update account email.
             *
             * @param email
             * @param email_confirmation
             * @returns {*}
             */
             function updateAccountEmail (email, email_confirmation) {
                var deferred = $q.defer();
                var lang = iaSettings.getLanguage() || 'en';                
                Restangular.setDefaultHeaders({'Accept-Language': lang});
                Restangular.one('account').one('settings').one('email').customPOST({email: email, email_confirmation: email_confirmation}).then(
                    function (res) {
                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Add a member to the account
             *
             * @param member
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function addMember (member) {
                var deferred = $q.defer();

                Restangular.all('members').post(member).then(
                    function (res) {
                        account.members.push(res);
                        
                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });
                return deferred.promise;
            }

            /**
             * Get member for specific member id.
             *
             * @param id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function getMember (id, dirty) {
                var deferred = $q.defer();
                
                get()
                .then(function (account) {
                    var filteredMembers = $filter('filter')(account.members, {id: id});
                    if (!filteredMembers) {
                        if(filteredMembers.additional_information.personal.home_phone.number==" ")
                        {
                            filteredMembers.additional_information.personal.home_phone.number=null;
                        }
                        if(filteredMembers.additional_information.personal.workplace_phone.number==" ")
                        {
                            filteredMembers.additional_information.personal.workplace_phone.number=null;
                        }
                        return deferred.reject();
                    }

                    var memberExist = filteredMembers[0];
                    if (memberExist) {
                        if(memberExist.additional_information.personal.home_phone != null || memberExist.additional_information.personal.home_phone ==" " || memberExist.additional_information.personal.home_phone != undefined)
                        {
                            if(memberExist.additional_information.personal.home_phone.number==" ")
                            {
                                memberExist.additional_information.personal.home_phone.number=null;
                            }
                        }
                        if(memberExist.additional_information.personal.workplace_phone != null || memberExist.additional_information.personal.workplace_phone ==" " || memberExist.additional_information.personal.workplace_phone != undefined)
                        {
                            if(memberExist.additional_information.personal.workplace_phone.number==" ")
                            {
                                memberExist.additional_information.personal.workplace_phone.number=null;
                            }
                        }
                        return deferred.resolve(memberExist);
                    }

                    return deferred.reject();
                });
                return deferred.promise;
            }


            /**
             * Get member history.
             *
             * @returns {*}
             */
             function getMemberHistory (member_id, page) {
                RequestCache.clear('/members/' + member_id + '/history', {page: page});
                return Restangular.one('members', member_id).one('history').get({page: page || 0});
            }

            /**
             * HTTP PUT member updates.
             *
             * @param data
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function updateMember (data) {
                var deferred = $q.defer();
                
                Restangular.one('members', data.id).customPUT(data).then(
                    function(res) {

                        angular.forEach(account.members, function(member, index) {
                            if (member.id == res.id) {
                                account.members[index] = res;
                            }
                        });

                        if (res.id == account.id) {
                            angular.extend(account, res);
                        }

                        $rootScope.$broadcast('updated.member', data);

                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/account', {});

                        deferred.reject(err);
                    });
                return deferred.promise;
            }

            /**
             * HTTP DELETE destroy member.
             *
             * @param id
             * @returns {*|Array}
             */
             function removeMember (id) {
                var deferred = $q.defer();

                Restangular.one('members', id).remove().then(
                    function(res) {
                        angular.forEach(account.members, function(member, index) {
                            if (_.find(member.contacts, {id: account.id})) {
                                account.friends_count--;
                            }

                            if (member.id == id) {
                                account.members.splice(index, 1);
                            }
                        });

                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/account', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Validate Member Email.
             *
             * @param email
             * @param member
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function validateMemberEmail (email, member) {
                var deferred = $q.defer();

                if (member.use_account_email || email == member.email) {
                    deferred.resolve(true);
                } else {
                    deferred.reject({'data' : {'error': {'message' : 'errors.transferMemberEmailRejectedByServer'}}});
                }

                return deferred.promise;
            }

            /**
             * Validate whether email is available from server side.
             *
             * @param email
             * @returns {*}
             */
             function validateEmailAvailable (email, accountId) {
                var deferred = $q.defer();
                Restangular.one('account').one('email').one('exists').get({email: email, id: accountId}).then(
                    function(res) {
                        RequestCache.clear('/' + ['account', 'email', 'exists'].join('/'), {email: email, id: accountId});
                        deferred.resolve(res);
                    },
                    function(err) {
                        deferred.reject(err);
                    }
                    );

                return deferred.promise;
            }

            function validateProduct (sr, pc) {
                var deferred = $q.defer();


                var token = AuthToken.get();
                var req = {
                    method: 'POST',
                    data:{"pcategory":pc,"srnumber":sr},
                    url: Config.API_BASE+'/member/validatecovidrecordweb',
                    headers: {
                        'X-Authorization':$rootScope.apiKey,
                        'Accept-Language': iaSettings.getLanguage()
                    } 
                }
                $http(req)
                .then(function(res){
                    deferred.resolve(res);
                }, 
                function(error)
                {
                    deferred.reject(err);             
                });

                return deferred.promise;
            }

            function validateVaccineProduct (sr, pc) {
                var deferred = $q.defer();


                var token = AuthToken.get();
                var req = {
                    method: 'POST',
                    data:{"pcategory":pc,"srnumber":sr},
                    url: Config.API_BASE+'/member/validatevaccinerecordweb',
                    headers: {
                        'X-Authorization':$rootScope.apiKey,
                        'Accept-Language': iaSettings.getLanguage()
                    } 
                }
                $http(req)
                .then(function(res){
                    deferred.resolve(res);
                },
                function(error)
                {
                    deferred.reject(err);
                });

                return deferred.promise;
            }

            function validatePhoneNumber (number1,code,id,ccode) {
               var deferred = $q.defer();

               Restangular.one('account').one('phonenumber').one('exists').get({number: number1, code: code, id: id,ccode: ccode}).then(
                function (res) {
                    RequestCache.clear('/' + ['account', 'phonenumber', 'exists'].join('/'), {number: number1, code: code, id: id,ccode: ccode});
                    deferred.resolve(res);
                },
                function (err) {
                    deferred.reject(err);
                });

               return deferred.promise;
           }

            /***********************************************
             *
             * Account guardians.
             *
             * @returns {*}
             *
             **********************************************/
             function getAllGuardians () {
                var deferred = $q.defer();

                Restangular.one('guardians').get().then(
                    function (res) {
                        guardians = res;

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/guardians', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Send account guardian nomination request.
             *
             * @param email
             * @returns {*}
             */
             function sendGuardianEmailNomination (email) {
                var deferred = $q.defer();

                Restangular.all('guardians').post({'guardian_email': email}).then(
                    function (res) {
                        account.guardians_count++;
                        guardians.push(res);

                        RequestCache.update('/guardians', {} , guardians);
                        RequestCache.update('/account', {} , account);
                        RequestCache.clear('/contacts', {});

                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Cancel account guardian request.
             *
             * @param email
             * @param index
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function cancelGuardianRequest (email, index) {
                var deferred = $q.defer();

                Restangular.one('guardians', 'cancel').remove({guardian_email: email}).then(
                    function (res) {
                        guardians.splice(index, 1);
                        account.guardians_count--;

                        RequestCache.update('/guardians', {} , guardians || []);
                        RequestCache.update('/account', {} , account);

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/guardians', {});
                        RequestCache.clear('/account', {} , account);

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Remove account guardian.
             *
             * @param guardian_id
             * @param index
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function removeGuardian (guardian_id, index) {
                var deferred = $q.defer();

                Restangular.one('guardians', guardian_id).remove().then(
                    function (res) {

                        guardians.splice(index, 1);
                        account.guardians_count--;

                        RequestCache.update('/guardians', {} , guardians);
                        RequestCache.update('/account', {} , account);
                        RequestCache.clear('/contacts', {});

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/guardians', {} , guardians || []);
                        RequestCache.clear('/account', {} , account);
                        RequestCache.clear('/contacts', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Accept account guardian.
             *
             * @param request_id
             * @param message_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function acceptGuardianRequest (request_id, message_id) {
                var deferred = $q.defer();

                Restangular.one('guardians').one('accept', request_id).post().then(
                    function(res) {
                        angular.extend(res, {message_id: message_id});

                        account.friends_count++;

                        RequestCache.update('/account', {}, account);
                        RequestCache.clear('/friends', {});
                        clearAllMessages();
                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Decline account guardian request.
             *
             * @param request_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function declineGuardianRequest (request_id) {
                return Restangular.one('guardians').one('decline', request_id).remove().then(function(){
                    clearAllMessages();
                });
            }

            /**
             * Get all contacts under one accounts
             *
             * @returns {*}
             */
             function getAllContacts () {
                return Restangular.all('contacts').getList();
            }

            /**
             * Send nominate myself request.
             *
             * @param member_id
             * @param account_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function nominateSelfContact (member_id, account_id) {
                var deferred = $q.defer();

                Restangular.all('contacts').post({member_id: member_id, contact_id: account_id}).then(
                    function(res) {

                        _.find(account.members, {id: member_id}).contacts.push(res);
                        account.friends_count++;

                        sessionStorage.setItem("refreshAccountDetails",true);                        
                        get();
                        //RequestCache.update('/account', {}, account);
                        RequestCache.clear('/friends', {});
                        RequestCache.clear('/contacts', {});

                        deferred.resolve(res);
                    },
                    function(err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Send email nomination request.
             *
             * @param member_id
             * @param email
             * @returns {*}
             */
             function sendContactEmailNomination (member_id, email) {
                var deferred = $q.defer();

                Restangular.all('contacts').post({member_id: member_id, contact_email: email}).then(
                    function (res) {
                        var member;
                        if (member = _.find(account.members, {id: member_id})) {

                            member.contacts.push(res);

                            if (email == account.email) {
                                account.friends_count++;
                            }
                        }

                        RequestCache.update('/account', {}, account);
                        RequestCache.clear('/friends', {});
                        RequestCache.clear('/contacts', {});

                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Cancel member contact request.
             *
             * @param member_id
             * @param email
             * @param contact_index
             * @returns {*|Array}
             */
             function cancelContact (member_id, email, contact_index) {
                var deferred = $q.defer();

                Restangular.one('contacts', 'cancel').remove({member_id: member_id, contact_email: email}).then(
                    function (res) {
                      angular.forEach(account.members, function (member, index) {
                        if (member.id == member_id) {
                            account.members[index].contacts.splice(contact_index, 1);
                        }
                    });

                      RequestCache.update('/account', {}, account);

                      deferred.resolve(res);
                  },
                  function(err) {
                    RequestCache.clear('/account', {});

                    deferred.reject(err);
                });

                return deferred.promise;
            }

            /**
             * Delete member contact.
             *
             * @param member_id
             * @param contact_id
             * @param contact_index
             *
             * @returns {*|Array}
             */
             function removeContact (member_id, contact_id, contact_index) {
                var deferred = $q.defer();

                Restangular.one('contacts', 'remove').remove({member_id: member_id, contact_id: contact_id}).then(
                    function (res) {
                        angular.forEach(account.members, function (member, index) {
                            if (account.id !=contact_id && member.id == member_id) {
                                account.members[index].contacts.splice(contact_index, 1);
                            }
                        });

                        if (account.id == contact_id) {
                            account.friends_count--;
                        }

                        RequestCache.update('/account', {}, account);
                        RequestCache.clear('/contacts', {});

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/account', {});
                        RequestCache.clear('/contacts', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Accept account contact request.
             *
             * @param request_id
             * @param message_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function acceptContactRequest (request_id, message_id) {
                var deferred = $q.defer();

                Restangular.one('contacts').one('accept', request_id).post().then(
                    function (res) {
                        angular.extend(res, {message_id: message_id});
                        account.friends_count++;

                        RequestCache.update('/account', {}, account);
                        RequestCache.clear('/friends', {});
                        RequestCache.clear('/contacts', {});
                        clearAllMessages();
                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });


                return deferred.promise;
            }

            /**
             * Decline account contact request.
             *
             * @param request_id
             * @param reason
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function declineContactRequest (request_id, reason) {
                var deferred = $q.defer();

                Restangular.one('contacts').one('decline', request_id).remove({reason: reason}).then(
                    function(res) {
                        clearAllMessages();
                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/account', {});
                        RequestCache.clear('/contacts', {});
                        deferred.reject(err);
                    }
                    );

                return deferred.promise;
            }

            /**
             * Get account messages.
             *
             * @param page
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function getAccountMessages (page) {
                var deferred = $q.defer();

                Restangular.one('messages').get({page: page || 0}).then(
                    function (res) {
                        if (res.data.length > 0) {
                            addMessages(res.data);
                        }

                        RequestCache.clear('/messages', {page: page});

                        deferred.resolve(res.data);
                    },
                    function (err) {
                        RequestCache.clear('/messages', {page: page});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
            * Retrieves and sets non-viewed messages
            *
            * @returns {Promise.promise|*|Deferred.promise}
            */
            function fetchNonViewedMessages(){

                var deferred = $q.defer();
                var page=0;
                Restangular.one('messages').withHttpConfig({ cache: false}).get({viewed: 0}).then(
                    function(messages){
                        addMessages(messages.data);
                        $rootScope.globals.newMessagesCount = messages.total;
                        if($rootScope.globals.newMessagesCount === 0)
                            $rootScope.globals.newMessagesCount = null;
                        //$rootScope.$broadcast('messages.viewed', nonViewedMessages);
                        deferred.resolve(messages.data);
                    },
                    function (err) {
                        RequestCache.clear('/messages', {page: page});
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Get current messages.
             *
             * @returns {Array}
             */
             function getCurrentMessages () {
                return messages;
            }

            /**
             * Add account messages.
             *
             * @returns {Array}
             */
             function addMessages (newMessages) {

                _.forEach(newMessages, function (newMessage) {

                    if (!messageExists(newMessage)) {
                        if (!newMessage.viewed) {
                            nonViewedMessages.push(newMessage.id);
                        }
                        messages.push(newMessage);

                    } else {
                        if (newMessage.deleted) {
                            if (messageExists(newMessage)){
                                removeMessage(newMessage.id);
                            }
                            nonViewedMessages = _.without(nonViewedMessages, newMessage.id);
                        }
                        else{
                             //swap them
                             var message = _.find(messages, {id: newMessage.id});
                             message.message = newMessage.message;
                         }
                     }
                 });

                return messages;
            }

            /**
             * Remove one specific message from list.
             *
             * @param message_id
             */
             function removeMessage (message_id) {
                angular.forEach(messages, function (message, index) {
                    if (message.id == message_id) {
                        messages.splice(index, 1);

                        if (!message.viewed && $rootScope.globals.newMessagesCount){
                            $rootScope.globals.newMessagesCount -= 1;
                        }
                    }
                });
              //  updateMessagesStatus();
          }

            /**
             * Check if message exists in messages collection.
             *
             * @param search
             * @returns {boolean}
             */
             function messageExists(search) {
                return !!_.find(messages, function (message) {
                    return message.id == search.id;
                });
            }

            /**
             * Get all non viewed messages.
             *
             * @returns {Array}
             */
             function getNonViewedMessages() {
                return nonViewedMessages;
            }

            /**
             * Update nonViewedMessages status.
             */
             function updateMessagesStatus() {
                if (nonViewedMessages) {
                    var ids = nonViewedMessages.join(',');

                    Restangular.one('messages', 'status').customPOST({id: ids}).then(
                        function(res) {

                            _.each(nonViewedMessages, function(message_id) {
                                var message = _.find(messages, {id: message_id});
                                if (message) {
                                    message.viewed = true;
                                }
                            });

                            nonViewedMessages = [];

                            $rootScope.$broadcast('messages.viewed', nonViewedMessages);

                        }
                        );
                }
            }

            /**
             * Viewed Messages status.
             */
             function viewedMessagesStatus() {
                Restangular.one('messages/viewed').post().then(
                    function(res) {
                        nonViewedMessages = [];
                        $timeout(function() { 
                            $rootScope.globals.newMessagesCount = null;
                        }, 2000);
                        $rootScope.$broadcast('messages.viewed', nonViewedMessages);
                    });                
            }

            /**
             * View messages
             *
             * @param ids
             */
             function viewMessages (ids) {
                _.each(ids, function(message_id) {
                    var message = _.find(messages, {id: message_id});
                    message.viewed = true;
                });
            }

            /**
             * Clear messages
             */
             function clearAllMessages () {
                messages = [];
                nonViewedMessages = [];
            }

            /**
             * Get account friends.
             *
             * @returns {*|Array|ng.ui.IState|ng.ui.IState[]|Object}
             */
             function getFriends () {
                var deferred = $q.defer();

                Restangular.one('friends').get().then(
                    function (res) {
                        if (account) {
                            var friendsLength = parseInt(res.guardians.length) + parseInt(res.contacts.length);
                            if (account.friends_count != friendsLength) {
                                account.friends_count = friendsLength;
                                RequestCache.update('/account', {}, account);
                            }
                        }

                        friends = res;

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Remove account guardian for.
             *
             * @param guardian_id
             * @param index
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function removeGuardianFor (guardian_id, index) {
                var deferred = $q.defer();

                Restangular.one('friends').one('guardians', guardian_id).remove().then(
                    function (res) {
                        account.friends_count--;
                        friends.guardians.splice(index, 1);

                        RequestCache.update('/account', {}, account);
                        RequestCache.update('/friends', {}, friends);

                        deferred.resolve(res);
                    },
                    function (err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Remove account contact for.
             *
             * @param contact_id
             * @param index
             * @returns {*|Array}
             */
             function removeContactFor (contact_id, index) {
                var deferred = $q.defer();

                Restangular.one('friends').one('contacts', contact_id).remove().then(
                    function (res) {
                        var member;
                        if (member = _.find(account.members, {id: contact_id})) {
                            angular.forEach(member.contacts, function (contact, index) {
                                if (contact.id == account.id) {
                                    member.contacts.splice(index, 1);
                                }
                            });
                        }

                        account.friends_count--;
                        friends.contacts.splice(index, 1);

                        RequestCache.update('/account', {}, account);
                        RequestCache.update('/friends', {}, friends);

                        deferred.resolve(res);
                    },
                    function (err) {
                        RequestCache.update('/friends', {}, friends);
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Resend guardian nomination
             */
             function resendGuardianNomination (email) {
                return Restangular.one('guardians').one('resend').customPOST({email: email});
            }

            /**
             * Resend contacts nomination
             */
             function resendContactNomination (member_id, contact_email) {
                return Restangular.one('contacts').one('resend').customPOST({member_id: member_id, contact_email: contact_email});
            }

            /**
             * Send login help
             *
             * @param data
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function sendHelp (data) {
                return Restangular.one('support').customPOST(data);
            }

            /**
             * Get access to friend profile.
             *
             * @param token
             * @returns {*|Array|ng.ui.IState|ng.ui.IState[]|Object|Mixed}
             */
             function getSharedProfile (token) {
                return Restangular.one('members', 'public').one(token).get();
            }

            /**
             * Get ememrgency contact permissions.
             *
             * @param member_id
             * @param contact_id
             * @returns {*}
             */
             function getEmergencyContactPermission (member_id, contact_id) {
                var deferred = $q.defer();
                
                Restangular.one('members', member_id).one('contacts', contact_id).one('permissions').get().then(
                    function(res) {

                        res.permission || (res.permission = {});
                        if (res.permissions.personal == null) {
                            res.permissions.personal = {};
                        }

                        if (res.permissions.medical.blood == null) {
                            res.permissions.medical.blood = {};
                        }

                        if (res.permissions.medical.organ_donor == null) {
                            res.permissions.medical.organ_donor = {};
                        }

                        deferred.resolve(res);
                        RequestCache.clear('/members/' + member_id + '/contacts/' + contact_id + '/permissions', {});
                    }
                    );

                return deferred.promise;
            }

            /**
             * Set emergency contact permissions.
             *
             * @param member_id
             * @param contact_id
             * @param fileds
             * @returns {*}
             */
             function setEmergencyContactPermission (member_id, contact_id, fileds) {
                var deferred = $q.defer();

                // remove all isAllSelected from payload
                _.each(fileds, function(value, sKey){
                    if (_.has(value, 'fields')){
                        _.remove(value['fields'], function(v) { return v == 'isAllSelected'});
                    }else{

                        _.each(value, function (val, key){
                            if(_.isArray(val)){
                                _.each(val, function(item, k){
                                    _.remove(item['fields'], function(v) { return v == 'isAllSelected'});
                                })
                            }else {
                                _.remove(val['fields'], function(v) { return v == 'isAllSelected'});
                            }
                        });

                    }
                });

                var data = {member_id: member_id, contact_id: contact_id, permissions: fileds};
                var url = ['/members',member_id,'contacts', contact_id, 'permissions'].join('/');
                
                Restangular.one('members', member_id).one('contacts', contact_id).one('permissions').customPUT(data).then(
                    function(res) {
                     RequestCache.clear(url, {});
                     deferred.resolve(res);
                 },
                 function(err) {
                    RequestCache.clear(url, {});
                    deferred.reject(err);
                }
                );

                return deferred.promise;
            }

            /**
             * Update share profile permission for one member.
             *
             * @param data
             * @returns {*}
             */
             function updateShareProfilePermission (data) {
                return Restangular.one('members', data.id).customPUT(data);
            }

            /**
             * Share ice id.
             *
             * @param member
             * @returns {*}
             */
             function shareByEmail (member, email, profile) {
                return Restangular.one('members', member.id).one('share').customPOST({type: 'email', email: email, profile: profile});
            }

            /**
             * Forward an existing public profile by email
             *
             * @param public profil token
             * @returns {*}
             */
             function forwardByEmail (email, token) {
                var lang = iaSettings.getLanguage() || 'en';
                return Restangular.one('members/public', token).one('forward').customPOST({email: email, language: lang});
            }

            //Route::post('members/public/{token}/forward', ['as' => 'member.forward-shared', 'uses' => 'ShareController@forwardProfile']);

            /**
             * Share member profile event.
             *
             * @param member
             * @param type
             * @returns {*}
             */
             function memberShareEvent (member, type) {
                var data = {additional_information: member.additional_information, type: type};
                return Restangular.one('members', member.id).one('share').customPOST(data);
            }

            /**
             * Reset password
             *
             * @param password
             * @param reset_code
             */
             function resetPassword (password, reset_code) {
                return Restangular.one('password', 'reset').customPOST({
                    'new_password': password,
                    'reset_code': reset_code
                });
            }

            /**
             * check password
             *
             * @param password
             * @returns {*}
             */
             function checkPassword (password) {
                var deferred = $q.defer();

                Restangular.one('account', 'checkPassword').customPOST({password: password}).then(
                    function (res) {
                        accountAccess = true;
                        deferred.resolve(res);
                    },
                    function (err) {
                        accountAccess = false;
                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Change account password.
             *
             * @param password
             * @returns {*}
             */
             function changePassword (password) {
                return Restangular.one('account').one('settings', 'password').customPOST({
                    password: password.current,
                    new_password: password.new,
                    new_password_confirmation: password.new //password.new_repeat
                });
            }

            /**
             * Check whether account pass the password verification.
             */
             function verifiedPassword () {
                return !!accountAccess;
            }

            /**
             * Security Questions
             */
            /**
             * Reset error times for security question 1.
             */
             function resetAttempts () {
                attempts = 0;
            }

            /**
             * Get account security questions.
             *
             * @param email
             * @returns {*}
             */
             function getSecurityQuestions (email) {

                var data = {email: (_.isEmpty(email) ? account.email : email)};
                var deferred = $q.defer();

                Restangular.one('password', 'remind').get(data).then(
                    function (res) {
                        RequestCache.clear('/password/remind', data);

                        deferred.resolve(res);
                    },
                    function(error) {
                        RequestCache.clear('/password/remind', data);

                        deferred.reject(error);
                    });

                return deferred.promise;
            }

            /**
             * Get login user's security questions.
             *
             * @returns {Array|questions|*}
             */
             function getAccountSecurityQuestions (account) {
                var questions = [];

                questions.push(
                    $rootScope.globals.settings.security_questions.find({id: account.security_question_1}),
                    $rootScope.globals.settings.security_questions.find({id: account.security_question_2})
                    );

                return questions;
            }

            /**
             * Verify the first security question.
             *
             * @param answer
             * @param email
             * @param question_num
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function forgetPasswordSecurityQuestionVerification (answer, email, question_num) {
                var data = {
                    answer: answer,
                    email: (_.isEmpty(email) ? account.email : email),
                    question_num: question_num,
                    attempts: ++attempts
                };

                var deferred = $q.defer();

                Restangular.one('password', 'remind').customPOST(data).then(
                    function (res) {
                        resetAttempts();

                        RequestCache.clear('/account', {});

                        needHelp = false;

                        deferred.resolve(res);
                    },
                    function (err) {
                        $rootScope.$broadcast('captcha_error');

                        RequestCache.clear('/account', {});

                        if (question_num == 2 && attempts == 3) {
                            needHelp = true;
                        }

                        deferred.reject(err);
                    });


                return deferred.promise;
            }

            /**
             * Verify the security question for change security question part.
             *
             * @param answer
             * @param question_num
             * @returns {*}
             */
             function checkSecurityQuestion (answer, question_num) {
                var deferred = $q.defer();

                var data = {
                    answer: answer,
                    question_num: question_num,
                    attempts: ++changeSecurityAttempts
                };

                Restangular.one('account').one('settings', 'security-answer').customPOST(data).then(
                    function(res) {
                        resetChangeSecurityQuestionAttempts();

                        needHelp = false;

                        deferred.resolve(res);
                    },
                    function(err) {
                        if (question_num == 2 && changeSecurityAttempts == 3) {
                            needHelp = true;
                        }

                        $rootScope.$broadcast('captcha_error');

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Resend active email.
             *
             * @returns {number}
             */
             function resendActiveEmail (email) {
                return Restangular.one('account').one('activation-code').customPOST({email: email});
            }

            /**
             * Get the first security question wrong times.
             *
             * @returns {number}
             */
             function getForgetPasswordSecurityQuestionAttempts () {
                return attempts;
            }

            /**
             * Reset change security question attmepts
             */
             function resetChangeSecurityQuestionAttempts () {
                changeSecurityAttempts = 0;
            }

            /**
             * Get change security questions attempts.
             *
             * @returns {number}
             */
             function getChangeSecurityQuestionsAttempts () {
                return changeSecurityAttempts;
            }

            /**
             *
             * @param uuid
             * @param member_id
             */
             function sync (uuid, member_id) {
                var deferred = $q.defer();

                Restangular.one('sync', 'devices').one(uuid, 'accept').post().then(
                    function (res) {

                        var device = _.find(_.find(account.members, {id: member_id}).devices, {uuid: uuid});
                        angular.extend(device, res);

                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);
                    },
                    function (error) {
                        RequestCache.clear('/account', {});

                        deferred.reject(error);
                    });

                return deferred.promise;
            }

            /**
             * Unsync device from member controller.
             *
             * @param uuid
             * @param member_id
             * @returns {*}
             */
             function unsync (uuid, member_id) {
                var deferred = $q.defer();

                Restangular.one('sync', 'devices').one(uuid, 'decline').remove().then(
                    function (res) {

                        _.remove(_.find(account.members, {id: member_id}).devices, {uuid: uuid});

                        RequestCache.update('/account', {}, account);

                        deferred.resolve(res);

                    },
                    function (error) {
                        RequestCache.clear('/account', {});

                        deferred.reject(error);
                    });

                return deferred.promise;
            }


            /**
             * Accept account guardian.
             *
             * @param uu_id
             * @param message_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function acceptSync (uu_id, message_id) {
                var deferred = $q.defer();

                Restangular.one('sync/devices', uu_id).one('accept').post().then(
                    function(res) {
                        angular.extend(res, {message_id: message_id});

                        // account.friends_count++;
                        var dev_index = null;
                        var acc_index = 0;

                        _.forEach(account.members, function(member){
                            dev_index = _.findIndex(member.devices, {'uuid': uu_id});
                            if (!dev_index){
                                acc_index++;
                            }
                        });

                        if (!_.isNull(dev_index)){
                            $rootScope.account.members[acc_index].devices[dev_index].status = 1;
                        }

                        RequestCache.update('/account', {}, account);
                        RequestCache.clear('/friends', {});

                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });

                return deferred.promise;
            }

            /**
             * Decline account guardian request.
             *
             * @param uu_id
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function declineSync (uu_id) {
                return Restangular.one('sync/devices', uu_id).one('decline').remove();
            }



            /**
             * Update ecp.
             *
             * @param data
             * @param remove
             */
             function updateEcp (data, remove) {
                var member = _.find(account.members, {id: parseInt(data.id)});
                _.each(member.contacts, function(contact, index) {
                    if (contact.email == data.data.email) {
                        if (remove) {
                            member.contacts.splice(index, 1);
                        } else {
                            member.contacts[index] = data.data;
                        }

                        sessionStorage.setItem("refreshAccountDetails",true);                        
                        get();
                        RequestCache.update('/account', {}, account);
                    }
                });
            }

            function updateGuardian (data, remove) {
                _.each(guardians, function(guardian, index) {
                    if (guardian.email == data.data.email) {
                        if (remove) {
                            guardians.splice(index, 1);
                            if (account.guardians_count > 0) {
                                account.guardians_count -= 1;
                            }
                        } else {
                            guardians[index] = data.data;
                        }

                        RequestCache.update('/guardians', {}, guardians);
                        RequestCache.update('/account', {}, account);
                    }
                });
            }

            function removeFinGuardian (data) {
                _.each(friends.guardians, function(friendGuardian, index) {
                    if (friendGuardian.id == data.id) {

                        friends.guardians.splice(index, 1);
                        if (account.friends_count > 0) {
                            account.friends_count -= 1;
                        }

                        RequestCache.update('/friends', {}, friends);
                        RequestCache.update('/account', {}, account);
                    }
                });
            }

            function removeFinEcp (data) {
                if (friends) {
                    _.each(friends.contacts, function(friendContact, index) {
                        if (friendContact.id == data.id) {
                            friends.contacts.splice(index, 1);

                            RequestCache.update('/friends', {}, friends);
                        }
                    });
                }

                if (account.friends_count > 0) {
                    account.friends_count -= 1;
                    RequestCache.update('/account', {}, account);
                }

                removeEcpFromMember(data.id, {email: account.email});
            }

            function removeEcpFromMember (id, contact) {
                var member = _.find(account.members, {id: id});
                var toBeRemoved = undefined;

                if (angular.isDefined(member)) {
                    _.each(member.contacts, function(c, index) {
                        if (c.email == contact.email) {
                            toBeRemoved = index;
                        }
                    });
                }

                if (angular.isDefined(toBeRemoved)) {
                    member.contacts.splice(toBeRemoved, 1);
                    RequestCache.update('/account', {}, account);
                }
            }
            /**
             * Add a Account to the Partner
             *
             * @param member
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function addPartnerAccount (partnerAccount) {
                var deferred = $q.defer();
                Restangular.all('partners/account')
                .customPOST(partnerAccount,undefined,{
                    'X-Authorization':$rootScope.apiKey
                })
                .then(
                    function(res) {
                        deferred.resolve(res);
                    },
                    function(err) {
                        RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });

                return deferred.promise;

            }

            /**
             * Add a Account to the Partner
             *
             * @param member
             * @returns {Promise.promise|*|Deferred.promise}
             */
             function subscribePayment (member_id, token, coupon,isFreeVal) {
                var deferred = $q.defer();
                Restangular.all('stripe/subscribe')
                .customPOST({'member_id': member_id, 'token': token, 'coupon': coupon,'is_free': isFreeVal})
                .then(
                    function(res) {
                        deferred.resolve(res);
                    },
                    function(err) {
                        // RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });

                return deferred.promise;

            }

            function subscribePaymentAfterCoupon (member_id, token, coupon,isFreeVal) {
                var deferred = $q.defer();
                Restangular.all('stripe/subscribe')
                .customPOST({'member_id': member_id, 'token': token, 'coupon': coupon, 'is_free': isFreeVal})
                .then(
                    function(res) {
                        deferred.resolve(res);
                    },
                    function(err) {
                        deferred.reject(err);
                    });

                return deferred.promise;

            }

            function createAlipaySource (total_amount) {

                // manage angular's # via nginx
                var return_url = Config.WEB_BASE + '?alipay-checkout=true';
                var stripe = Stripe(Config.STRIPE_PUBLIC_KEY);
                stripe.createSource({
                  type: 'alipay',
                                      amount: total_amount, //todo: 1500 usd
                                      currency: 'usd',
                                      owner: {
                                        name: $rootScope.account.first_name,
                                        email: $rootScope.account.email,
                                        phone: $rootScope.account.phone.number
                                    },
                                    redirect: {
                                        return_url: return_url,
                                    },
                                }).then(function(result)
                                {  
                                    if(result.source)
                                    {
                                      sessionStorage.setItem("alipaySource",JSON.stringify(result.source));

                                      $rootScope.alipaySource = result.source;

                                      if(result.source.redirect)
                                      {
                                        if(result.source.redirect.url)
                                        {
                                                   //window.location.href=result.source.redirect.url;
                                                   var mobileDevice = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));                                                  
                                                   if(mobileDevice){
                                                    var win = window.open(result.source.redirect.url, '_self');
                                                }
                                                else{
                                                    var win = window.open(result.source.redirect.url, '_blank');
                                                }

                                            }
                                        }

                                    }
                                    if(result.error)
                                    { 
                                       return false;
                                   }

                               });


                            }

                            function subscribePaymentAlipay (source) {
                                var deferred = $q.defer();
                                Restangular.one('stripe/alipay')
                                .customPOST({'source': source})
                                .then(
                                    function(res) {

                                        deferred.resolve(res);
                                    },
                                    function(err) {

                        // RequestCache.clear('/friends', {});

                        deferred.reject(err);
                    });
                                return deferred.promise;
                            }

            /**
             * HTTP DELETE Remove ECP.
             *
             * @param id
             * @returns {*|Array}
             */
             function removeECPFromPartner (id) {
                var deferred = $q.defer();

                Restangular.one('partners/account', id).remove({'X-Authorization':$rootScope.apiKey}).then(
                    function(res) {
                        deferred.resolve(res);
                    },
                    function(err) {
                        deferred.reject(err);
                    });

                return deferred.promise;
            }
        })

.controller('AccountHelpController', ['$rootScope', '$scope', 'EmergencyChannel', function($rootScope, $scope, EmergencyChannel) {
    $scope.isRequired = isRequired;

    function isRequired (id) {
        if (id) {
            var requiredChannels = ['email', 'twitter'];
            var channel = EmergencyChannel.find({ id: parseInt(id) });
            return (_.indexOf(requiredChannels, channel.type) != -1);
        }
    }
}])

.controller('paymentSuccessController', ['$rootScope', '$scope', '$state','Account','$location','$routeParams',  function($rootScope, $scope, $state, Account,$location,$routeParams) {

    $rootScope.isAlipayChargeable = false;
    $rootScope.isAlipayFailed = false;
    $rootScope.isAlipayError = false;
    $rootScope.isAlipayCanceled = false;

    var alipaySourceDetails =jQuery.parseJSON(sessionStorage.getItem("alipaySource"));
    var stripe = Stripe(Config.STRIPE_PUBLIC_KEY);
    var MAX_POLL_COUNT = 10;
    var pollCount = 0;

    function checkSourceStatus(){
        stripe.retrieveSource({
            id: alipaySourceDetails.id,
            client_secret:alipaySourceDetails.client_secret,
        }).then(
        function (result) {
            if(result.source)               
            {
                if(result.source.status)
                {
                    var statusVal = result.source.status.toLowerCase();
                    if(statusVal === "chargeable"){
                     $rootScope.isAlipayChargeable = true;
                     sessionStorage.setItem("alipayPaymentSuccess",true);                               
                     HideSpinnerAndRedirect();
                 }
                 else if (statusVal === 'pending' && pollCount < MAX_POLL_COUNT) {
                    pollCount += 1;
                    setTimeout(checkSourceStatus, 1000);
                }
                else if(statusVal === "failed"){
                    $rootScope.isAlipayFailed = true;
                    HideSpinnerAndRedirect();
                }
                else if(statusVal === "canceled"){
                    $rootScope.isAlipayCanceled = true;
                    HideSpinnerAndRedirect();
                }
            }
        }
    },
    function (error) {
       $rootScope.isAlipayError = true;
       HideSpinnerAndRedirect();
   });
    }        
    checkSourceStatus();
    $rootScope.globals.showSpinner = true;
    $rootScope.globals.stateShowSpinner = true;
    $rootScope.redirecting = false;

    function HideSpinnerAndRedirect()
    {
        $rootScope.globals.showSpinner = false;
        $rootScope.globals.stateShowSpinner = false;
        $rootScope.redirecting = true;

        setTimeout(function() {
            $state.go('account.show');
        }, 8000);

    }

}])

.controller('PartnerController', ['$rootScope', '$scope','Account','AuthToken','iaSettings','$http','$state', '$cookies', function($rootScope, $scope,Account,AuthToken,iaSettings,$http,$state,$cookies) {
    $scope.propertyName = 'ice_id';
    $scope.reverse = true;
    $scope.showFinEcp = false;
    $scope.isDownloadCompleteFile = false;
    $scope.reqDownaloadLoading = false;
    $scope.accountIdValue = sessionStorage.getItem("LoginAccountId");
    $scope.sortBy = function(propertyName) {
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
        $scope.propertyName = propertyName;
    };
    if(!_.isNull(sessionStorage.getItem("passwordpopupsession"))){
        $rootScope.changePasswordPopUpdiv = true;
    }

    $scope.sort = {
            column: 'id', //['id', $scope.sortby ],
            descending: true
        };

        $scope.changeSortingOrder = function() {
            if($scope.sort.descending){
                $scope.sort.descending = false;
            }else{
                $scope.sort.descending = true;
            }

        };

        $scope.changeSortingMem = function(sortby) {

            var sortus = $scope.sort;
            $scope.sort.column = sortby;

            /*if (sortus.column == sortby) {
                sortus.descending = !sortus.descending;
            } else {
                sortus.column = sortby;
                sortus.descending = false;
            }*/
        };
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
        $scope.downloadCompleteFile = function() {
            $scope.isDownloadCompleteFile = true;
            $scope.reqDownaloadLoading = true;
        $rootScope.redirecting=true; // to stop global spinner
        $scope.showError = false; 
        var token = AuthToken.get();
        var req = {
            method: 'GET',
            url: Config.API_BASE+'/partners/multiuserqr',
            headers: {
                'X-Authorization':$rootScope.apiKey,
                'Accept-Language': iaSettings.getLanguage()
            } 
        }
        $http(req)
        .then(function(res){
            var anchor = angular.element('<a/>');
            anchor.css({display: 'none'});
            angular.element(document.body).append(anchor);
            anchor.attr({
                href: res.data.url,
                target: '_self',
                download: 'iCE_wallpaper.jpg'
            })[0].click();                                
            anchor.remove();

            $rootScope.redirecting=false;
            $rootScope.reqLoading = false;
        }, 
        function(error)
        {
            $rootScope.reqLoading = false;
            $scope.showError = false;              
        });
    };
    $scope.handle = function(partnerAccount){
    	var postData = angular.copy(partnerAccount);
        $scope.memberError = " ";
        var errors = [];
        $scope.errors = [];
        Account.addPartnerAccount(postData)
        .then(function (res) {
            Account.getFriends().then(function(friends) {
                $scope.friends = friends;
                var saveSuccessfully = angular.element(document).find('div.member-save-info');
                saveSuccessfully.fadeIn(500,0).slideDown(500);
                setTimeout(function() {
                    saveSuccessfully.fadeOut(500,0).slideUp(500);
                }, 6000);
                addPartnerForm.reset();	
                partnerAccount.partner_ecp=true;
            });

        })
        .catch(function (err) {
            errors = [];
            errors.push(err.data.error);

            _.each(errors, function(error) {
                if (!_.isNull(error.message) || !_.isEmpty(error.message)) {
                    $scope.memberError = error.message;
                }
            });

            var errorMsg = angular.element(document).find('div.danger-class');
            errorMsg.fadeIn(500,0).slideDown(500);
            setTimeout(function() {
                errorMsg.fadeOut(500,0).slideUp(500);
            }, 2000);
            $scope.errors = errors;
        });
    };

    $scope.removeECP=function(iceIdNumber){
        Account.removeECPFromPartner(iceIdNumber)
        .then(function (res) {
            $scope.errors = [];
            Account.getFriends().then(function(friends) {
                $scope.friends = friends;

            });

        })
        .catch(function (err) {
            errors = [];
            errors.push(err.data.error);

            _.each(errors, function(error) {
                if (!_.isNull(error.message) || !_.isEmpty(error.message)) {
                    $scope.memberError = error.message;
                }
            });

            var errorMsg = angular.element(document).find('div.danger-class');
            errorMsg.fadeIn(500,0).slideDown(500);
            setTimeout(function() {
                errorMsg.fadeOut(500,0).slideUp(500);
            }, 2000);
            $scope.errors = errors;
        });
    }

    $scope.propertyName = 'ice_id';
    $scope.reverse = true;
    $scope.showFinEcp = false;
    $scope.sortBy = function(propertyName) {     
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
        $scope.propertyName = propertyName;
    };
}])

.controller('RegisterAccountController', ['$rootScope','$scope', '$controller', '$state', '$location', '$cookieStore', 'Account', 'Store', 'locale', function ($rootScope,$scope, $controller, $state, $location, $cookieStore, Account, Store, locale) {
    var errors;
    var data;
    var key = 'tempAccount';

    $scope.errors = [];

    $scope.account = Store.get(key) || {
        emergency_channels: {},
        security_question_1: 1,
        security_question_2: 2,
        security_answer_1:'',
        security_answer_2:''
    };

    Store.remove(key);

    /*$scope.IsImgUpload = false;
    $scope.myCroppedImage = '';
    $scope.myImage = '';
    $scope.IsImgUploadButton = true;
    $scope.termsHtml = null;
    $scope.privacyHtml = null;
    $scope.imageCropResult = null;
    $scope.showImageCropper = true;*/


    if ($state.current.name == 'base.registration.active-account' && angular.isUndefined($scope.account.email)) {
        $state.go('base.registration.register');
    }

    if (data = $location.$$search.data) {
        var result = {};

        var q = decodeURIComponent((atob([data]))).replace(/\?/, '').replace(/\[([^\]]+)\]/g, '.$1').split('&');

        q.forEach(function(pair) {
            pair = pair.split('=');

            if (/birth_date/.test(pair[0]) || /phone/.test(pair[0])) {
                var keys = pair[0].split('.');

                if (angular.isUndefined(result[keys[0]])) {
                    result[keys[0]] = {};
                }

                result[keys[0]][keys[1]] = parseInt(pair[1]);
            } else {
                switch(pair[0]) {
                    case 'nationality':
                    result[pair[0]] = parseInt(pair[1] || '');
                    break;
                    default:
                    result[pair[0]] = pair[1] || '';
                }
            }

        });

        angular.extend($scope.account, result);
    }
            /**
             * Handle Register Form
             */
             $scope.handle = function (account) {
                account.email = account.email.toLowerCase();
                
                // handle the emergency channel 1.
                if (account.email) {
                    account.emergency_channels = angular.extend(
                    {
                        emergency_channel1: {
                            id: 1,
                            value: account.email,
                            type: 'email',
                            name: 'Email'
                        }
                    }
                        //, account.emergency_channels
                        );
                }

                Account.register(account)
                .then(function (res) {
                    $scope.errors = [];
                    $state.go('base.registration.active-account');
                }, function (err) {
                    errors = [];
                    if (!_.isUndefined(err.data.error)) {
                       if (!_.isUndefined(err.data.error.message) || !_.isNull(err.data.error.message) || !_.isEmpty(err.data.error.message)) {
                        if(err.data.error.message.trim().toLowerCase().indexOf('email address has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('email address 已经被使用')!=-1){                               
                            $rootScope.isemailavailableformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                                    }, 7000); */
                                                }
                                                else{
                                                 errors.push(err.data.error);
                                                 $scope.errors = errors;
                                             }
                                         }
                                     }
                                     else{
                                        if (!_.isUndefined(err.data) || !_.isNull(err.data) || err.data){
                                            if (err.data === undefined) {
                                                $scope.isNotValide = true;

                                            } else if(err.data === "taken"){
                                                $rootScope.isemailavailableformember = true;
                                           /* setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                                    }, 7000); */

                                                }
                                                else if(err.data === "inactive"){                              
                                                    $rootScope.isemailactiveformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailactiveformember = false;                                            
                                                        });                                        
                                                    }, 7000);  */                             
                                                }
                                                else if(err.data === "member"){                                  
                                                    $rootScope.isemailalreadyexistformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailalreadyexistformember = false;                                            
                                                        });                                        
                                                    }, 7000); */                               
                                                }
                                                else if(err.data === "account"){                                    
                                                    $rootScope.isemailavailableformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                                    }, 7000); */                                 

                                                }
                                                else if(err.data === "Empty email"){                                  
                                                    $rootScope.isemailrequiredformember = true;
                                           /* setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailrequiredformember = false;                                            
                                                        });                                        
                                                    }, 7000); */
                                                }

                                            }
                                        }
                                    });
};

$controller('AccountHelpController', {$scope: $scope});

$scope.readTerms = function(account) {
    Store.put(key, account);
    $state.transitionTo('base.terms', {});
};
$scope.messagesclear = function(matchingCase){
    switch(matchingCase){
        case 1: 
        if($rootScope.isemailavailableformember == true){
            $rootScope.isemailavailableformember = false;
        }
        if($rootScope.isemailalreadyexistformember == true){
            $rootScope.isemailalreadyexistformember = false;
        }
        if($rootScope.isemailactiveformember == true){
            $rootScope.isemailactiveformember = false;
        }
        if($rootScope.isemailrequiredformember == true){
            $rootScope.isemailrequiredformember = false;
        }
        break;
    }
};

}])

.controller('ActiveAccountController', ['$rootScope', '$scope', '$state', '$location', function ($rootScope, $scope, $state, $location) {
    $scope.account = {};
    if ($location.$$path == '/account/active') {
        $rootScope.activated = $location.$$search.activated;
        $state.go('base.login');
    }
}])

.controller('SecurityRedirectController', function ($scope,  $location, $state, Account, $rootScope, $timeout) {

    sessionStorage.setItem("refreshAccountDetails", true);
    if ($location.$$search.ref == 'unsubscribe'){
    }

    $scope.redirectLocation = function(){
        $location.path('/account/edit');
        $timeout(function() {
            $location.hash('security');
        }, 200);
    }

})

        /**
         * Edit account controller
         */
         .controller('EditAccountController', function ($scope, $controller, $state, Account, $rootScope, $timeout,$http) {
            $controller('AccountHelpController', { $scope: $scope });

            $rootScope.phonenumberalreadyused = false; 
            var originalAccount;
            $scope.handle = updateAccount;
            $scope.reset = reset;
            $scope.showFB = false;
            var userAgent = navigator.userAgent.toLowerCase(),
            safari = /safari/.test( userAgent ),                
            ios = /iphone|ipod|ipad/.test( userAgent );
            
            var registrationSubmitFirst = document.querySelector('#registration-submitFirst');
            var registrationSubmitSecond = document.querySelector('#registration-submitSecond');

            function hideSpinnerFunction(){
                if(!_.isNull(registrationSubmitFirst)){
                    registrationSubmitFirst.classList.remove('loading_icon_price');
                }
                if(!_.isNull(registrationSubmitSecond)){
                    registrationSubmitSecond.classList.remove('loading_icon_price');
                }
            }
            hideSpinnerFunction();
            if(ios && !safari)
            {
                $scope.isIphoneFb = true;
            }
            else {
                $scope.isIphoneFb = false;
            }

            if(!_.isNull(sessionStorage.getItem("passwordpopupsession"))){
                $rootScope.changePasswordPopUpdiv = true;
            }

            Account.get()
            .then(onAccountReady);
            $scope.isVisible = function isElementInViewport (el) {

                if (typeof jQuery === "function" && el instanceof jQuery) {
                    el = el[0];
                }

                var rect = el.getBoundingClientRect();

                return (
                    rect.top >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + 100 /*or $(window).height() */
                    );
            }

            $scope.storeScroll = function(){

                if ($state.current.name == 'account.edit'){
                    $rootScope.editPosition = window.scrollY + (window.scrollY > 500 ? 480 : 0 );
                }

                $scope.dockEditFooter();

            }

            $scope.dockEditFooter = function(){

                if (jQuery.browser && !jQuery.browser.mobile && angular.element('#footer-include').css('display') !== 'none'){

                    setTimeout(function() {

                        $scope.isVisible(angular.element('#footer-include')) ? angular.element('#edit-footer').addClass('docked')
                        : angular.element('#edit-footer').removeClass('docked');

                    }, 80); /* accordion transition completed */

                }
            }

            window.onscroll = function(){
                $scope.storeScroll();
            };

            function onAccountReady (account) {
                // copy angular scope to avoid changing the origin scope
                $scope.account = angular.copy(account);
                originalAccount = account;
                if(!$scope.account.last_name || !$scope.account.phone) {
                    var CountriesList = $rootScope.globals.settings.countries.toArray();
                    $http({
                        "url":Config.IP_LOCATION_URL,
                        "method":"GET",
                    }).then(function(response){
                        angular.forEach(CountriesList, function(item){
                            if(item.iso.toLowerCase().indexOf(response.data.country.toLowerCase()) != -1){
                                $scope.account.phone =
                                {
                                    code: item.id
                                }
                            }
                        });
                    });
                }

                if (!$scope.account.nationality) {
                    $scope.account.nationality = null;
                }
            }

            function updateAccount (account) {
                if(!_.isNull(registrationSubmitFirst)){
                    //registrationSubmitFirst.classList.add('fa fa-spinner fa-spin');
                    $scope.editLoading= true;
                }
                if(!_.isNull(registrationSubmitSecond)){
                    //registrationSubmitSecond.classList.add('fa fa-spinner fa-spin');
                    $scope.editLoading= true;
                } 
                account.twitter_screen_name = setTwitterScreenName(account.emergency_channels);

                if(account.emergency_channels.emergency_channel2) {
                    account.emergency_channels.emergency_channel2= {
                        id: 2,
                        value: account.emergency_channels.emergency_channel2.value,
                        type: 'twitter',
                        name: 'Twitter notification',
                        name_en: 'Twitter notification',
                        name_zh: 'Twitter推送'
                    }
                }
                if(account.emergency_channels.emergency_channel3) {
                    account.emergency_channels.emergency_channel3= {
                        id: 3,
                        value: account.emergency_channels.emergency_channel3.value,
                        type: 'email',
                        name: 'Email',
                        name_en: 'Email',
                        name_zh: '邮件箱'
                    }
                }

                $rootScope.globals.showSpinner = false;
                $rootScope.globals.stateShowSpinner = false;
                $rootScope.redirecting = true;

                Account.update(account)
                .then(function (res) {
                 $rootScope.phonenumberalreadyused = false; 
                 sessionStorage.setItem("accountphonenubmervalue", true);
                 angular.extend(originalAccount, res);
                 $state.transitionTo('account.edit', {});
                    //hideSpinnerFunction();
                    $scope.editLoading= false;
                    var saveSuccessfully = angular.element(document).find('div.success-messages');
                    saveSuccessfully.fadeIn(500,0).slideDown(500);
                    setTimeout(function() {
                        saveSuccessfully.fadeOut(500,0).slideUp(500);
                        $state.transitionTo('account.show', {});
                    }, 3000);
                }, function (err) {
                    //hideSpinnerFunction();
                    $scope.editLoading= false;
                    if (!_.isNull(err.data.error.message) || !_.isEmpty(err.data.error.message)) {
                        if(err.data.error.message.trim().toLowerCase().indexOf('phone number has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('phone number 已经被使用')!=-1){
                            $rootScope.phonenumberalreadyused = true; 
                            /* setTimeout(function() {
                                        $rootScope.$apply(function () {
                                            $rootScope.phonenumberalreadyused = false;                                            
                                        });                                        
                                    }, 7000); */
                                }
                                else{
                                    alert(err.data.error.message);
                                }
                            }
                        });
            }

            function reset () {
                $state.transitionTo('account.settings', {});
            }


            function setTwitterScreenName(data) {
                if (data.emergency_channel2 && data.emergency_channel2.type === 'twitter') {
                    return data.emergency_channel2.value;
                } else if (data.emergency_channel3 && data.emergency_channel3.type === 'twitter') {
                    return data.emergency_channel3.value;
                } else {
                    return null;
                }
            }

            function clearQuestions(value){
                if (value == undefined && $scope.account != null){
                    $scope.account.security_question_1 = null;
                    $scope.account.security_question_2 = null;
                    $scope.account.security_answer_1 = null;
                    $scope.account.security_answer_2 = null;
                }

            }

            $scope.$watch('account.security_question_1', function(newValue, OldValue) {
                clearQuestions(newValue);
            }, true);

            $scope.$watch('account.security_question_2', function(newValue, OldValue) {
                clearQuestions(newValue);
            }, true);
        })

        /**
         * Show account friends in need controller
         */
         .controller('ShowAccountFriendsController', ['$scope', 'friends', 'Account', function ($scope, friends, Account) {
            $scope.friends = friends;

            $scope.$on('events.received', function(event) {
                Account.getFriends().then(function(friends) {
                    $scope.friends = friends;
                });
            });
        }])

        /**
         *  Show account guardians controller
         */
         .controller('ShowGuardianController', ['$scope', 'guardians', 'Account', 'locale', function ($scope, guardians, Account, locale) {
            $scope.guardians = guardians;

            $scope.atLeastOneGuardian = function(guardians) {
                return guardians.length == 1;
            };

            $scope.GUAcount = function(){
                var total = 0;
                _.forEach($scope.guardians, function(rec){
                    if(rec.status === 'accepted'){
                        total+=1;
                    }
                })
                return total;
            }

            /*$scope.resendGuardianNomination = function(email) {
                Account.resendGuardianNomination(email).then(function(res) {
                    var token = 'messages.resendNominationSuccess';

                    if (locale.isToken(token)) {
                        locale.ready(locale.getPath(token)).then(function () {
                            setTimeout(function() {
                                window.alert(locale.getString(token, {}));
                            }, 500);
                        });
                    }
                });
            };*/

            $scope.$on('events.received', function(event) {
                Account.getAllGuardians().then(function(guardians) {
                    $scope.guardians = guardians;
                });
            });
        }])

        /**
         * Show account messages controller.
         */
         .controller('ShowAccountMessagesController', ['$scope', '$state', 'Account', 'messages','iaSettings','$rootScope', function ($scope, $state, Account, messages,iaSettings,$rootScope) {
            var page = 0;
            // $scope.messages = messages;
            $scope.more_messages = true;
           // if($rootScope.account!==null){
                //Account.resetLanguage();
                //iaSettings.setLanguage($rootScope.account.language); 
                
                
                $scope.loadMore = function () {

                    if ($scope.more_messages) {
                        page = page + 1;

                        Account.getAccountMessages(page).then(function(res) {
                            Account.fetchNonViewedMessages().then(function(){
                                $scope.messages = messages;
                                if (_.isEmpty(res)) {
                                 $scope.more_messages = false;
                             }
                         })
                            
                        });
                    }
                };

                $scope.loadMore();           

           // }
           // else
            //{
             //   Account.getCurrentMessages();
           // }

            //Restangular.defaultHeaders["Accept-Language"] = null;
            
        }])

        /**
         * Forget password controller
         */
         .controller('ForgetPasswordController', ['$rootScope', '$scope', '$state', '$location', '$filter', 'Account', function ($rootScope, $scope, $state, $location, $filter, Account) {

            var errors;

            $scope.questions = [];
            $scope.answers = [];
            $scope.errors = [];

            $scope.account = {};

            $scope.showError = false;

            if (_.isEmpty($scope.questions) && ($state.current.name != 'base.forgot-password.email')) {
                $state.go('base.forgot-password.email');
            }

            $scope.onStep = function(path) {
                if (_.isArray(path)) {
                    return ! ((path.indexOf($location.$$path) == -1));
                }

                return path == $location.$$path;
            };

            $scope.getSecurityQuestions = function (email) {

                Account.getSecurityQuestions(email).then(
                    function (res) {
                        $scope.questions = [$rootScope.globals.settings.security_questions.find({id: res.security_question_1}),
                        $rootScope.globals.settings.security_questions.find({id: res.security_question_2})];

                       //Todo: get the answers here and redirect to forgot-pass-sucess, if empty
                       ($scope.questions.length===0)?$state.go('base.forgot-password.success'):$state.go('base.forgot-password.question1');
                       $scope.errors = [];

                   }, function (err) {
                    errors = [];
                    errors.push(err.data.error);
                    $scope.errors = errors;
                }
                );

            };

            $scope.verifySecurityQuestion = function (answer, email, question_num) {

                if (answer === undefined){
                    question_num = 0;
                    answer = '2va79CexvdGBK3iNOpmVFy50zFYy5uLNW'; //see back-end reminder
                }

                Account.forgetPasswordSecurityQuestionVerification(answer, email, question_num).then(
                    function (res) {
                        $state.go('base.forgot-password.success');
                    },
                    function (err) {
                        errors = [];
                        errors.push(err.data.error);
                        $scope.errors = errors;

                        if (Account.getForgetPasswordSecurityQuestionAttempts() === 3) {

                            Account.resetAttempts();

                            if (question_num === 1) {
                                $state.go('base.forgot-password.question2');
                            }
                        }
                    }
                    );
            };

        }])

        /**
         * Resend active email
         */
         .controller('ResendActiveEmailController', ['$scope', 'Account', function($scope, Account) {
            var errors = [];
            $scope.errors = [];
            $scope.success = false;
            $scope.websiteNameValue = Config.BASE_URL;
            $scope.supportEmailDetail = Config.SUPPORT_EMAIL;
            $scope.handle = function(email) {
                Account.resendActiveEmail(email).then(
                    function(res) {
                        $scope.errors = [];
                        $scope.success = true;
                    },
                    function(err) {
                        errors = [];
                        errors.push(err.data.error);
                        $scope.errors = errors;
                    }
                    );
            };
        }])


         /**
         * Covid Traker 
         */
         .controller('CovidController', ['$rootScope','$scope', '$http', 'Account' ,'iaSettings', '$stateParams', function($rootScope, $scope,$http, Account , iaSettings, $stateParams) {
            var cncountries =$rootScope.globals.settings.cncountry;
            console.log(cncountries.items);
            $scope.allcountries = cncountries.items; // {'key1':'', 'key1':'',}  cncountries['key1']

            if($stateParams.lang){
                $rootScope.globals.language = iaSettings.setLanguage($stateParams.lang);
            }

            $http({
                "url":'https://api.iceangelid.com/worldcoviddetail',
                "method":"POST",
                "data":{"url":"https://disease.sh/v2/countries/"},
            }).then(function(response){
                $scope.allCountriesData = JSON.parse(response.data[0]);
                $scope.filteredList =  $scope.allCountriesData;

                $scope.search = function()
                { 
                    $scope.filteredList  = _.filter($scope.allCountriesData,
                     function(item){  
                         return searchUtil(item,$scope.searchText); 
                     });

                    if($scope.searchText == '')
                    {
                        $scope.filteredList = $scope.allCountriesData ;
                    }
                }

            });

            $http({
                "url":'https://api.iceangelid.com/worldcoviddetail',
                "method":"POST",
                "data":{"url":"https://disease.sh/v2/all/"},              
            }).then(function(response){
                $scope.allData = JSON.parse(response.data[0]);
                
            });

            $http({
                "url":'https://api.iceangelid.com/worldcoviddetail',
                "method":"POST",
                "data":{"url":"https://disease.sh/v2/states"},   
            }).then(function(response){
                $scope.USAdata = JSON.parse(response.data[0]);
                $scope.filteredSatteList = $scope.USAdata ;

                $scope.searchForState = function()
                { 
                    $scope.filteredSatteList  = _.filter($scope.USAdata,
                     function(item){  
                         return searchStateUtil(item,$scope.searchState); 
                     });

                    if($scope.searchState == '')
                    {
                        $scope.filteredSatteList = $scope.USAdata ;
                    }
                }
            });

            $http({
                "url":'https://api.iceangelid.com/worldcoviddetail',
                "method":"POST",
                "data":{"url":"https://disease.sh/v2/countries/US"}, 
            }).then(function(response){
                $scope.allDataUSA = JSON.parse(response.data[0]);
            });

            
            $http({
                "url":'https://api.iceangelid.com/worldcoviddetail',
                "method":"POST",
                "data":{"url":"https://disease.sh/v2/historical/all?lastdays=30"}, 
            }).then(function(response){
                var recentData = JSON.parse(response.data[0]);

                $scope.myJson = {
                  gui: {
                    contextMenu: {
                      button: {
                        visible: 0
                    }
                }
            },
            backgroundColor: "#eeeeee",
            globals: {
              shadow: false,
              fontFamily: "Helvetica"
          },
          type: "area",

          legend: {
              layout: "x4",
              backgroundColor: "transparent",
              borderColor: "transparent",
              marker: {
                  borderRadius: "50px",
                  borderColor: "transparent"
              },
              item: {
                  fontColor: "#000"
              }

          },
          scaleX: {
              maxItems: 8,
              transform: {
                  type: 'date'
              },
              zooming: true,
              values: Object.keys(recentData.cases),
              lineColor: "#000",
              lineWidth: "1px",
              tick: {
                  lineColor: "#dee2e6",
                  lineWidth: "1px"
              },
              item: {
                  fontColor: "#000"
              },
              guide: {
                  visible: false
              }
          },
          scaleY: {
              lineColor: "#dee2e6",
              lineWidth: "1px",
              tick: {
                  lineColor: "#dee2e6",
                  lineWidth: "1px"
              },
              guide: {
                  lineStyle: "solid",
                  lineColor: "#626262"
              },
              item: {
                  fontColor: "#000"
              },
          },
          tooltip: {
              visible: false
          },
          crosshairX: {
              scaleLabel: {
                  backgroundColor: "#fff",
                  fontColor: "black"
              },
              plotLabel: {
                  backgroundColor: "#434343",
                  fontColor: "#FFF",
                  _text: "Number of hits : %v"
              }
          },
          plot: {
              lineWidth: "2px",
              aspect: "spline",
              marker: {
                  visible: false
              }
          },
          plotarea: {
        // margin: 'dynamic'
        marginLeft: '80px',
        marginRight: '40px'
    },
    series: [{
      text: "Cases",
      values: Object.values(recentData.cases) ,
      backgroundColor1: "#ff9a0f",
      backgroundColor2: "#ff9a0f",
      lineColor: "#ff9a0f"
  }, {
      text: "Deaths",
      values: Object.values(recentData.deaths),
      backgroundColor1: "#FF0000",
      backgroundColor2: "#FF0000",
      lineColor: "#FF0000"
  }, {
      text: "Recovered",
      values: Object.values(recentData.recovered),
      backgroundColor1: "#0000FF",
      backgroundColor2: "#0000FF",
      lineColor: "#0000FF"
  }]
};

});

            $scope.sort = {
                column: 'cases',
                descending: true
            };  
            
            $scope.sortUS = {
                column: 'cases',
                descending: true
            };  

            $scope.changeSorting = function(column) {

                var sort = $scope.sort;

                if (sort.column == column) {
                    sort.descending = !sort.descending;
                } else {
                    sort.column = column;
                    sort.descending = false;
                }
            };

            $scope.changeSortingUS = function(column) {

                var sortus = $scope.sortUS;

                if (sortus.column == column) {
                    sortus.descending = !sortus.descending;
                } else {
                    sortus.column = column;
                    sortus.descending = false;
                }
            };
        }])

        /**
         * Login help controller
         */
         .controller('HelpController', function ($rootScope, $scope, $filter, $state, $modal, $interval, $timeout, Account, Auth) {
            $scope.data = {};

            if ($rootScope.account) {
                $scope.data = {
                    first_name: $rootScope.account.first_name,
                    last_name: $rootScope.account.last_name,
                    middle_name: $rootScope.account.middle_name,
                    email: $rootScope.account.email,
                    birth_date: $rootScope.account.birth_date,
                    ice_id : $filter('formatId')($rootScope.account.ice_id)
                };

            }

            $timeout(function() {
                if (angular.isDefined($rootScope.globals.settings.query_types)) {
                    $scope.data.subject = $rootScope.globals.settings.query_types.toArray()[0].name;
                }
            }, 0);

            $scope.times = 15;

            var goBack;

            $scope.fight = function () {
                // Don't start a new fight if we are already fighting
                if (angular.isDefined(goBack)) {
                    return;
                }

                goBack = $interval(function () {
                    if ($scope.times > 0) {
                        $scope.times--;
                    } else {
                        $scope.stopFight();
                    }
                }, 1000);
            };

            $scope.stopFight = function () {
                if (angular.isDefined(goBack)) {
                    $interval.cancel(goBack);
                    goBack = undefined;
                    $scope.resetFight();
                    history.back();
                }
            };

            $scope.resetFight = function () {
                $scope.times = 15;
            };

            $scope.$on('$destroy', function () {
                // Make sure that the interval is destroyed too
                $scope.stopFight();
            });

            $scope.success = '';
            $scope.error = '';

            $scope.handle = function (data) {
                //data.ice_id = data.ice_id.replace(/ /g,'');
                Account.sendHelp(data).then(
                    function (res) {
                        $state.current.name == 'base.contactus' ? $rootScope.$broadcast('account.static.contactus') : $rootScope.$broadcast('account.static.help');
                        $scope.success = res;
                    },
                    function (err) {
                        $scope.error = err.data.error;
                    });
            };
        })

        /**
         * Trigger alert controller
         */
         .controller('TriggerAlertController', ['$rootScope','$scope','$http', '$location', '$state', '$controller', '$filter', 'locale', 'Alert', 'UserLocation', 'Restangular','ngCopy','$timeout','$modal', function ($rootScope,$scope,$http, $location, $state, $controller, $filter, locale, Alert, UserLocation, Restangular,ngCopy,$timeout,$modal) {
            $scope.alert = {};
            $scope.goToContacts = false;
            $scope.goToTrigger = false;
            $scope.isValidateEcp = true;
            $scope.isEmailCopy = false;
            $scope.cityName = null;
            $scope.countryName = null;

            if ($location.$$search.memberId){
                $rootScope.globals.showSpinner = true;
                $rootScope.globals.stateShowSpinner = true;
                $rootScope.redirecting = false;
                $scope.alert.ice_id = $location.$$search.memberId || null;
                if(!_.isNull($scope.alert.ice_id)){                    
                    verifyMemberById($scope.alert.ice_id)
                }
            }

            if (angular.isUndefined($scope.alert.ice_id) && $state.current.name != 'base.trigger-alert.iceid') {
                $state.go('base.trigger-alert.iceid');
            }

            $scope.enterIceId = function(member_id) {
                $scope.isValidateEcp = true;
                if(_.isUndefined(member_id)){
                  member_id = $scope.alert.ice_id;
              }
              $scope.invalidId = false;
              if(_.isUndefined(member_id)){
                 $scope.invalidId = true;
             }
             member_id = member_id.replace(/ /g,'');             
             verifyMemberById(member_id);
         };

         $scope.showErrorMessage = function() { 
            $scope.TriggerAlertForm.phone_number.$touched = true;
              //  angular.element(document).find(".minlenghtherror").removeClass("hide");
               // angular.element(document).find(".phoneNumberRequiredError").removeClass("hide");

           }
           $scope.copyEmailId = function(emailDetail) {
            ngCopy(emailDetail);
            var emailCopyDiv = angular.element(document).find('div.emailCopyDiv');
            var modalInstance = $modal.open({
                backdrop: true,
                backdropClick: true,
                dialogFade: false,
                keyboard: true,                            
                templateUrl: 'partials/modal/copydata.html',
                scope: $scope,
                controller: function () {
                    $scope.cancel = function () {
                        modalInstance.close();
                    };
                }
            });
            $timeout(function() {                    
                modalInstance.close();
            }, 2000);
        }

        $scope.onStep = function(path) {
            if (_.isArray(path)) {
                return ! ((path.indexOf($location.$$path) == -1));
            }

            return path == $location.$$path;
        };


        function triggerAlert(form, alert) {

            var newPhoneCode1 = $filter('settingsFilter')(alert.phone.code, 'countries', 'phonecode');
            alert.phone.number = '+'+ newPhoneCode1 +' '+alert.phone.number;
            
            Alert.triggerAlert(alert).then(
                function (res) {
                    $scope.cityName = null;
                    $scope.countryName = null;
                    form.$setPristine();

                    $scope.alert = res;
                    $state.go('base.trigger-alert.success');
                },
                function (err) {
                    $scope.errors = [];

                    if (err.status == 500) {
                        locale.ready(locale.getPath('errors.systemError')).then(function () {
                            $scope.errors.push({message: locale.getString('errors.systemError', {})});
                        });
                    } else {
                        $scope.errors.push(err.data.error);
                    }
                }
                );
        }

        function  verifyMemberById (member_id){
            var CountriesList = $rootScope.globals.settings.countries.toArray();
            $http({
                "url":Config.IP_LOCATION_URL,
                "method":"GET",
            }).then(function(response){
                $scope.cityName = response.data.city;
                $scope.countryName =response.data.country_name;
                angular.forEach(CountriesList, function(item){
                    if(item.iso.toLowerCase().indexOf(response.data.country.toLowerCase()) != -1){
                        $scope.alert.phone =
                        {
                            code: item.id
                        }
                    }
                });
            });

                    /*Restangular.one("sync/verify_member").get({member_id:member_id}).then(
                        function(res){
                            if(!res.has_contacts){
                                $scope.isValidateEcp = false;
                                $rootScope.globals.showSpinner = false;
                                $rootScope.globals.stateShowSpinner = false;
                                $rootScope.redirecting = true;                       
                                $state.go('base.trigger-alert.iceid');
                            }
                            else{
                                $scope.goToContacts = true;
                                $state.go('base.trigger-alert.contacts');
                            }
                        },
                        function(err){
                            $rootScope.globals.showSpinner = false;
                            $rootScope.globals.stateShowSpinner = false;
                            $rootScope.redirecting = true;
                            $scope.memberError = [];
                            $scope.memberError.push(err.data.error);
                            $state.go('base.trigger-alert.iceid');
                        }
                        )*/ 
                        $scope.changeiceid =function (){
                            $scope.TriggerAlertForm.ice_id.$setValidity('notfound', true);
                        }

                        var req = {
                         method: 'GET',
                         url: Config.API_BASE+'/sync/verify_member?member_id='+member_id,
                         headers: {
                           'Accept-Language': locale,

                       } 
                   }

                   $http(req).then(function(res)
                   {
                    $scope.memberError = [];
                    if(!res.data.has_contacts){
                        $scope.isValidateEcp = false;
                        $rootScope.globals.showSpinner = false;
                        $rootScope.globals.stateShowSpinner = false;
                        $rootScope.redirecting = true;                       
                        $state.go('base.trigger-alert.iceid');
                    }
                    else{
                        $scope.goToContacts = true;
                        $state.go('base.trigger-alert.contacts');
                    }
                }, 
                function(error)
                {
                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;
                    $rootScope.redirecting = true;
                    $scope.memberError = [];
                    $scope.memberError.push(error.data.error);
                    $scope.TriggerAlertForm.ice_id.$setValidity('notfound', false);
                    $state.go('base.trigger-alert.iceid');
                } );                       


               }

            /**
            * Trigger Alert.
            */
           /* $scope.handle = function (alert, event) {

             if( $scope.goToContacts){
              $scope.goToTrigger = true;

              var form = this.TriggerAlertForm;
              alert.ice_id = $filter('iceFormat')(alert.ice_id);

              $scope.$emit('showSpinner');

              UserLocation.getCurrentPosition().then(                
                function (coords) {
                    coords.city = $scope.cityName;
                    coords.country = $scope.countryName;
                    alert.location = coords;
                    triggerAlert(form, alert);
                },
                function (error) {
                    triggerAlert(form, alert);
                });
             }
            else
              $scope.enterIceId();
      }; */

      $scope.handle = function (alert, event) {

         if( $scope.goToContacts){
          $scope.goToTrigger = true;

          var form = this.TriggerAlertForm;
          alert.ice_id = $filter('iceFormat')(alert.ice_id);

          $scope.$emit('showSpinner');

          UserLocation.getCurrentPosition().then(                
            function (coords) {
                $http({
                 "url": Config.IP_LOCATION_URL,
                 "method":"GET",
             }).then(function(response){
                if(response.data.country_name.toLowerCase().match(/china/i) == "china"){
                    coords.city = response.data.city;
                    coords.country = response.data.country_name;
                    var earthR = 6378137.0;

                    function transform(x, y) {
                        var xy = x * y;
                        var absX = Math.sqrt(Math.abs(x));
                        var xPi = x * Math.PI;
                        var yPi = y * Math.PI;
                        var d = 20.0*Math.sin(6.0*xPi) + 20.0*Math.sin(2.0*xPi);

                        var lat = d;
                        var lng = d;

                        lat += 20.0*Math.sin(yPi) + 40.0*Math.sin(yPi/3.0);
                        lng += 20.0*Math.sin(xPi) + 40.0*Math.sin(xPi/3.0);

                        lat += 160.0*Math.sin(yPi/12.0) + 320*Math.sin(yPi/30.0);
                        lng += 150.0*Math.sin(xPi/12.0) + 300.0*Math.sin(xPi/30.0);

                        lat *= 2.0 / 3.0;
                        lng *= 2.0 / 3.0;

                        lat += -100.0 + 2.0*x + 3.0*y + 0.2*y*y + 0.1*xy + 0.2*absX;
                        lng += 300.0 + x + 2.0*y + 0.1*x*x + 0.1*xy + 0.1*absX;

                        return {lat: lat, lng: lng}
                    }
                    function wgs2gcj(wgsLat, wgsLng) {
                        var d = delta(wgsLat, wgsLng);
                        return {lat: wgsLat + d.lat, lng: wgsLng + d.lng};
                    }

                    function delta(lat, lng) {
                        var ee = 0.00669342162296594323;
                        var d = transform(lng-105.0, lat-35.0);
                        var radLat = lat / 180.0 * Math.PI;
                        var magic = Math.sin(radLat);
                        magic = 1 - ee*magic*magic;
                        var sqrtMagic = Math.sqrt(magic);
                        d.lat = (d.lat * 180.0) / ((earthR * (1 - ee)) / (magic * sqrtMagic) * Math.PI);
                        d.lng = (d.lng * 180.0) / (earthR / sqrtMagic * Math.cos(radLat) * Math.PI);
                        return d;
                    }


                    var result = wgs2gcj(coords.latitude,coords.longitude);

                    coords.latitude =result.lat;                               
                    coords.longitude =result.lng;

                    alert.location = coords;
                    triggerAlert(form, alert); 
                }
                else{
                    coords.city = response.data.city;
                    coords.country = response.data.country_name;
                    alert.location = coords;
                    triggerAlert(form, alert);
                }
            }, function(error) {
                alert.location = coords;
                triggerAlert(form, alert);
            });
         },
         function (error) {
            triggerAlert(form, alert);
        });
      }
      else
          $scope.enterIceId();
  };


}])

        /**
         * Change Security Questions
         */
         .controller('ChangeSecurityQuestionsController', function ($rootScope, $scope, $state, $filter, Account) {

            if (!Account.verifiedPassword()) {
                $state.go('account.settings');
            }

            var errors = [];
            $scope.errors = [];
            $scope.showError = false;
            $scope.account = angular.copy($rootScope.account);

            $scope.questions = Account.getAccountSecurityQuestions($rootScope.account);

            $scope.verifySecurityQuestion = function (answer, question_num) {

                Account.checkSecurityQuestion(answer, question_num).then(
                    function (res) {
                        $scope.errors = [];

                        $state.go('account.security-questions.update');
                    },
                    function (err) {
                        errors = [];
                        errors.push(err.data.error);
                        $scope.errors = errors;
                        $scope.showError = false;

                        if (Account.getChangeSecurityQuestionsAttempts() === 3) {
                            Account.resetChangeSecurityQuestionAttempts();

                            switch(question_num) {
                                case 2:
                                $state.transitionTo('account.help', {});
                                break;
                                default:
                                $scope.errors = [];
                                $scope.showError = true;
                                $state.go('account.security-questions.question2');
                            }
                        }
                    });
            };

            $scope.handle = function (update) {

                Account.update(update).then(
                    function (res) {
                        $state.go('account.settings');
                    },
                    function (err) {
                        errors = [];
                        errors.push(err.data.error);
                        $scope.errors = errors;
                    });
            };
        })

        /**
         * Change Account Email
         */
         .controller('ChangeEmailController', ['$rootScope', '$scope', '$state', 'Account', function($rootScope, $scope, $state, Account) {
            var errors = [];
            $scope.errors = [];

            if (!Account.verifiedPassword()) {
                $state.go('account.settings');
            }
            $rootScope.passwordVerified = false;
            
            $scope.emailAlreadyUsed = false;
            $rootScope.isemailavailableformember= false;
            $rootScope.isemailalreadyexistformember= false;
            $rootScope.isemailactiveformember = false;
            $rootScope.isemailrequiredformember = false;

            $scope.gotoSettings = function(){
                $state.go('account.settings');
            };

            $scope.setmessage = function(){
                $scope.emailAlreadyUsed = false;
                $rootScope.isemailavailableformember= false;
                $rootScope.isemailalreadyexistformember= false;
                $rootScope.isemailactiveformember = false;
                $rootScope.isemailrequiredformember = false;
            }

            $scope.handle = function(email, email_confirmation) {

                $rootScope.isemailavailableformember= false;
                $rootScope.isemailalreadyexistformember= false;
                $rootScope.isemailactiveformember = false;
                $rootScope.isemailrequiredformember = false;

                $scope.emailAlreadyUsed = false;
                $rootScope.globals.showSpinner = true;
                $rootScope.globals.stateShowSpinner = true;
                $rootScope.redirecting = false;
                Account.updateAccountEmail(email, email_confirmation).then(
                    function(res) {
                        if (res.success) {
                         $scope.emailConfirmed = true;
                         $scope.message = res.message.replace('{email}', email);
                         $rootScope.globals.showSpinner = false;
                         $rootScope.globals.stateShowSpinner = false;
                         $rootScope.redirecting = true;
                     }
                 },
                 function(err) {
                    errors = [];
                    $rootScope.globals.showSpinner = false;
                    $rootScope.globals.stateShowSpinner = false;
                    $rootScope.redirecting = true;

                    if(!_.isUndefined(err.data.error.message) && !_.isNull(err.data.error.message)){
                        if(angular.equals(angular.lowercase(err.data.error.type) ,'validationexception')){
                            $scope.emailAlreadyUsed = true;
                        }
                        else{
                            $scope.emailAlreadyUsed = false;
                            errors.push(err.data.error);
                            $scope.errors = errors;
                            $scope.emailConfirmed = false;
                        }
                    }
                    else{
                        $scope.emailAlreadyUsed = false;
                        errors.push(err.data.error);
                        $scope.errors = errors;
                        $scope.emailConfirmed = false;
                    }
                }
                );
            }
        }])
         .controller('SettingForgetPasswordController', ['$rootScope','$scope', 'Account','Auth','$state','Alert',function($rootScope, $scope, Account,Auth,$state,Alert) {
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

            $state.go('base.forgot-password.email');
        }])


         .controller('imageCropController', ['$rootScope', '$scope', '$controller', '$state', '$location', '$cookieStore', 'Account', 'Store','Auth', 'locale','CountriesUtils','fileUpload','$timeout', function ($rootScope, $scope, $controller, $state, $location, $cookieStore, Account, Store, Auth, locale,CountriesUtils,fileUpload,$timeout) {
            var errors = [];
            $scope.errors = [];

            $scope.IsImgUpload = false;
            $scope.myCroppedImage = '';
            $scope.myImage = '';
            $scope.IsImgUploadButton = true;

            $scope.imageCropResult = null;
            $scope.showImageCropper = true;
            $scope.isPrintLoading = false;

            var handleFileSelect = function(evt) {
                $scope.IsImgUpload = true;
                var file = evt.currentTarget.files[0];
                var reader = new FileReader();
                reader.onload = function(evt) {
                    $scope.$apply(function($scope) {
                        $scope.myImage = evt.target.result;
                    });
                    $scope.IsImgUploadButton = false;
                    $rootScope.isFileSizeExceed = false;                   
                };
                reader.readAsDataURL(file);
            };

            $scope.clearImgCrop = function()
            {    
                $scope.myImage = null;
                $scope.IsImgUpload = false;
                $scope.IsImgUploadButton = true;
                angular.element("input[name='pic']").val(null);
            };

            $timeout(function() { angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect); },1000, false);

            $scope.uploadImagCrop = function() {

                var isEdge = !isIE && !!window.StyleMedia;
                var isIE = false || !!document.documentMode;
                $scope.isPrintLoading = true;

                var newVal =  sessionStorage.getItem('getCropImageValue');
                var result;
                $scope.myImage = null;
                $scope.IsImgUpload = false;
                $scope.IsImgUploadButton = true;

                if (newVal) {
                    $scope.showImageCropper = false;
                    $scope.imageCropResult = false;
                    $scope.imageCropStep = 1;
                    var block = newVal.split(";");
                    var contentType = block[0].split(":")[1];
                    if (block[1] != undefined) {
                        var realData = block[1].split(",")[1];
                        var blob = b64toBlob(realData, contentType);
                        blob.lastModifiedDate = new Date();                         
                        
                        var imageExt = contentType.split("/")[1];
                        
                        //var image = new File([blob], 'image.'+imageExt,{type: contentType});
                        if(isEdge || isIE){
                            var image = new Blob([blob], 'image.'+imageExt, {type : contentType});
                        }else{
                            var image = new File([blob], 'image.'+imageExt,{type: contentType});
                        }

                        result = $scope;
                        if (image != '' && image != undefined) {
                            var maxSize = Config.MaxFileSize ? Config.MaxFileSize : 3072;
                            if(image.size > (maxSize * 1024)){
                                $rootScope.isFileSizeExceed= true;
                                return;
                            }

                            var typeValue='photo'; 
                            var model=[];
                            
                            fileUpload.upload(image, typeValue).then(
                                function (res) {
                                    $scope.isPrintLoading = false;
                                    model[0] ='account';
                                    result = result[model[0]];
                                    result['photo'] = res.data.url;
                                }, function(err){
                                    errors = [];
                                    errors.push(err.data.error);
                                    scope.errors = errors;
                                    scope.spinner=false;
                                });

                        }
                    }
                }
            };

            function b64toBlob(b64Data, contentType, sliceSize) {
                contentType = contentType || '';
                sliceSize = sliceSize || 512;

                var byteCharacters = atob(b64Data);
                var byteArrays = [];

                for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    var slice = byteCharacters.slice(offset, offset + sliceSize);

                    var byteNumbers = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }

                    var byteArray = new Uint8Array(byteNumbers);
                    byteArrays.push(byteArray);
                }

                var blob = new Blob(byteArrays, { type: contentType });
                return blob;
            }


        }])

        /**
        * Partner dashboard
        */

        .controller('PartnerDashboardController', ['$scope','$rootScope', 'Account', 'AuthToken','locale','$http','$timeout', '$modal', 'iaSettings', function($scope, $rootScope, Account, AuthToken, locale, $http , $timeout, $modal, iaSettings) {
            $scope.loading = function(){
                var token = AuthToken.get();
            //var lang = iaSettings.getLanguage() || 'en'; 
            $rootScope.globals.showSpinner = true;
            $rootScope.globals.stateShowSpinner = true;
            if(!_.isNull(sessionStorage.getItem("passwordpopupsession"))){
                $rootScope.changePasswordPopUpdiv = true;
            }
            $http({  
                url: Config.API_BASE+'/account/allcoviddetail', 
                method:"GET",
                headers: {
                    'X-Authorization':'Bearer ' + token,
                    'Accept-Language': iaSettings.getLanguage(),
                    'Content-Type': 'application/json'
                }
            }).then(function(response) {  
                $rootScope.globals.showSpinner = false;
                $rootScope.globals.stateShowSpinner = false;

                // var arraydata = response.data.testList.map(obj=>{
                //     if(obj.type!='covid19'){
                //         return ({...obj, resultSort:obj.result});
                //     }
                //     if(obj.type=='covid19'){
                //         return ({...obj, resultSort:obj.info});   
                //     }
                // });

                var element = {}, arraydata = [];
                angular.forEach(response.data.testList,function(obj){
                   element = obj;
                   if(obj.type!='covid19'){
                        obj.resultSort = obj.result;
                    }else if(obj.type=='covid19'){
                        obj.resultSort = obj.info;
                    }
                    arraydata.push(element);
                    element={};
                });

                $scope.MemRecs =arraydata ; //response.data.testList;
                $scope.dashboard =response.data;
                $scope.makeTodos = function() {
                    $scope.user_data = [];
                    angular.forEach(response.data.testList, function(value, key){
                        $scope.user_data.push(value);
                    });
                };
                $scope.makeTodos(); 
                $scope.file = $scope.MemRecs;
                $scope.current_grid = 1;
                $scope.data_limit = 50;
                $scope.filter_data = $scope.MemRecs.length;
                $scope.entire_user = $scope.MemRecs.length;
                $scope.page_position = function(page_number) {
                    $scope.current_grid = page_number;
                };
                $scope.filter = function() {
                    $timeout(function() {
                        $scope.filter_data = $scope.searched.length;
                    }, 20);
                };
                $scope.sort_with = function(base) {
                    $scope.base = base;
                    $scope.reverse = !$scope.reverse;
                };
                })
                            /*.error(function(data, status, headers, config) {
                console.log("error");
           

            });*/
        }

        $scope.loading();



        $scope.remove =function(){


            var modalInstance = $modal.open({
                backdrop: false,
                backdropClick: false,
                dialogFade: false,
                keyboard: true,
                size: 'sm',
                templateUrl: 'partials/modal/ptndelete.html',
                scope: $scope,
                controller: function () {
                    $scope.cancel = function () {
                        modalInstance.close();
                    };     

                    $scope.oktodelete = function () {

                        var token_ = AuthToken.get();
                        $http({  
                                url: Config.API_BASE+'/member/deletecovidvaccinerec', //Config.API_BASE+'/account/allcoviddetail',
                                method:"DELETE",
                                headers: {
                                    'X-Authorization':'Bearer ' + token_,
                                    'Accept-Language': iaSettings.getLanguage(),
                                    'Content-Type': 'application/json'
                                },
                                data:{'deleterec':$scope.removeDataList},
                            }).then(function(response) { 
                                $scope.deleted = response.data.data.length;

                                $scope.success = true;

                                $scope.loading();

                                var DataList = [];
                                $scope.removeDataList=[];
                                angular.forEach($scope.MemRecs,function(v){
                                    if(!v.isDelete){
                                        DataList.push(v);
                                    }
                                });
                                $scope.file = DataList;
                                $scope.filter_data = DataList.length;

                                setTimeout(function(){  $scope.success = false; $scope.deleted =0; }, 3000);
                            })
                            
                            modalInstance.close();
                        }; 
                    }
                });



        }

        $scope.exportAllCSV = function(){

            var csvString = 'Date,LastName,FirstName,Category,Result,Attachment,Product,Manufacturer,Lot #,Serial #';
            csvString = csvString + "\n";
            for(var i=0; i<$scope.MemRecs.length;i++){
                var rowData = $scope.MemRecs[i];
                var csvString = csvString + rowData.covid_date_sort  + ",";
                var csvString = csvString + ( rowData.last_name?  rowData.last_name:'' )  +  ",";
                var csvString = csvString + ( rowData.first_name?  rowData.first_name:'' )  + ",";
                var csvString = csvString + rowData.name_cat  + ",";
                if(rowData.type=='covid19'){
                    var csvString = csvString + (( rowData.info != null && rowData.info != '5' )? rowData.info : rowData.series )  + ",";
                }else{
                    var csvString = csvString +  rowData.result + ",";
                }
                var csvString = csvString + ( rowData.document? rowData.document:'' ) + ",";
                var csvString = csvString + ( rowData.pname ?  rowData.pname:'' )   + ",";
                var csvString = csvString + ( rowData.mfname ?  rowData.mfname :'' )  + ",";
                var csvString = csvString + ( rowData.lotnumber?  rowData.lotnumber:'' )   + ",";
                var csvString = csvString + ( rowData.srnumber?  rowData.srnumber:'' )   + ",";

                csvString = csvString.substring(0,csvString.length - 1);
                csvString = csvString + "\n";
            }
            var a = $('<a/>', {
                style:'display:none',
                href:'data:application/octet-stream;base64,'+btoa(csvString),
                download:'All_Results.csv'
            }).appendTo('body')
            a[0].click()
            a.remove();
        }

        $scope.selected =function(e){
            //var inn =  $scope.MemRecs.findIndex((obj)=>obj.id == e.MemRec.id);
            var  i, inn = null;
            for(i in $scope.MemRecs) {
                if($scope.MemRecs[i].id==e.MemRec.id) 
                inn = i;
            }

            //obj = $scope.MemRecs.find(({id}) => id === e.MemRec.id);
            if( inn != null && ($scope.MemRecs[inn].isDelete == null || $scope.MemRecs[inn].isDelete ==='undefined' || $scope.MemRecs[inn].isDelete == false) ) {
                $scope.MemRecs[inn].isDelete=true;
            }
            else{
                $scope.MemRecs[inn].isDelete=false;
                $scope.isAllDelete=false;
            }
            $scope.removeDataList = [];
            angular.forEach($scope.MemRecs,function(v){
                if(v.isDelete){
                    $scope.removeDataList.push(v);
                }
            }); 

            if($scope.removeDataList.length == $scope.MemRecs.length){
             $scope.isAllDelete=true;
         }
     }


     $scope.selectAll = function(){
                //var checkboxes = angular.element(document.getElementsByName('isDelete'));
                
                if(!$scope.isAllDelete==true){
                    for (var i = 0; i < $scope.MemRecs.length ; i++) {
                        $scope.MemRecs[i].isDelete = true;

                    }

                }else{
                    for (var i = 0; i < $scope.MemRecs.length; i++) {
                        $scope.MemRecs[i].isDelete = false;
                    }

                }

                $scope.removeDataList = [];
                angular.forEach($scope.searched,function(v){
                    if(v.isDelete){
                        $scope.removeDataList.push(v);
                    }
                });
            }


            $scope.addSubClass = function(irowd){

                if($(".tr_"+irowd).hasClass('members_sub')){
                    $(".tr_"+irowd).removeClass('members_sub');
                    $(".tr_"+irowd).next('tr').removeClass('hide');
                    $(".tr_"+irowd).addClass('expandsection');

                }
                else{
                    $(".tr_"+irowd).removeClass('expandsection');
                    $(".tr_"+irowd).addClass('members_sub');
                    $(".tr_"+irowd).next('tr').addClass('hide');
                }
            }

        }])



.controller('memberImageCropController', ['$rootScope', '$scope', '$controller', '$state', '$location', '$cookieStore', 'Account', 'Store','Auth', 'locale','CountriesUtils','fileUpload','$timeout', function ($rootScope, $scope, $controller, $state, $location, $cookieStore, Account, Store, Auth, locale,CountriesUtils,fileUpload,$timeout) {
    var errors = [];
    $scope.errors = [];

    $scope.IsImgUpload = false;
    $scope.myCroppedImage = '';
    $scope.myImage = '';
    $scope.IsImgUploadButton = true;
    $scope.isPrintLoading = false;
    $scope.imageCropResult = null;
    $scope.showImageCropper = true;

    var handleFileSelect = function(evt) {
        $scope.IsImgUpload = true;
        var file = evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function(evt) {
            $scope.$apply(function($scope) {
                $scope.myImage = evt.target.result;
            });
            $scope.IsImgUploadButton = false;
            $rootScope.isFileSizeExceed = false;                   
        };
        reader.readAsDataURL(file);
    };

    $scope.clearImgCrop = function()
    {    
        $scope.myImage = null;
        $scope.IsImgUpload = false;
        $scope.IsImgUploadButton = true;
        angular.element("input[name='pic']").val(null);
    };

    $timeout(function() { angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect); },1000, false);

    $scope.uploadImagCrop = function() {
        var isEdge = !isIE && !!window.StyleMedia;
        var isIE = false || !!document.documentMode;
        $scope.isPrintLoading = true;
        var newVal =  sessionStorage.getItem('getCropImageValue');
        var result;
        $scope.myImage = null;
        $scope.IsImgUpload = false;
        $scope.IsImgUploadButton = true;

        if (newVal) {
            $scope.showImageCropper = false;
            $scope.imageCropResult = false;
            $scope.imageCropStep = 1;
            var block = newVal.split(";");
            var contentType = block[0].split(":")[1];
            if (block[1] != undefined) {
                var realData = block[1].split(",")[1];
                var blob = b64toBlob(realData, contentType);
                blob.lastModifiedDate = new Date();                         

                var imageExt = contentType.split("/")[1];
                        //var image = new File([blob], 'image.'+imageExt,{type: contentType});
                        if(isEdge || isIE){
                            var image = new Blob([blob], 'image.'+imageExt, {type : contentType});
                        }else{
                            var image = new File([blob], 'image.'+imageExt,{type: contentType});
                        }

                        result = $scope;
                    }
                    if (image != '' && image != undefined) {
                        var maxSize = Config.MaxFileSize ? Config.MaxFileSize : 3072;
                        if(image.size > (maxSize * 1024)){
                            $rootScope.isFileSizeExceed= true;
                            return;
                        }

                        var typeValue='photo'; 
                        var model=[];

                        fileUpload.upload(image, typeValue).then(
                            function (res) {
                                $scope.isPrintLoading = false;
                                model[0] ='member';                                    
                                result = result[model[0]];
                                result['photo'] = res.data.url;                               

                            }, function(err){
                                errors = [];
                                errors.push(err.data.error);
                                scope.errors = errors;
                                scope.spinner=false;
                            });

                    }
                }
            };


            function b64toBlob(b64Data, contentType, sliceSize) {
                contentType = contentType || '';
                sliceSize = sliceSize || 512;

                var byteCharacters = atob(b64Data);
                var byteArrays = [];

                for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    var slice = byteCharacters.slice(offset, offset + sliceSize);

                    var byteNumbers = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }

                    var byteArray = new Uint8Array(byteNumbers);
                    byteArrays.push(byteArray);
                }

                var blob = new Blob(byteArrays, { type: contentType });
                return blob;
            }


        }])


.directive('fbSendTo', ['Account', '$timeout', function (Account, $timeout) {

    return {
        restrict: 'EA',
        scope: {
            member: '=',
            icedata: '='
        },
        link: link,
        template: '<div class="fb-send-to-messenger" messenger_app_id="498919360311253" page_id="197331103649577" ' +
        ' data-ref="{{e_id}}" ' +
        ' color="blue"  size="large"> </div>'
    };

    function link(scope, elem, attrs) {

        scope.encrypt = function (raw_string) {

            if (raw_string){
                var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                var crypt = Base64.encode(raw_string);
                return crypt ? 'ice'+crypt : '';
            }
        }

        scope.e_id = scope.encrypt(scope.icedata);
    }
}])

        /*************************************
         * Account alert
         *************************************/
         .directive('alertMember', ['Alert', function (Alert) {

            return {
                restrict: 'A',
                scope: {
                    member: '='
                },
                link: link
            };

            function link(scope, elem, attrs) {

                var member = scope.member;

                applyClass();

                scope.$on('alerts.received', function (event, data) {
                    applyClass();
                });

                function applyClass() {
                    angular.forEach(Alert.getAlerts(), function (alert) {
                        if (alert.member_id == member.id) {
                            elem.addClass('member-alert-triggered');
                        }
                    });
                }
            }
        }])

         .directive('alertFriend', ['Alert', function (Alert) {

            return {
                restrict: 'A',
                scope: {
                    contactfor: '='
                },
                link: link
            };

            function link(scope, elem, attrs) {
                var contactfor = scope.contactfor;

                applyClass();

                scope.$on('alerts.received', function (event, data) {
                    applyClass();
                });

                function applyClass() {
                    angular.forEach(Alert.getFriendAlerts(), function (friendAlert, index) {
                        if (contactfor.id == friendAlert.member_id) {
                            elem.addClass('member-alert-triggered');
                        }
                    });
                }
            }
        }])

         .directive('contactUs', ['$modal', '$state', function ($modal, $state) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: ['$scope', function ($scope) {


                            scope.ok = function () {
                                modalInstance.close();
                                $state.transitionTo('base.home', {});
                            };
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

     })();
