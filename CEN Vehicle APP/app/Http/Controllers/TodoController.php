<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class TodoController extends Controller
{
    public function user_info(){

        //$user = JWTAuth::user(); //Auth::user();
        $user = Auth::user();
        dd($user->email);
    }
}
