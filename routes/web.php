<?php

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

use App\Http\Controllers\ExpenseReport\BucketsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers')->group(function() {
    Auth::routes();
});

/**
 * Authenticated routes
 */
Route::group(['middleware' => 'auth'], function() {
    /**
     * Home Route
     */
    Route::get('/', HomeController::class)->name('home');


    /**
     * Expense Report Routes
     * @routeName expense-report.
     */
    Route::group([
        'as' => 'expense-report.',
    ], function() {
        /**
         * Expense Report Bucket Routes
         * @routeName buckets.
         * @routePrefix buckets/
         */
        Route::resource('buckets', BucketsController::class);
    });
});
