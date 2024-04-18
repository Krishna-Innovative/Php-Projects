<?php namespace IceAngel\Sync;

use Cartalyst\Sentry\Users\UserNotFoundException;
use IceAngel\Sync\Throttling\InvalidAccountAuthenticationException;
use IceAngel\Sync\Throttling\SyncExceedLimitException;
use IceAngel\Sync\Throttling\InvalidAccountEmailAuthenticationException;
use IceAngel\Sync\Throttling\SyncThrottle;
use Member, Device, PushDevice, Sentry;

class SyncDevice {

    protected $data;

    protected $member;

    /**
     * @var SyncThrottle
     */
    private $throttle;

    /**
     * @param SyncThrottle $throttle
     */
    function __construct(SyncThrottle $throttle)
    {
        $this->throttle = $throttle;
    }

    /**
     * Sync the Member's device.
     *
     * @param \Member $member
     * @param array $data
     * @return bool|Device
     * @throws InvalidAccountAuthenticationException
     */
    public function sync($member, $data)
    {
        $this->member = $member;
        $this->data = $data;
        $this->data['activated'] = false;
        $throttler = $this->throttle->findByMemberAndUuid($member, $data['uuid']);

        if ($throttler) {
            $throttler->check();
        }

        if (!$this->validateMember()) {

            $throttler->addSyncAttempt();

            if ($member->isAccount()){
                throw new InvalidAccountAuthenticationException;
            }else{
                throw new InvalidAccountEmailAuthenticationException;
            }

        }
        $device_count=Device::where(['member_id'=>$member->id])->get();
        if(count($device_count) >= 3){
            /*if(count($device_count)>=10){
                throw new SyncExceedLimitException;
            }*/
             throw new SyncExceedLimitException;
        }




        $device = $member->devices()->create($this->data);

        $pushDevice = PushDevice::create(array('account_id' => $member->account_id, 'device_id' => $device->id));

        $throttler->clearSyncAttempts();

        return $device;
    }

    /**
     * Vaidate the member credentials.
     *
     * @return bool
     */
    private function validateMember()
    {
        if ($this->member->isAccount()) {

            try {
                Sentry::findUserByCredentials([
                    'email' => $this->member->email,
                    'password' => $this->data['password'],
                ]);

                // $this->data['activated'] = true;

                return true;
            } catch (UserNotFoundException $e) {
                return false;
            }

        } else {
            return $this->data['email'] == $this->member->account->email;
        }
    }
}
