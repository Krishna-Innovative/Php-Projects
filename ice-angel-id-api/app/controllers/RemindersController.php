<?php

use IceAngel\Auth\Reminder;

class RemindersController extends ApiController
{
    /**
     * @var Reminder
     */
    private $reminder;

    function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Get the first security question.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function getRemind()
    {
        try {

            App::setLocale(Request::header('Accept-Language'));

            $email = Input::get('email');

            $throttle = Sentry::findThrottlerByUserLogin($email);

            if ($throttle->check()) {
                return Response::json($this->reminder->question($throttle->getUser()));
            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('UserNotFoundException', trans('errors.auth.user_not_found'), 404);

        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {

            $time = $throttle->getSuspensionTime();

            return $this->respondWithError('UserSuspendedException', trans('errors.auth.user_suspended', ['time' => $time]), 403);

        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {

            return $this->respondWithError('UserBannedException', trans('errors.auth.user_banned'), 403);

        }
    }

    public function postRemind()
    {
        try {
            $throttle = Sentry::findThrottlerByUserLogin(Input::get('email'));

            if ($throttle->check()) {

                $account = $throttle->getUser();

                App::setLocale(Request::header('Accept-Language'));

                if ($this->reminder->check(
                    $account,
                    Input::get('question_num'),
                    Input::get('answer'))
                ) {

                    // Get the password reset code
                    $this->reminder->sendEmail($account);

                    return Response::json(['success' => true]);
                }

                // @TODO: ban the account. This feature will be handled from the server
                if ((Input::get('question_num') == 2) && (Input::get('attempts') == 3)) {
                    $throttle->suspend();

                    Event::fire('account.banned.post-reset-password', [Sentry::findUserByLogin(Input::get('email'))]);

                    return $this->respondWithError('UserBannedException', trans('errors.auth.user_banned'), 403);
                }

                return $this->respondWithError('IncorrectSecurityAnswerException', trans('errors.reminders.incorrect_security_question'), 406);
            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('UserNotFoundException', trans('errors.auth.user_not_found'), 404);

        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {

            $time = $throttle->getSuspensionTime();

            return $this->respondWithError('UserSuspendedException', trans('errors.auth.user_suspended', ['time' => $time]), 403);

        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {

            return $this->respondWithError('UserBannedException', trans('errors.auth.user_banned'), 403);

        }
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        try {

            $resetCode = Input::get('reset_code');

            App::setLocale(Request::header('Accept-Language'));

            $account = Sentry::findUserByResetPasswordCode($resetCode);

            // Attempt to reset the user password
            if ($account->attemptResetPassword($resetCode, Input::get('new_password'))) {

                Event::fire('account.password.reset', $account);

                return Response::json(['success' => true, 'message' => trans('errors.reminders.reset_success')]);

            } else {

                return $this->respondWithError('ExpiredResetCodeException', trans('errors.reminders.invalid_reset_code'), 406);

            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('InvalidResetCodeException', trans('errors.reminders.invalid_reset_code'), 404);

        }
    }

}
