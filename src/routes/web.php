<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopmanageController;



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




Route::middleware('auth')->group(function () {
    Route::get('/thanks', [AuthController::class, 'thanks']);
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/area', [ShopController::class, 'search_area']);
    Route::get('/genre', [ShopController::class, 'search_genre']);
    Route::get('/shopname', [ShopController::class, 'search_name']);
    Route::get('/detail/{shop}', [ShopController::class, 'detail']);
    Route::post('/like', [LikeController::class, 'create']);
    Route::post('/reserve', [ReservationController::class, 'create']);
    Route::patch('/reserve/update', [ReservationController::class, 'update']);
    Route::post('/reserve/delete', [ReservationController::class, 'delete']);
    Route::get('/done', [ReservationController::class, 'create']);
    Route::get('/mypage', [UserController::class, 'mypage']);
 });

// 店舗管理
Route::get('/manage/shopmanage', [ShopController::class, 'shopmanage']);
Route::post('/manage/shopmanage', [ShopController::class, 'create'])->name('shopmanage');
Route::patch('/manage/shopmanage/update', [ShopController::class, 'update']);
Route::get('/manage/shopmanage/update', [ShopController::class, 'update']);



// Shop画像のアップロード
Route::post('/upload/upload', [ShopController::class, 'upload'])->name('upload');
Route::get('/upload/upload', [ShopController::class, 'upload'])->name('upload');