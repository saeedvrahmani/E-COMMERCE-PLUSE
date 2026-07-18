<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/redis', function () {
    Cache::put('seeed' , 'rahmanii' , 120);
    return \Illuminate\Support\Facades\Cache::get('seeed');
});

Route::group(['prefix'=>'admin' , 'middleware'=> CheckRole::class],function (){
   Route::get('dashboard' ,[DashboardController::class , 'index'])->name('dashboard');
});
//Route::get('/dashboard/{any?}', function () {
//    return view('index');
//})->where('any', '.*');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix' =>'admin' , 'middleware' => 'check-role'], function (){
//Route::resource('/user' , )
});
require __DIR__ . '/auth.php';
