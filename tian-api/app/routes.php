<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return Response::json([
        'status' => 'Ok',
        'time' => \Carbon\Carbon::now()->toISO8601String(),
    ]);
});

// Handle requests to undefined routes.
App::error(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e) {
    return Redirect::to('/');
});

App::error(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
    return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Account Authentication
|--------------------------------------------------------------------------
*/

Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);

Route::get('auth', ['as' => 'token', 'uses' => 'AuthController@checkToken']);

/*
|--------------------------------------------------------------------------
| Password Reminders Routes
|--------------------------------------------------------------------------
*/

Route::get('password/remind', ['as' => 'reminders.reminder', 'uses' => 'RemindersController@getRemind']);

Route::post('password/remind', ['as' => 'reminders.reminder', 'uses' => 'RemindersController@postRemind']);

Route::post('password/reset', ['as' => 'reminders.reset', 'uses' => 'RemindersController@postReset']);

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
*/
Route::get('account/monthly', [ 'as' => 'account.listaccounts', 'uses' => 'AccountController@listAccounts']);

Route::get('account/allrecords', [ 'as' => 'account.listaccounts', 'uses' => 'AccountController@listAllAccounts']);

Route::post('account/register/partner', ['as' => 'account.register.partner', 'uses' => 'AccountController@topartner']);

Route::post('account/register', ['as' => 'account.register', 'uses' => 'AccountController@register']);

Route::get('account/email/exists', ['as' => 'account.check-email', 'uses' => 'AccountController@checkEmail']);

Route::get('account/activate/{accountId}/{activationCode}', ['as' => 'account.activate', 'uses' => 'AccountController@activate']);

Route::post('account/activation-code', ['as' => 'account.request-activation-code', 'uses' => 'AccountController@reActivate']);

Route::get('account/phonenumber/exists', ['as' => 'account.check-phone', 'uses' => 'AccountController@validatePhone']);

Route::get('account/covid/{id}', [ 'as' => 'account.accountmemberinfo', 'uses' => 'AccountController@accountMemberInfo']);

Route::get('account/allvaccinedetail/{id}', [ 'as' => 'account.allvaccinedetail', 'uses' => 'AccountController@allVaccineDetail']);

Route::get('account/memberphotoiddetail/{id}', [ 'as' => 'account.memberphotoiddetail', 'uses' => 'AccountController@getMemberPhotoIdDetail']);

Route::get('account/recentcoviddetail/{id}', [ 'as' => 'account.recentcoviddetail', 'uses' => 'AccountController@recentCovidDetail']);

Route::post('members/memberaddcovidrecord', ['as' => 'member.addCovidRecord', 'uses' => 'MemberController@memberAddCovidRecord']);

Route::post('members/memberaddvaccinerecord', ['as' => 'member.memberAddVaccineRecord', 'uses' => 'MemberController@memberAddVaccineRecord']);

Route::group(['before' => 'auth.jwt'], function () {

    Route::get('getmaptoken', ['as' => 'getmaptoken', 'uses' => 'AuthController@getmaptoken']);

    Route::get('account', ['as' => 'account.show', 'uses' => 'AccountController@show']);

    Route::put('account', ['as' => 'account.update', 'uses' => 'AccountController@update']);

    Route::patch('account', ['as' => 'account.update', 'uses' => 'AccountController@update']);

    Route::delete('account', ['as' => 'account.delete', 'uses' => 'AccountController@destroy']);

    Route::post('account/checkPassword', ['as' => 'account.check_password', 'uses' => 'AccountController@checkPassword']);

    Route::post('account/deviceTokens', ['as' => 'account.device_token', 'uses' => 'AccountController@registerDeviceToken']);

    Route::get('account/badges', ['as' => 'account.badges', 'uses' => 'AccountController@badges']);

    Route::post('account/termsandconditions', ['as' => 'account.termsandconditions', 'uses' => 'AccountController@termsconditions']);

    Route::get('account/allcoviddetail', [ 'as' => 'account.allcoviddetail', 'uses' => 'AccountController@allCovidDetail']);

    /*Route::get('account/check/endsubscription', [ 'as' => 'account.checksubscription', 'uses' => 'AccountController@checkSubscriptionDate']);*/

});

Route::post('account/assignpartnerplan', ['as' => 'account.assignPartnerPlan', 'uses' => 'AccountController@assignPartnerPlan']);

