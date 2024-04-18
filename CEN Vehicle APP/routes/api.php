<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\GetTemplateController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['cors', 'json.response']], function () {
//     Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
// });

// Route::middleware('auth:api')->group(function () {
//     // our routes to be protected will go in here
//     Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
// });
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/media', [MediaController::class, 'store']);
    Route::get('/get-assign-template/{id}/', [GetTemplateController::class, 'get_driver_assign_template']);
    Route::get('/get-template-info/{id}/', [GetTemplateController::class, 'get_template_info']);
    Route::get('/get-user-answer-info/{id}/', [GetTemplateController::class, 'get_user_answer_info']);
    Route::get('/check-user-compeleted-template/{user_id}/{template_id}/{form_number}', [GetTemplateController::class, 'check_user_completed_form']);
    Route::get('/get-completed-template/{user_id}', [GetTemplateController::class, 'get_completed_templates']);
});


//jwt.auth  
Route::group(['middleware' => ['auth.jwt'], 'prefix' => 'driver'], function ($router) {
    //Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    //Route::post('refresh', [ApiAuthController::class, 'logout']);
    Route::post('/get', [TodoController::class, 'user_info']);
});
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    //Route::post('/media//{productId}/upload', [MediaController::class, 'store']);;
    Route::get('/media/-image/{productImageId}/delete', [MediaController::class, 'destroy']);
});
