<?php

use App\Http\Controllers\Api\V2\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V2\Auth\LoginController;
use App\Http\Controllers\Api\V2\Auth\LogoutController;
use App\Http\Controllers\Api\V2\Auth\RegisterController;
use App\Http\Controllers\Api\V2\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V2\MeController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\JsonApi;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

//Route::prefix('v2')->middleware(JsonApi::class)->group(function () {
//    Route::post('/login', LoginController::class)->name('showLogin');
//    Route::post('/logout', LogoutController::class);
//    Route::post('/register', RegisterController::class);
//    Route::post('/password-forgot', ForgotPasswordController::class);
//    Route::post('/password-reset', ResetPasswordController::class)->name('password.reset');
//});

//JsonApiRoute::server('v2')->prefix('v2')->resources(function (ResourceRegistrar $server) {
//    $server->resource('users', JsonApiController::class);
//    Route::get('me', [MeController::class, 'readProfile']);
//    Route::patch('me', [MeController::class, 'updateProfile']);
//});