Route::post('account/updatefeatures', ['as' => 'account.updateFeatures', 'uses' => 'AccountController@updateFeatures']);

/*
|--------------------------------------------------------------------------
| Account Settings Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt', 'prefix' => 'account/settings'], function () {

    Route::post('password', ['as' => 'account.settings.password', 'uses' => 'AccountSettingsController@password']);

    Route::post('security-answer', ['as' => 'account.settings.security-question', 'uses' => 'AccountSettingsController@checkSecurityAnswer']);

    Route::post('email', ['as' => 'account.settings.email', 'uses' => 'AccountSettingsController@updateEmail']);

});

Route::get('account/settings/confirm-email', ['as' => 'account.settings.confirm-email', 'uses' => 'AccountSettingsController@confirmEmail']);

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::post('member/validatecovidrecord', ['as' => 'member.validatecovidrecord', 'uses' => 'MemberController@validateCovidRecord']);

Route::post('member/validatecovidrecordweb', ['as' => 'member.validatecovidrecordweb', 'uses' => 'MemberController@validateCovidRecordWeb']);

Route::post('member/validatevaccinerecord', ['as' => 'member.validatevaccinerecord', 'uses' => 'MemberController@validateVaccineRecord']);

Route::post('member/validatevaccinerecordweb', ['as' => 'member.validatevaccinerecordweb', 'uses' => 'MemberController@validateVaccineRecordWeb']);

Route::post('members/memberupdatephotoid', ['as' => 'member.memberupdatephotoid', 'uses' => 'MemberController@memberUpdatePhotoID']);

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('members', ['as' => 'member.create', 'uses' => 'MemberController@store']);

    Route::get('members/{id}', ['as' => 'member.show', 'uses' => 'MemberController@show']);

    Route::put('members/{id}', ['as' => 'member.update', 'uses' => 'MemberController@update']);

    Route::patch('members/{id}', ['as' => 'member.update', 'uses' => 'MemberController@update']);

    Route::delete('members/{id}', ['as' => 'member.delete', 'uses' => 'MemberController@destroy']);

    Route::get('members/{id}/alerts', ['as' => 'member.alerts', 'uses' => 'MemberController@getAlerts']);

    Route::get('members/{id}/printId', ['as' => 'member.print_id', 'uses' => 'PdfController@printIceId']);

    Route::post('members/{id}/transfer', ['as' => 'member.transfer', 'uses' => 'MemberController@transferToAccount']);

    Route::match(['get', 'post'], 'members/{id}/share', ['as' => 'member.generate_pdf_profile', 'uses' => 'ShareController@share']);

    Route::get('members/{id}/history', ['as' => 'member.history', 'uses' => 'HistoryController@show']);

    Route::get('members/{mid}/contacts/{cid}/permissions', ['as' => 'member.contact.get-permissions', 'uses' => 'ShareController@showContactPermission']);

    Route::put('members/{mid}/contacts/{cid}/permissions', ['as' => 'member.contact.update-permissions', 'uses' => 'ShareController@updateContactPermission']);

    Route::get('members/{id}/shared-profile/{token}', ['as' => 'member.shared-profile', 'uses' => 'ShareController@showProfile']);

    Route::delete('member/deletecovidvaccinerec', ['as' => 'member.deletecovidvaccine', 'uses' => 'MemberController@deletecovidvaccinerec']);

});

Route::get('covid/publickey/{public_key}', ['as' => 'member.getcovidpublickeyrecord', 'uses' => 'MemberController@getCovidPublicKeyRecord']);

Route::get('immunization/publickey/{public_key}', ['as' => 'member.getimmunicationspublickeyrecord', 'uses' => 'MemberController@getImmunicationsPublicKeyRecord']);

Route::get('covid/buttondetail', ['as' => 'member.covidbuttondetail', 'uses' => 'MemberController@covidButtonDetail']);

Route::get('members/shared/{token}', ['as' => 'member.show-shared', 'uses' => 'MemberController@showShared']);

Route::get('members/public/{token}', ['as' => 'member.show-shared', 'uses' => 'ShareController@showProfile']);

Route::post('members/public/{token}/print', ['as' => 'member.print-shared', 'uses' => 'ShareController@printProfile']);

Route::post('members/public/{token}/forward', ['as' => 'member.forward-shared', 'uses' => 'ShareController@forwardProfile']);

/*
|--------------------------------------------------------------------------
| Guardian Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('guardians', ['as' => 'guardian.request', 'uses' => 'GuardianController@request']);

    Route::get('guardians', ['as' => 'guardian.index', 'uses' => 'GuardianController@index']);

    Route::post('guardians/accept/{requestId}', ['as' => 'guardian.accept', 'uses' => 'GuardianController@accept']);

    Route::delete('guardians/decline/{requestIdId}', ['as' => 'guardian.decline', 'uses' => 'GuardianController@decline']);

    Route::delete('guardians/cancel', ['as' => 'guardian.cancel', 'uses' => 'GuardianController@cancel']);

    Route::delete('guardians/{guardianId}', ['as' => 'guardian.delete', 'uses' => 'GuardianController@delete']);

    Route::post('guardians/resend', ['as' => 'guardian.resend-nomination', 'uses' => 'GuardianController@resend']);

});

/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('contacts', ['as' => 'contact.request', 'uses' => 'ContactController@request']);

    Route::post('contacts/accept', ['as' => 'contact.accept', 'uses' => 'ContactController@accept']);

    Route::get('contacts', ['as' => 'contact.index', 'uses' => 'ContactController@index']);

    Route::delete('contacts/cancel', ['as' => 'contact.cancel', 'uses' => 'ContactController@cancel']);

    Route::delete('contacts/remove', ['as' => 'contact.delete', 'uses' => 'ContactController@delete']);

    Route::post('contacts/accept/{requestId}', ['as' => 'contact.accept', 'uses' => 'ContactController@accept']);

    Route::delete('contacts/decline/{requestId}', ['as' => 'contact.decline', 'uses' => 'ContactController@decline']);

    Route::post('contacts/resend', ['as' => 'contact.resend-nomination', 'uses' => 'ContactController@resend']);
});

/*
|--------------------------------------------------------------------------
| Friend Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt'], function () {

    Route::get('friends', ['as' => 'friend.index', 'uses' => 'FriendController@index']);

    Route::delete('friends/guardians/{accountId}', ['as' => 'friend.guardian.delete', 'uses' => 'FriendController@deleteGuardian']);

    Route::delete('friends/contacts/{memberId}', ['as' => 'friend.contact.delete', 'uses' => 'FriendController@deleteContact']);

});

/*
|--------------------------------------------------------------------------
| File upload Route
|--------------------------------------------------------------------------
*/
Route::group(['before' => 'auth.jwt'], function () {

    Route::post('upload', ['as' => 'file.upload', 'uses' => 'FileController@upload']);

    Route::get('lockscreen', ['as' => 'file.lockscreen', 'uses' => 'FileController@generateLockscreen']);

});

