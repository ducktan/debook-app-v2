<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;

Auth::routes();

Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('google.login');
    Route::get('auth/google-callback', 'googleAuthencation')->name('auth.google-callback');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
    
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    
}); 



Route::middleware(['auth', AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});




// Other pages
Route::get('/member-register', [HomeController::class, 'member'])->name('member');
