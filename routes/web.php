<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SuperAdmin\PagesController as SuperAdminPages;
use App\Http\Controllers\SuperAdmin\SettingController as SuperAdminSettings;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\CaretakerController;
use App\Http\Controllers\SuperAdmin\YearController;
use App\Http\Controllers\SuperAdmin\AddUserController;
use App\Http\Controllers\SuperAdmin\PaymentController as SuperAdminPayment;
use App\Http\Controllers\Admin\PagesController as AdminPages;
use App\Http\Controllers\Admin\PaymentController as AdminPayment;
use App\Http\Controllers\Admin\SettingController as AdminSettings;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewUserController;
use App\Http\Controllers\User\PagesController as UserPages;
use App\Http\Controllers\User\PaymentController as UserPayment;
use App\Http\Controllers\User\SettingController as UserSettings;

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

Route::get('/', [UserPages::class, 'index'])->name('home');
Route::inertia('about', 'Web/About')->name('about');
Route::inertia('contact-us', 'Web/Contact')->name('contact');

// Admin Dashboard

Route::group(['middleware' => ['auth', 'landlord'], 'prefix' => 'landlord'], function(){

    Route::controller(SuperAdminPages::class)->group(function() { 
        Route::get('dashboard', 'dashboardSuperAdmin')->name('dashboard.super.admin');
        Route::get('all-users', 'allUsers')->name('all.users');
    });

    Route::resource('tenants', TenantController::class);

    Route::resource('caretakers', CaretakerController::class);

    Route::controller(SuperAdminSettings::class)->group(function() { 
        Route::get('settings', 'superAdminSettings')->name('super.admin.settings');
        Route::post('update-landlord-password', 'updateLandlordPassword')->name('update.landlord.password');

        Route::get('change-user-room', 'landlordChangeRoom')->name('landlord.change.room');
        Route::post('change-user-number', 'landlordChangeNumber')->name('landlord.change.number');

        Route::get('activate-user/{id}', 'landlordActivateUser')->name('landlord.activate.user');
        Route::get('deactivate-user/{id}', 'landlordDeactivateUser')->name('landlord.deactivate.user');
    });

    Route::controller(SuperAdminPayment::class)->group(function() { 
        Route::get('new-payment', 'newPayment')->name('super.admin.payment');
        Route::get('confirm-payment/{id}', 'confirmPayment')->name('confirm.payment');
        Route::get('reject-payment/{id}', 'rejectPayment')->name('reject.payment');
        Route::get('all-transactions', 'allTransactions')->name('all.transactions');
    });

});

// Caretaker Dashboard

Route::group(['middleware' => ['auth', 'caretaker'], 'prefix' => 'caretaker'], function(){ 

    Route::controller(AdminPages::class)->group(function() {
        Route::get('dashboard', 'dashboardAdmin')->name('dashboard.admin');

        Route::get('all-users', 'adminUsers')->name('admin.users');
    });

    Route::controller(AdminPayment::class)->group(function() {
        Route::get('new-payment', 'showPaymentDetails')->name('show.payment.details');
        Route::get('all-transactions', 'adminAllTransactions')->name('admin.all.transactions');
        Route::get('confirm-payment/{id}', 'adminConfirmPayment')->name('admin.confirm.payment');
        Route::get('reject-payment/{id}', 'adminRejectPayment')->name('admin.reject.payment');
    });

    Route::controller(AdminSettings::class)->group(function() { 
        Route::get('settings', 'adminSettings')->name('admin.settings');
        Route::post('update-caretaker-email', 'updateCaretakerEmail')->name('update.caretaker.email');
        Route::post('update-caretaker-password', 'updateCaretakerPassword')->name('update.caretaker.password');
    });

    Route::resource('users', UserController::class);
});

// Tenant Dashboard

Route::group(['middleware' => ['auth', 'tenant'], 'prefix' => 'tenant'], function(){ 
    
    Route::controller(UserPages::class)->group(function() { 
        Route::get('dashboard', 'dashboardUser')->name('dashboard.user');
        Route::get('payment', 'userPayment')->name('user.payment');
        Route::get('receipt', 'userReceipt')->name('user.receipt');
        Route::get('transaction-history', 'userHistory')->name('user.history');
        Route::get('legal', 'userLegal')->name('user.legal');
        Route::get('account-details', 'userDetails')->name('user.details');     
    });

    Route::controller(UserPayment::class)->group(function() {
        
        Route::get('payment/house-lodge-payment', 'housePayment')->name('house.payment');
        Route::get('payment/other-payments', 'otherPayment')->name('other.payment');

        Route::get('payment/house-lodge-payment/online-banking', 'onlineBanking')->name('online.banking');
        Route::get('payment/house-lodge-payment/offline-banking', 'offlineBanking')->name('offline.banking');
        Route::get('payment/house-lodge-payment/crypto', 'crypto')->name('crypto');

        Route::get('payment/other-payment/online-banking', 'otherOnlineBanking')->name('other.online.banking');

        Route::post('paystack/initialize', 'initialize')->name('pay');

        Route::post('online/paid', 'demoPayment')->name('demo.pay');

        // The callback url after a payment
        Route::get('paystack/callback', 'callback')->name('callback');
    });

    Route::controller(UserSettings::class)->group(function() {
        Route::get('settings', 'userSettings')->name('user.settings');
        Route::get('user-edit', 'userEdit')->name('user.edits');
        Route::post('update-tenant', 'updateTenant')->name('update.tenant');
        Route::post('update-tenant-email', 'updateTenantEmail')->name('update.tenant.email');
        Route::post('update-tenant-password', 'updateTenantPassword')->name('update.tenant.password');
    });
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
