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
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostController;

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
// Blog
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');



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

    // Member register
    Route::get('/subscription/confirm/{id}', [SubscriptionController::class, 'confirm'])->name('subscription.confirm');
    Route::post('/subscription/pay', [SubscriptionController::class, 'pay'])->name('subscription.pay');
    Route::get('/subscription/payment/return', [SubscriptionController::class, 'vnpayReturn'])->name('subscription.vnpay_return');

    // Đăng bài
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');









    
}); 


Route::get('/payment/return', [CartController::class, 'paymentReturn']);



// Admin routes
Route::middleware(['auth', AuthAdmin::class])->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.show');
    Route::post('/users/store', [AdminController::class, 'store'])->name('admin.users.store');
    Route::delete('/users/delete/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/update/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

});





// Other pages
Route::get('/member-register', [HomeController::class, 'member'])->name('member');

// Products
Route::get('/products', [ProductController::class, 'showProducts'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['check.vip'])->group(function () {
    Route::get('/categories/noi-dung-doc-quyen', function () {
        return view('pages.category');
    })->name('categories.vip');
});






// 9704198526191432198
