<?php

use IceAngel\Sync\SyncDevice;
use IceAngel\Sync\Throttling\SyncExceedLimitException;
use IceAngel\Sync\Throttling\PartnerPermiumException;

class SyncController extends ApiController {

    /**
     * @var SyncDevice
     */
    private $syncDevice;

    /**
     * @param SyncDevice $syncDevice
     */
    function __construct(SyncDevice $syncDevice)
    {
        $this->syncDevice = $syncDevice;
    }

    /**
     * Verify a member by his/her iCEAngel Id and return the user's type.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function verifyMember()
    {
        $memberId = Input::get('member_id');
        $isMobileApp = Input::get('isMobileApp') ? Input::get('isMobileApp') : 0;
        $lang = Request::header('Accept-Language', Config::get('app.locale'));

        App::setLocale($lang);

        if (!$memberId) {
            return $this->respondWithError('MissingArgumentException', trans('errors.sync.member_id_required'), 400);
        }

        try {
            $member = Member::findByIceId($memberId);

            $type = $email = $name = '';

            $has_contacts = (bool)$member->contacts(false)->count();

            if ($member->account_id === $member->id){
                $type = 'account';
                $email = $member->email;
                $name = full_name($member->first_name, $member->last_name, $member->middle_name, $lang, false, false);
                $iscompleteprofile = (trim($name) == '' || trim(empty($name)) ) ? false : true;
                $usera = Sentry::findUserById($member->id);
                $parentAcc = array(
                    'name'=>full_name($usera->first_name, $usera->last_name, $usera->middle_name, $lang, false, false),
                    'email'=>$usera->email,
                    'ispremium'=> $usera->is_lifetime || $usera->subscribed()
                );

            }
            else{
                $type='member';
                $has_contacts = true;
                $accHolder = Account::findOrFail($member->account_id);
                $email = $accHolder->email;
                $name = full_name($accHolder->first_name, $accHolder->last_name, $accHolder->middle_name, $lang, false, false);
                if($isMobileApp && $accHolder && $accHolder->is_partner && !$accHolder->toArray()['is_premium']){
                    throw new PartnerPermiumException;
                }
                $iscompleteprofile = (trim($name) == '' || trim(empty($name)) ) ? false : true;
                $usera = Sentry::findUserById($member->account_id);
                $parentAcc = array(
                    'name'=>full_name($usera->first_name, $usera->last_name, $usera->middle_name, $lang, false, false),
                    'email'=>$usera->email,
                    'is_partner'=>$usera->is_partner,
                    'ispremium'=> $usera->is_partner ? true : $usera->is_lifetime || $usera->subscribed()
                );

            }
        $device_count=Device::where(['member_id'=>$member->id])->get();
        if($isMobileApp && count($device_count) >= 3){
            /*if(count($device_count)>=10){
                throw new SyncExceedLimitException;
            }*/
             throw new SyncExceedLimitException;
        }

	    $phoneArray = $member->phone;

	    if( !strpos($phoneArray['number'], ' ') ){
            
            $ccode = DB::table('countries')->where('id', $phoneArray['code'])->pluck('phonecode');

            $phoneArray['number'] = '+'. $ccode . ' ' . $phoneArray['number'];

	    }

            return Response::json([
                'type' => $type,
                'account_email' => $email,
                'account_name' => $name,
                'phone' => $phoneArray,
                'has_contacts' => $has_contacts,
                'parent'=>$parentAcc,
                'iscompleteprofile' =>$iscompleteprofile
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFound', trans('errors.member.not_found'), 404);
        } catch (\IceAngel\Sync\Throttling\SyncExceedLimitException $e) {
            return $this->respondWithError('SyncExceedLimitException', trans('errors.sync.sync_exceed_limit'), 401);
        }catch (\IceAngel\Sync\Throttling\PartnerPermiumException $e) {
            return $this->respondWithError('PartnerPermiumException', trans('errors.sync.partner_permium_exception',['account'=> !empty(trim($name)) ? $name : $email]), 402);
        }catch (\Exception $e) {
            return $this->respondWithError('SystemError', trans('errors.member.not_found'), 404);
        }

    }

    /**
     * Sync the Member device.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function sync()
    {
        try {
            $data = Input::only('uuid', 'member_id', 'phone_code', 'phone_number', 'email', 'password');

            App::setLocale(Request::header('Accept-Language'));

            with(new SyncDeviceValidator())->validate($data);

            $member = Member::findByIceId($data['member_id']);

            $device = $this->syncDevice->sync($member, $data);

            if ($member->isAccount()) {
                Event::fire('device.sync.accepted', [$member, $device]);
            } else {
                Event::fire('device.sync.requested', [$member, $device]);
            }

            return Response::json($device, 201);

        } catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFound', trans('errors.member.not_found'), 404);
        } catch (\IceAngel\Sync\Throttling\DeviceBlockedException $e) {
            return $this->respondWithError('DeviceBlockedException', trans('errors.auth.user_suspended', ['time' => 15]), 403);
        } catch (\IceAngel\Sync\Throttling\InvalidAccountAuthenticationException $e) {
            return $this->respondWithError('InvalidAccountAuthenticationException', trans('errors.sync.invalid_account_authentication'), 401);
        }catch (\IceAngel\Sync\Throttling\SyncExceedLimitException $e) {
            return $this->respondWithError('SyncExceedLimitException', trans('errors.sync.sync_exceed_limit'), 401);
        }catch (\IceAngel\Sync\Throttling\InvalidAccountEmailAuthenticationException $e) {
            return $this->respondWithError('InvalidAccountEmailAuthenticationException', trans('errors.sync.invalid_account_email_authentication'), 401);
        } catch (\Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }

    }

    /**
     * Retrieve the device by a given uuid.
     *
     * @param string $uuid
     * @return \Illuminate\Support\Facades\Response
     */
    public function show($uuid)
    {
        try {
            $device = Device::findByUuidOrFail($uuid);

            return Response::json($device);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('DeviceNotFound', trans('errors.sync.device_not_found'), 404);
        }
    }

    /**
     * Update a given device.
     *
     * @param string $uuid
     * @return \Illuminate\Support\Facades\Response
     */
    public function update($uuid)
    {
        try {
            $data = Input::only('new_uuid', 'member_id', 'phone_code', 'phone_number');
            with(new UpdateSyncedDeviceValidator())->validate($data);

            $device = Device::findByUuidOrFail($uuid);

            $device->uuid = Input::get('new_uuid');
            $device->phone_code = Input::get('phone_code', $device->phone_code);
            $device->phone_number = Input::get('phone_number', $device->phone_number);

            $device->save();

            return Response::json($device);
        } catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('DeviceNotFound', trans('errors.sync.device_not_found'), 404);
        }
    }

    /**
     * Unsync the device by a given uuid.
     *
     * @param string $uuid
     * @return \Illuminate\Support\Facades\Response
     */
    public function unSync($uuid)
    {
        try {
            $device = Device::findByUuidOrFail($uuid);

            $pushDevice = PushDevice::firstByAttributes(array('device_id' => $device->id));

            $device->delete();

            // if ($pushDevice)
            //     $pushDevice->delete();

            $device->deleteSyncRequest();

            Event::fire('device.sync.deleted', [$device->member, $device]);

            return Response::json([], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('DeviceNotFound', trans('errors.sync.device_not_found'), 404);
        }
    }

    /**
     * Accept sync device request.
     *
     * @param $uuid
     * @return \Illuminate\Support\Facades\Response
     */
    public function acceptSync($uuid)
    {
        try {
            $device = Device::findByUuidOrFail($uuid);

            $device->activate();

            Event::fire('device.sync.accepted', [$device->member, $device]);

            return Response::json($device);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('DeviceNotFoundException', trans('errors.sync.device_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Decline sync device request.
     *
     * @param $uuid
     * @return \Illuminate\Support\Facades\Response
     */
    public function declineSync($uuid)
    {
        try {
            $device = Device::findByUuidOrFail($uuid);

            $device->delete();

            Event::fire('device.sync.declined', [$device->member, $device]);

            return Response::json([], 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('DeviceNotFoundException', trans('errors.sync.device_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }
}
