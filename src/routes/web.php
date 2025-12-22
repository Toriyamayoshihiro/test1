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
Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('detail.item');
Route::get('/search',[ItemController::class, 'search']);
Route::middleware('auth')->group(function () {
     Route::get('/purchase/{item_id}', [ItemController::class, 'purchase'])->name('purchase.item');
     Route::post('/purchase/{item_id}', [ItemController::class, 'postPurchase']);
     Route::get('/purchase/address/{item_id}', [ItemController::class, 'address_edit']);
     Route::post('/purchase/address/{item_id}', [ItemController::class, 'address_store']);
     Route::post('/item/{item_id}/add', [ItemController::class, 'commentAdd']);
     Route::post('/item/{item_id}/like',[ItemController::class,'like']);
     Route::get('/mypage',[ProfileController::class, 'profile']);
     Route::get('/mypage/profile',[ProfileController::class, 'edit']);
     Route::post('/mypage/profile/edit',[ProfileController::class, 'store']);
     Route::patch('/mypage/profile/edit',[ProfileController::class, 'update']);
     Route::get('/sell',[ItemController::class, 'sell']);
     Route::post('/item/upload',[ItemController::class, 'store']);
    
});
