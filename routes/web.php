<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\BackgroudController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CardStylesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FontController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserCardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

Route::get('/optimize', [HomeController::class, 'optimize'])->name('optimize');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');

Route::get('design/{id}', [HomeController::class, 'design'])->name('design');

Route::get('oauth/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');


Route::group(['middleware' => ['auth','verified']], function () {
    Route::post('ajaxLike', [UserCardController::class, 'ajaxLike'])->name('card.ajaxLike');
    Route::post('like/{id}', [UserCardController::class, 'like'])->name('card.like');
    Route::delete('like/{id}/{type?}', [UserCardController::class, 'removeLike'])->name('card.destroyLike');
    Route::delete('like/delete/all', [UserCardController::class, 'removeAllLikes'])->name('card.destroyAllLikes');
    Route::put('profile/update', [UserCardController::class, 'changeUserInfo'])->name('profile.update');
    Route::delete('order/{id}', [UserCardController::class, 'removeOrder'])->name('order.destroy');


    Route::put('design/save/{id}', [HomeController::class, 'saveCardDesign'])->name('design.save');

    Route::get('checkout', [HomeController::class, 'paymentCheckout'])->name('checkout.payment');
    Route::get('checkout/{id}', [HomeController::class, 'checkout'])->name('checkout');
    Route::put('checkout/{id}', [HomeController::class, 'checkoutSave'])->name('checkout.save');
    Route::get('favorite', [HomeController::class, 'favorite'])->name('favorite');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');


    Route::get('jawwalpay/response', [PaymentController::class, 'jawwalPayResponse'])->name('jawwalpay.response');
    Route::get('paypal/cancel-payment', [PaymentController::class, 'payPalCancel'])->name('payPal.cancel');
    Route::get('paypal/payment-success', [PaymentController::class, 'payPalSuccess'])->name('payPal.success');

});

//Control Panel
Route::group(['prefix' => 'admin'], function () {
    //Admin Auth
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login.post');
    Route::get('forgot', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.forgot');
    Route::post('forgot', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.forgot.post');
    Route::get('reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.reset');
    Route::post('reset', [AdminResetPasswordController::class, 'reset'])->name('admin.reset.post');


    Route::group(['middleware' => 'admin'], function () {
        Route::group(['middleware' => 'role:Delivery,Printer'], function () {
            Route::get('', [AdminHomeController::class, 'index'])->name('admin');
            Route::get('settings', [AdminHomeController::class, 'settings'])->name('settings');
            Route::put('changePassword', [AdminHomeController::class, 'changePassword'])->name('changePassword');
            Route::put('changeInfo', [AdminHomeController::class, 'changeInfo'])->name('changeInfo');
            Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
            Route::get('orders/{page}', [OrderController::class, 'index'])->name('orders.index');
            Route::get('orders/print/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::post('orders/checkCount/{usertype}', [OrderController::class, 'checkCount'])->name('orders.checkCount');
        });


        Route::delete('cards/destroy-image/{cardImage}', [CardController::class, 'destroyImage'])->name('cards.destroy.image');
        Route::resource('cards', CardController::class);
        Route::resource('cards.styles', CardStylesController::class)->shallow();;
        Route::resource('accounts', AccountController::class)->except(['show']);
        Route::resource('fonts', FontController::class)->except(['edit', 'update']);
        Route::resource('icons', IconController::class)->except(['edit', 'update']);
        Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
        Route::resource('cities', CityController::class)->only(['index', 'store', 'destroy', 'update']);
        Route::resource('coupons', CouponController::class)->except(['edit', 'update']);
        Route::resource('orders', OrderController::class)->except(['index', 'show']);
    });

});
