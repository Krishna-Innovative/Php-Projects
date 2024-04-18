<?php

use IceAngel\Traits\NotificationHelpersTrait;

class AccountEventHandler {

    use NotificationHelpersTrait;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('account.registered', 'AccountEventHandler@onAccountRegistered');

        $events->listen('contact.requested', 'AccountEventHandler@onContactRequested');

        $events->listen('account.activation.requested', 'AccountEventHandler@onReActivationRequested');

        $events->listen('account.activated', 'AccountEventHandler@onAccountActivated');

        $events->listen('account.push-notification-device.registered', 'AccountEventHandler@onDeviceRegistered');

        $events->listen('account.email-updated', 'AccountEventHandler@onEmailUpdation');

        $events->listen('account.monthlyusers', 'AccountEventHandler@onMonthlyList');

        $events->listen('account.alluserlist', 'AccountEventHandler@onAllUsersList');
    }

    /**
     * Monthly List of new users
     *
     * @param $account
     */

    public function onAllUsersList($fileLink){

        $last_month = date('FY', strtotime('last month'));

        $this->notifyViaEmailToAdmin(
            'krishnaisengg@gmail.com',
            'monthly-userlist-email',
            'monthly-user-list',
            [
                'filelink' =>  $fileLink,
                'month' => $last_month
            ]
        ); 

    } 


    /**
     * Monthly List of new users
     *
     * @param $account
     */

    public function onMonthlyList($fileLink){

        $last_month = date('FY', strtotime('last month'));

        $this->notifyViaEmailToAdmin(
            'richard@iceangelid.com',
            'monthly-userlist-email',
            'monthly-user-list',
            [
                'filelink' =>  $fileLink,
                'month' => $last_month
            ]
        ); 

    } 


    /**
     * Handle Account registration.
     *
     * @param $account
     */
    public function onAccountRegistered($account)
    {
        $this->checkPendingRequests($account);

        $this->sendActivationEmail($account);

        $this->setDefaultMemberProfile($account);
    }

    /**
     * handle Contact requests.
     *
     * @param $request
     */
    public function onContactRequested($request)
    {
        $account = Sentry::getUser();

        if ($account->id == $request->requested_id) {

            $account->contactFor()->attach($request->requester_id);

            $request->delete();

        }
    }

    /**
     * Handle send reactivation link.
     *
     * @param $account
     */
    public function onReActivationRequested($account)
    {
        $this->sendActivationEmail($account);
    }

    /**
     * Handle account activation event
     *
     * @param Account $account
     */
    public function onAccountActivated($account)
    {
        //pre-generate qr code after
        $gen = new \PHPQRCode\QRcode();
        $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;

        $qrGenerator->generateAndUpload($account->ice_id);

        $this->notifyViaEmail(
            $account->email,
            'account-notify-about-contacts',
            'account-activation',
            [
                'account' => $account->fullName(),
                'addContactLink' => web_app_url('member-profile', $account->language, ['memberId' => $account->id, 'query' => '?addEcp=true']),
            ],
            $account->language
        );
    }

    /**
     * Handle push notification device registration
     *
     * @param Account $account
     * @param PushDevice $device
     */
    public function onDeviceRegistered($account, $device)
    {
        $account->enablePushNotificationsAsEmergencyChannel();
    }

    /**
     * Sends the activation email.
     *
     * @param $account
     */
    protected function sendActivationEmail($account)
    {
        $activationCode = $account->getActivationCode();
        $activationLink = route('account.activate', [
            'account' => $account->id,
            'code' => $activationCode,
        ]);

        $this->notifyViaEmail(
            $account->email,
            'account-activate',
            'account-activation',
            [
                'account' => $account->fullName(),
                'activationLink' => $activationLink,
            ],
            $account->language
        );
    }

    /**
     * Checks pending requests.
     *
     * @param $account
     */
    protected function checkPendingRequests($account)
    {
        if (Input::has('nomination')) {
            if (!is_null($nomination = PendingRequest::findByToken(Input::get('nomination')))) {
                $nomination->assignTo($account);
            }
        }

        PendingRequest::where('email', $account->email)
            ->get()
            ->each(function ($request) use ($account) {
                $request->assignTo($account);
                if ($request->type == 'contact') {
                    $data = [
                        'member' => Member::find($request->requester_id)->fullName(),
                    ];

                    $this->sendInAppMessage(
                        'contact.request.to_contact',
                        $account->id,
                        [
                            'placeholders' => $data,
                            'payload' => $request->toArray(),
                            'request' => $request->id,
                        ]
                    );
                }
                elseif ($request->type == 'guardian') {

                    $data = [
                        'account' => Account::find($request->requester_id)->fullName(),
                    ];

                    $this->sendInAppMessage(
                        'guardian.request.to_guardian',
                        $account->id,
                        [
                            'placeholders' => $data,
                            'payload' => $request->toArray(),
                            'request' => $request->id,
                        ]
                    );
                }

            });
    }

    /**
     * Do some initial setup
     *
     * @param Account $account
     */
    protected function setDefaultMemberProfile($account)
    {
        /** @var Member $member */
        $member = Member::find($account->id);

        // Enable location tracking by default
        $member->personalInformation()->create([
            'location_track' => 1,
        ]);
    }

    /**
     * Handle update email events.
     *
     * @param Account $account
     */
    public function onEmailUpdation($account)
    {
        $this->sendInAppMessage('account.email-updated-message', $account->id);	
    }

	
} 
