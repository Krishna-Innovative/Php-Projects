<?php

class AuthControllerTest extends ApiTestCase
{

    public function test_attempt_to_login_with_valid_and_active_account()
    {
        $account = $this->createAccount(true, ['email' => 'tech@iceangelid.com']);

        $response = $this->call('post', 'login', [
            'email' => $account->email,
            'password' => 'password',
        ]);

        $this->assertResponseOk();

        $this->assertContains('token', $response->getContent());
    }

    public function test_attempt_to_login_with_inactive_account()
    {
        $account = $this->createAccount();

        $response = $this->call('post', 'login', [
            'email' => $account->email,
            'password' => 'password',
        ]);

        $this->assertResponseStatus(401);

        $this->assertContains('UserNotActivatedException', $response->getContent());
    }

    public function test_attempt_to_login_with_invalid_credentials()
    {
        $response = $this->call('post', 'login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertResponseStatus(401);

        $this->assertContains('UserNotFoundException', $response->getContent());
    }

}
