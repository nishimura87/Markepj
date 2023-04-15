<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AddresseeController;
use App\Http\Controllers\OrderController;

Route::get('/marke/about', [ShopController::class, 'about'])->name('about');
Route::get('/marke/privacy', [ShopController::class, 'privacy'])->name('privacy');
Route::get('/marke/law', [ShopController::class, 'law'])->name('law');

Route::get('/marke/contact', [ContactController::class, 'index'])->name('index');
Route::post('/marke/contact/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('marke/contact/completed', [ContactController::class, 'send'])->name('send');

Route::get('/member', [MemberController::class, 'infoUser'])->name('infoUser');

Route::get('/marke', [ItemController::class, 'home'])->name('home');
Route::get('/marke/item/category/{name}', [ItemController::class, 'categoryItem'])->name('categoryItem');
Route::get('/marke/item/{id}', [ItemController::class, 'showItem'])->name('showItem');

Route::get('/marke/news', [NewsController::class, 'news'])->name('news');
Route::get('/marke/news/{id}', [NewsController::class, 'showNews'])->name('showNews');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orderhistory', [MemberController::class, 'orderHistory'])->name('orderHistory');

    Route::get('/admin/item/store', [ItemController::class, 'createItem'])->name('createItem');
    Route::get('/admin/item/{id}', [ItemController::class, 'editItem'])->name('editItem');
    Route::get('/admin/item/fix/{id}', [ItemController::class, 'fixItem'])->name('fixItem');
    Route::post('/admin/item/update/{id}', [ItemController::class, 'updateItem'])->name('updateItem');
    Route::post('/admin/item/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');
    Route::post('/admin/item/store/confirm', [ItemController::class, 'confirmItem'])->name('confirmItem');
    Route::post('/admin/item/store/compleate', [ItemController::class, 'storeItem'])->name('storeItem');

    Route::get('/admin/news/store', [NewsController::class, 'createNews'])->name('createNews');
    Route::get('/admin/news/{id}', [NewsController::class, 'editNews'])->name('editNews');
    Route::get('/admin/news/fix/{id}', [NewsController::class, 'fixNews'])->name('fixNews');
    Route::post('/admin/news/store/confirm', [NewsController::class, 'confirmNews'])->name('confirmNews');
    Route::post('/admin/news/store/compleate', [NewsController::class, 'storeNews'])->name('storeNews');
    Route::post('/admin/news/update/{id}', [NewsController::class, 'updateNews'])->name('updateNews');
    Route::post('/admin/news/{id}', [NewsController::class, 'deleteNews'])->name('deleteNews');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/member/orderhistory', [MemberController::class, 'orderHistory'])->name('orderHistory');
    Route::get('/member/edit', [MemberController::class, 'editUser'])->name('editUser');
    Route::get('/member/password', [MemberController::class, 'editPassword'])->name('editPassword');
    Route::post('/member/edit', [MemberController::class, 'updateUser'])->name('updateUser');
    Route::post('/member/password', [MemberController::class, 'updatePassword'])->name('updatePassword');

    Route::get('/member/addressee/store',
    [AddresseeController::class, 'createAddressee'])->name('createAddressee');
    Route::post('/member/addressee/store/complete',
    [AddresseeController::class, 'storeAddressee'])->name('storeAddressee');

    Route::get('/marke/cart', [ItemController::class, 'cartList'])->name('cartList');
    Route::post('/marke/cart', [ItemController::class, 'addCart'])->name('addCart');
    Route::post('/marke/cart/remove', [ItemController::class, 'removeCart'])->name('removeCart');
    Route::post('/marke/cart/update', [ItemController::class, 'updateCart'])->name('updateCart');
    Route::post('/marke/cart/order', [ItemController::class, 'orderItem'])->name('orderItem');

    Route::get('/member/payment', [PaymentController::class, 'infoPayment'])->name('infoPayment');
    Route::get('/member/payment/form', [PaymentController::class, 'createPayment'])->name('createPayment');
    Route::post('/member/payment/form', [PaymentController::class, 'storePayment'])->name('storePayment');
    Route::post('/member/payment/destroy', [PaymentController::class, 'destroyPayment'])->name('destroyPayment');

    Route::get('/marke/cart/order/complete', [OrderController::class, 'completeOrder'])->name('completeOrder');
    Route::post('/marke/cart/order/complete', [OrderController::class, 'order'])->name('order');
});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';