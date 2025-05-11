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

Route::middleware('auth')->group(function () {

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
