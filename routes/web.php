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
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
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
    Route::get('/users/search', [AdminController::class, 'search'])->name('admin.users.search');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories.show');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/delete/{id}', [AdminController::class, 'destroyCate'])->name('admin.categories.destroy');
    Route::put('/categories/update/{id}', [AdminController::class, 'updateCate'])->name('admin.categories.update');
   
    // Products
    Route::get('/products', [AdminController::class, 'showProducts'])->name('admin.products.show');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::delete('/products/delete/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    Route::put('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');

    // Comments
    Route::get('/comments', [AdminController::class, 'showComments'])->name('admin.comments.show');
    Route::delete('/comments/delete/{comment}', [AdminController::class, 'destroyComment'])->name('admin.comments.destroy');

    // Orders
    Route::get('/orders', [AdminController::class, 'showOrders'])->name('admin.orders.show');
    Route::get('/orders/{id}', [AdminController::class, 'showOItems'])->name('admin.orders.show.items');
    Route::delete('/orders/delete/{id}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
    Route::patch('/orders/complete/{order}', [AdminController::class, 'complete'])->name('orders.complete');

    // Export
    Route::get('/export-report', [AdminController::class, 'exportExcel'])->name('admin.exportReport');
  











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
