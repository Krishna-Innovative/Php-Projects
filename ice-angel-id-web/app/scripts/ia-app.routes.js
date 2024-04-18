(function () {
   // 'use strict';  // showing error in console in IE

    angular.module('iaApp.routes', ['ui.router'])
        .config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise('/');
            $stateProvider
                .state('base', {
                    name: 'base',
                    url: '',
                    templateUrl: 'partials/base.html',
                    controller: 'MainController',
                    abstract: true
                })

                .state('base.home', {
                    name: 'base.home',
                    parent: 'base',
                    url: '/?back&exit',
                    hideHeader: true,
                    params: {
                            back : {
                                value: null,
                                squash:true
                            },
                            exit : {
                                value: null,
                                squash:true
                            }
                    },
                    templateUrl: 'partials/home.html',
                    controller: 'MainController',
                    states: 'home'
                })

                .state('base.login', {
                    name: 'base.login',
                    url: '/login?back&redirect-to&ref',
                     params: {
                            back : {
                                value: null,
                                squash:true
                            },
                            'redirect-to': {
                                value: null,
                                squash:true
                            },
                            ref:{
                                value: null,
                                squash: true
                            }
                    },
                    templateUrl: 'partials/login/normal-container.html',
                    controller: 'AuthController',
                    isLoggedIn: false,
                    isLoginPage: true,
                    states: 'login',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.auth', {
                    name: 'base.auth',
                    url: '/auth/:token?redirect-to',
                    templateUrl: 'partials/login/auth.html',
                    controller: 'AuthTokenController',
                    states: 'login',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.registration', {
                    name: 'base.registration',
                    url: '/registration',
                    templateUrl: 'partials/account/registration/form.html',
                    controller: 'RegisterAccountController',
                    isLoggedIn: false,
                    states: 'register',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.registration.register', {
                    name: 'registration.register',
                    url: '/register',
                    views: {
                        'register@base.registration': {
                            templateUrl: 'partials/account/registration/register.html'
                        }
                    },
                    isLoggedIn: false,
                    isTransferMem:true,
                    states: 'register',
                    ncyBreadcrumb: {
                        skip: true
                    }
                })

                .state('base.registration.active-account', {
                    name: 'registration.active-account',
                    url: '/active-account',
                    views: {
                        'register@base.registration': {
                            templateUrl: 'partials/account/registration/active-account.html'
                        }
                    },
                    isLoggedIn: false,
                    states: 'active-account',
                    ncyBreadcrumb: {
                        skip: true
                    }
                })

                // Active account notify url.
                .state('account-active', {
                    name: 'account-active',
                    url: '/account/active',
                    controller: 'ActiveAccountController',
                    states: 'account-active',
                    isLoggedIn: false,
                    data: {
                        title: 'Active Account'
                    }
                })

                .state('base.resend-active-email', {
                    name: 'base.resend-active-email',
                    url: '/resend/active-email',
                    isLoggedIn: false,
                    states: 'resend-active-email',
                    templateUrl: 'partials/account/resend-active-email/form.html',
                    controller: 'ResendActiveEmailController',
                    ncyBreadcrumb: {
                        parent: 'base.login'
                    }
                })

                .state('base.live-covid-tracker', {
                    name: 'base.live-covid-tracker',
                    url: '/covid-tracker',
                    states: 'live-covid-tracker',
                    templateUrl: 'partials/livetraker.html',
                    controller: 'CovidController',
                })

                .state('base.immunization-results', {
                    name: 'base.immunization-results',
                    url: '/immunization/public-key/:key',
                    states: 'immunization-results',
                    templateUrl: 'partials/immunizationresult.html',
                    controller: 'ImmunizationResultController',
                })

                .state('base.covid-results', {
                    name: 'base.covid-results',
                    url: '/covid/public-key/:key',
                    states: 'covid-results',
                    templateUrl: 'partials/covidresult.html',
                    controller: 'CovidResultController',
                })

                .state('base.forgot-password', {
                    name: 'forget-password',
                    url: '/forget-password',
                    templateUrl: 'partials/account/forget-password/form.html',
                    controller: 'ForgetPasswordController',
                    isLoggedIn: false
                })

                .state('base.forgot-password.email', {
                    name: 'forget-password.email',
                    url: '/email',
                    views: {
                        'forgetPassword@base.forgot-password': {
                            templateUrl: 'partials/account/forget-password/email.html'
                        }
                    },
                    isLoggedIn: false,
                    states: 'forget-password-1',
                    ncyBreadcrumb: {
                        parent: 'base.login'
                    }
                })

                .state('base.forgot-password.question1', {
                    name: 'forget-password.question1',
                    url: '/question1',
                    views: {
                        'forgetPassword@base.forgot-password': {
                            templateUrl: 'partials/account/forget-password/question1.html'
                        }
                    },
                    isLoggedIn: false,
                    states: 'forget-password-2',
                    ncyBreadcrumb: {
                        parent: 'base.login'
                    }
                })

                .state('base.forgot-password.question2', {
                    name: 'forgot-password.question2',
                    url: '/question1',
                    views: {
                        'forgetPassword@base.forgot-password': {
                            templateUrl: 'partials/account/forget-password/question2.html'
                        }
                    },
                    isLoggedIn: false,
                    states: 'forget-password-2',
                    ncyBreadcrumb: {
                        parent: 'base.login'
                    }
                })

                .state('base.forgot-password.success', {
                    name: 'forgot-password.success',
                    url: '/success',
                    views: {
                        'forgetPassword@base.forgot-password': {
                            templateUrl: 'partials/account/forget-password/success.html'
                        }
                    },
                    isLoggedIn: false,
                    states: 'forget-password-3',
                    ncyBreadcrumb: {
                        parent: 'base.login'
                    }
                })

                .state('base.reset-password', {
                    name: 'reset-password',
                    url: '/password/reset/:reset_code',
                    templateUrl: 'partials/account/forget-password/password-reset.html',
                    controller: 'ResetPasswordController',
                    isLoggedIn: false,
                    states: 'reset-password',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.trigger-alert', {
                    name: 'trigger-alert',
                    url: '/trigger-alert',
                    templateUrl: 'partials/alert/form.html',
                    controller: 'TriggerAlertController'
                })

                .state('base.trigger-alert.iceid', {
                    views: {
                        'triggerAlert@base.trigger-alert': {
                            templateUrl: 'partials/alert/iceid.html'
                        }
                    },
                    name: 'trigger-alert.iceid',
                    url: '/iceid',
                    states: 'trigger-alert-1',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.trigger-alert.contacts', {
                    views: {
                        'triggerAlert@base.trigger-alert': {
                            templateUrl: 'partials/alert/contacts.html'
                        }
                    },
                    name: 'alert-contacts',
                    url: '/contacts',
                    states: 'trigger-alert-2',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.trigger-alert.success', {
                    views: {
                        'triggerAlert@base.trigger-alert': {
                            templateUrl: 'partials/alert/success.html'
                        }
                    },
                    name: 'alert-success',
                    states: 'trigger-alert-3',
                    url: '/success',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                // View friend in need profile.
                .state('base.shared-profile',{
                    name: 'base.shared-profile',
                    url: '/members/public/:profile_token',
                    templateUrl: 'partials/member/preview-profile.html',
                    controller: 'ViewSharedProfileController',
                    showAlertsHistory: true,
                    //isLoggedIn: false,
                    states: 'view-shared-profile',
                    resolve: {
                        member: ['$q','$stateParams', '$location', 'Account','$state', '$rootScope', function ($q,$stateParams, $location, Account, $state, $rootScope) {

                            var deferred = $q.defer();

                               Account.getSharedProfile($stateParams.profile_token).then(
                                    function(res) {
                                         $rootScope.ShowSharedProfile = true;
                                        if(!_.isNull(res.first_name)){
                                            $rootScope.profileUserName =  res.first_name;
                                            if(!_.isNull(res.middle_name)){
                                                $rootScope.profileUserName += ' '+res.middle_name;
                                            }
                                            if(!_.isNull(res.last_name)){
                                               $rootScope.profileUserName +=  ' ' + res.last_name;
                                            }
                                        }
                                        deferred.resolve(res);
                                    },
                                    function(err) {
                                        $rootScope.linkExpired = true;
                                        $state.transitionTo('base.home', {});
                                    }
                                );

                            return deferred.promise;

                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                /**
                 * Account route
                 */
                .state('account', {
                    name: 'account',
                    abstract: true,
                    url: '/account?back',
                    params: {
                            back : {
                                value: null,
                                squash:true
                            }
                    },
                    templateUrl: 'partials/base.html',
                    controller: 'AccountController',
                    isLoggedIn: true,
                    isPartner:true,
                    showAlerts: true,
                    visibleUnsync:true
                })

                .state('account.show', {
                    name: 'account.show',
                    url: '',
                    templateUrl: 'partials/account/show.html',
                    isLoggedIn: true,
                    isPartner:false,
                    showAlerts: true,
                    states: 'my-account',
                    visibleUnsync:true
                })

                .state('base.partner', {

                    name: 'base.partner',
                    url: '/partner',
                    templateUrl: 'partials/partner/partner.html',
                    controller: 'PartnerController',
                    isLoggedIn: true,
                    isPartner:true,
                    showAlerts: true,
                    states: 'show-partner'
                })

                .state('account.settings', {
                    name: 'account.settings',
                    url: '/settings?ref',
                    params: {
                            ref : {
                                value: null,
                                squash:true
                            }
                    },
                    templateUrl: 'partials/account/settings.html',
                    controller: 'SecurityRedirectController',
                    isLoggedIn: true,
                    isPartner:true,
                    showAlerts: true,
                    states: 'account-settings',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('account.change-email', {
                    name: 'account.change-email',
                    url: '/change-email',
                    templateUrl: 'partials/account/change-email/form.html',
                    controller: 'ChangeEmailController',
                    isLoggedIn: true,
                    isPartner:true,
                    showAlerts: true,
                    states: 'change-email',
                    ncyBreadcrumb: {
                        parent: 'account.settings'
                    }
                })

                // View friend in need profile.
                .state('account.friend-in-need-profile',{
                    name: 'account.friend-in-need-profile',
                    url: '/members/profile/:profile_token',
                    templateUrl: 'partials/member/share-third-party.html',
                    controller: 'ViewFinProfileController',
                    showAlertsHistory: true,
                    isLoggedIn: true,
                    states: 'friend-in-need-profile',
                    resolve: {
                        member: ['$stateParams', 'Account', function($stateParams, Account) {
                            return Account.getSharedProfile($stateParams.profile_token);
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                // Share friend in need profile.
                .state('account.share-friend-in-need-profile',{
                    name: 'account.share-friend-in-need-profile',
                    url: '/members/profile/:profile_token/share',
                    templateUrl: 'partials/member/share-profile.html',
                    controller: 'ShareViewFinProfileController',
                    isLoggedIn: true,
                    states: 'share-friend-in-need-profile',
                    resolve: {
                        member: ['$stateParams', 'Account', function($stateParams, Account) {
                            return Account.getSharedProfile($stateParams.profile_token);
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.friend-in-need-profile'
                    }
                })

                .state('account.preview-friend-in-need-profile',{
                    name: 'account.preview-friend-in-need-profile',
                    url: '/members/profile/:profile_token/preview',
                    templateUrl: 'partials/member/preview-profile.html',
                    controller: 'PreviewFinProfileController',
                    isLoggedIn: true,
                    isPartner: true,
                    states: 'preview-profile',
                    resolve: {
                        member: ['$stateParams', 'Account', function($stateParams, Account) {
                            return Account.getSharedProfile($stateParams.profile_token);
                        }],
                        permission: ['PermissionService', function(PermissionService) {
                            return PermissionService.getTempPermission();
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.friend-in-need-profile'
                    }
                })

                .state('account.security-questions', {
                    name: 'account.security-questions',
                    url: '/security-questions',
                    templateUrl: 'partials/account/security-questions/form.html',
                    controller: 'ChangeSecurityQuestionsController',
                    isLoggedIn: true,
                    data: {
                        title: 'Change Security Questions'
                    },
                    ncyBreadcrumb: {
                        label: 'Change Security Questions',
                        parent: 'account.settings'
                    }
                })

                .state('account.security-questions.question1', {
                    name: 'account.security-questions.question1',
                    url: '/question1',
                    views: {
                      'securityQuestions@account.security-questions': {
                          templateUrl: 'partials/account/security-questions/question1.html'
                      }
                    },
                    isLoggedIn: true,
                    states: 'change-security-question-1',
                    ncyBreadcrumb: {
                        parent: 'account.settings'
                    }
                })

                .state('account.security-questions.question2', {
                    name: 'account.security-questions.question2',
                    url: '/question2',
                    views: {
                        'securityQuestions@account.security-questions': {
                            templateUrl: 'partials/account/security-questions/question2.html'
                        }
                    },
                    isLoggedIn: true,
                    states: 'change-security-question-2',
                    ncyBreadcrumb: {
                        parent: 'account.settings'
                    }
                })

                .state('account.security-questions.update', {
                    name: 'account.security-questions.update',
                    url: '/update',
                    views: {
                        'securityQuestions@account.security-questions': {
                            templateUrl: 'partials/account/security-questions/update.html'
                        }
                    },
                    isLoggedIn: true,
                    states: 'update-security-questions',
                    data: {
                        title: 'Update Security Questions'
                    },
                    ncyBreadcrumb: {
                        label: 'Update Security Questions',
                        parent: 'account.settings'
                    }
                })

                .state('account.edit', {
                    name: 'account.edit',
                    url: '/edit',
                    templateUrl: 'partials/account/edit.html',
                    controller: 'EditAccountController',
                    isLoggedIn: true,
                    showAlerts: true,
                    isPartner:true,
                    states: 'account-edit',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('account.member', {
                    name: 'account.member',
                    url: '/member',
                    templateUrl: 'partials/member/member.html',
                    controller: 'AddMemberController',
                    isLoggedIn: true,
                    showAlerts: true,
                     isPartner:true,
                    states: 'new-member',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('account.viewMember', {
                    name: 'account.viewMember',
                    url: '/member/:member_id',
                    templateUrl: 'partials/member/show.html',
                    controller: 'ShowMemberController',
                    isLoggedIn: true,
                    isPartner:true,
                    showAlerts: false,
                    showAlertsHistory: true,
                    showAddEcpAlert: true,
                    states: 'view-member',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('base.dashboard', {
                    name: 'base.dashboard',
                    url: '/partner/dashboard',
                    templateUrl: 'partials/member/ptndashboard.html',
                    controller: 'PartnerDashboardController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'partner-dashboard',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })
                .state('base.ptnmembers', {
                    name: 'base.ptnmembers',
                    url: '/partner/members',
                    templateUrl: 'partials/partner/MemberList.html',
                    controller: 'ShowPTNMemberController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'partner-members',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })
                .state('base.ptnecpersons', {
                    name: 'base.ptnecpersons',
                    url: '/partner/ecpersons',
                    templateUrl: 'partials/partner/FIN.html',
                    controller: 'ShowPTNECPersonController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'partner-ecpersons',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('base.covid-data', {
                    name: 'base.covid-data',
                    url: '/member/:member_id/covid',
                    states: 'covid-data',
                    templateUrl: 'partials/member/coviddata.html',
                    controller: 'CovidMemberController',
                   
                })

                .state('account.editMember', {
                    name: 'member',
                    url: '/member/:member_id/edit',
                    templateUrl: 'partials/member/member.html',
                    controller: 'EditMemberController',
                    isLoggedIn: true,
                    showAlerts: false,
                    isPartner:true,
                    showAlertsHistory: true,
                    showAddEcpAlert: true,
                    states: 'edit-member',
                    data: {
                        title: 'Edit Member',
                        title_zh: '编辑成员'
                    },
                    ncyBreadcrumb: {
                        parent: 'account.viewMember'
                    }
                })

                .state('account.viewMemberHistory', {
                    name: 'account.viewMemberHistory',
                    url: '/member/:member_id/history',
                    templateUrl: 'partials/member/history.html',
                    controller: 'ViewMemberHistoryController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'view-member-history',
                    ncyBreadcrumb: {
                        parent: 'account.viewMember'
                    }
                })

                .state('account.setEcpPermission', {
                    name: 'account.setEcpPermission',
                    url: '/member/:member_id/ecp/:contact_id/permission',
                    templateUrl: 'partials/member/ecp-permission.html',
                    controller: 'EcpPermissionController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'set-ecp-permission',
                    resolve: {
                        permission: ['$q', '$stateParams', 'Account', 'PermissionService', function($q, $stateParams, Account, PermissionService) {
                            var deferred = $q.defer();

                            Account.getEmergencyContactPermission($stateParams.member_id, $stateParams.contact_id).then(
                                function(res) {
                                    res.permissions = res.permissions || {};

                                    /* This block keeps checked permissions state between pages (removed) */

                                    // if (PermissionService.checkEcpPreviewed($stateParams.member_id, $stateParams.contact_id) && PermissionService.getEcpPreviewPermission($stateParams.member_id, $stateParams.contact_id)) {
                                    //     res.permissions = PermissionService.process(PermissionService.getEcpPreviewPermission($stateParams.member_id, $stateParams.contact_id), true);
                                    // }

                                    /* end block */

                                    deferred.resolve(res.permissions);
                                },
                                function(err) {
                                    console.log('ECP Permissions Error');
                                }
                            );

                            return deferred.promise;
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.editMember'
                    }
                })

                .state('account.share-profile', {
                    name: 'account.share-profile',
                    url: '/member/:member_id/share-profile',
                    templateUrl: 'partials/member/share-profile.html',
                    controller: 'ShareMemberProfileController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'share-member-profile',
                    resolve: {
                          permission: ['$q', '$stateParams','PermissionService', function($q, $stateParams,PermissionService) {
                            var deferred = $q.defer();
                                deferred.resolve(PermissionService.getPreviewPermission($stateParams.member_id));
                            return deferred.promise;
                        }]
                    },
                    data: {
                        title: 'Share Profile'
                    },
                    ncyBreadcrumb: {
                        label: 'Share {{member.first_name}}\'s profile',
                        parent: 'account.viewMember'
                    }
                })

                .state('account.preview-profile', {
                    name: 'preview-profile',
                    url: '/member/:member_id/preview-profile',
                    templateUrl: 'partials/member/preview-profile.html',
                    controller: 'PreviewProfileController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'preview-profile',
                     resolve: {
                          permission: ['$q', '$stateParams','PermissionService', function($q, $stateParams,PermissionService) {
                            var deferred = $q.defer();
                                deferred.resolve(PermissionService.getPreviewPermission($stateParams.member_id));                           
                            return deferred.promise;
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.viewMember'
                    }
                })

                .state('account.ecp-preview-profile', {
                    name: 'preview-profile',
                    url: '/member/:member_id/ecp/:contact_id/preview-profile',
                    templateUrl: 'partials/member/preview-profile.html',
                    controller: 'PreviewProfileController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'preview-profile',
                    resolve: {
                        permission: ['$stateParams', 'PermissionService', function($stateParams, PermissionService) {
                            return PermissionService.getEcpPreviewPermission($stateParams.member_id, $stateParams.contact_id) ? PermissionService.getEcpPreviewPermission($stateParams.member_id, $stateParams.contact_id): PermissionService.getPermission($stateParams.member_id, $stateParams.contact_id);
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'account.viewMember'
                    }
                })

                .state('account.showGuardians', {
                    name: 'guardians',
                    url: '/guardians',
                    templateUrl: 'partials/guardian/show.html',
                    controller: 'ShowGuardianController',
                    isLoggedIn: true,
                    isPartner:true,
                    resolve: {
                        guardians: ['Account', function(Account) {
                            return Account.getAllGuardians();
                        }]
                    },
                    states: 'guardians',
                    ncyBreadcrumb: {
                        parent: 'account.show'
                    }
                })

                .state('account.friends', {
                    name: 'friends',
                    url: '/friends',
                    templateUrl: 'partials/account/friends.html',
                    controller: 'ShowAccountFriendsController',
                    isLoggedIn: true,
                    isPartner:true,
                    states: 'friends',
                    resolve: {
                        friends: ['Account', function(Account) {
                          return Account.getFriends();
                        }]
                    },
                    data: {
                        title: 'Friends'
                    },
                    ncyBreadcrumb: {
                        label: 'Friends',
                        parent: 'account.show'
                    }
                })

                .state('account.messages', {
                    name: 'messages',
                    url: '/messages',
                    templateUrl: 'partials/account/messages.html',
                    controller: 'ShowAccountMessagesController',
                    isLoggedIn: true,
                    isPartner: true,
                    states: 'messages',
                    resolve: {
                        messages: ['Account', function(Account) {
                            return Account.getCurrentMessages();
                        }]
                    },
                    data: {
                        title: 'Message Center'
                    },
                    ncyBreadcrumb: {
                        label: 'Message Center',
                        parent: 'account.show'
                    }
                })

                /***************************
                 * Panic Section
                 ***************************/
                .state('account.panic-setup', {
                    name: 'account.panic-setup',
                    url: '/panic',
                    templateUrl: 'partials/panic/setup-scan.html',
                    controller: 'PanicController',
                    showAlerts: false,
                    states: 'panic-setup',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('account.unsync', {
                    name: 'account.unsync',
                    url: '/unsync',
                    templateUrl: 'partials/panic/unsync-panic.html',
                    controller: 'PanicController',
                    showAlerts: false,
                    states: 'unsync',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('account.waiting-sync-approve', {
                    name: 'account.waiting-sync-approve',
                    url: '/panic-sync-confirm/:ice_id',
                    templateUrl: 'partials/panic/panic-sync-confirm.html',
                    controller: 'SyncWaitingApproveController',
                    showAlerts: false,
                    states: 'waiting-sync-approve',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('trigger-panic', {
                    name: 'trigger-panic',
                    url: '/trigger-panic',
                    templateUrl: 'partials/panic/trigger-panic.html',
                    controller: 'TriggerPanicController',
                    showAlerts: false,
                    states: 'trigger-panic',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('trigger-panic-success', {
                    name: 'trigger-panic-success',
                    url: '/trigger-success',
                    templateUrl: 'partials/panic/trigger-success.html',
                    controller: 'TriggerPanicSuccessController',
                    showAlerts: false,
                    hideHeader: true,
                    states: 'trigger-panic-success',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                /*******************************
                 * Static pages
                 *******************************/
                .state('base.terms', {
                    name: 'terms',
                    url: '/terms',
                    templateUrl: 'partials/static/terms.html',
                    states: 'terms',
                    controller: 'PagesController',
                    resolve: {
                        pages: ['iaPages', function(iaPages) {
                            return iaPages.get('terms');
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.privacy', {
                    name: 'privacy',
                    url: '/privacy',
                    templateUrl: 'partials/static/privacy.html',
                    states: 'privacy',
                    controller: 'PagesController',
                    resolve: {
                        pages: ['iaPages', function(iaPages) {
                            return iaPages.get('privacy');
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.about', {
                    name: 'base.about',
                    url: '/about-iceangel?back',
                    params: {
                            back : {
                                value: null,
                                squash:true
                            }
                    },
                    templateUrl: 'partials/static/about-iceangel.html',
                    states: 'about',
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.aboutus', {
                    name: 'base.aboutus',
                    url: '/aboutus',
                    templateUrl: 'partials/static/aboutus.html',
                    states: 'aboutus',
                    controller: 'PagesController',
                    resolve: {
                        pages: ['iaPages', function(iaPages) {
                            return iaPages.get('about');
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })

                .state('base.contactus', {
                    name: 'base.contactus',
                    url: '/contactus',
                    templateUrl: 'partials/static/contactus.html',
                    controller: 'HelpController',
                    states: 'contactus',
                    ncyBreadcrumb: {
                        label: 'Contact US'
                    }
                })

                .state('base.faq', {
                    name: 'faq',
                    url: '/faq',
                    templateUrl: 'partials/static/faq.html',
                    states: 'faq',
                    controller: 'PagesController',
                    resolve: {
                        pages: ['iaPages', function(iaPages) {
                            return iaPages.get('faq');
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                })
                .state('base.alipay-checkout', {
                    name: 'base.alipay-checkout',                    
                    url: '/alipay-checkout',
                    templateUrl: 'partials/payment-successful.html',
                    controller: 'paymentSuccessController',                                     
                      states: 'alipay-checkout',
                    ncyBreadcrumb: {
                        parent: 'base.home'                      
                    }
                })
                .state('android-device-app', {
                    name: 'android-device-app',
                    url: '/app',
                    templateUrl: 'partials/android-app.html',
                    controller: 'AndroidDeviceAppController',
                    states: 'android-device-app',
                    ncyBreadcrumb: {
                        parent: 'base.home'                      
                    }
                })                
                .state('base.setting-forgot-password', {
                    name: 'setting-forgot-password',
                    url: '/setting-forgot-password',
                    controller: 'SettingForgetPasswordController'
                })
                .state('base.privacypolicy', {
                    name: 'privacypolicy',
                    url: '/inappdisclosure',
                    templateUrl: 'partials/static/privacypolicy.html',
                    states: 'privacypolicy',
                    controller: 'PagesController',
                    resolve: {
                      pages: ['iaPages', function(iaPages) {
                            return iaPages.get('appindisclosure');
                        }]
                    },
                    ncyBreadcrumb: {
                        parent: 'base.home'
                    }
                });

                $urlRouterProvider.when('/account/alerts', '/account');
        }]);
})();