Route::post('upload', ['as' => 'file.upload', 'uses' => 'FileController@upload']);

/*
|--------------------------------------------------------------------------
| Message Center Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt'], function () {

    Route::get('messages', ['as' => 'message.index', 'uses' => 'MessageController@index']);

    Route::post('messages/status', ['as' => 'message.status', 'uses' => 'MessageController@updateMessageStatus']);

    Route::post('messages/viewed', ['as' => 'message.status.viewed', 'uses' => 'MessageController@updateMessageViewedAll']);

});

Socket::channel('messages', 'MessagesChannel');

/*
|--------------------------------------------------------------------------
| Alert Routes
|--------------------------------------------------------------------------
*/

Route::post('alerts', ['as' => 'alert.trigger', 'uses' => 'AlertController@trigger']);

Route::get('testalerts/{iceId}', ['as' => 'alert.testtriggernormalalert', 'uses' => 'AlertController@testTriggerNormalAlert']);

Socket::channel('alerts', 'AlertsChannel');

/*
|--------------------------------------------------------------------------
| Tickets (aka Help) Routes
|--------------------------------------------------------------------------
*/

Route::post('support', ['as' => 'support.create_ticket', 'uses' => 'SupportController@openTicket']);

/*
|--------------------------------------------------------------------------
| Pdfs/Print Routes
|--------------------------------------------------------------------------
*/

Route::get('pdf/print/iceangel_id/{memberId}', ['as' => 'pdf.print_ice_id', 'uses' => 'PdfController@printIceId']);

Route::get('pdf/view/member_profile/{memberId}', ['as' => 'pdf.view_member_profile', 'uses' => 'PdfController@viewProfile']);

Route::get('pdf/download/member_profile/{memberId}', ['as' => 'pdf.download_member_profile', 'uses' => 'PdfController@downloadProfile']);

