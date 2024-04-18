<?php

use IceAngel\Traits\NotificationHelpersTrait;

class AuthEventHandler {

    use NotificationHelpersTrait;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('account.suspended*', 'AuthEventHandler@onAccountSuspended');

        $events->listen('account.banned*', 'AuthEventHandler@onAccountBanned');

        $events->listen('account.password.reset', 'AuthEventHandler@onAccountPasswordReset');

        $events->listen('account.password-updated', 'AuthEventHandler@onAccountPasswordUpdated');

        $events->listen('account.login', 'AuthEventHandler@onAccountLogin');
    }
    
    /**
     * Handle account suspension
     *
     * @param \Account $account
     */
    public function onAccountSuspended($account)
    {
        if ($account->canSendNotificationEmail('security')) {
            $this->notifyViaEmail(
                $account->email,
                'account-suspended',
                'account-suspended',
                [
                    'account' => $account->fullName(),
                    'login' => web_app_url('login', $account->language, ['query' => '']),
                ],
                $account->language
            );
        }

        // $this->sendPushNotification($account, 'account.suspended');

        $this->sendInAppMessage('auth.account.suspended', $account->id);
    }

    /**
     * Handle account banned
     *
     * @param \Account $account
     */
    public function onAccountBanned($account)
    {
        if ($account->canSendNotificationEmail('security')) {
            $this->notifyViaEmail(
                $account->email,
                'account-banned',
                'account-banned',
                [
                    'account' => $account->fullName(),
                    'login' => web_app_url('login', $account->language, ['query' => '']),
                ],
                $account->language
            );
        }

        // $this->sendPushNotification($account, 'account.banned');

        $this->sendInAppMessage('auth.account.banned', $account->id);
    }

    /**
     * Handle reset account password
     *
     * @param $account
     */
    public function onAccountPasswordReset($account)
    {
        if ($account->canSendNotificationEmail('security')) {
            $this->notifyViaEmail(
                $account->email,
                'account-password-reminder-success',
                'password-reset',
                [
                    'account' => $account->fullName(),
                    'login' => web_app_url('forgot-password', $account->language, ['query' => '']),
                ],
                $account->language
            );
        }

        // $this->sendPushNotification($account, 'account.reset-password');

        $this->sendInAppMessage('auth.account.reset-password', $account->id);
    }

    public function onAccountPasswordUpdated($account)
    {
        if ($account->canSendNotificationEmail('security')) {
            $this->notifyViaEmail(
                $account->email,
                'account-passwordupdated-reminder-success',
                'password-updated',
                [
                    'account' => $account->fullName(),
                ],
                $account->language
            );
        }

        // $this->sendPushNotification($account, 'account.reset-password');

        $this->sendInAppMessage('auth.account.updated-password', $account->id);
    }

    /**
     * Handle account login event
     *
     * @param Account $account
     */
    public function onAccountLogin($account)
    {
        if (Input::has('nomination')) {
            if (!is_null($nomination = PendingRequest::findByToken(Input::get('nomination'))) && !Member::find($nomination->requester_id)->hasContact($account->id)) {
                $nomination->assignTo($account);
            }
        }
    }
}
