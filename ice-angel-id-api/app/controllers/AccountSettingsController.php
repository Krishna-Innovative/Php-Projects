<?php

class AccountSettingsController extends ApiController {

    use \IceAngel\Traits\NotificationHelpersTrait;

    /**
     * Update the Account password.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function password()
    {

        try {

            with(new UpdatePasswordValidator())->validate(Input::all());

            $account = Sentry::getUser();

            if ($account->checkPassword(Input::get('password'))) {

                $account->password = Input::get('new_password');

		$account->pass_update = 1;

                $account->save();

                Event::fire('account.password-updated', $account);

                return Response::json(['success' => true, 'message' => trans('errors.account.settings.password_updated')]);

            }
            else {

                return $this->respondWithError('WrongPasswordException', trans('errors.account.settings.wrong_password'), 406);

            }

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        }

    }

    /**
     * Check if the given answer is correct.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function checkSecurityAnswer()
    {
        /** @var Account $account */
        $account = Sentry::getUser();

        $questionNum = Input::get('question_num');
        $answer = Input::get('answer');

        $checked = $questionNum === 1 ? $account->checkSecurityAnswer1($answer) : $account->checkSecurityAnswer2($answer);

        if ($checked) {
            return Response::json(['success' => true]);
        }

        return $this->respondWithError('IncorrectSecurityAnswerException', trans('errors.reminders.incorrect_security_question'), 406);
    }

    /**
     * Update the account's email address
     *
     * @return \Response
     */
    public function updateEmail()
    {
        try {

            with(new UpdateEmailValidator())->validate(Input::only('email'));

            // Send email to validate the email
            /** @var Account $account */
            $account = Sentry::getUser();
            $email = Input::get('email');
            App::setLocale(Request::header('Accept-Language')); ;

            $token = \IceAngel\Auth\JWT::encrypt([
                'id' => $account->id,
                'email' => $email,
		        'expireIn' => (time()+14400),
            ]);
            $confirmationLink = route('account.settings.confirm-email', ['data' => $token]);

            $data = [
                'account' => $account->fullName(),
                'confirmationLink' => $confirmationLink
            ];
            $data_new = [
                'account' => $account->fullName(),
                'email' => $email
            ];
            $oldEmail = $account->email;
            
            $this->notifyViaEmail($oldEmail, 'account-update-email-notify', 'email-updated', $data_new, $account->language);

            $this->notifyViaEmail($email, 'account-update-email', 'email-updated', $data, $account->language);

//	      Event::fire('account.email-updated', $account); //26062019
//            Mail::queue('emails.account.update-email',
//                ['account' => $account->first_name, 'confirmationLink' => $confirmationLink],
//                function ($message) use ($email) {
//                    $message
//                        ->from(Config::get('mail.emails.no-reply'), 'iCEAngel-ID')
//                        ->to($email)
//                        ->subject(trans('mail.subjects.email-verification'));
//                });

            return Response::json(['success' => true, 'message' => trans('errors.account.settings.email_updated')]);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first('email'), 406);

        }

    }

    /**
     * Confirm Email update
     *
     * @return mixed
     */
    public function confirmEmail()
    {
        try {

            $data = Input::get('data');
            $data = \IceAngel\Auth\JWT::decrypt($data);
	
	        $expireIn = $data->expireIn;

            if( time() <= $expireIn ){

            $account = Account::findOrFail($data->id);

            $oldEmail = $account->email;
            $account->email = $data->email;

            $channels = $account->emergency_channels;
            $primaryChannel = $channels["emergency_channel1"];
            $primaryChannel["value"] = $account->email;
            $channels["emergency_channel1"] = $primaryChannel;
            $account->emergency_channels = $channels->toArray();

            $account->save();

             $data = [
                'account' => $account->fullName(),
                'email' => $account->email
            ];

            //$this->notifyViaEmail($oldEmail, 'account-update-email-notify', 'email-updated', $data, $account->language);

            Event::fire('account.email-updated', $account);

            return Redirect::away(web_app_url('login', $account->language, ['query' => '?emailUpdated=1']));
  	
	    }else{

            return Redirect::away(web_app_url('login',App::getLocale(), ['query' =>'?expireLink=1']));

        }

        } catch (Exception $e) {

            return Redirect::away(web_app_url('login', App::getLocale(), ['query' => '?emailUpdated=0']));

        }
    }

}
