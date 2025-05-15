<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdAccountController;
use App\Http\Controllers\AdAccountTopupController;
use App\Http\Controllers\AdExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PersonalExpenseController;
use App\Http\Controllers\PersonalInstallmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController; // Added CommentController
use App\Http\Controllers\FacebookAccountController;
use App\Http\Controllers\AdController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All routes are wrapped in the `auth` middleware so only logged-in users
| can access the CRM screens. We redirect “/” to the dashboard by default.
|
*/

Route::get('/', fn() => redirect()->route('dashboard'));
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
Route::get('/installments', [InstallmentController::class, 'index'])->name('installments.index');
Route::get('/installments/create', [InstallmentController::class, 'create'])->name('installments.create');
Route::post('/installments', [InstallmentController::class, 'store'])->name('installments.store');
Route::get('/installments/{plan}', [InstallmentController::class, 'show'])->name('installments.show');
Route::post('/installments/{plan}/pay', [InstallmentController::class, 'pay'])->name('installments.pay');
Route::get('/installments/{plan}/reschedule', [InstallmentController::class, 'showRescheduleForm'])->name('installments.reschedule.form');
Route::post('/installments/{plan}/reschedule', [InstallmentController::class, 'reschedule'])->name('installments.reschedule');
Route::delete('/installments/{plan}/payments/{payment}', [InstallmentController::class, 'removePayment'])->name('installments.payments.remove');
Route::delete('/installments/{plan}', [InstallmentController::class, 'delete'])->name('installments.delete');
Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
Route::resource('facebook-accounts', FacebookAccountController::class);
Route::resource('clients', ClientController::class);
Route::resource('ads', AdController::class);


// New Comment Routes
Route::middleware('auth')->group(function () {

    // Add comments to installment plans

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    // Clients (name + profile)
    Route::resource('clients', ClientController::class)
         ->only(['index','create','store','show']);

    // Ad Accounts & Top-Ups
    Route::resource('ad_accounts', AdAccountController::class);
    Route::resource('ad_account_topups', AdAccountTopupController::class);

    // Ad Expenses
    Route::resource('ad_expenses', AdExpenseController::class);

    // Payments
    Route::resource('payments', PaymentController::class);

    // Personal Expenses & Installments under /personal/*
    Route::prefix('personal')->group(function () {
        // My Daily Expenses
        Route::resource('expenses', PersonalExpenseController::class)
             ->names('personal.expenses');
        // My Installments
        Route::resource('installments', PersonalInstallmentController::class)
             ->names('personal.installments');
    });
});

// Auth routes (login, register, etc.) provided by Breeze
require __DIR__.'/auth.php';