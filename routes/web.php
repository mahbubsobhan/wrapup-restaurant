<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::get('/profile', [ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->middleware('auth')
    ->name('profile.destroy');


/*
|--------------------------------------------------------------------------
| Admin Category Routes
|--------------------------------------------------------------------------
*/

Route::resource('admin/categories', CategoryController::class)
    ->middleware('auth')
    ->names('admin.categories');


/*
|--------------------------------------------------------------------------
| Admin Product Routes
|--------------------------------------------------------------------------
*/

Route::resource('admin/products', ProductController::class)
    ->middleware('auth')
    ->names('admin.products');


/*
|--------------------------------------------------------------------------
| Admin Coupon Routes
|--------------------------------------------------------------------------
*/

Route::resource('admin/coupons', CouponController::class)
    ->middleware('auth')
    ->names('admin.coupons');


/*
|--------------------------------------------------------------------------
| Admin Settings Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/settings', [SettingController::class, 'index'])
    ->middleware('auth')
    ->name('admin.settings.index');

Route::put('/admin/settings', [SettingController::class, 'update'])
    ->middleware('auth')
    ->name('admin.settings.update');


/*
|--------------------------------------------------------------------------
| Admin Order Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/orders', [OrderController::class, 'index'])
    ->middleware('auth')
    ->name('admin.orders.index');

Route::get('/admin/orders/{order}', [OrderController::class, 'show'])
    ->middleware('auth')
    ->name('admin.orders.show');

Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('admin.orders.updateStatus');

Route::patch('/admin/orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])
    ->middleware('auth')
    ->name('admin.orders.updatePaymentStatus');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeMenuController::class, 'index'])
    ->name('home');

Route::view('/product', 'frontend.pages.product')
    ->name('product');

Route::view('/about', 'frontend.pages.about')
    ->name('about');

Route::view('/contact', 'frontend.pages.contact')
    ->name('contact');

Route::view('/franchises', 'frontend.pages.franchises')
    ->name('franchises');


/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::put('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');


/*
|--------------------------------------------------------------------------
| Coupon Routes
|--------------------------------------------------------------------------
*/

Route::post('/cart/apply-coupon', [CheckoutController::class, 'applyCoupon'])
    ->name('cart.applyCoupon');

Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])
    ->name('checkout.applyCoupon');


/*
|--------------------------------------------------------------------------
| Checkout Routes
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');


/*
|--------------------------------------------------------------------------
| Order Success
|--------------------------------------------------------------------------
*/

Route::get('/order/{order}/success', [CheckoutController::class, 'success'])
    ->name('order.success');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/


// SSLCOMMERZ Start



Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

require __DIR__ . '/auth.php';

