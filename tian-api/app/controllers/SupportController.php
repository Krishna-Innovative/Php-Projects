<?php

use Config;
use IceAngel\Support\Ticket;

class SupportController extends ApiController
{

    use \IceAngel\Traits\NotificationHelpersTrait;

    /**
     * @var OpenTicketValidator
     */
    private $openTicketValidator;

    function __construct(OpenTicketValidator $openTicketValidator)
    {
        $this->openTicketValidator = $openTicketValidator;
    }

    /**
     * Open a new ticket.
     *
     * @return Response
     */
    public function openTicket()
    {
        try {

            $this->openTicketValidator->validate(Input::all());

            App::setLocale(Request::header('Accept-Language'));

            // UserVoice::post("/api/v1/tickets.json", array(
            //     'email' => Input::get('email'),
            //     'name' => Input::get('first_name') . ' ' . Input::get('last_name'),
            //     'ticket' => array(
            //         'state' => 'open',
            //         'subject' => Input::get('subject'),
            //         'message' => Input::get('message'),
            //     )
            // ));

            $this->notifyUser();

            return Response::json(['success' => true, 'message' => trans('errors.support.open_ticket_success')]);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        }
    }

    /**
     * Notify the sender
     */
    private function notifyUser()
    {
        $data = [
            'account' => Input::get('email'),
            'subject' => Input::get('subject'),
            'message' => Input::get('message'),
            'ice_id' => Input::get('ice_id'),
        ];

        $language = App::getLocale();

        if (!is_null($account = $this->getUserIfExists())) {
            $language = $account->language;
        }

        //override with name in form
        $name = full_name(Input::get('first_name', ''), Input::get('last_name', ''), Input::get('middle_name', ''), null, false, false);

        $data['account'] = $name . ' (' . Input::get('email') . ')';
        if($language == 'zh'){
            $data['ice_id_str'] = !empty($data['ice_id']) ? '天使救援™号码 '.$data['ice_id'] : '';
        }
        else{
            $data['ice_id_str'] = !empty($data['ice_id']) ? 'iCE ID '.$data['ice_id'] : '';
        }

        $this->notifyViaEmail(Config::get('mail.emails.tickets'), 'support-receive', 'receive-support-enquiry', $data, $language);

        $this->notifyViaEmail(Input::get('email'), 'support-receive', 'receive-support-enquiry', $data, $language);

    }

    /**
     * Get the logged in user in case of routes which do not require authentication
     *
     * @return null|Account
     */
    protected function getUserIfExists()
    {
        try {
            /** @var JwtFilter $filter */
            $filter = \App::make('JwtFilter');
            $accessToken = $filter->determineAccessToken();

            $decryptedToken = IceAngel\Auth\JWT::decrypt($accessToken);

            // Find the user using the user id
            $user = \Sentry::findUserById($decryptedToken->uid);

            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }

}
