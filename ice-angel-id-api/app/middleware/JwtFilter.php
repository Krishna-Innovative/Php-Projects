<?php

use Illuminate\Http\Request;

class JwtFilter {

    /**
     * The query string key which is used by clients to present the access token (default: access_token)
     *
     * @var string
     */
    protected $tokenKey = 'access_token';

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     */
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function filter()
    {
        $accessToken = $this->determineAccessToken();

        if (empty($accessToken)) {

            return Response::json([
                'error' => [
                    'type' => 'Unauthorized',
                    'message' => trans('errors.auth.jwt_missing'),
                ]
            ], 401);

        }

        return $this->setCurrentUser($accessToken);
    }

    /**
     * Read in the access token from the headers or query string
     *
     * @param bool $headerOnly
     * @return mixed|string
     */
    public function determineAccessToken($headerOnly = false)
    {
        // try to get the access token from header
        if ($this->request->header("Authorization") !== null) {
            $accessToken = $this->determineAccessTokenInHeader();
        }
        elseif (!$headerOnly) {
            $accessToken = $this->request->get($this->tokenKey);
        }

        return $accessToken;
    }

    /**
     * Determine the access token in the authorization header
     *
     * @return string
     */
    private function determineAccessTokenInHeader()
    {
        $header = $this->request->header("Authorization");

        $accessToken = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $header));

        return ($accessToken === 'Bearer') ? '' : $accessToken;
    }

    /**
     * Login the user
     *
     * @param $accessToken
     */
    protected function setCurrentUser($accessToken)
    {
        try {
            $decryptedToken = IceAngel\Auth\JWT::decrypt($accessToken);

            // Find the user using the user id
            $user = Sentry::findUserById($decryptedToken->uid);

            // Log the user in
            Sentry::setUser($user);

            $this->setApplicationLocale($user);

        } catch (Exception $e) {

            return Response::json([
                'error' => [
                    'type' => 'Unauthorized',
                    'message' => trans('errors.auth.jwt_invalid'),
                ]
            ], 401);

        }
    }

    /**
     * Set the Account holder's language as the application locale
     *
     * @param Account $user
     */
    protected function setApplicationLocale($user)
    {
        \App::setLocale($user->language);
    }
}