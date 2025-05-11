<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;

Auth::routes(); //Authentication routes


// Socialite routes
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback', 'socialAuthencation')->name('auth.callback');
});

// Indexx
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe'); // mail subscribe
// Search
Route::get('/ajax-search', [HomeController::class, 'ajaxSearch'])->name('ajax.search');

// Category
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
// Blog
Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');



// User Profile
Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');    
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    // -------

    Route::get('/my-products', [UserController::class, 'myProducts'])->name('user.myProducts');
    Route::delete('/my-products/{product}', [UserController::class, 'destroy'])->name('user.products.destroy');

    // -------
    Route::get('/my-orders', [UserController::class, 'myOrders'])->name('user.myOrders');
    // -------
   

    // -----
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/update/{productId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/payment', [CartController::class, 'payment'])->name('payment');

    // Comment 
    Route::post('/products/{product}/comments', [ProductController::class, 'store'])->name('comments.store');

    // Read book
    Route::get('/products/{product}/read', [ProductController::class, 'read'])->name('products.read');
    Route::get('/products/{product}/listen', [ProductController::class, 'listen'])->name('products.listen');






    
}); 


Route::get('/payment/return', [CartController::class, 'paymentReturn']);



// Admin routes
Route::middleware(['auth', AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});




// Other pages
Route::get('/member-register', [HomeController::class, 'member'])->name('member');

// Products
Route::get('/products', [ProductController::class, 'showProducts'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');



// 9704198526191432198
