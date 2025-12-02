<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::get('/search',[ItemController::class, 'search']);
Route::middleware('auth')->group(function () {
     Route::post('/purchase/{item_id}', [ItemController::class, 'purchase']);
     Route::post('/item/{item_id}/add', [ItemController::class, 'commentAdd']);
     Route::get('/mypage',[ProfileController::class, 'profile']);
     Route::get('/mypage/profile',[ProfileController::class, 'edit']);
     Route::get('/sell',[ItemController::class, 'sell']);

});
