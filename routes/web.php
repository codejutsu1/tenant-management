<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\User\PagesController;

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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::inertia('about', 'Web/About')->name('about');
Route::inertia('contact-us', 'Web/Contact')->name('contact');

Route::get('/dashboardUser', [PagesController::class, 'dashboard'])->name('dashboardUser');
Route::inertia('payment', 'User/Payment')->name('payment');
Route::inertia('receipt', 'User/Receipt')->name('receipt');
Route::inertia('transaction-history', 'User/TransactionHistory')->name('history');
Route::inertia('legal', 'User/Legal')->name('legal');
Route::inertia('account-details', 'User/AccountDetails')->name('details');

Route::inertia('payment/house-lodge-payment', 'User/Payment/House')->name('housePayment');
Route::inertia('payment/other-payments', 'User/Payment/Other')->name('otherPayment');

Route::inertia('payment/house-lodge-payment/online-banking', 'User/Banking/OnlineBanking')->name('onlineBanking');
Route::inertia('payment/house-lodge-payment/offline-banking', 'User/Banking/OfflineBanking')->name('offlineBanking');
Route::inertia('payment/house-lodge-payment/crypto', 'User/Banking/Crypto')->name('crypto');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
