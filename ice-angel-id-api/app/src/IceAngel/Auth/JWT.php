<?php namespace IceAngel\Auth;

use Carbon\Carbon;
use Config;
use JWT as Firebase_JWT;

class JWT
{

    /**
     * Encrypt the given claims.
     *
     * @param array $claims
     * @param bool $remember
     * @return string
     */
    public static function encrypt(array $claims, $remember = false)
    {
        $claims['exp'] = isset($claims['exp']) ? $claims['exp'] : static::lifetime($remember);

        return Firebase_JWT::encode($claims, Config::get('app.key'));
    }

    /**
     * Decrypt the given token.
     *
     * @param string $token
     * @return string
     */
    public static function decrypt($token)
    {
        return Firebase_JWT::decode($token, Config::get('app.key'));
    }

    /**
     * Token Lifetime
     *
     * @param bool $remember
     * @return int
     */
    public static function lifetime($remember = false)
    {
        $now = Carbon::now();
        return $remember ? $now->addYears(100)->timestamp : $now->addMinutes(Config::get('auth.jwt.lifetime'))->timestamp;
    }

    /**
     * Check if token has expired
     *
     * @param int $expiration
     * @return mixed
     */
    public static function hasExpired($expiration){
        return  \Carbon\Carbon::createFromTimestamp($expiration)->lt(\Carbon\Carbon::now());
    }


}