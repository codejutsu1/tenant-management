<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SuperAdmin\PagesController as SuperAdminPages;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\CaretakerController;
use App\Http\Controllers\SuperAdmin\YearController;
use App\Http\Controllers\Admin\PagesController as AdminPages;
use App\Http\Controllers\Admin\PaymentController as AdminPayment;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/dashboardUser', [PagesController::class, 'dashboardUser'])->name('dashboard.user');
Route::get('/dashboard-admin', [AdminPages::class, 'dashboardAdmin'])->name('dashboard.admin');
Route::get('/dashboard-landlord', [SuperAdminPages::class, 'dashboardSuperAdmin'])->name('dashboard.super.admin');

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

Route::get('admin/new-payment', [AdminPayment::class, 'showPaymentDetails'])->name('show.payment.details');
Route::resource('users', UserController::class);
Route::resource('tenants', TenantController::class);
Route::resource('caretakers', CaretakerController::class);
Route::get('landlord/per-year', [YearController::class, 'showTenantsYearly'])->name('show.tenants.yearly');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
