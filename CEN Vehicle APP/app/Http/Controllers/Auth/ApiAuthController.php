<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiAuthController extends Controller
{
    use HasFactory;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    

    //login
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $credentials = request(['email', 'password']);

        $account = Driver::where('email',$credentials['email']);
        
        if($account->count()==0){
            return response()->json([
                'error' => 'UserNotExist',
                'status'=>'failed',
                'message'=>'This email address does not exist.'
            ], 401);
        }else{
        $token = Auth::guard('api')->attempt($credentials);
            if (!$token ) {
                return response()->json([
                    'error' => 'PasswordError',
                    'status'=>'failed',
                    'message'=>'Password is Incorect'
                ], 401);
            }else{
                $driver = Auth::guard('api')->user();
                if($driver->type=="ADMIN"){
                    return response()->json(['error' => 'Unauthorizedd'], 401);
                }
                else if($driver->email_verified_at==NULL){
                    return response()->json([
                        'error' => 'NotVerified',
                        'status'=>'failed',
                        'message'=>'User is not verified'
                    ], 401);
                }
                else{
                    return $this->respondWithToken( 
                        [
                            'id'=>$driver->id,
                            'email'=>$driver->email, 
                            'name'=>$driver->name, 
                            'phone'=>$driver->phone, 
                            'vehicle_1'=>$driver->vehicle_1,
                            'vehicle_2'=>$driver->vehicle_2, 
                            'vehicle_3'=>$driver->vehicle_3,  
                        ],  $token );
                }
            }
        }
        

        // $user = Driver::where('email', $request->email)->first();

        // if ($user) {
        //     if (Hash::check($request->password, $user->password)) {
        //         $token = $user->createToken('TokenKey')->accessToken;
        //         $response = ['token' => $token];
        //         return response($response, 200);
        //     } else {
        //         $response = ["message" => "Password mismatch"];
        //         return response($response, 422);
        //     }
        // } else {
        //     $response = ["message" =>'User does not exist'];
        //     return response($response, 422);
        // }
    }

    //logout
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    protected function respondWithToken($driver, $token)
    {
        
        return response()->json([
            'status' => 'success',
            'user' => $driver,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
