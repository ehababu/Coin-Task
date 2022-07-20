<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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


Route::redirect('/', '/coins',);
Route::resource('coins', CoinController::class);
Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class);
Route::put('/coins/{coin}/toggle', [CoinController::class, 'toggleActivation']);
Route::view('/main', 'main')->name('main');

