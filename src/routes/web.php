<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;


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
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/area', [ShopController::class, 'search_area']);
    Route::get('/genre', [ShopController::class, 'search_genre']);
    Route::get('/shopname', [ShopController::class, 'search_name']);
    Route::post('/like', [LikeController::class, 'create']);
    Route::get('/detail/{shop}', [ShopController::class, 'detail']);
    Route::post('/reserve', [ReservationController::class, 'create']);
    Route::get('/done', [ReservationController::class, 'create']);
 });

Route::get('/thanks', [AuthController::class, 'thanks']);

// // 画像のアップロード
// Route::get('/upload/upload', [UploadController::class, 'showUploadForm'])->name('upload.form');
// Route::post('/upload/upload', [UploadController::class, 'upload'])->name('upload');