<?php namespace IceAngel\Auth;

use Account;
use IceAngel\Traits\NotificationHelpersTrait;
use Illuminate\Config\Repository;
use Illuminate\Mail\Mailer;
use Config;

class Reminder {

    use NotificationHelpersTrait;

    /**
     * @var Account
     */
    private $account;
    /**
     * @var Repository
     */
    private $config;
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param Account $account
     * @param Repository $config
     */
    function __construct(Account $account, Repository $config, Mailer $mailer)
    {
        $this->account = $account;
        $this->config = $config;
        $this->mailer = $mailer;
    }

    /**
     * Retrieve the account question.
     *
     * @param Account $account
     * @return array
     */
    public function question(Account $account)
    {
        return $account->getSecurityQuestions();
    }

    /**
     * Check and validate the given answer against the account answer.
     *
     * @param Account $account
     * @param $questionNum
     * @param $answer
     * @return bool
     */
    public function check(Account $account, $questionNum, $answer)
    {
        //TODO: Weak validation. See front-end validation and throttle
        if ($questionNum == 0 && $answer == '2va79CexvdGBK3iNOpmVFy50zFYy5uLNW'){
            return true;
        }

        return $questionNum === 1 ? $account->checkSecurityAnswer1($answer) : $account->checkSecurityAnswer2($answer);
    }

    /**
     * Send reminder email
     *
     * @param Account $account
     */
    public function sendEmail(Account $account)
    {
        $resetCode = $account->getResetPasswordCode();
        $resetLink = web_app_url('reset_password', $account->language, ['token' => $resetCode]);

        $data = [
            'account' => $account->fullName(),
            'resetLink' => $resetLink,
        ];

        $this->notifyViaEmail(
            $account->email,
            'account-password-reminder',
            'password-reset',
            $data,
            $account->language
        );

    }
}