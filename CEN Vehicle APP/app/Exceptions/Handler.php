<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\ErrorHandler\ThrowableUtils;

use Illuminate\Contracts\Support\Jsonable;



class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        
        $this->renderable(function(TokenInvalidException $e, $request){
            return  response()->json([
                'status' => 'failed',
                'message'=>'Invalid token'
            ],421);
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            return  response()->json([
                'status' => 'failed',
                'message'=>'Token has Expired'],421);
        });

        $this->renderable(function (JWTException $e, $request) {
            return  response()->json([
                'status' => 'failed',
                'message'=>'Token not parsed'],421);
        });
    }
}
