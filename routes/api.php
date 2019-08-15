<?php

use App\Http\Controllers\ExpenseReport\BucketsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * API Routes
 */
Route::middleware('auth')->group(function() {
    /**
     * Expense Report Routes
     * @routeName expense-report
     */
    Route::as('expense-report.')->group(function() {
        /**
         * Expense Report Bucket Routes
         * @routeName buckets.
         * @routePrefix buckets/
         */
        Route::as('buckets.')->group(function() {
            Route::get('', [BucketsController::class, 'index'])->name('index');
            Route::post('', [BucketsController::class, 'store'])->name('store');
            Route::get('{bucket}', [BucketsController::class, 'show'])->name('show');
            Route::patch('{bucket}', [BucketsController::class, 'update'])->name('update');
            Route::delete('{bucket}', [BucketsController::class, 'destroy'])->name('destroy');
        });
    });
});
