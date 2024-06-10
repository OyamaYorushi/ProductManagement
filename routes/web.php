<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMovementController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('products/stock-report', [ProductController::class, 'stockReport'])->name('products.stock_report');
Route::get('top-products', [ProductMovementController::class, 'topProductsChart']);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('movements', ProductMovementController::class)->only(['index', 'create', 'store']);