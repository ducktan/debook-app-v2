<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\PaymentController;

Auth::routes();

Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback', 'socialAuthencation')->name('auth.callback');
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
Route::get('/member-register', [HomeController::class, 'showPackages'])->name('member');

//1
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment');
//2
Route::post('/process-payment', [PaymentController::class, 'process'])->name('processPayment');



//
Route::get('/user', [UserController::class, 'showUserDashboard'])->name('dashboard');



