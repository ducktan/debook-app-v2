<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\HomeController;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
    
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    
}); 



Route::middleware(['auth', AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/order', [AdminController::class, 'orderShow'])->name('admin.order');
    Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{order}', [AdminController::class, 'show'])->name('show');
    Route::put('/{order}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/{order}', [AdminController::class, 'destroy'])->name('destroy');

    //Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});




// Other pages
Route::get('/member-register', [HomeController::class, 'member'])->name('member');