Route::get('pdf/profile/{token}', ['as' => 'pdf.profile', 'uses' => 'PdfController@profile']);

/*
|--------------------------------------------------------------------------
| Sync/UnSync Routes
|--------------------------------------------------------------------------
*/

Route::get('sync/verify_member', ['as' => 'sync.verify_member', 'uses' => 'SyncController@verifyMember']);

Route::post('sync/devices', ['as' => 'sync.sync_device', 'uses' => 'SyncController@sync']);

Route::get('sync/devices/{uuid}', ['as' => 'sync.show_device', 'uses' => 'SyncController@show']);

Route::put('sync/devices/{uuid}', ['as' => 'sync.update_device', 'uses' => 'SyncController@update']);

Route::delete('sync/devices/{uuid}', ['as' => 'sync.unsync_device', 'uses' => 'SyncController@unSync']);

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('sync/devices/{uuid}/accept', ['as' => 'sync.accept_device', 'uses' => 'SyncController@acceptSync']);

    Route::delete('sync/devices/{uuid}/decline', ['as' => 'sync.decline_device', 'uses' => 'SyncController@declineSync']);

});

/*
|--------------------------------------------------------------------------
| Sync/UnSync Routes
|--------------------------------------------------------------------------
*/

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('analytics', ['as' => 'analytics', 'uses' => 'AnalyticsController@handle']);

});

/*
|--------------------------------------------------------------------------
| Contents Routes
|--------------------------------------------------------------------------
*/

Route::get('contents', ['as' => 'contents.index', 'uses' => 'ContentsController@index']);

Route::get('pages/{slug}', ['as' => 'contents.page', 'uses' => 'ContentsController@getPage']);

Route::get('covidcontents', ['as' => 'contents.covidcontents', 'uses' => 'ContentsController@getCovidContents']);

Route::get('vaccinedosages', ['as' => 'contents.vaccinedosages', 'uses' => 'ContentsController@getVaccineDosages']);

/*
|--------------------------------------------------------------------------
| Partners
|--------------------------------------------------------------------------
*/

Route::get('partners/members/{iceId}', ['as' => 'partners.member', 'uses' => 'PartnerController@member']);

Route::post('partners/account', ['as' => 'partners.account', 'uses' => 'PartnerController@createAccount']);

Route::post('partners/account/upload', ['as' => 'partners.account.upload', 'uses' => 'PartnerController@createAccountsFromFile']);

Route::delete('partners/account/{iceId}', ['as' => 'partners.remove_fin', 'uses' => 'PartnerController@removeFin']);

// Route::delete('partners/contacts/{iceId}', ['as' => 'partners.contact_remove', 'uses' => 'PartnerController@removeAsEcp']);

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('account/phone/exists', ['as' => 'account.check-phone', 'uses' => 'AccountController@checkPhone']);

    Route::get('partners/key', ['as' => 'partners.key', 'uses' => 'PartnerController@key']);

    Route::put('partners/key', ['as' => 'partners.updateKey', 'uses' => 'PartnerController@updateKey']);

});

Route::post('partners/coupon', ['as' => 'partners.coupon', 'uses' => 'PartnerController@createCoupon']);

/*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/

Route::post('stripe/partner/subscription', ['as' => 'partner.subscribe', 'uses' => 'PurchasesController@subscribeYearlyByPostman']);

Route::group(['before' => 'auth.jwt'], function () {

    Route::post('stripe/subscribe', ['as' => 'stripe.subscribe', 'uses' => 'PurchasesController@subscribeYearly']);

    Route::post('stripe/cancel', ['as' => 'stripe.cancel', 'uses' => 'PurchasesController@cancelYearly']);

    Route::post('stripe/resume', ['as' => 'stripe.resume', 'uses' => 'PurchasesController@resumeYearly']);

    Route::get('coupon/check', ['as' => 'coupon.check', 'uses' => 'PurchasesController@checkCoupon']);

});
Route::post('worldcoviddetail', ['as' => 'covid.detail', 'uses' => 'PurchasesController@gettingCovidDetail']);

Route::post('stripe/alipay/charge', ['as' => 'alipay.charge', 'uses' => 'PurchasesController@chargeAlipay']);

Route::post('stripe/alipay/failed', ['as' => 'alipay.failed', 'uses' => 'PurchasesController@failedAlipay']);

Route::post('stripe/alipay/canceled', ['as' => 'alipay.canceled', 'uses' => 'PurchasesController@canceledAlipay']);

