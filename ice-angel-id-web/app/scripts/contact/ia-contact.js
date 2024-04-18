(function () {
    'use strict';

    angular.module('iaContact', [])
        .directive('addContact', ['$modal', 'Account','$rootScope','iaSettings', function ($modal, Account, $rootScope, iaSettings) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var templates = {
                        add: 'partials/contact/templates/addContact.html',
                        success: 'partials/contact/templates/addContactSuccess.html'
                    };

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: templates.add,
                        scope: scope,
                        controller: ['$rootScope', function ($rootScope) {
                            var errors = [];
                            scope.errors = [];
                            $rootScope.emeCount = 0;

                            scope.slideTo = function (content) {
                                scope.modalContent = content;
                            };
                            
                            scope.refresh = function(){
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className == "modal-open") {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass("modal-open");
                                    layer.remove();
                                    modalLayer.remove();
                                }
                                
                            }
                            
                            scope.ok = function () {
                                modalInstance.close();
                                scope.refresh();
                            };

                            scope.cancel = function () {
                                modalInstance.close();
                                scope.refresh();
                            };

                            scope.ecpCount = function(){
                                var contacts = scope.member.contacts;
                                contacts = _.uniq(contacts);
                                scope.member.contacts = contacts; // to remove duplicate member contact from array
                                $rootScope.emeCount = contacts.length;
                            };

                            scope.nominateSelf = function (member_id, account_id) {
                                Account.nominateSelfContact(member_id, account_id).then(
                                    function (res) {
                                        scope.member.contacts.push(res);   //  adding one extra contact as contact already added
                                        modalInstance.close();
                                        scope.refresh();
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    });
                            };

                            scope.sendEmailNomination = function (member_id, email) {
                                if(email == $rootScope.account.email){
                                    errors = [];
                                    var errorDetail=[];
                                    if(member_id == scope.member.account_id){
                                        errorDetail.message ='errors.validateECPemail';
                                    }else{
                                        errorDetail.message ='errors.validateECP';
                                    }
                                    errors.push(errorDetail);
                                    scope.errors = errors;
                                    return false;
                                }
                                Account.sendContactEmailNomination(member_id, email).then(
                                    function (res) {
                                        scope.member.contacts.push(res);    //  adding one extra contact as contact already added
                                        modalInstance.close();
                                        success.scope.contact = res;
                                        modalInstance = $modal.open(success);
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    }
                                );
                            };
                        }]
                    };

                    scope.checkselfemail = function(){
                        console.log(scope.email);
                        scope.errors =[];
                    }
                    var success = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: templates.success,
                        scope: scope,
                        controller: function () {
                            scope.yes = function() {
                                modalInstance.close();
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                            scope.errors = [];
                            scope.modalContent = 'default';
                        }, function () {
                            scope.modalContent = 'default';
                        });
                    });
                }
            }
        }])
          .directive('addPartnerContact', ['$modal', 'Account', function ($modal, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var templates = {
                        add: 'partials/contact/templates/addPartnerContact.html',
                        success: 'partials/contact/templates/addContactSuccess.html'
                    };

                    var opts = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: templates.add,
                        scope: scope,
                        controller: ['$rootScope', function ($rootScope) {
                            var errors = [];
                            scope.errors = [];
                            $rootScope.emeCount = 0;

                            scope.slideTo = function (content) {
                                scope.modalContent = content;
                            };
                            
                            scope.refresh = function(){
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className == "modal-open") {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass("modal-open");
                                    layer.remove();
                                    modalLayer.remove();
                                }
                                
                            }
                            
                            scope.ok = function () {
                                modalInstance.close();
                                scope.refresh();
                            };

                            scope.cancel = function () {
                                modalInstance.close();
                                scope.refresh();
                            };

                            scope.ecpCount = function(){
                                var contacts = scope.member.contacts;
                                contacts = _.uniq(contacts);
                                scope.member.contacts = contacts; // to remove duplicate member contact from array
                                $rootScope.emeCount = contacts.length;
                            };

                            scope.nominateSelf = function (member_id, account_id) {
                                Account.nominateSelfContact(member_id, account_id).then(
                                    function (res) {
                                        scope.member.contacts.push(res);   //  adding one extra contact as contact already added
                                        modalInstance.close();
                                        scope.refresh();
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    });
                            };

                            scope.sendEmailNomination = function (member_id, email) {
                                if(email == $rootScope.account.email){
                                    errors = [];
                                    var errorDetail=[];
                                    if(member_id == scope.member.account_id){
                                        errorDetail.message ='errors.validateECPemail';
                                    }else{
                                        errorDetail.message ='errors.validateECP';
                                    }
                                    errors.push(errorDetail);
                                    scope.errors = errors;
                                    return false;
                                }
                                Account.sendContactEmailNomination(member_id, email).then(
                                    function (res) {
                                        scope.member.contacts.push(res);    //  adding one extra contact as contact already added
                                        modalInstance.close();
                                        success.scope.contact = res;
                                        modalInstance = $modal.open(success);
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    }
                                );
                            };
                        }]
                    };

                    var success = {
                        backdrop: true,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: templates.success,
                        scope: scope,
                        controller: function () {
                            scope.yes = function() {
                                modalInstance.close();
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                            scope.errors = [];
                            scope.modalContent = 'default';
                        }, function () {
                            scope.modalContent = 'default';
                        });
                    });
                }
            }
        }])
  .directive('addMemberContact', ['$modal','$state', 'Account', function ($modal,$state, Account) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;
                    var templates = {
                        add: 'partials/contact/templates/addMemberContact.html',
                        success: 'partials/contact/templates/addContactSuccess.html'
                    };
                    var getnewaddedmemberid;
                    var opts = {
                        backdrop: false,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: false ,
                        size: attrs.size,
                        templateUrl: templates.add,
                        scope: scope,
                        controller: ['$rootScope', function ($rootScope) {
                            var errors = [];
                            scope.errors = [];
                            $rootScope.emeCount = 0;

                            scope.slideTo = function (content) {
                                scope.modalContent = content;
                            };
                            
                            scope.refresh = function(){
                                var body = angular.element(document).find('body').eq(0);
                                if (body[0].className == "modal-open") {

                                    var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer = angular.element(document).find('div.modal').eq(0);

                                    body.removeClass("modal-open");
                                    layer.remove();
                                    modalLayer.remove();
                                }
                                
                            }
                            
                            scope.ok = function () {
                                modalInstance.close();
                                scope.refresh();
                                $state.transitionTo('account.viewMember', {member_id:newaddmemberid}); 
                            };

                            scope.cancel = function () {
                                modalInstance.close();
                                scope.refresh();
                                $rootScope.isAddNewEcp = false;
                                $state.transitionTo('account.viewMember', {member_id: $rootScope.newaddmemberid}); 

                            };

                            scope.ecpCount = function(){
                                var contacts = scope.member.contacts;
                                contacts = _.uniq(contacts);
                                scope.member.contacts = contacts; // to remove duplicate member contact from array
                                $rootScope.emeCount = contacts.length;
                            };

                            scope.nominateSelf = function (member_id, account_id) {
                                Account.nominateSelfContact(member_id, account_id).then(
                                    function (res) {
                                        //scope.member.contacts.push(res);   //  adding one extra contact as contact already added
                                        $state.transitionTo('account.viewMember', {member_id:member_id}); 
                                        modalInstance.close();
                                        scope.refresh();
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    });
                            };

                            scope.sendEmailNomination = function (member_id, email) {
                                if(email == $rootScope.account.email){
                                    errors = [];
                                    var errorDetail=[];
                                    if(member_id == scope.member.account_id){
                                        errorDetail.message ='errors.validateECPemail';
                                    }else{
                                        errorDetail.message ='errors.validateECP';
                                    }
                                    errors.push(errorDetail);
                                    scope.errors = errors;
                                    return false;
                                }
                                Account.sendContactEmailNomination(member_id, email).then(
                                    function (res) {
                                       // scope.member.contacts.push(res);    //  adding one extra contact as contact already added
                                        modalInstance.close();
                                        success.scope.contact = res;
                                        getnewaddedmemberid = member_id;
                                        modalInstance = $modal.open(success);
                                        scope.ecpCount();
                                    },
                                    function (err) {
                                        errors = [];
                                        errors.push(err.data.error);
                                        scope.errors = errors;
                                    }
                                );
                            };
                        }]
                    };

                    var success = {
                        backdrop: false,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: false,
                        size: attrs.size,
                        templateUrl: templates.success,
                        scope: scope,
                        controller: function () {
                            scope.yes = function() {
                                modalInstance.close();
                                $state.transitionTo('account.viewMember', {member_id: getnewaddedmemberid}); 
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                            scope.errors = [];
                            scope.modalContent = 'default';
                        }, function () {
                            scope.modalContent = 'default';
                        });
                    });
                }
            }
        }])
        .directive('removeContact', ['$state', '$modal', 'Account','$rootScope', function ($state, $modal, Account, $rootScope) {
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
                        controller: function () {
                            scope.slideTo = function (content) {
                                scope.modalContent = content;
                            };

                            scope.cancel = function () {
                                modalInstance.close(); 
                            };

                            scope.ok = function () {
                                if (scope.contact.status == 'accepted') {
                                    Account.removeContact(scope.member.id, scope.contact.id, scope.$index).then(
                                        function (res) {
                                         angular.forEach(scope.member.contacts, function (contact, index) {
                                            if (contact.id == scope.contact.id) {
                                                if(attrs.id === "memberecpremove"){
                                                    scope.member.contacts.splice(scope.$index, 1); // remove extra contact as contact already deleted.
                                                }
                                            } 
                                            });
                                        modalInstance.close();
                                        },
                                        function (err) {
                                            alert(err.data.error.message);
                                            modalInstance.close();
                                            $state.reload();
                                        });
                                } else {
                                    Account.cancelContact(scope.member.id, scope.contact.email, scope.$index).then(
                                   
                                        function (res) {
                                            //scope.member.contacts.splice(scope.$index, 1);
                                            if($rootScope.isEditPage){
                                                scope.member.contacts.splice(scope.$index, 1);
                                            }

                                            
                                            modalInstance.close();
                                        },
                                        function (err) {
                                            alert(err.data.error.message);
                                            modalInstance.close();
                                            $state.reload();
                                        });
                                }
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {
                            scope.modalContent = 'default';
                        }, function (err) {
                            scope.modalContent = 'default';
                        });
                    });
                }
            };
        }])

        .directive('reSend', ['$rootScope', '$state', '$modal', 'Account', 'locale', function ($rootScope, $state, $modal, Account, locale) {
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
                        controller: function () {
                            scope.cancel = function () {
                                modalInstance.close();
                            };

                            scope.ok = function () {

                                modalInstance.close();
                            };
                        }
                    };

                scope.resendContactNomination = function(member_id, contact_email){
                    Account.resendContactNomination(member_id, contact_email).then(function(res) {
                            var token = 'messages.resendNominationSuccess';

                            if (locale.isToken(token)) {
                                locale.ready(locale.getPath(token)).then(function () {
                                   
                                   scope.resendmessage = locale.getString(token, {});
                                   modalInstance = $modal.open(opts);
                                   /* setTimeout(function() {
                                        window.alert(locale.getString(token, {}));
                                    }, 500);*/
                                });
                            }
                        });
                }
                scope.resendGuardianNomination = function(email) {
                Account.resendGuardianNomination(email).then(function(res) {
                    var token = 'messages.resendNominationSuccess';

                    if (locale.isToken(token)) {
                        locale.ready(locale.getPath(token)).then(function () {
                            scope.resendmessage = locale.getString(token, {});
                                   modalInstance = $modal.open(opts);
                            /*setTimeout(function() {
                                window.alert(locale.getString(token, {}));
                            }, 500);*/
                        });
                    }
                });
            };

                }
            };
        }])

         .directive('landingPage', ['$rootScope', '$state', '$modal', 'Account', 'locale', function ($rootScope, $state, $modal, Account, locale) {
            return {
                restrict: 'EA',
                link: function (scope, elem, attrs) {
                    var modalInstance = null;

                    var opts1 = {
                        backdrop: false,
                        backdropClick: true,
                        dialogFade: false,
                        keyboard: true,
                        size: attrs.size,
                        templateUrl: attrs.templateurl,
                        scope: scope,
                        controller: function () {
                            scope.cancel = function () {
                                $rootScope.landingpage = false;
                                modalInstance.close();
                            };

                            scope.ok = function () {

                                modalInstance.close();
                            };
                        }
                    };
                   
        if($rootScope.landingpage){
                     setTimeout(function(){ 
                       
                        modalInstance = $modal.open(opts1);

                    }, 500);
        }

                scope.loadingPage = function(){
                    //window.scrollTo(0, 0); 
                    $rootScope.landingpage = true;
                    modalInstance = $modal.open(opts1);
                }

                }
            };
        }])



        .directive('acceptContactRequest', ['$rootScope', '$state', '$modal', 'Account', function ($rootScope, $state, $modal, Account) {
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
                        controller: function () {
                            scope.cancel = function () {
                                modalInstance.close();
                            };

                            scope.ok = function () {
                               
                                if(scope.success == 0){
                                $state.reload();
                                }else{
                                // Fire event for remove message of accepted guardian.
                                $rootScope.$broadcast('message.contact.request.accepted', scope.res.message_id);
                                }
                                modalInstance.close();
                            };
                        }
                    };

                    scope.acceptContact = function (request_id, message_id) {

                        Account.acceptContactRequest(request_id, message_id).then(
                            function (res) {
                                scope.res = res;
                                scope.success = 1;
                                modalInstance = $modal.open(opts);
                                $(".emergency_alert_list ul li").each(function () {
                                    if($(this).hasClass('hide_class_'+request_id)){
                                        $(this).addClass('hide');
                                    }
                                });
                            },
                            function (err) {
                               
                                scope.res = err.data; 
                                scope.success = 0;
                                modalInstance = $modal.open(opts);
                            });
                    }
                }
            };
        }])

        .directive('declineContactRequest', ['$state', '$modal', 'Account', function ($state, $modal, Account) {
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
                        controller: ['$rootScope', function ($rootScope) {
                            scope.cancel = function () {
                                modalInstance.close();
                                $state.transitionTo('account.messages', {}, {reload: true});
                                $rootScope.errorDeclineRequest = '';
                            };

                            scope.declineContact = function (request_id, message_id, reason) {
                                Account.declineContactRequest(request_id, reason).then(
                                    function (res) {
                                        modalInstance.close();
                                        $(".emergency_alert_list ul li").each(function () {
                                            if($(this).hasClass('hide_class_'+request_id)){
                                                $(this).addClass('hide');
                                            }
                                        });
                                        // Fire event for remove message of declined contact.
                                        $rootScope.$broadcast('message.contact.request.declined', message_id);
                                    },
                                    function (err) {
                                        $rootScope.errorDeclineRequest = 'Error: ' + err.data.error.message;
                                       // alert(err.data.error.message);
                                    });
                            }
                        }]
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);
                    });
                }
            };
        }])

        .directive('removeContactFor', ['$state', '$modal', 'Account', function ($state, $modal, Account) {
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
                        controller: function () {
                            scope.slideTo = function (content) {
                                scope.modalContent = content;
                            };

                            scope.cancel = function () {
                                modalInstance.close();
                            };

                            scope.ok = function () {

                                Account.removeContactFor(scope.contact.id, scope.$index).then(
                                    function (res) {
                                        if (angular.element(elem).parent().hasClass('member-alert-triggered')) {
                                            angular.element(elem).parent().removeClass('member-alert-triggered');
                                        }

                                        modalInstance.close();
                                    },
                                    function (err) {
                                        alert(err.data.error.message);
                                        modalInstance.close();
                                        $state.reload();
                                    });
                            };
                        }
                    };

                    elem.on('click', function () {
                        modalInstance = $modal.open(opts);

                        modalInstance.result.then(function (res) {

                        }, function () {
                            scope.modalContent = 'default';
                        });
                    });
                }
            };
        }]);
})();
