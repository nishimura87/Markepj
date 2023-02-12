<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;

Route::get('/marke', [ShopController::class, 'home'])->name('home');
Route::get('/marke/about', [ShopController::class, 'about'])->name('about');

Route::get('/marke/contact', [ContactController::class, 'index'])->name('index');
Route::post('/marke/contact/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('marke/contact/thanks', [ContactController::class, 'send'])->name('send');

Route::get('/member', [MemberController::class, 'infoUser'])->name('info');
Route::get('/member/edit', [MemberController::class, 'editUser'])->name('editUser');
Route::POST('/member/edit', [MemberController::class, 'updateUser'])->name('updateUser');
Route::get('/member/password', [MemberController::class, 'editPassword'])->name('editPassword');
Route::POST('/member/password', [MemberController::class, 'updatePassword'])->name('updatePassword');

Route::get('/member/payment', [PaymentController::class, 'infoPayment'])->name('infoPayment');
Route::get('/member/payment/form', [PaymentController::class, 'createPayment'])->name('createPayment');
Route::POST('/member/payment/form', [PaymentController::class, 'storePayment'])->name('storePayment');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';