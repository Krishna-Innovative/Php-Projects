<?php

use Illuminate\Support\Facades\Input;

class AlertController extends ApiController {

    /**
     * Trigger an emergency alert.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function trigger()
    {
        App::setLocale(Request::header('Accept-Language'));
        if (Input::get('type') == 'panic') {
            return $this->triggerPanicAlert();
        }
        else {
            return $this->triggerNormalAlert();
        }
    }

    /**
     * Handle normal alert
     *
     * @return \Illuminate\Support\Facades\Response
     */
    protected function triggerNormalAlert()
    {
        try {
            /** @var Member $member */
            $member = Member::findByIceId(Input::get('ice_id'));

            $alert = $member->alerts()->create([
                'account_id' => $member->account_id,
                'angel_information' => Input::get('phone', $member->phone),
                'location' => Input::get('location', $this->getAlertLocation()),
                'type' => 'normal',
            ]);

            Event::fire('angel.trigger.alert', $member);
            Event::fire('alert.triggered', [$alert]);

            return Response::json(array_merge($alert->toArray(), ['contacts' => $this->_getContacts($member->id, $member->contacts())]));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }

    /**
     * Handle panic alert
     *
     * @return \Illuminate\Support\Facades\Response
     */
    protected function triggerPanicAlert()
    {
        try {
            /** @var Member $member */
            $member = Member::findByIceId(Input::get('ice_id'));
            if ($member->account_id === $member->id){
                $has_contacts = (bool)$member->contacts(false)->count();
                if(!$has_contacts){
                    return $this->respondWithError('NoECP', trans('errors.member.noecp'), 404);
                }
            }

            $device = $member->devices()->where('uuid', Input::get('uuid'))->first();

            if (is_null($device)) {
                return $this->respondWithError('DeviceNotFound', trans('errors.sync.device_not_found'), 404);
            }

            $alert = $member->alerts()->create([
                'account_id' => $member->account_id,
                'angel_information' => Input::get('phone', $device->toArray()['phone']),
                'location' => Input::get('location', $this->getAlertLocation()),
                'type' => 'panic'
            ]);

            Event::fire('angel.trigger.alert', $member);
            Event::fire('alert.triggered', [$alert]);

            return Response::json(array_merge($alert->toArray(), ['contacts' => $this->_getContacts($member->id, $member->contacts())]));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }

    /**
     * Decorates the contact list and returns only accepted contacts.
     *
     * @param \Illuminate\Support\Collection $contacts
     * @return array
     */
    private function _getContacts($id, $contacts)
    {
        $decoratedList = new \Illuminate\Support\Collection();
        $account = Account::find($id);
        foreach ($contacts as $key => $contact) {
            if ($contact['status'] == 'accepted' && $account->account_id != $contact['id']) {
                $contact = Account::find($contact['id']);
                $phoneArray = $contact->phone;
                if(!empty($phoneArray['number']) && !strpos($phoneArray['number'], ' ') ){
                    $ccode = DB::table('countries')->where('id', $phoneArray['code'])->pluck('phonecode');
                    $phoneArray['number'] = '+'. $ccode . ' ' . $phoneArray['number'];
                
                }
                $this->_push($decoratedList, $contact,$phoneArray);
            }
        }
        /*$contacts->each(function ($contact) use ($decoratedList) {

            if ($contact['status'] == 'accepted') {
                $contact = Account::find($contact['id']);
                $this->_push($decoratedList, $contact);
            }

        });*/

        //if ($decoratedList->isEmpty()){

            //$account = Account::find($id);

            if (!$account->isAccount()){
                $account = Account::find($account->account_id);
                $phoneArray = $account->phone;
                if(!empty($phoneArray['number']) && !strpos($phoneArray['number'], ' ') ){
                    $ccode = DB::table('countries')->where('id', $phoneArray['code'])->pluck('phonecode');
                    $phoneArray['number'] = '+'. $ccode . ' ' . $phoneArray['number'];
                
                }
                $this->_push($decoratedList, $account,$phoneArray);
            }

           
        //}

        return $decoratedList->toArray();
    }

    /**
     * Add contact to a collection
     * @param  array $collection
     * @param  object $account
     */
    private function _push($collection, $account,$phoneArray=array()){

        $full_name = $account->first_name . ' ' . $account->last_name;

        if (has_chinese_characters($full_name)){
            $full_name = full_name($account->first_name, $account->last_name, $account->middle_name, null, false, false);
        }

        $phonenumber =  !empty($phoneArray)?$phoneArray:$account->phone;
        $collection->push([
            'first_name' => $account->first_name,
            'last_name' => $account->last_name,
            'middle_name' => $account->middle_name,
            'full_name' => $full_name,
            'email' => $account->email,
            'phone' => $phonenumber,
        ]);

    }

    /**
     * @return mixed
     */
    protected function getAlertLocation()
    {
        // No more server side geolocation
        return null;

        try {

            $ip = Request::getClientIp();

            return Geocoder::geocode($ip);

        } catch (\Exception $e) {

            return null;

        }
    }
    protected function testTriggerNormalAlert($iceId)
    {
        try {
            App::setLocale('en');
            /** @var Member $member */
            $member = Member::findByIceId($iceId);
            $location = (object)["latitude" =>30.374153600000003,"longitude"=>76.14941569999999,"source"=>"native","city"=>"Mohali","country"=>"India"];
            $alert = $member->alerts()->create([
                'account_id' => $member->account_id,
                'angel_information' => Input::get('phone', $member->phone),
                'location' => $location,
                'type' => 'normal',
            ]);

            Event::fire('angel.trigger.alert', $member);
            Event::fire('alert.triggered', [$alert]);

            return Response::json(['trigger' => 'Successfully trigger']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
} 