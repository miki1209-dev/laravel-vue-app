<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::controller(ExpenseController::class)->group(function () {
	Route::get('expenses', 'index')->name('api.expenses.index');
	Route::post('expenses', 'store')->name('api.expenses.store');
	Route::get('expenses/{expense}', 'show')->name('api.expenses.show');
	Route::put('expenses/{expense}', 'update')->name('api.expenses.update');
	Route::delete('expenses/{expense}', 'destroy')->name('api.expenses.destroy');
});
