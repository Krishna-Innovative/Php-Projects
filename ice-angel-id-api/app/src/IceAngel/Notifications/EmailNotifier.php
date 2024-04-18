<?php namespace IceAngel\Notifications;

use IceAngel\Traits\NotificationHelpersTrait;
use Illuminate\Mail\Mailer;
use Config;
use MemberSharedProfile;

class EmailNotifier implements NotifierInterface
{

    use NotificationHelpersTrait;

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @param Mailer $mailer
     */
    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Process the users notification.
     *
     * @param array $users
     * @param $alert
     */
    public function notify(array $users, $alert)
    {

        foreach ($users as $user) {

            /** @var \Account $account */
            $account = \Account::find($user['id']);
            /** @var \Member $member */
            $member = $alert->member;

            $data = [
                'account' => $account->fullName(),
                'member' => $member->fullName(),
                'angel' =>  $alert->angel_information['number'],
                'sharedProfileLink' => $this->getSharedProfileUrl($alert, $account->id),
                'login' => web_app_url('login', $account->language, ['query' => '']),
                'contacts' => '',
            ];

            $data['contacts'] = array_reduce(
                $this->excludeAccountFromContactList($users, $alert->member->account_id),
                function ($contacts, $contact) {
                    $contact = \Account::find($contact['id']);

                    $contacts .= '- ' . $contact->fullName() . ' ' . $contact->phone['number'];

                    return $contacts;
                });

            $content = $alert->type === 'panic' ? 'panic-alert' : 'emergency-alert';

            foreach ($this->userEmails($account) as $email) {

                $this->notifyViaEmail(
                    $email,
                    $content,
                    $content,
                    $data,
                    $account->language
                );

                \Log::info(":email: to [{$email}]");
            }

        }
    }

    /**
     * Return array of contacts excluding the account holder.
     *
     * @param $contacts
     * @param $accountId
     *
     * @return array
     */
    private function excludeAccountFromContactList($contacts, $accountId)
    {
        return array_filter($contacts, function ($contact) use ($accountId) {
            return $accountId !== $contact['id'];
        });
    }

    /**
     * Get a list of user's emergency email addresses
     *
     * @param \Account $account
     *
     * @return array
     */
    private function userEmails($account)
    {
        return $account->emergency_channels->getEmailAddresses();
    }

    /**
     * Get the link to the member's profile
     *
     * @param \Alert $alert
     * @param int $contactId
     *
     * @return string
     */
    protected function getSharedProfileUrl($alert, $contactId)
    {
        $member = $alert->member;

        // Link to member's profile page
        if ($member->account_id == $contactId) {
            return web_app_url('member-profile', $member->account->language, ['memberId' => $member->id, 'query' => '']);
        }

        $sharedProfile = MemberSharedProfile::findByAlert($alert->id, $contactId);

        $contact = \Account::find($contactId);
        $expires = $sharedProfile->expires_at;
        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expires->toDateTimeString(),  $expires->timezoneName);
        $timestamp = $timestamp->setTimezone('UTC')->toISO8601String();
        return web_app_url('shared_profile', $contact->language, ['token' => $sharedProfile->token]) . "?expireDate={$timestamp}";
    }

}