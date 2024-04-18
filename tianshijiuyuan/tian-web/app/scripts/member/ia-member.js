(function () {
    'use strict';

    angular.module('iaMember',['ngCookies'])
        .controller('MemberHelperController', function($rootScope, $scope, $state, $stateParams, Account, Alert, locale, MEDIA_BASE,$q) {
            $rootScope.isMobile = false;
            angular.element(document).ready(function () {
                 if(jQuery.browser && jQuery.browser.mobile){
                    $rootScope.isMobile = true;
                }
            });
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

            $scope.locationTracking = false;

            $scope.expandTab = function(){
                angular.element('.panel-collapse').collapse('show');
                $scope.addInfoItems('Insurance', 'Insurances');
                $scope.addInfoItems('Medical', 'Doctors');
                $scope.addInfoItems('Medical', 'Allergies');
                $scope.addInfoItems('Medical', 'Medications');
                $scope.addInfoItems('Medical', 'Covid_reports');
                $scope.addInfoItems('Medical', 'Immunizations');
                $scope.addInfoItems('Medical', 'Medical_conditions');
                $scope.addInfoItems('Medical', 'Surgical_history');
                $scope.addInfoItems('Medical', 'Family_medical_history');
                $scope.addInfoItems('Records', 'Emergency_messages');
                $scope.addInfoItems('Medical', 'Hospital_records');
            }

            $scope.collapseTab = function(){
                angular.element('.panel-collapse').collapse('hide');
            }
            
            $scope.storeScroll = function(){
                if ($state.current.name == 'account.viewMember'){
                    var tab = $rootScope['tabGroup'];
                    if (tab){
                        $rootScope.editPosition =
                            _.isNull(angular.element('#collapse'+tab['tab'])) ?
                                        angular.element('#collapse'+tab['tab']).position().top :
                                        angular.element('#collapse'+tab['group']).position().top;

                        $rootScope.editPosition += (window.innerHeight || document.documentElement.clientHeight);

                    }else {
                        $rootScope.editPosition = window.scrollY + (window.scrollY > 500 ? 480 : 0 );
                    }
                }
                $scope.dockEditFooter();
            }

            $scope.storeTab = function(groupName, tabName){
                if ($state.current.name == 'account.viewMember'){
                    $rootScope['tabGroup'] = {'group': groupName, 'tab': tabName};
                }
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

            var target;

            $scope.$on('$destroy', onDestroy);
            $scope.$watch('member', function (newVal) {
                $rootScope.member = newVal;
            });

            $scope.onAccountLoaded = Account.get()
                .then(function onAccountLoaded (account) {
                    if ($stateParams.member_id) {
                        updateMember(_.find(account.members, { id: parseInt($stateParams.member_id) }));
                    }
                });
                
            var deregister = $rootScope.$watch('account', function (newVal) {
                if (newVal && $stateParams.member_id) {
                    updateMember(_.find(newVal.members, { id: parseInt($stateParams.member_id) }));
                }
            });

            $scope.openImageLoad = false;
            $scope.removeBorder = function()    {
                angular.element(document).find(".Personal_Main_Heading").removeClass("border_red");
                angular.element(document).find(".Insurance_Main_Heading").removeClass("border_red");
                angular.element(document).find(".Medical_Main_Heading").removeClass("border_red");
            }
            
            $scope.onMemberLoaded = $scope.onAccountLoaded
                .then(function onMemberLoaded () {
                    if($scope.member.ice_id === undefined || $scope.member.ice_id === null)
                    {
                        return $scope.member;
                    }
                    $scope.openImageLoad = false;
                    $scope.openImage =  MEDIA_BASE + 'media/qr/iCE_' +$scope.member.ice_id+'.png';
                   qrImageCheck($scope.openImage);

                    if (!$scope.member) {
                        $state.transitionTo('account.show');
                        throw 'Member doesn\'t exist!';
                    }

                    $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt($scope.member.id)});

                    return $scope.member;
                });
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
                function qrImageCheck(src)
                {
                    var deferred = $q.defer();
                    var image = new Image();
                    image.onerror = function() {
                        //window.console.clear();
                        deferred.resolve(false);
                         $scope.openImageLoad = false;
                    };
                    image.onload = function() {
                        //window.console.clear();
                        deferred.resolve(true);
                         $scope.openImageLoad = true;
                    };
                    image.src = src;
                    //window.console.clear();
                    return deferred.promise;
                }
            $scope.changeFrequencyUnit = function(index) {
                var medicalFrequency = angular.element(document).find('input.medication_frequency').eq(index);
                if($scope.member.additional_information.medical.medications[index]['frequency_unit'] == 6) {
                    medicalFrequency.val('');
                    $scope.member.additional_information.medical.medications[index]['frequency'] = null;
                }
                 if($scope.member.additional_information.medical.medications[index]['frequency_unit'] != 6) {
                    angular.element(document).find('input.medication_frequency').removeProp("disabled");
                }
            };

            $scope.getInsuranceCount = function(){
                   var total = 0;
                   if(!$rootScope.publicMode){
                        _.forEach($scope.permission.insurances, function(rec){
                        if(rec.company_name || rec.company_phone || rec.expiry_date || rec.insurance_type || rec.notes || rec.number || rec.plan_type){
                            total += 1;
                            }
                        });

                   }
                   else {
                        var grayout = angular.element(document).find('div.grayout').eq(0);
                        grayout.removeClass("grayout");
                        for(var i = 0; i < $scope.member.additional_information.insurances.length; i++){
                            if($scope.member.additional_information.insurances[i].insurance_type){
                            total ++;
                            }
                        }
                   }
                   
                    return total;
            }

            $scope.getDoctorCount = function(){
                   var total = 0;
                   if(!$rootScope.publicMode){
                        /*for(var i = 0; i < $scope.permission.medical.doctors.length; i++){
                            var all = $scope.permission.medical.doctors[i].all;
                            total += all;
                        }*/
                        _.forEach($scope.permission.medical.doctors, function(rec){
                            var all = rec.all;
                            total += all;
                        });
                   }
                   else {
                        var grayout = angular.element(document).find('div.grayout').eq(0);
                        grayout.removeClass("grayout");
                        for(var i = 0; i < $scope.member.additional_information.medical.doctors.length; i++){
                            if($scope.member.additional_information.medical.doctors[i].first_name || $scope.member.additional_information.medical.doctors[i].last_name){
                            total ++;
                            }
                        }
                   }
                   
                    return total ? total : 0;
            }

            $scope.getBloodCount = function(){
                if($rootScope.publicMode){
                    return $scope.member.additional_information.medical.blood!=null ? 1 : 0;
                }
                else{
                    return $scope.permission.medical.blood.isAllSelected ? 1 : 0;
                }
            }

            $scope.getOrganDonorCount = function(){
                if($rootScope.publicMode){
                    return $scope.member.additional_information.medical.organ_donor.status ? 1 : 0;
                }
                else{
                    return $scope.permission.medical.organ_donor.isAllSelected ? 1 : 0;
                }
            }

             $scope.getLivingWillCount = function(){
                if($rootScope.publicMode){
                   var living_will = $scope.member.additional_information.records.living_will;
                  // console.log(living_will);
                    if(!_.isNull(living_will) && !_.isUndefined(living_will)){
                       //return (living_will.date || living_will.document || living_will.notes) ? 1 : 0;
                       return (living_will.date || living_will.document || living_will.notes) ? 1 : 0;
                    }
                }
                else{
                    return $scope.permission.records.living_will.isAllSelected ? 1 : 0;
                }
            }

            $scope.getAllergiesCount = function(){
                   var total = 0;

                   if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.allergies, function(rec){
                         if(!_.isUndefined(rec.id)){
                            if(rec.name || rec.notes || rec.reaction || rec.severity){
                                total += 1;
                            }
                        }
                    });
                   
                   }
                   else {
                        var grayout = angular.element(document).find('div.grayout').eq(0);
                        grayout.removeClass("grayout");
                       for(var i = 0; i < $scope.member.additional_information.medical.allergies.length; i++){
                            if($scope.member.additional_information.medical.allergies[i].name){
                            total ++;
                            }
                        }
                   }
                   
                    return total;
            }

            $scope.getMedicationCount = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.medications, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.dosage || rec.frequency || rec.from || rec.to || rec.name || rec.notes || rec.purpose || rec.status){
                                total += 1;
                            }
                        }
                    });
            
                }
                else {
                     var grayout = angular.element(document).find('div.grayout').eq(0);
                     grayout.removeClass("grayout");   
                     for(var i = 0; i < $scope.member.additional_information.medical.medications.length; i++){
                        if($scope.member.additional_information.medical.medications[i].name){
                        total ++;
                        }
                    }
                }
                    return total;
            }
            $scope.getCovidReportsCount = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.covid_reports, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.pcategory || rec.pname || rec.mfname || rec.lotnumber || rec.srnumber || rec.result){
                                total += 1;
                            }
                        }
                    });
            
                }
                else {
                     var grayout = angular.element(document).find('div.grayout').eq(0);
                     grayout.removeClass("grayout");   
                     for(var i = 0; i < $scope.member.additional_information.medical.covid_reports.length; i++){
                        if($scope.member.additional_information.medical.covid_reports[i].pname){
                        total ++;
                        }
                    }
                }
                    return total;
            }

            $scope.getImmunizationCount = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.immunizations, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.date || rec.name || rec.notes || rec.series){
                                total += 1;
                            }
                        }
                    });
                }
                else {
                    var grayout = angular.element(document).find('div.grayout').eq(0);
                    grayout.removeClass("grayout");
                    for(var i=0; i<$scope.member.additional_information.medical.immunizations.length; i++){
                        if($scope.member.additional_information.medical.immunizations[i].name){
                            total++;
                        }
                    }
                }
                return total;
            }

            $scope.getSurgicalHistoryCount = function(){
                var total = 0;
                 if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.surgical_history, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.date || rec.notes || rec.reason || rec.type){
                                total += 1 ;
                            }
                        }
                    });
                    
                  }
                 else {
                        var grayout = angular.element(document).find('div.grayout').eq(0);
                        grayout.removeClass("grayout");
                        for(var i=0; i<$scope.member.additional_information.medical.surgical_history.length; i++){
                            if($scope.member.additional_information.medical.surgical_history[i].type){
                                total ++;
                            }
                        }
                    }
                
                return total;
            }

            $scope.getMedicalConditionCount = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.medical_conditions, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.from || rec. to || rec.name || rec.status || rec.notes){
                                total += 1;
                            }
                        }
                    });
                }
                else{
                    var grayout = angular.element(document).find('div.grayout').eq(0);
                    grayout.removeClass("grayout");
                    for(var i=0; i<$scope.member.additional_information.medical.medical_conditions.length; i++){
                        if($scope.member.additional_information.medical.medical_conditions[i].name){
                            total ++;
                        }
                    }
                }
                return total;
            }

            $scope.getFamilyMedHistCount = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.family_medical_history, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if(rec.notes ||rec.relationship || rec.severity || rec.type){
                                total += 1;
                            }
                        }
                    });
                }
                else{
                    var grayout = angular.element(document).find('div.grayout').eq(0);
                    grayout.removeClass("grayout");
                    for(var i = 0; i<$scope.member.additional_information.medical.family_medical_history.length; i++){
                        if($scope.member.additional_information.medical.family_medical_history[i].type){
                            total ++;
                        }
                    }
                }
                return total;
            }

            $scope.getEmergencyMessages = function(){
                var total = 0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.records.emergency_messages, function(rec){
                        var all = !_.isUndefined(rec.id) && rec.file 
                                    || !_.isUndefined(rec.id) && rec.notes ? 1 : 0;
                        total += all;
                    });
                    /*for(var i=0; i<$scope.permission.records.emergency_messages.length; i++){
                        var all = !_.isUndefined($scope.permission.records.emergency_messages[i].id) && $scope.permission.records.emergency_messages[i].file 
                                    || !_.isUndefined($scope.permission.records.emergency_messages[i].id) && $scope.permission.records.emergency_messages[i].notes ? 1 : 0;
                        total += all;
                    }*/
                }
                else{
                    var grayout = angular.element(document).find('div.grayout').eq(0);
                    grayout.removeClass("grayout");
                    for(var i=0; i<$scope.member.additional_information.records.emergency_messages.length; i++){
                        if($scope.member.additional_information.records.emergency_messages[i].file 
                                || $scope.member.additional_information.records.emergency_messages[i].notes){
                            total ++;
                        }
                    }
                }
                return total;
            }

            $scope.getHospitalRecordsCount = function(){
                var total =0;
                if(!$rootScope.publicMode){
                    _.forEach($scope.permission.medical.hospital_records, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if (rec.date  || rec.category || rec.practitioner || rec.notes || rec.file){
                                total += 1;
                            }
                        }
                    });

                }
                else{
                    var grayout = angular.element(document).find('div.grayout').eq(0);
                    grayout.removeClass("grayout");

                    _.forEach($scope.member.additional_information.medical.hospital_records, function(rec){
                        if(!_.isUndefined(rec.id)){
                            if (rec.date  || rec.category || rec.practitioner || rec.notes || rec.file){
                                total += 1;
                            }
                        }
                    });
                }
                return total;
            }


           
            

            $scope.changeType = function() {
                $scope.member.additional_information.medical.organ_donor.condition = null;
                $scope.member.additional_information.medical.organ_donor.card = null;
                $scope.member.additional_information.medical.organ_donor.notes = null;
            };

            $scope.changeDelete = function(){
                $scope.member.additional_information.medical.organ_donor.status = null;
                $scope.member.additional_information.medical.organ_donor.condition = null;
                $scope.member.additional_information.medical.organ_donor.card = null;
                $scope.member.additional_information.medical.organ_donor.notes = null;
                angular.element("input[name='card']").val(null);
            };

            $scope.hasSynced = function (devices){

                return _.isArray(devices) ? devices.length > 0 : 0;
            };

            $scope.editMode = function (){
                return $rootScope.editMode;
            };

            $scope.addInfoItems = function(groupName, tabName){

                var itemCount = tabName.toLowerCase() + '_item_count';

                if(_.isUndefined($scope[itemCount])){
                    $scope[itemCount] = 0;
                }

                $scope[itemCount] = groupName == 'Insurance' ? $scope.member.additional_information[tabName.toLowerCase()].length
                                         : $scope.member.additional_information[groupName.toLowerCase()][tabName.toLowerCase()].length;

                $scope.storeTab(groupName, tabName);

                $scope.dockEditFooter();
                var heading_class = '';
                var tab_class = '';
                var mainHeadingClass = '';
                switch(tabName){
                    case 'Doctors':
                        heading_class = 'Doctor_heading';
                        tab_class = 'Doctor_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Allergies':
                        heading_class = 'AllergyInfo_heading';
                        tab_class = 'AllergyInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Medications':
                        heading_class = 'MedicationsInfo_heading';
                        tab_class = 'MedicationsInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Immunizations':
                        heading_class = 'ImmunizationsInfo_heading';
                        tab_class = 'ImmunizationsInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Covid_reports':
                        heading_class = 'CovidInfo_heading';
                        tab_class = 'CovidInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Medical_conditions':
                        heading_class = 'MedicalCondition_heading';
                        tab_class = 'MedicalCondition_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Surgical_history':
                        heading_class = 'surgicalHistoryInfo_heading';
                        tab_class = 'surgicalHistoryInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Family_medical_history':
                        heading_class = 'FamilyMedicalInfo_heading';
                        tab_class = 'FamilyMedicalInfo_tab';
                        mainHeadingClass = 'Medical_Main_Heading';
                        break;
                    case 'Insurances':
                        heading_class = 'Insurance_Main_Heading';
                        tab_class = 'Insurance_tab';
                        mainHeadingClass = 'Insurance_Main_Heading';
                        break;
                }
                // Border red for any error in tabs of medical, insuraces etc
               // $scope.tabValidation(heading_class,tab_class,mainHeadingClass);

            }

            $scope.tabValidation = function(heading_class,tab_class,mainHeadingClass){
                var get_collapse = angular.element(document).find("."+heading_class+" .panel-heading .get_collapse ").attr("aria-expanded") === "true" ? true:false;
                var element = angular.element(document).find("."+heading_class+" .panel-body ."+tab_class+" .ng-invalid").length;
                var medical_element = angular.element(document).find("."+mainHeadingClass+" .panel-body .ng-invalid").length;

                if(mainHeadingClass=="Medical_Main_Heading"){
                    if(element){
                        angular.element(document).find("."+heading_class).addClass("border_red");
                    }else{
                        angular.element(document).find("."+heading_class).removeClass("border_red");
                    }
                    if(medical_element && tab_class =='Medical_Main_Heading_tab'){
                        angular.element(document).find("."+mainHeadingClass).addClass("border_red");
                    }
                    else{
                        angular.element(document).find("."+mainHeadingClass).removeClass("border_red");
                    }
                }
                else{
                    if(element || medical_element){
                        //angular.element(document).find("."+heading_class).addClass("border_red");
                        angular.element(document).find("."+mainHeadingClass).addClass("border_red");
                    }else{
                        //angular.element(document).find("."+heading_class).removeClass("border_red");
                        angular.element(document).find("."+mainHeadingClass).removeClass("border_red");
                    }   
                }
                

                if(!get_collapse){
                    angular.element(document).find("."+heading_class).removeClass("border_red");
                }
            }
            $scope.onMemberLoaded.then(function () {
                $scope.addMore = addMore;
                $scope.remove = remove;
                $scope.resetStatus = resetStatus;
                $scope.getFormData = getFormData;
                $scope.hasAdditionalInfo = hasAdditionalInfo;
                $scope.infoAvailable = infoAvailable;
                $scope.shouldShow = shouldShow;
                $scope.memberHasTwoContacts = memberHasTwoContacts;
                $scope.resendContactNomination = resendContactNomination;
                $scope.olderThen16 = olderThen16;
                $scope.goPermissionPage = goPermissionPage;
                $scope.showField = showField;
                $scope.hasPermission = hasPermission;
                $scope.getPermissionIndex = getPermissionIndex;
                $scope.sync = sync;
                $scope.unsync = unsync;

            });


            function onDestroy () {
                deregister();
            }

            function updateMember (newMember) {
                
                if (typeof(newMember) == 'object'){
                    $scope.member = angular.copy(newMember);
                } else {
                    $state.transitionTo('account.show', {});
                }

                if (typeof(newMember) == 'undefined') {
                    $state.transitionTo('account.show');
                    throw 'This member doesn\'t exists!';
                }
                
                if ($scope.member == null){
                    $scope.member = {
                      "additional_information":{}  
                    };
                };
                
                target = $scope.member.additional_information || {};
            }

            function addMore (attribute, parent) {
                target = $scope.member.additional_information || {};
                if (angular.isUndefined(target[parent])) {
                    target[parent] = (attribute === parent) ? [] : {};
                }

                if (attribute === parent) {
                    target[parent].push({});                
                } else {

                    if (angular.isUndefined(target[parent][attribute]) || _.isEmpty(target[parent][attribute])) {
                        target[parent][attribute] = [];
                    }

                    if(attribute ==='covid_reports'){
                        var curr_date_obj = new Date();
                        target[parent][attribute].push({'coviddate':{'year':curr_date_obj.getFullYear(),'month':curr_date_obj.getMonth()+1,'day':curr_date_obj.getDate()}});
                    }else if(attribute ==='immunizations'){
                        var curr_date_obj = new Date();
                        target[parent][attribute].push({'date':{'year':curr_date_obj.getFullYear(),'month':curr_date_obj.getMonth()+1,'day':curr_date_obj.getDate()}});
                    }else{
                    target[parent][attribute].push({});
                    }
                }
                if(!angular.isUndefined(target[parent][attribute]))
                    target[parent][attribute].allempty = false;
                else if(!angular.isUndefined(target[parent])){
                    target[parent].allempty = false;
                }
                $scope[attribute+'_item_count'] += 1;
            }

            /**
             * Remove data from scope.
             *
             * @param attribute
             * @param parent
             * @param index
             */
            function remove (attribute, parent, index,remove_tab_class) {
                var inew = 0;
                var deletedCount = 0;
                var notDeletedCount = 0;
                if (attribute === parent) {
                    if (angular.isDefined(target[parent][index]['id'])) {
                        target[parent][index]['deleted'] = true;
                    } else {
                        target[parent].splice(index, 1) ;
                    }
                } else {
                    if (angular.isDefined(target[parent][attribute][index]['id'])) {
                        target[parent][attribute][index]['deleted'] = true;
                    } else {
                        target[parent][attribute].splice(index, 1);
                        angular.element("input[name='file']").val(null);
                    }

                }

                if(!angular.isUndefined(target[parent][attribute])){
                    for(inew = 0;inew < target[parent][attribute].length;inew++){
                        if(target[parent][attribute][inew]['deleted']){
                            deletedCount++;
                        }
                        else{
                            notDeletedCount++;
                        }
                    }
                    if(notDeletedCount){
                        target[parent][attribute].allempty = false;  
                    }
                    else{
                        target[parent][attribute].allempty = true;  
                    }
                    target[parent][attribute].deletedCount = deletedCount;
                }
                else if(!angular.isUndefined(target[parent])){
                    for(inew = 0;inew < target[parent].length;inew++){
                        if(target[parent][inew]['deleted']){
                            target[parent].allempty = true;
                        }
                        else{
                            target[parent].allempty = false; 
                            break;  
                        }
                    }
                }
                $scope.memberForm.$submitted = false;
                angular.element(document).find("."+remove_tab_class+"_"+index+" .ng-invalid").remove();
            }

            function resetStatus(attribute2, parent,attribute1)
            {
                target = $scope.member.additional_information || {};
                if(attribute2==='marital_status')
                {
                     target[parent][attribute2]=null;
                }
                else if(attribute1==='phone')
                {
                    target[parent][attribute2].number='';
                    target[parent][attribute2].code=null;
                }
                else
                {
                     target[parent][attribute2][attribute1]=null;
                }

                $scope.memberForm.$submitted = false;
            }

            $scope.resetliving = function(){
                $scope.member.additional_information.records.living_will.document= null;
                $scope.member.additional_information.records.living_will.notes= null;
                $scope.member.additional_information.records.living_will.date.year= null;
                angular.element("input[name='document']").val(null);
            };
            $scope.resetblood = function(){
                $scope.member.additional_information.medical.blood.blood_type= null;
                $scope.member.additional_information.medical.blood.notes= null;
            };

            function getFormData (attribute, parent, index) {
              var data = {};
              data.id = $scope.member.id;
              data.additional_information = {};

              if (attribute === parent) {
                data.additional_information[parent] = [];

                data.additional_information[parent].push(target[parent][index]);
                
              } else {
                data.additional_information[parent] = {};
                data.additional_information[parent][attribute] = [];

                data.additional_information[parent][attribute].push(target[parent][attribute][index]);
              }

              return data;
            }

            /**
             * Check whether scope value length > 0
             *
             * @param attribute
             * @param parent
             * @returns {boolean}
             */
            function hasAdditionalInfo (attribute, parent) {
                if (angular.isUndefined(target[parent])) {
                    return false;
                } else {
                    return (attribute === parent) ?
                            angular.isDefined(target[parent]) :
                            angular.isDefined(target[parent][attribute]);
                }
            }

            function infoAvailable (attribute, parent, index) {
                if (angular.isUndefined(index)) {
                    if (angular.isUndefined(target['permission']) || angular.isUndefined(target['permission']['category'])) {
                    	return false;
                    }

                    return angular.isUndefined(target['permission']['category'][parent]) || target['permission']['category'][parent];
                } else {
                    return attribute === parent ? target['permission'][parent][index] : target['permission'][parent][attribute][index];
                }
            }

            function shouldShow (attribute, parent, index) {
                return $scope.hasAdditionalInfo(attribute, parent) && $scope.infoAvailable(attribute, parent, index);
            }

            function memberHasTwoContacts (member) {
                return member.contacts.length === 2;
            }

            function resendContactNomination (member_id, contact_email) {
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

            function olderThen16 (member) {
                
                var today = new Date();
                if (!angular.isUndefined(member.birth_date)){
                    if(member.birth_date.year ===0){
                        return false;
                    }
                    var birthDate = new Date(member.birth_date.year, member.birth_date.month, member.birth_date.day);
                    return today >= new Date(birthDate.getFullYear() + 16, birthDate.getMonth()-1, birthDate.getDate());
                }else{
                    return today;
                }
            }

            function goPermissionPage (account_id, member_id, contact) {
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

            function showField (field, permission) {

                if (!field 
                    || (_.isObject(field) && _.every(field, _.isNull)) 
                    || (_.isObject(field) && !_.every(field, _.isNumber) && _.every(field, _.isEmpty)) 
                    || (_.isArray(field) && _.isEmpty(field)) ) {
                    return false;
                }
                
                return ($rootScope.publicMode) || ($rootScope.thirdPartyMode && permission) || ($rootScope.setEcpPermission) || ($rootScope.shareMode) || ($rootScope.previewMode && permission);
            }

            function hasPermission (collection, id, field) {
                var item = _.find(collection, {id: parseInt(id)});

                return (item) ? item[field] : false;
            }

            function getPermissionIndex (collection, id) {
                var index = null;

                _.each(collection, function(c, i) {
                    if (c.id == id) {
                        index = i;
                    }
                });

                return (index) ? index : collection.length + 1;
            }

            function sync (uuid, member_id) {
                Account.sync(uuid, member_id)
                    .then(function (res) {
                        angular.extend(_.find($scope.member.devices, {uuid: res.uuid}), res);
                    });
            }

            function unsync (uuid, member_id) {
                Account.unsync(uuid, member_id)
                    .then(function () {
                        angular.forEach($scope.member.devices, function (device, index) {
                            if (device.uuid === uuid) {
                                $scope.member.devices.splice(index, 1);
                                $rootScope.$broadcast('account.updated', $scope.member);
                                $state.transitionTo('account.viewMember', {member_id: $scope.member.id});
                            }
                        });
                    })
                    .catch(function () {
                        $state.reload();
                    });
            }
        })

        .controller('AddMemberController', function ($rootScope,$scope, $controller, $state, Account,Auth) {
            var errors = [];
            $rootScope.phonenumberalreadyused = false;
            $rootScope.isemailavailableformember= false;
            $rootScope.isemailalreadyexistformember= false;
            $rootScope.isemailactiveformember = false;
            $rootScope.isemailrequiredformember = false;
            
            sessionStorage.setItem("accountphonenubmervalue", true);
            $scope.errors = [];
             Account.get()
               .then(function onAccountLoaded (account) {                    
                   if(!account.is_premium && account.is_partner != 1){
                       $state.go('base.home');
                    }
                    if(account.members.length==5 && ((account.is_partner != 1)|| (account.is_partner == 1)&& (account.is_premium == false))){
                        $state.transitionTo('account.show', {});
                    }else if(account.members.length==(account.plans.member_count+1) && account.is_partner == 1){
                        $state.transitionTo('account.show', {});
                    }
               });
            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == "micromessenger") {
                $scope.fileuploadtype = "image/*";
            }else{
                $scope.fileuploadtype = "image/*|application/pdf";
            }

            $scope.isSaveBtnTrue = false;
            var memberSaveBtnFrst = document.querySelector('#memberSaveFirstBtn');
            if(!_.isNull(memberSaveBtnFrst))
                memberSaveBtnFrst.classList.remove('loading_icon_price');

            var memberSaveBtnSecond = document.querySelector('#memberSaveSecondBtn');
            if(!_.isNull(memberSaveBtnSecond))
                memberSaveBtnSecond.classList.remove('loading_icon_price');

            $scope.member = {
                additional_information: {
                    personal: {
                        location_track: 1,
                        home_phone:{code: $rootScope.IPCountryCode, number:''},
                        workplace_phone:{code: $rootScope.IPCountryCode, number:''}
                    },
                    insurances: [], 
                    records:{
                        emergency_messages: [],
                        living_will:{

                        }
                    },


                    medical:{
                        doctors:[],
                        blood:{

                        },
                        allergies:[],
                        covid_reports:[],
                        medications:[],
                        immunizations:[],
                        medical_conditions:[],
                        surgical_history:[],
                        family_medical_history:[],
                        hospital_records: [],
                        organ_donor:{
                        }

                    }

                }
            };

            $controller('MemberHelperController', { $scope: $scope });
            $scope.scrollDown = function (mem_valid){
                //alert(mem_valid);
                if(!mem_valid){
                    var personal_main = angular.element(document).find('div.Personal_Main_Heading .ng-invalid');
                    if(personal_main.length){
                        $scope.assignScrolling('collapsePersonal');
                    }
                    var insurance_main = angular.element(document).find('div.Insurance_Main_Heading .ng-invalid');
                    if(insurance_main.length){
                        $scope.assignScrolling('collapseInsurance');
                    }
                    var medical = angular.element(document).find('div.Medical_Main_Heading .ng-invalid');
                    if(medical.length){
                        $scope.assignScrolling('collapseMedical');
                        var doctor_tab = angular.element(document).find('div.Medical_Main_Heading .Doctor_heading .ng-invalid');
                        if(doctor_tab.length){
                            $scope.assignScrolling('collapseDoctors');
                        }
                        var allergies_tab = angular.element(document).find('div.Medical_Main_Heading .AllergyInfo_heading .ng-invalid');
                        if(allergies_tab.length){
                            $scope.assignScrolling('collapseAllergies');
                        }
                        var medical_info_tab = angular.element(document).find('div.Medical_Main_Heading .MedicationsInfo_heading .ng-invalid');
                        if(medical_info_tab.length){
                            $scope.assignScrolling('collapseMedications');
                        }
                        var covid_tab = angular.element(document).find('div.Medical_Main_Heading .CovidInfo_heading .ng-invalid');
                        if(covid_tab.length){
                            $scope.assignScrolling('collapseCovid');
                        }
                        var immunization_tab = angular.element(document).find('div.Medical_Main_Heading .ImmunizationsInfo_heading .ng-invalid');
                        if(immunization_tab.length){
                            $scope.assignScrolling('collapseImmunizations');
                        }
                        var medicalcondition_tab = angular.element(document).find('div.Medical_Main_Heading .MedicalCondition_heading .ng-invalid');
                        if(medicalcondition_tab.length){
                            $scope.assignScrolling('collapseMedical_conditions');
                        }
                        var surgical_tab = angular.element(document).find('div.Medical_Main_Heading .surgicalHistoryInfo_heading .ng-invalid');
                        if(surgical_tab.length){
                            $scope.assignScrolling('collapseSurgical_history');
                        }
                        var familyMed_tab = angular.element(document).find('div.Medical_Main_Heading .FamilyMedicalInfo_heading .ng-invalid');
                        if(familyMed_tab.length){
                            $scope.assignScrolling('collapseFamily_medical_history');
                        }
                        var familyMed_tab = angular.element(document).find('div.Medical_Main_Heading .FamilyMedicalInfo_heading .ng-invalid');
                        if(familyMed_tab.length){
                            $scope.assignScrolling('collapseFamily_medical_history');
                        }
                    }
                }
            }
            $scope.assignScrolling = function(assign_id){
                $('#'+assign_id).attr('aria-expanded',true);
                $('#'+assign_id).removeAttr('style');
                $('#'+assign_id).addClass('in');
            }

            $scope.handle = function (member) {

                if(!_.isUndefined(member.phone.number)|| !_.isNull(member.phone.number)) {
                    member.phone.number = $scope.formatPhoneNumber(member.phone.number);
                }
                if(!_.isUndefined(member.additional_information.personal.home_phone)){
                    if(!_.isUndefined(member.additional_information.personal.home_phone.number)){
                         member.additional_information.personal.home_phone.number = $scope.formatPhoneNumber(member.additional_information.personal.home_phone.number);
                      }
                }
                if(!_.isUndefined(member.additional_information.personal.workplace_phone) ){
                    if(!_.isUndefined(member.additional_information.personal.workplace_phone.number)  ){
                        member.additional_information.personal.workplace_phone.number = $scope.formatPhoneNumber(member.additional_information.personal.workplace_phone.number);
                     }
                }

                if(member.additional_information.insurances.length>0){
                    _.forEach(member.additional_information.insurances, function(rec){
                       if(!_.isUndefined(rec.company_phone)){
                            if(!_.isUndefined(rec.company_phone.number)){
                             rec.company_phone.number = $scope.formatPhoneNumber(rec.company_phone.number);
                             }
                        }
                    })
                }

                if(member.additional_information.medical.doctors.length>0){
                    _.forEach(member.additional_information.medical.doctors, function(rec){
                        if(!_.isUndefined(rec.phone.number)){
                             if(!_.isUndefined(rec.phone.number)){
                                 rec.phone.number = $scope.formatPhoneNumber(rec.phone.number);
                            }
                         }
                    })
                }

                var postData = angular.copy(member);
                $scope.memberError = " ";

                if (postData.use_account_email) {
                    postData.email = null;
                }

                $rootScope.globals.showSpinner = false;
                $rootScope.globals.stateShowSpinner = false;
                $rootScope.redirecting = true;

                if(!_.isNull(memberSaveBtnFrst)){
                   //memberSaveBtnFrst.classList.add('loading_icon_price');
                   $scope.editmemLoading= true;
                }

                if(!_.isNull(memberSaveBtnSecond)){
                    //memberSaveBtnSecond.classList.add('loading_icon_price');
                    $scope.editmemLoading= true;
                }
                   
                   $scope.isSaveBtnTrue = true;

                Account.addMember(postData)
                    .then(function (result) {
                        $rootScope.phonenumberalreadyused = false;
                        sessionStorage.setItem("accountphonenubmervalue", true);
                        sessionStorage.setItem("refreshAccountDetails", true);
                        Account.get().then(function (value){
                            $rootScope.showPartner = Auth.isPartner();
                        });
                        $rootScope.isAddNewEcp = true;
                        $rootScope.newaddmemberid = result.id;
                        
                           if($rootScope.showPartner){
                                $state.transitionTo('account.viewMember', {member_id: result.id});
                                return;
                           }
                        var resultval = result;
                        $scope.isSaveBtnTrue = true;
                        $scope.errors = [];
                        if(!_.isNull(memberSaveBtnFrst)){
                           // memberSaveBtnFrst.classList.remove('loading_icon_price');                
                           $scope.editmemLoading= false;
                        }
                        if(!_.isNull(memberSaveBtnSecond)){
                            //memberSaveBtnSecond.classList.remove('loading_icon_price');
                            $scope.editmemLoading= false;
                        }
                         $scope.removeBorder();
                        var saveSuccessfully = angular.element(document).find('div.member-save-info');
                        var addnewEcpButton = angular.element(document).find('a.add-person');
                            saveSuccessfully.fadeIn(500,0).slideDown(500);
                            setTimeout(function() {
                                saveSuccessfully.fadeOut(500,0).slideUp(500);
                                angular.element('#add-ecp-btn-member').click();
                            }, 3000);
                    })
                    .catch(function (err) {
                              if(!_.isNull(memberSaveBtnFrst))
                                            memberSaveBtnFrst.classList.remove('loading_icon_price');
                                        
                                        if(!_.isNull(memberSaveBtnSecond))
                                            memberSaveBtnSecond.classList.remove('loading_icon_price');
                                 
                           $scope.isSaveBtnTrue = false;
                           if (!_.isUndefined(err.data.error)) {
                                if (!_.isUndefined(err.data.error.message) || !_.isNull(err.data.error.message) || !_.isEmpty(err.data.error.message)) {
                                    if(err.data.error.message.trim().toLowerCase().indexOf('email has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('email 已经被使用')!=-1){                                     
                                            $rootScope.isemailavailableformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                            }, 7000);*/
                                         }
                                    else if(err.data.error.message.trim().toLowerCase().indexOf('phone number has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('phone number 已经被使用')!=-1){                                     
                                        $rootScope.phonenumberalreadyused = true;
                                           /*setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.phonenumberalreadyused = false;                                            
                                                });                                        
                                             }, 7000);*/ 
                                    }
                                    else{
                                          errors = [];
                                        $scope.errorSaving = true;
                                        errors.push(err.data.error);
                                        _.each(errors, function(error) {
                                            if (!_.isNull(error.message) || !_.isEmpty(error.message)) {
                                                $scope.memberError = error.message;
                                            }
                                        });
                                    }
                                }
                            }
                            else{
                                    if (!_.isUndefined(err.data) || !_.isNull(err.data) || err.data){
                                        if (err.data === undefined) {
                                            $scope.isNotValide = true;
                                            
                                        } else if(err.data === "taken"){
                                            $rootScope.isemailavailableformember = true;
                                            /*setTimeout(function() {
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
                                            }, 7000); */                              
                                        }
                                        else if(err.data === "member"){                                  
                                            $rootScope.isemailalreadyexistformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailalreadyexistformember = false;                                            
                                                        });                                        
                                            }, 7000);  */                              
                                        }
                                        else if(err.data === "account"){                                    
                                            $rootScope.isemailavailableformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                            }, 7000);*/                                 
                                         
                                        }
                                        else if(err.data === "Empty email"){                                  
                                            $rootScope.isemailrequiredformember = true;
                                            /*setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailrequiredformember = false;                                            
                                                        });                                        
                                            }, 7000);*/
                                        }
                            
                                    }
                                }
                            
                    });
            };

             $scope.formatPhoneNumber = function(phoneNumber){
                var number = phoneNumber;
                number = number.replace(/\D/g,'');
                return number;

            };
        })

        .controller('ShowMemberController', function ($rootScope, $scope, $controller,$location, Restangular, $stateParams, Account, AuthToken, Alert) {
            Restangular.one('account').withHttpConfig({ cache: false}).get()
                .then(function(account) {
                    Account.accountUpdated({'data': account});
                })
            $rootScope.viewMode = true;
           $rootScope.isAddNewEcp = false;
            $rootScope.isShowAlertBanner = false;
            var getExpireDateVal = $location.$$search.expireDate;  
            
             if(!_.isUndefined(getExpireDateVal)&&!_.isNull(getExpireDateVal)){
              
            var getDateOnly = getExpireDateVal.split(' ');
            var getExpireDate = getDateOnly[0];
            
            if(!_.isUndefined(getExpireDate)&&!_.isNull(getExpireDate)){
              
                var ServerTimeDate;
                if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone"){
                    ServerTimeDate = new Date(getExpireDate+'Z');
                }
                else{
                    ServerTimeDate = new Date(getExpireDate);
                }
                    //currentTime = moment().tz(date.timezone).format('YYYY-MM-DDTHH:mm:ss');
                var differenceVal =  setInterval(function() {
                    var timeDifferenceVal = null;
                    var mylocalDate = new Date();
                    var diffVal = mylocalDate.getTimezoneOffset() * 60000;
                    
                    if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone"){
                        var timeDifference = (ServerTimeDate.getTime()) - (mylocalDate.getTime());
                    }
                    else{
                        var timeDifference = (ServerTimeDate.getTime()-(mylocalDate.getTimezoneOffset() * 60000)) - (mylocalDate.getTime());
                    }
                    timeDifferenceVal = timeDifference;

                    var diffHrs = Math.floor((timeDifference % 86400000) / 3600000); // hours
                    var diffMins = Math.round(((timeDifference % 86400000) % 3600000) / 60000)
                    var  ms = timeDifference % 1000;
                        timeDifference = (timeDifference - ms) / 1000
                    var ss = timeDifference % 60;
                        $scope.secondsVal = ss;
                        timeDifference = (timeDifference - ss) / 60
                    var mm = timeDifference % 60;
                        $scope.minutesVal = mm;
                        timeDifference = (timeDifference - mm) / 60

                    var hh = timeDifference;
                        $scope.CounterTime = hh +'h '+mm+ 'm '+ss+'s';

                    if (timeDifferenceVal <= 0) {                        
                        $rootScope.isShowAlertBanner = false;                                
                        }
                        else{
                            $rootScope.isShowAlertBanner = true;
                        }

                   $scope.$apply();
                }, 1000);    
                    
            }
        }
            onEventsReceived();
            $controller('MemberHelperController', { $scope: $scope });
            
            $scope.$on('events.received', onEventsReceived);
            
            function onMemberLoaded () {
                $scope.$on('alerts.received', getAlertHistory);
                getAlertHistory();
            }
            
            function onEventsReceived () {
                Account.getMember($stateParams.member_id)
                    .then(function (member) {
                        $scope.member = member;
                        $scope.$watch('member', function (member) {
                            $rootScope.member = member;
                        });    
                    });
            }

            function getAlertHistory () {
                $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt($scope.member.id)});
            }

            $scope.editMiniloader = function(){
            $rootScope.editLoading = true;
            /*setTimeout(
            function() {
              $scope.editLoading = false;
            }, 2000); */
        };

        })

        .controller('CovidResultController', function ($rootScope, $scope, $controller, $state, $stateParams, $window, $filter, Account, MEDIA_BASE,$modal, $http) {
         
            $http({
                "url":Config.API_BASE+'/covid/publickey/'+$stateParams.key,
                "method":"GET",
            }).then(function(response){
                $scope.covidresult = response.data.data[0];
            });
        })

        .controller('ShowPTNMemberController', function ($rootScope, $scope, $controller, $state, $stateParams, $window, $filter, Account, MEDIA_BASE,$modal, $http) {
            Account.get().then(function(res){
               $rootScope.partner_ice_id = res;
                angular.forEach($rootScope.partner_ice_id.members, function(member, index) {
                    if((member.birth_date.year && member.birth_date.year !=='') && (member.birth_date.month && member.birth_date.month !=='') && (member.birth_date.day && member.birth_date.day !=='')){
                        $rootScope.partner_ice_id.members[index].getfulldob = new Date(member.birth_date.year+'-'+member.birth_date.month+'-'+member.birth_date.day);
                    }
                    else{
                        $rootScope.partner_ice_id.members[index].getfulldob = new Date('1200-1-1');
                    }
                });
               
            });
            $scope.sortBy = function(propertyName) {
                $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
                $scope.propertyName = propertyName;
            };

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
         
        })
        .controller('ShowPTNECPersonController', function ($rootScope, $scope, $controller, $state, $stateParams, $window, $filter, Account, MEDIA_BASE,$modal, $http) {
            
         
        })

        .controller('ImmunizationResultController', function ($rootScope, $scope, $controller, $state, $stateParams, $window, $filter, Account, MEDIA_BASE,$modal, $http) {
         
            $http({
                "url":Config.API_BASE+'/immunization/publickey/'+$stateParams.key,
                "method":"GET",
            }).then(function(response){
                $scope.immunizationresult = response.data.data[0];
            });
        })

        .controller('CovidMemberController', function ($rootScope, $scope, $controller, $state, $stateParams, $window, $filter, Account, MEDIA_BASE,$modal, $http) {
            //$scope.dataLoaded = false;
            $scope.crecords = false;

            $http({
                "url":Config.API_BASE+'/account/covid/'+$stateParams.member_id,
                "method":"GET",
            }).then(function(response){
            //$rootScope.cityName = response.data.city;
            $scope.members = response.data;
            //console.log(response.data.length);
            //$scope.dataLoaded = true ;
            });


            $scope.showtest = function (){
                var data = $scope.members;
                $scope.crecords = false;
                //var xuser = $scope.members.find(xuser => xuser.id === $scope.coviduser.id);
                
                if($scope.coviduser.id != ''){
                var result = $.grep($scope.members, function(e){ return e.id == $scope.coviduser.id; });
                //if(result[0].additional_information.medical.covid_reports.length!=0){
                $scope.user = result[0].additional_information.medical.covid_reports;
                    //$scope.nouser = false;
                }else{
                    //$scope.nouser = true;
                }
                

            }
            /*
            $scope.colors = [
                {name:'black', shade:'dark'},
                {name:'white', shade:'light', notAnOption: true},
                {name:'red', shade:'dark'},
                {name:'blue', shade:'dark', notAnOption: true},
                {name:'yellow', shade:'light', notAnOption: false}
            ]; 
            */
          // console.log("sddsd");
        })

        .controller('EditMemberController', function ($rootScope, $scope, $controller, $state, Restangular, $stateParams, $window, $filter, Account, AuthToken, MEDIA_BASE,$modal) {
            Restangular.one('account').withHttpConfig({ cache: false}).get()
                .then(function(account) {             
                    Account.accountUpdated({'data': account});
                })
            $rootScope.editMode = true;
            $scope.transition = false;
             $rootScope.editLoading = false;
            $rootScope.isAddNewEcp = false;
            $rootScope.phonenumberalreadyused = false;

            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == "micromessenger") {
                $scope.fileuploadtype = "image/*";
            }else{
                $scope.fileuploadtype = "image/*|application/pdf";
            }
            
            $rootScope.isemailavailableformember = false;
            $rootScope.isemailactiveformember = false;
            $rootScope.isemailalreadyexistformember = false;
            $rootScope.isemailrequiredformember = false;
            
            $rootScope.isEditPage= true;

			sessionStorage.setItem("accountphonenubmervalue", true);
            var memberEditBtnFrst = document.querySelector('#memberEditBtnFirstId');
            if(!_.isNull(memberEditBtnFrst))
                memberEditBtnFrst.classList.remove('loading_icon_price');

            var memberEditBtnSecnd = document.querySelector('#memberEditBtnSecId');
            if(!_.isNull(memberEditBtnSecnd))
                memberEditBtnSecnd.classList.remove('loading_icon_price');

            var memberSaveBtnFrst = document.querySelector('#memberSaveFirstBtn');
            if(!_.isNull(memberSaveBtnFrst))
                memberSaveBtnFrst.classList.remove('loading_icon_price');

            var memberSaveBtnSecond = document.querySelector('#memberSaveSecondBtn');
            if(!_.isNull(memberSaveBtnSecond))
                memberSaveBtnSecond.classList.remove('loading_icon_price');
            
            $controller('MemberHelperController', {$scope: $scope});
            
            $scope.homephone = function (fieldname){
    
                    if(fieldname === 'home_phone' && $scope.member.additional_information.personal.home_phone.code == null){
                        $scope.member.additional_information.personal.home_phone = {code: null, number: null};
                    }

                    if(fieldname === 'workplace_phone' && $scope.member.additional_information.personal.workplace_phone.code == null){
                        $scope.member.additional_information.personal.workplace_phone = {code: null, number: null};
                    }
                    
            }

           /* $scope.onChangeSeries = function (index){
                if($scope.member.additional_information.medical.immunizations[index].info !== '5' ){
                    $scope.member.additional_information.medical.immunizations[index].series = '';
                }
                console.log("change");
            }*/

            $scope.onMemberLoaded
                .then(function () {
                    if(!_.isNull(memberEditBtnFrst)){
                    memberEditBtnFrst.classList.add('loading_icon_price');
                     }

                    if(!_.isNull(memberEditBtnSecnd)){
                       memberEditBtnSecnd.classList.add('loading_icon_price');
                     }

                    if (!$scope.member.nationality) {
                        $scope.member.nationality = null;
                    }

                    if ($state.current.name == 'account.editMember'){

                        if (_.isObject($rootScope['tabGroup'])){

                            setTimeout(function() { 

                                    if ($rootScope['tabGroup']['group'])
                                        angular.element('.panel-heading div[href="#collapse'+$rootScope['tabGroup']['group']+'"]'). trigger('click');

                                    if ($rootScope['tabGroup']['tab'])
                                        angular.element('div[href="#collapse'+$rootScope['tabGroup']['tab']+'"]').trigger('click');

                                    $rootScope['tabGroup'] = null;
                                }, 200);

                        }

                        setTimeout(function() {
                            $('html, body').animate({scrollTop : $rootScope.editPosition}, 800);
                            $rootScope.editPosition = null;

                        }, 600);

                        if($rootScope.permissionSaved){
                            //$window.alert($filter('i18n')('common.saveSuccessfully'));   
                        }
                        $rootScope.permissionSaved = false;

                    }
                });
            $scope.scrollDown = function (mem_valid){
                //alert(mem_valid);
                if(!mem_valid){
                    var personal_main = angular.element(document).find('div.Personal_Main_Heading .ng-invalid');
                    if(personal_main.length){
                        $scope.assignScrolling('collapsePersonal');
                    }
                    var insurance_main = angular.element(document).find('div.Insurance_Main_Heading .ng-invalid');
                    if(insurance_main.length){
                        $scope.assignScrolling('collapseInsurance');
                    }
                    var medical = angular.element(document).find('div.Medical_Main_Heading .ng-invalid');
                    if(medical.length){
                        $scope.assignScrolling('collapseMedical');
                        var doctor_tab = angular.element(document).find('div.Medical_Main_Heading .Doctor_heading .ng-invalid');
                        if(doctor_tab.length){
                            $scope.assignScrolling('collapseDoctors');
                        }
                        var allergies_tab = angular.element(document).find('div.Medical_Main_Heading .AllergyInfo_heading .ng-invalid');
                        if(allergies_tab.length){
                            $scope.assignScrolling('collapseAllergies');
                        }
                        var medical_info_tab = angular.element(document).find('div.Medical_Main_Heading .MedicationsInfo_heading .ng-invalid');
                        if(medical_info_tab.length){
                            $scope.assignScrolling('collapseMedications');
                        }
                        var covid_tab = angular.element(document).find('div.Medical_Main_Heading .CovidInfo_heading .ng-invalid');
                        if(covid_tab.length){
                            $scope.assignScrolling('collapseCovid');
                        }
                        var immunization_tab = angular.element(document).find('div.Medical_Main_Heading .ImmunizationsInfo_heading .ng-invalid');
                        if(immunization_tab.length){
                            $scope.assignScrolling('collapseImmunizations');
                        }
                        var medicalcondition_tab = angular.element(document).find('div.Medical_Main_Heading .MedicalCondition_heading .ng-invalid');
                        if(medicalcondition_tab.length){
                            $scope.assignScrolling('collapseMedical_conditions');
                        }
                        var surgical_tab = angular.element(document).find('div.Medical_Main_Heading .surgicalHistoryInfo_heading .ng-invalid');
                        if(surgical_tab.length){
                            $scope.assignScrolling('collapseSurgical_history');
                        }
                        var familyMed_tab = angular.element(document).find('div.Medical_Main_Heading .FamilyMedicalInfo_heading .ng-invalid');
                        if(familyMed_tab.length){
                            $scope.assignScrolling('collapseFamily_medical_history');
                        }
                        var familyMed_tab = angular.element(document).find('div.Medical_Main_Heading .FamilyMedicalInfo_heading .ng-invalid');
                        if(familyMed_tab.length){
                            $scope.assignScrolling('collapseFamily_medical_history');
                        }
                    }
                }
            }
            $scope.assignScrolling = function(assign_id){
                $('#'+assign_id).attr('aria-expanded',true);
                $('#'+assign_id).removeAttr('style');
                $('#'+assign_id).addClass('in');
            }
            $scope.handle = function (data, options) {
                $rootScope.isphonecodeselected = false;
                if(!_.isUndefined(data.phone.code)|| !_.isNull(data.phone.code)){
                    if(data.phone.code === 0){
                        $rootScope.isphonecodeselected = true;
                        setTimeout(function() {
                             $rootScope.isphonecodeselected = false;
                        }, 5000);
                        return;
                    }
                }
                if(!_.isUndefined(data.phone.number)|| !_.isNull(data.phone.number)){
                    data.phone.number = $scope.getNumber(data.phone.number);
                }
                if(!_.isUndefined(data.additional_information.personal.home_phone.number)){
                    data.additional_information.personal.home_phone.number = $scope.getNumber(data.additional_information.personal.home_phone.number);
                }
                if(!_.isUndefined(data.additional_information.personal.workplace_phone.number)  ){
                    data.additional_information.personal.workplace_phone.number = $scope.getNumber(data.additional_information.personal.workplace_phone.number);
                }

                if(data.additional_information.insurances.length>0){
                    _.forEach(data.additional_information.insurances, function(rec){
                        if(!_.isUndefined(rec.company_phone.number)){
                            rec.company_phone.number = $scope.getNumber(rec.company_phone.number);
                        }
                    })
                }

                if(data.additional_information.medical.doctors.length>0){
                    _.forEach(data.additional_information.medical.doctors, function(rec){
                        if(!_.isUndefined(rec.phone.number)){
                            rec.phone.number = $scope.getNumber(rec.phone.number);
                        }
                    })
                }

                if(data.additional_information.personal.home_phone!==false && !_.isUndefined(data.additional_information.personal.home_phone) && (data.additional_information.personal.home_phone.code===null) && (data.additional_information.personal.home_phone.number===""))
                {
                    data.additional_information.personal.home_phone=false;
                }

                if(data.additional_information.personal.workplace_phone!==false && !_.isUndefined(data.additional_information.personal.workplace_phone) && data.additional_information.personal.workplace_phone.code===null && data.additional_information.personal.workplace_phone.number==="")
                {
                    data.additional_information.personal.workplace_phone=false;
                }

                var postData = angular.copy(data);
                
                if (!options && postData.use_account_email) {
                    postData.email = null;
                }

                if(!_.isNull(memberSaveBtnFrst))
                    {
                        //memberSaveBtnFrst.classList.add('loading_icon_price');
                         $scope.editmemLoading= true;
                    }
                if(!_.isNull(memberSaveBtnSecond)){
                    //memberSaveBtnSecond.classList.add('loading_icon_price');
                     $scope.editmemLoading= true;
                }

                $scope.errorSaving = false;
                
                $rootScope.globals.showSpinner = false;
                $rootScope.globals.stateShowSpinner = false;
                $rootScope.redirecting = true;

                Account.updateMember(postData)
                    .then(function (res) {
                        $rootScope.phonenumberalreadyused = false;
                        angular.extend(_.find($scope.account.members, {id: res.id}), res);
                        angular.extend($rootScope.member.additional_information, res.additional_information);
                        $rootScope.$broadcast('member.updated', res);

                        if(!_.isNull(memberSaveBtnFrst)){
                                //memberSaveBtnFrst.classList.remove('loading_icon_price');
                                 $scope.editmemLoading= false;
                            }
                            if(!_.isNull(memberSaveBtnSecond)){
                                //memberSaveBtnSecond.classList.remove('loading_icon_price');
                                 $scope.editmemLoading= false;
                            }
                        $scope.removeBorder();
                        if (!options) {
                            if($scope.member.additional_information.personal.home_phone.number==" ")
                        {
                            $scope.member.additional_information.personal.home_phone.number=null;
                        }
                        if($scope.member.additional_information.personal.workplace_phone.number==" ")
                        {
                            $scope.member.additional_information.personal.workplace_phone.number=null;
                        }
                            sessionStorage.setItem("refreshAccountDetails",true); 
                            Account.get();
                            
                             $state.transitionTo('account.editMember', {member_id: res.id});
                            

                             var saveSuccessfully = angular.element(document).find('div.member-save-info');
                             saveSuccessfully.fadeIn(500,0).slideDown(500);
                             setTimeout(function() {
                                 saveSuccessfully.fadeOut(500,0).slideUp(500);
                                //$state.transitionTo('account.show', {});
                             }, 5000);
                        } else if (angular.isArray(options)) {
                            if ((options[0] !== options[1]) && !postData.additional_information[options[1]][options[0]][0].id) {
                                $scope.member.additional_information[options[1]][options[0]][options[2]] = _.last(res.additional_information[options[1]][options[0]]);
                            } else if ((options[0] === options[1]) && !postData.additional_information[options[0]][0].id) {
                                $scope.member.additional_information[options[0]][options[2]] = _.last(res.additional_information[options[0]]);
                            }
                        }

                        $scope.memberForm.$submitted = false;                        
                    })
                    .catch(function (err) {
                        $scope.editmemLoading= false;
                          if(!_.isNull(memberSaveBtnFrst))
                                memberSaveBtnFrst.classList.remove('loading_icon_price');
                                        
                            if(!_.isNull(memberSaveBtnSecond))
                                memberSaveBtnSecond.classList.remove('loading_icon_price');

                        var errors = [];

                         if (_.isNull(err.data)){

                            $scope.memberError = $filter('i18n')('errors.systemError');

                         }else{

                         
                              if (!_.isUndefined(err.data.error)) {
                                 if (!_.isUndefined(err.data.error.message) ||!_.isNull(err.data.error.message) || !_.isEmpty(err.data.error.message)) {
                                    if(err.data.error.message.trim().toLowerCase().indexOf('email address has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('email address 已经被使用')!=-1){                                     
                                         $rootScope.isemailavailableformember = true;
                                           /* setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                            }, 7000); */
                                    }
                                    else if(err.data.error.message.trim().toLowerCase().indexOf('phone number has already been taken') !=-1 || err.data.error.message.trim().toLowerCase().indexOf('phone number 已经被使用')!=-1){                                     
                                        $rootScope.phonenumberalreadyused = true;
                                        $('html, body').animate({
                                            scrollTop: (angular.element('#accountphoneRange').offset().top - 300)
                                       }, 2000);
                                           /* setTimeout(function() {
                                                $rootScope.$apply(function () {
                                                    $rootScope.phonenumberalreadyused = false;                                            
                                                });                                        
                                             }, 7000); */
                                    }
                                    else{
                                        $scope.errorSaving = true;
                                        errors.push(err.data.error);
                                        _.each(errors, function(error) {
                                            if (!_.isNull(error.message) || !_.isEmpty(error.message)) {
                                                $scope.memberError = error.message;
                                            }
                                        });
                                    }
                                }
                                else{
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
                                           /* setTimeout(function() {
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
                                            }, 7000);    */                            
                                        }
                                        else if(err.data === "account"){                                    
                                            $rootScope.isemailavailableformember = true;
                                            
                                           /* setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailavailableformember = false;                                            
                                                        });                                        
                                            }, 7000);  */                                
                                         
                                        }
                                        else if(err.data === "Empty email"){                                  
                                            $rootScope.isemailrequiredformember = true;
                                           /* setTimeout(function() {
                                                        $rootScope.$apply(function () {
                                                            $rootScope.isemailrequiredformember = false;                                            
                                                        });                                        
                                            }, 7000);*/
                                        }
                                }
                            }
                         }
                    });
                return false;
            };
            
            $scope.editMemberPermission = function (member_id) {
                $state.go('account.editMemberPermission', {member_id: member_id});
            };
            $scope.getNumber = function(phoneNumber){
                if(phoneNumber!=null)
                {
                var number = phoneNumber;
                number = number.replace(/\D/g,'');
                return number;
                }

            };
        })

        .controller('ViewMemberHistoryController', function($stateParams, $scope, Account) {
            var page = 1;
            $scope.more_histories = true;
            Account.getMemberHistory($stateParams.member_id, 0)
                .then(function (histories) {
                    $scope.histories = histories.data;
                    $scope.loadMore = loadMore;
                });
            // The member is needed for the breadcrumb.
            Account.getMember($stateParams.member_id)
                .then(function (member) {
                    $scope.member = member;
                });

            function loadMore () {
                if ($scope.more_histories) {
                    page = page + 1;
                    Account.getMemberHistory($stateParams.member_id, page).then(function(res) {
                        if (_.isEmpty(res.data)) {
                            $scope.more_histories = false;
                        } else {
                            $scope.histories = $scope.histories.concat(res.data);
                        }
                    });
                }
            }
        })

        /**
         * Preview profile controller
         */
        .controller('ShareMemberProfileController', function ($rootScope, $scope, $controller, $state, $stateParams, Account, permission, PermissionService, $timeout) {
            $rootScope.shareMode = true;
             $scope.permission = null;
            $scope.permission = permission;
             Account.getMember($stateParams.member_id)
                .then(function (member) {   
                            
                    $scope.member = member;
                });
            $controller('MemberHelperController', { $scope: $scope });
            
                $scope.permission["personal"]       = {};
                $scope.permission["insurances"]     = [];
                $scope.permission["medical"]        = {
                    "doctors":[],
                    "blood":{},
                    "allergies":[],
                    "covid_reports":[],
                    "medications":[],
                    "immunizations":[],
                    "medical_conditions":[],
                    "surgical_history":[],
                    "family_medical_history":[],
                    "hospital_records":[],
                    "organ_donor":{}
                    
                };
                
                $scope.permission.records           = {
                    "living_will":{},
                    "emergency_messages":[]
                };
                
                
                // assign permission personal by default

                $scope.permission.personal.passports = true;
                $scope.permission.personal.social_securities = true;
                $scope.permission.personal.marital_status = true;
                $scope.permission.personal.secondary_email = true;
                $scope.permission.personal.address = true;
                $scope.permission.personal.home_phone = true;
                $scope.permission.personal.workplace_address = true;
                $scope.permission.personal.workplace_phone = true;

                if (angular.isDefined($scope.member) && !_.isNull($scope.member) && ( "additional_information" in $scope.member )) {

                    // assign permission insurances by default

                    for (var element in $scope.member.additional_information.insurances) {
                        $scope.permission.insurances[element] = {
                            "company_name": true,
                            "insurance_type": true,
                            "number":true,
                            "plan_type": true,
                            "company_phone": true,
                            "expiry_date": true,
                            "notes": true,
                            "document":true
                        };
                    };

                    

                    // assign permission medical/doctors by default
                
                    for (var element in $scope.member.additional_information.medical.doctors) {

                        $scope.permission.medical.doctors[element] = {
                            "first_name": true,
                            "last_name": true,
                            "phone": true,
                            "specialty": true,
                            "notes": true
                        };

                    };

                    // assign permission medical/blood by default

                    $scope.permission.medical.blood.isAllSelected = true;
                    $scope.permission.medical.blood.blood_type = true;
                    $scope.permission.medical.blood.notes = true;
                    $scope.toggleBloodInfo = function() {
                        var toggleStatus = $scope.permission.medical.blood.isAllSelected;
                        $scope.permission.medical.blood.blood_type = toggleStatus;
                        $scope.permission.medical.blood.notes = toggleStatus;
                    }

                    for (var element in $scope.member.additional_information.medical.allergies) {
                        $scope.permission.medical.allergies[element] = {
                            "name": true,
                            "reaction": true,
                            "severity": true,
                            "notes": true,
                            "document":true
                        };
                    };


                    // assign permission medical/medications by default

                    for (var element in $scope.member.additional_information.medical.medications) {
                        $scope.permission.medical.medications[element] = {
                            "name": true,
                            "status": true,
                            "dosage": true,
                            "frequency": true,
                            "purpose": true,
                            "from": true,
                            "to": true,
                            "notes": true,
                            "document":true
                        };
                    };

                    // assign permission medical/covid by default

                    for (var element in $scope.member.additional_information.medical.covid_reports) {
                        $scope.permission.medical.covid_reports[element] = {
                            "coviddate": true,
                            "fullname": true,
                            "lotnumber": true,
                            "mfname": true,
                            "pcategory": true,
                            "pname": true,
                            "qrcode": true,
                            "notes": true,
                            "result":true,
                            "srnumber":true,
                            "document":true,
                            
                        };
                    };

                    // assign permission medical/immunizations by default

                    for (var element in $scope.member.additional_information.medical.immunizations) {

                        $scope.permission.medical.immunizations[element] = {
                            "name": true,
                            "date": true,
                            "series": true,
                            "notes": true,
                            "srnumber":true,
                            "document":true,
                            "fullname": true,
                            "lotnumber": true,
                            "mfname": true,
                            "pname": true,
                            "qrcode": true

                        };

                    };

                    // assign permission medical/medical_conditions by default

                    for (var element in $scope.member.additional_information.medical.medical_conditions) {

                        $scope.permission.medical.medical_conditions[element] = {
                            "name": true,
                            "status": true,
                            "from": true,
                            "to": true,
                            "notes": true,
                            "document":true
                        };

                    };

                    // assign permission medical/surgical_history by default

                    for (var element in $scope.member.additional_information.medical.surgical_history) {
                        $scope.permission.medical.surgical_history[element] = {
                            "type": true,
                            "date": true,
                            "reason": true,
                            "notes": true,
                            "document":true
                        };
                    };

                    // assign permission medical/family_medical_history by default

                    for (var element in $scope.member.additional_information.medical.family_medical_history) {

                        $scope.permission.medical.family_medical_history[element] = {
                                    "type": true,
                                    "relationship": true,
                                    "severity": true,
                                    "notes": true
                        };
                    };

                    for (var element in $scope.member.additional_information.medical.hospital_records){

                        $scope.permission.medical.hospital_records[element] = {
                            "date":true,
                            "category":true,
                            "practitioner":true,
                            "notes":true,
                            "file":true
                        };

                    }


                    $scope.permission.medical.organ_donor = {
                        "status": true,
                        "condition": true,
                        "card": true,
                        "notes": true,
                        "isAllSelected": true
                    };

                     $scope.toggleOrganInfo = function() {
                        var toggleStatus = $scope.permission.medical.organ_donor.isAllSelected;
                        $scope.permission.medical.organ_donor.status = toggleStatus;
                        $scope.permission.medical.organ_donor.condition = toggleStatus;
                        $scope.permission.medical.organ_donor.card = toggleStatus;
                        $scope.permission.medical.organ_donor.notes = toggleStatus;
                    }

                    // assign permission records.living_will by default

                    $scope.permission.records.living_will = {
                        "date": true,
                        "document": true,
                        "notes": true,
                        "isAllSelected":true
                    };

                    $scope.toggleLivingWillInfo = function() {
                        var toggleStatus = $scope.permission.records.living_will.isAllSelected;
                        $scope.permission.records.living_will.date = toggleStatus;
                        $scope.permission.records.living_will.document = toggleStatus;
                        $scope.permission.records.living_will.notes = toggleStatus;
                    }

                    for (var element in $scope.member.additional_information.records.emergency_messages){

                        $scope.permission.records.emergency_messages[element] = {
                            "file":true,
                            "notes":true
                        };

                    };


            }
            
            /* show preview */
            
            $scope.preview = function (permission) {
                
                PermissionService.setPreviewPermission($stateParams.member_id, permission);
                sessionStorage.removeItem("previewPermission");
                $state.transitionTo('account.preview-profile', {member_id: $stateParams.member_id});               
            };
            _.defer(function(){ 
              $scope.$apply(); 
            });
        })

        .controller('PreviewProfileController', function ($rootScope, $scope, $controller, $state, $stateParams, Account, permission) {
            $rootScope.previewMode = true;
            
            if(_.isNull(sessionStorage.getItem("previewPermission")) || sessionStorage.getItem("previewPermission")=="{}" || permission !="{}" && (permission.insurances && permission.personal && permission.insurances) ){
                $scope.permission = permission;
                sessionStorage.setItem("previewPermission" ,JSON.stringify(permission));
            }
            else{
                $scope.permission =  $.parseJSON(sessionStorage.getItem("previewPermission"));
            }
            
            //$scope.permission = permission;
           Account.getMember($stateParams.member_id)
                .then(function (member) {
                    $scope.member = member;
            });

            $controller('MemberHelperController', { $scope: $scope });
        })


        /**
         * FIN's profiles
         */
        .controller('ViewFinProfileController', ['$rootScope', '$controller', '$scope', '$stateParams', 'member', 'PermissionService', 'Alert', function ($rootScope, $controller, $scope, $stateParams, member, PermissionService, Alert) {

            $rootScope.previewMode = true;
            $rootScope.thirdPartyMode = true;
            $rootScope.shareMode = true;

            $scope.member = member;

            $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt(member.id)});

            $scope.profile_token = $stateParams.profile_token;

            $scope.permission = {};

            $scope.$on('alerts.received', function(event, alerts) {
                $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt(member.id)});
            });

            $scope.$watch('member', function (newVal, oldVal) {
                if (newVal !== oldVal) {
                    $rootScope.member = newVal;
                }
            });

            // $controller('MemberHelperController', {$scope: $scope});
        }])

        .controller('ShareViewFinProfileController', ['$rootScope', '$scope', '$state', '$controller', '$stateParams', 'member', 'Alert', 'PermissionService', function ($rootScope, $scope, $state, $controller, $stateParams, member, Alert, PermissionService) {
            $rootScope.shareMode = true;
            $rootScope.thirdPartyMode = true;
            
            $scope.member = member;

            $scope.permission = PermissionService.getTempPermission() || {};

            $scope.alert_histories = Alert.getFriendAlerts() || [];

            $controller('MemberHelperController', {$scope: $scope});

            $scope.preview = function (permission) {
                PermissionService.setTempPermission(permission);
                $state.transitionTo('account.preview-friend-in-need-profile', {profile_token: $stateParams.profile_token});
            };
        }])

        .controller('PreviewFinProfileController', ['$rootScope', '$scope', '$controller', 'member', 'permission', function($rootScope, $scope, $controller, member, permission) {
            $rootScope.previewMode = true;
            $rootScope.thirdPartyMode = true;

            $scope.member = member;

            $scope.permission = permission;

            $controller('MemberHelperController', {$scope: $scope});
        }])

        /**
         * FIN's profiles
         */
        .controller('ViewSharedProfileController', ['$rootScope','$location', '$scope', '$http', '$state', '$controller', '$timeout', 'Alert', 'member', function ($rootScope,$location, $scope, $http, $state, $controller, $timeout, Alert, member) {

            $rootScope.previewMode = true;
            $rootScope.publicMode = true;
            var mapCountryCode = '';
            $scope.member = member;
            $rootScope.isShowBanner = false;
            var getExpireDateVal = $location.$$search.expireDate;
            if(!_.isUndefined(getExpireDateVal)&&!_.isNull(getExpireDateVal)){
            var getDateOnly = getExpireDateVal.split(' ');
            var getExpireDate = getDateOnly[0];

            $http({
                    "url":Config.IP_LOCATION_URL,
                    "method":"GET",
                }).then(function(response){
                //$rootScope.cityName = response.data.city;
                mapCountryCode =response.data.country_code;
                if(mapCountryCode === 'CN'){
                    $scope.isChina =true;
                }else{
                    $scope.isChina = false;
                }
            });

            if(!_.isUndefined(getExpireDate)&&!_.isNull(getExpireDate)){
                
                if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone"){
                    var ServerTimeDate = new Date(getExpireDate+'Z');
                }
                else{
                    var ServerTimeDate = new Date(getExpireDate);
                }
                
                    //currentTime = moment().tz(date.timezone).format('YYYY-MM-DDTHH:mm:ss');
                var differenceVal =  setInterval(function() {
                    var timeDifferenceVal = null;
                    var mylocalDate = new Date();
                    var diffVal = mylocalDate.getTimezoneOffset() * 60000;
                    
                    if(navigator.userAgent.toLowerCase().match(/iphone/i) == "iphone"){
                        var timeDifference = (ServerTimeDate.getTime()) - (mylocalDate.getTime());
                    }
                    else{
                        var timeDifference = (ServerTimeDate.getTime()-(mylocalDate.getTimezoneOffset() * 60000)) - (mylocalDate.getTime());
                    }
                    timeDifferenceVal = timeDifference;

                    var diffHrs = Math.floor((timeDifference % 86400000) / 3600000); // hours
                    var diffMins = Math.round(((timeDifference % 86400000) % 3600000) / 60000)
                    var  ms = timeDifference % 1000;
                        timeDifference = (timeDifference - ms) / 1000
                    var ss = timeDifference % 60;
                        $scope.secondsVal = ss;
                        timeDifference = (timeDifference - ss) / 60
                    var mm = timeDifference % 60;
                        $scope.minutesVal = mm;
                        timeDifference = (timeDifference - mm) / 60

                    var hh = timeDifference;
                        $scope.CounterTime = hh +'h '+mm+ 'm '+ss+'s';
                       
                        
                    if (timeDifferenceVal <= 0) {
                        $rootScope.linkExpired = true;
                        $rootScope.isShowBanner = false;                               
                        }
                        else{
                            $rootScope.isShowBanner = true;
                        }

                   $scope.$apply();
                }, 1000);    
                    
            }
        }
            $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt(member.id)});

            $rootScope.$on('alerts.received', function(event, alerts) {
                $timeout(function () {
                    $rootScope.alert_histories = _.filter($scope.alerts, {member_id: parseInt(member.id)});
                }, 100);
            });
            
            $controller('MemberHelperController', {$scope: $scope});
        }])

        .directive('emailProfile', ['$modal', '$timeout', 'Account', 'PermissionService', function ($modal, $timeout, Account, PermissionService) {

            return {
                restrict: 'A',
                scope: {
                    member: '=',
                    permission: '='
                },
                link: link
            };

            function link(scope, elem, attrs) {
                var emailModalTemplate = 'partials/member/share-member-profile/email.html';

                var modalInstance = null;

                var opts = {
                    backdrop: true,
                    backdropClick: true,
                    dialogFade: false,
                    keyboard: true,
                    size: attrs.size,
                    templateUrl: emailModalTemplate,
                    scope: scope,
                    controller: ['$scope', function ($scope) {
                        var additional;
                        var additional_information = $scope.member.additional_information;
                        $scope.profile = angular.copy($scope.member);

                        $scope.$watch('permission', function(newVal, oldVal) {
                            additional = PermissionService.filterShareData(additional_information, $scope.permission);
                            $scope.profile.additional_information = additional;
                        }, true);

                        $scope.cancel = function () {
                            modalInstance.close();
                            
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className == "modal-open") {

                                var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer = angular.element(document).find('div.modal').eq(0);

                                body.removeClass("modal-open");
                                layer.remove();
                                modalLayer.remove();
                            }
                            
                        };

                        $scope.shareByEmail = function(member, email) {
                            Account.shareByEmail(member, email, $scope.profile).then(
                                function(res) {
                                    if (res.success) {
                                        $scope.error = null;
                                        $scope.success = true;
                                    }
                                },
                                function(err) {
                                    $scope.error = err.data.error;
                                });
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                    
                });
            }
        }])

        .directive(
            "insuranceLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/insurance/insurance.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "insurance-link" , scope, element, attributes);
                }

            }
        )

        .directive(
            "doctorLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/doctor.html"
                });

                // console.log('SCOPE', scope);

                function link( scope, element, attributes ) {
                    // console.log( "doctor-link" );
                     // console.log(scope, element, attributes);

                }

            }
        )

        .directive(
            "bloodLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/blood.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "blood-link" );
                }

            }
        )

        .directive(
            "allergyLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/allergy.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "allergy-link" );
                }

            }
        )

        .directive(
            "medicationLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/medication.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "medication-link" );
                }

            }
        )

        .directive(
            "immunizationLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/immunization.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "immunization-link" );
                }

            }
        )

        .directive(
            "covidLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/covid.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "immunization-link" );
                }

            }
        )

        .directive(
            "medicalConditionLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/medicalcondition.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "medicalCondition-link" );
                }

            }
        )

        .directive(
            "surgicalLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/surgical.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "surgical-link" );
                }

            }
        )

        .directive(
            "familyHistoryLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/familyhistory.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "familyHistory-link" );
                }

            }
        )

        .directive(
            "organDonorLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/medical/organdonorstatus.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "organDonor-link" );
                }

            }
        )

        .directive(
            "willRecordLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/record/willrecord.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "willrecord-link", scope, element, attributes );
                }

            }
        )

        .directive(
            "messageRecordLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/record/messagerecord.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "messageRecord-link" );
                }

            }
        )

        .directive(
            "hospitalRecordLayout",
            function() {
                return({
                    link: link,
                    restrict: "A",
                    templateUrl: "partials/member/record/hospitalrecord.html"
                });

                function link( scope, element, attributes ) {
                    // console.log( "hospitalrecord-link" );
                }

            }
        )


        .directive('emailForwardProfile', ['$modal', '$timeout', 'Account', 'PermissionService', function ($modal, $timeout, Account, PermissionService) {

            return {
                restrict: 'A',
                scope: {
                    member: '=',
                    permission: '='
                },
                link: link
            };

            function link(scope, elem, attrs) {
                var emailModalTemplate = 'partials/member/share-member-profile/email-forward.html';

                var modalInstance = null;

                var opts = {
                    backdrop: true,
                    backdropClick: true,
                    dialogFade: false,
                    keyboard: true,
                    size: attrs.size,
                    templateUrl: emailModalTemplate,
                    scope: scope,
                    controller: ['$scope', function ($scope) {
                        var additional;
                        var additional_information = $scope.member.additional_information;
                        $scope.profile = angular.copy($scope.member);

                        $scope.$watch('permission', function(newVal, oldVal) {
                            additional = PermissionService.filterShareData(additional_information, $scope.permission);
                            $scope.profile.additional_information = additional;
                        }, true);

                        $scope.cancel = function () {
                            modalInstance.close();
                            var body = angular.element(document).find('body').eq(0);
                            if (body[0].className == "modal-open") {

                                var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                var modalLayer = angular.element(document).find('div.modal').eq(0);

                                body.removeClass("modal-open");
                                layer.remove();
                                modalLayer.remove();
                            }
                        };

                        $scope.forwardByEmail = function(email) {
                            var token = $scope.profile.route || null;
                            Account.forwardByEmail(email, token).then(
                                function(res) {
                                    if (res.success) {
                                        $scope.error = null;
                                        $scope.success = true;
                                    }
                                },
                                function(err) {
                                    $scope.error = err.data.error;
                                });
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                });
            }
        }])

        .filter('formatId', function() {
            return function (input) {
                input = input || '';
                input = input.replace(/\s+/g, '');
                input = input.replace(/(\d{3})(\d{3})(\d{3})(\d{3})/, '$1 $2 $3 $4');

                return input;
            };
        })

        .filter('rounded', function(){
            return function(val){
                return !_.isNull(val) && !_.isUndefined(val)?val.toFixed():val;
            }
        })

        .filter('unique', function() {
               return function(collection, keyname) {
                  var output = [], 
                      keys = [];

                  angular.forEach(collection, function(item) {
                      var key = item[keyname];
                      if(keys.indexOf(key) === -1) {
                          keys.push(key);
                          output.push(item);
                      }
                  });

                  return output;
               };
            })

        .directive('memberId', function() {
            return {
                restrict: "AE",
                replace: true,
                transclude: true,
                scope: {
                    model: "=model"
                },
                template:'<div class="member-id"> <span class="hideId_mobile" i18n="common.id"></span>{{model.ice_id | formatId}} </div>',
                controller: function($scope,Account,$window) { 
                    $('div.popover__wrapper').click(function(){                   
                        var visibility = $('.push.popover__content').css('visibility');
                    if(visibility=='visible'){
                        $('.push.popover__content').css('visibility','hidden');
                    }
                    else{
                        $('.push.popover__content').css('visibility','visible');
                    }                    
                });       
              }
          }
      })
        .directive('finmemberId', function() {
            return {
                restrict: "AE",
                replace: true,
                transclude: true,
                scope: {
                    model: "=model"
                },
                template:'<div class="member-id ice_id_patner"> <span class="hideId_mobile" i18n="common.memberId"></span> {{model.ice_id | formatId}}</div>',
                controller: function($scope,Account,$window) { 
                    $('div.popover__wrapper').click(function(){                   
                        var visibility = $('.push.popover__content').css('visibility');
                    if(visibility=='visible'){
                        $('.push.popover__content').css('visibility','hidden');
                    }
                    else{
                        $('.push.popover__content').css('visibility','visible');
                    }                    
                });       
              }
          }
      })                 

        .directive('shareMemberProfileForm', function($cookies) {
            return {
                restrict: 'AE',
                replace: true,
                scope: {
                    type: '@',
                    member: '=',
                    permission: '='
                },
                controller: function($rootScope,$scope,$element, $sce, API_BASE, Auth, PermissionService, iaSettings,Account) {

                    $scope.isPrintLoading = false;

                    $scope.$watch('member', function (newValue, oldValue) {
                        if (angular.isDefined($scope.member)){
                            var url = [API_BASE, 'members',  $scope.member.id, 'share?access_token=' + Auth.getToken()].join('/') + '&lang=' + iaSettings.getLanguage() + '&pdfcard=1&type=download-member-id';
                            var additional;
                            $scope.action = $sce.trustAsUrl(url);
                        
                            var additional_information = $scope.member.additional_information;

                            $scope.profile = angular.copy($scope.member);
                        
                            if ($scope.type == 'download-member-profile') {
                                $scope.$watch('permission', function(newVal, oldVal) {
                                    additional = PermissionService.filterShareData(additional_information, $scope.permission);
                                    $scope.profile.additional_information = additional;
                                }, true);
                            }
                        
                        }else{
                            
                        }
                        
                    });

                    $element.on('click', 'button', function(e) {
                        if($scope.type == 'download-member-profile') {
                            $element.submit();
                            var pdfDownload = angular.element(document).find('div.pdf-download').eq(0);
                            pdfDownload.fadeIn(500,0).slideDown(500);
                            setTimeout(function() {
                                pdfDownload.fadeOut(500,0).slideUp(500);
                            }, 6000);
                        }
                        if ($scope.type == 'download-member-id') {

                            $scope.isPrintLoading = true;
                            angular.element(e.target).attr('disabled', 'disabled');
                            $element.submit();

                            $cookies.downloadCardDetail = "true";
                            $rootScope.showDownloadCard = false;
                            setTimeout(function() {

                                var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);
                                    var body = angular.element(document).find('body').eq(0);
                                    if (body[0].className == "modal-open") {
                                        body.removeClass("modal-open");
                                    }
                                    layer.remove();
                                    modalLayer.remove();

                            }, 11000);
                        }
                    });
                },
                templateUrl: 'partials/member/share-member-profile/form.html'
            };
        })

        .directive('iphoneShareMemberProfileForm', function($cookies) {
            return {
                restrict: 'AE',
                replace: true,
                scope: {
                    type: '@',
                    member: '=',
                    permission: '='
                },

                controller: function($scope, $element, $sce, API_BASE, Auth, PermissionService, iaSettings,Account,$rootScope,$modal,AuthToken,$http) {

                    $scope.isPrintLoading = false;

                    $scope.$watch('member', function (newValue, oldValue) {
                        if (angular.isDefined($scope.member)){
                            var url = [API_BASE, 'members',  $scope.member.id, 'share?access_token=' + Auth.getToken()].join('/') + '&lang=' + iaSettings.getLanguage() + '&pdfcard=1&type=download-wechat-member-id';
                            var additional;
                            $scope.action = $sce.trustAsUrl(url);
                        
                            var additional_information = $scope.member.additional_information;

                            $scope.profile = angular.copy($scope.member);
                        
                            if ($scope.type == 'download-member-profile') {
                                $scope.$watch('permission', function(newVal, oldVal) {
                                    additional = PermissionService.filterShareData(additional_information, $scope.permission);
                                    $scope.profile.additional_information = additional;
                                }, true);
                            }
                        }                        
                    });

                    $element.on('click', 'button', function(e) {

                    
                        if($scope.type == 'download-member-profile') {
                            $element.submit();
                            var pdfDownload = angular.element(document).find('div.pdf-download').eq(0);
                            pdfDownload.fadeIn(500,0).slideDown(500);
                            setTimeout(function() {
                                pdfDownload.fadeOut(500,0).slideUp(500);
                            }, 6000);
                        }
                        if ($scope.type == 'download-member-id') {
                             $scope.isPrintcardLoading = true;
                             var urlcardDetails = [API_BASE, 'members',  $scope.member.id, 'share?access_token=' + Auth.getToken()].join('/') + '&lang=' + iaSettings.getLanguage() + '&pdfcard=1&type=download-wechat-member-id';

                            $rootScope.redirecting=true; // to stop global spinner
                            //$rootScope.reqLoading = true;
                            $scope.showError = false;
                            var token = AuthToken.get();
                            var req = {
                                method: 'GET',
                                url: urlcardDetails,
                                headers: {
                                    'X-Authorization':'Bearer ' + token,
                                    'Accept-Language': iaSettings.getLanguage()
                                }
                            }

                            $http(req)
                                .then(function(res)
                                {
                                    $scope.phonewechatpdflinkdetails= res.data.url;
                                   var layer = angular.element(document).find('div.modal-backdrop').eq(0);
                                    var modalLayer  = angular.element(document).find('div.modal').eq(0);
                                    var body = angular.element(document).find('body').eq(0);
                                    if (body[0].className == "modal-open") {
                                        body.removeClass("modal-open");
                                    }
                                    layer.remove();
                                    modalLayer.remove();

                                    setTimeout(function() {
                                           var modaliphonewechatpdfInstance = $modal.open({
                                            backdrop: false,
                                            backdropClick: false,
                                            dialogFade: false,
                                            keyboard: true,
                                            size: 'sm',
                                            templateUrl: 'partials/modal/show-cardid.html',
                                            scope: $scope,
                                            controller: function () {
                                                $scope.cancelpdflinkpopup = function () {
                                                    modaliphonewechatpdfInstance.close();
                                                };

                                                $scope.cancel = function () {
                                                    modaliphonewechatpdfInstance.close();
                                                };
                                            }
                                        });
                                    }, 100);

                                },
                                function(error)
                                {
                                        $rootScope.reqLoading = false;
                                        $scope.showError = true;
                                });
                        }
                    });
                },
                templateUrl: 'partials/member/share-member-profile/iphonewechatpdf.html'
            };
        })
        
        .directive('confirmUnsync',['$rootScope', '$state', '$modal', 'Account', function ($rootScope, $state, $modal, Account) {

            return {
                restrict: 'A',
                scope: {
                    uuid: '='
                },
                link: link
            };

            function link(scope, elem, attrs) {

                var modalInstance = null;
                var opts = {
                    backdrop: true,
                    backdropClick: true,
                    dialogFade: false,
                    keyboard: true,
                    size: attrs.size,
                    templateUrl: 'partials/panic/unsync-panic.html',
                    scope: scope,
                    controller: ['$scope', '$controller', '$rootScope', function ($scope, $controller, $rootScope) {
                   //     $controller('MemberHelperController', { $scope: $scope });
                        scope.cancel = function () {
                            modalInstance.close();
                        };
                        scope.ok = function () {
                            modalInstance.close();
                            Account.unsync(scope.uuid, $rootScope.account.id);
                        };
                    }]
                };

                elem.on('click', function () {
                    modalInstance = $modal.open(opts);
                });
            }
        }])
        
        .directive('ngPrint',['$http',function($http){ //Action for printing
    
            var url     = "";
            var lang    = "";
            var scope   = "";
            return {
                link:link,
                scope:true,
                controller:function($scope, $element, $sce, API_BASE, Auth, PermissionService, iaSettings, $filter, $location){
                    $scope.$watch('member', function (newValue, oldValue) {
                        if (angular.isDefined($scope.member)){
                            try{
                                lang = iaSettings.getLanguage();

                                if ($scope.account){
                                    url = [API_BASE, 'members',  $scope.member.id , 'share?access_token=' + Auth.getToken()].join('/') + '&lang=' + lang;
                                }else{
                                    url = [API_BASE, 'members/public',  $scope.member.route, 'print'].join('/') + '';
                                }
                                var additional;
                                var additional_information = $scope.member.additional_information;
                                $scope.profile = angular.copy($scope.member);
                                $scope.message =  $filter('i18n')('common.loading');

                                // check for permissions only if not a shared public profile
                                if (_.isUndefined($scope.profile.route) || $location.$$path.indexOf('/account/member/'+ $scope.member.id +'/ecp')>-1 || $scope.member.additional_information.not_all_additional_information){
                                    $scope.$watch('permission', function(newVal, oldVal) {
                                        additional = PermissionService.filterShareData(additional_information, $scope.permission);
                                        $scope.profile.additional_information = additional;
                                    }, true);
                                }
                                scope = $scope.profile;
                            }catch(e){
                                return;
                            }
                        }
                    });
                }
            };
            
            function link(scope, element, attrs){
                

                element.on('click',function(child){
                    var windowOpenPrint = window.open();
                    windowOpenPrint.document.write("<p>"+scope.message+"</p>");
                    $http({
                        "url":url,
                        "method":"POST",
                        "data":{
                            "profile":scope.profile,
                            "type":"print",
                            "language": lang
                        }
                    }).then(function(response){
                        windowOpenPrint.document.open();
                        windowOpenPrint.document.write(response.data);
                        windowOpenPrint.print();
                        windowOpenPrint.document.close();
                        windowOpenPrint.close();
                            
                    });
                          
                    
                    
                });
                
            }
            
        }]);
        
})();
