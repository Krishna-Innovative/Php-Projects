<?php
use Mapkit\JWT;
/**
 * Class AuthController
 */
class AuthController extends ApiController {

    /**
     *  Log in the user and return the JWT token
     */
    public function login()
    {
        try {

            App::setLocale(Request::header('Accept-Language'));

            // Try to login with member id
            if (Input::has('ice_id')) {
                $account = Account::findByIceId(Input::get('ice_id'));
                $email = $account->email;
            }else{
                $email = Input::get('email');
            }

            // $email = Input::get('email') ?: $account->email;

            // Login credentials
            $credentials = array(
                'email' => $email,
                'password' => Input::get('password'),
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);
            $remember = Input::get('remember', false);

            // Link device to logged in user
            if ($device = Input::get('device')) {
                $this->registerDeviceToken($user, $device);
            }

            // Basic claims
            $claims = [
                'uid' => $user->id
            ];

            $token = IceAngel\Auth\JWT::encrypt($claims, $remember);

            Event::fire('account.login', $user);

            return Response::json([
                'token' => $token,
                'expires_at' => IceAngel\Auth\JWT::lifetime($remember),
                'type' => 'Bearer',
                'location' => $this->getLoginLocation(),
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('WrongCredentialsException', trans('errors.auth.wrong_ice_id'), 401);

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {

            return $this->respondWithError('EmailRequiredException', trans('errors.auth.login_required'), 401);

        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {

            return $this->respondWithError('PasswordRequiredException', trans('errors.auth.password_required'), 401);

        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {

            return $this->respondWithError('WrongCredentialsException', trans('errors.auth.wrong_password'), 401);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('WrongCredentialsException', trans('errors.auth.user_not_found'), 401);

        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {

            return $this->respondWithError('UserNotActivatedException', trans('errors.auth.user_not_activated'), 401);

        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {

            $throttle = Sentry::findThrottlerByUserLogin($email);

            $time = $throttle->getSuspensionTime();

            // Event::fire('account.suspended.auth', [Sentry::findUserByLogin($email)]);

            return $this->respondWithError('UserSuspendedException', trans('errors.auth.user_suspended', ['time' => $time]), 401);

        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {

            // Event::fire('account.banned.auth', [Sentry::findUserByLogin($email)]);

            return $this->respondWithError('UserBannedException', trans('errors.auth.user_banned'), 401);

        } catch (\Exception $e) {

            return $this->respondWithError('Exception', $e->getMessage() , 401);

        }


    }
     public function getmaptoken(){
            $my_token = JWT::getToken('-----BEGIN PRIVATE KEY-----
MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgSKpOozx4Pxn8IXnY
mWxSkRizQ9BawPLPhUjSZbmyoWOgCgYIKoZIzj0DAQehRANCAARaxtJJgBiw0No+
5IOsFK7hGmxr+Wkqdkay2PAlWCjI8QJsOuRSBkdCdLrQBH2dfchJlLOOvqh5SZtX
IrY6sZZc
-----END PRIVATE KEY-----','924NB3T89A','D6S9NQGVAX',null,172800);
            return Response::json([
                'token' => $my_token
            ]);
    }

    /**
    *  Validate an existing valid JWT token
    */
    public function checkToken()
    {

        try {

            App::setLocale(Request::header('Accept-Language'));

            $filter = \App::make('JwtFilter');
            $filter->filter();

            $accessToken = Input::get('access_token');
            $decryptedToken = IceAngel\Auth\JWT::decrypt($accessToken);
            $remember = Input::get('remember', false);

            if(IceAngel\Auth\JWT::hasExpired($decryptedToken->exp)){
                return $this->respondWithError('Unauthorized', trans('errors.auth.jwt_invalid'), 404);
            }

            $account = Sentry::findUserById($decryptedToken->uid);
            Event::fire('account.login', $account);

            return Response::json([
                'token' => $accessToken,
                'expires_at' => $decryptedToken->exp,
                'type' => 'Bearer',
                'location' => $this->getLoginLocation(),
            ]);


        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('WrongCredentialsException', trans('errors.auth.wrong_ice_id'), 401);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('WrongCredentialsException', trans('errors.auth.user_not_found'), 401);

        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {

            return $this->respondWithError('UserNotActivatedException', trans('errors.auth.user_not_activated'), 401);

        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {

            $throttle = Sentry::findThrottlerByUserLogin($email);

            $time = $throttle->getSuspensionTime();

            // Event::fire('account.suspended.auth', [Sentry::findUserByLogin($email)]);

            return $this->respondWithError('UserSuspendedException', trans('errors.auth.user_suspended', ['time' => $time]), 401);

        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {

            // Event::fire('account.banned.auth', [Sentry::findUserByLogin($email)]);

            return $this->respondWithError('UserBannedException', trans('errors.auth.user_banned'), 401);

        } catch (Exception $e) {

            return $this->respondWithError('Unauthorized', trans('errors.auth.jwt_invalid'), 404);
        }
    }

    /**
     * Link the device to the logged in user.
     *
     * @param Account $account
     * @param array $device
     * @return PushDevice|bool
     */
    protected function registerDeviceToken(Account $account, $device)
    {

        //sanitize device
        $device['token'] = trim($device['token']) ?: null;
        $device['onesignal_id'] = trim($device['onesignal_id']) ?: null;

        if ($device['type'] == 'android'){
            $device['jpush_id'] = trim($device['jpush_id']) ?: null;
        }else{
            $device['jpush_id'] = null;
        }
        if(isset($device['device_id'])){
            $pushDev = PushDevice::firstByAttributes(array('onesignal_id' => null, 'jpush_id' => null, 'type' => null, 'account_id' => $account->id, 'device_id'=> $device['device_id']));
        }
        else{
            $pushDev = PushDevice::firstByAttributes(array('onesignal_id' => null, 'jpush_id' => null, 'type' => null, 'account_id' => $account->id));
        }
        $get_device_id = isset($device['device_id']) ? $device['device_id'] : '';
        
        extract($device);

        if ($pushDev)
        {
            $registeredDevice = Device::find($pushDev->device_id);

            if (isset($onesignal_id) && !empty($token) && !empty($onesignal_id) || !empty($jpush_id)){

                if (PushDevice::checkToken($token, $type) && is_object($pushDev)) {

                    $registeredDevice->activated = true;
                    $registeredDevice->save();

                    Event::fire('device.sync.complete', [Member::findOrFail($account->id), $registeredDevice]);

                    $newDevice = PushDevice::updateOrCreate(array('id' => $pushDev->id), $device);
                    if(empty($get_device_id)){
                        PushDevice::deleteUnallocated($account->id); //clean up all unassigned push devices
    
                    }
                    
                     \Log::info(':zap: Synced Device ', array('account_id' => $account->id, 'ice_id' => $account->ice_id,
                                                           'push_id'=> $newDevice->id, 'type'=>$newDevice->type));

                    return $newDevice;
                }
            }
            $payload = $device + $pushDev->toArray();
            //invalid payload, reverse sync
            $registeredDevice->delete();
            $pushDev->delete();
            throw new \Exception(trans('errors.sync.device_incomplete'));
        }

        throw new \Exception(trans('errors.sync.device_incomplete'));

    }

    /**
     * Get the user's login location
     *
     * @return mixed
     */
    protected function getLoginLocation()
    {
        try {

            $ip = Request::getClientIp();

            return Geocoder::geocode($ip)->toArray();

        } catch (\Exception $e) {

            return null;

        }
    }
} 
