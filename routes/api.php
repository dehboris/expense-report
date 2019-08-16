<?php

use App\Http\Controllers\ExpenseReport\BucketItemsController;
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
        Route::prefix('buckets')->as('buckets.')->group(function() {
            Route::get('', [BucketsController::class, 'index'])->name('index');
            Route::post('', [BucketsController::class, 'store'])->name('store');
            Route::get('{bucket}', [BucketsController::class, 'show'])->name('show');
            Route::patch('{bucket}', [BucketsController::class, 'update'])->name('update');
            Route::delete('{bucket}', [BucketsController::class, 'destroy'])->name('destroy');

            /**
             * Expense Report Bucket Items Routes
             * @routeName buckets.items.
             * @routePrefix buckets/{bucket}/items/
             */
            Route::as('items.')->group(function() {
                Route::get('{bucket}/items', [BucketItemsController::class, 'index'])->name('index');
                Route::post('{bucket}/items', [BucketItemsController::class, 'store'])->name('store');
                Route::delete('items/{bucketItem}', [BucketItemsController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
