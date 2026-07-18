<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\DashboardController;

Route::group(['prefix' => 'admin' , 'middleware' => 'check-role'], function (){
   Route::get('/dashboard' ,[DashboardController::class , 'index']);
});
