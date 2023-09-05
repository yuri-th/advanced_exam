<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;


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
    Route::get('/detail/{shop}', [ShopController::class, 'detail']);
 });

Route::get('/thanks', [AuthController::class, 'thanks']);

// // 画像のアップロード
// Route::get('/upload/upload', [UploadController::class, 'showUploadForm'])->name('upload.form');
// Route::post('/upload/upload', [UploadController::class, 'upload'])->name('upload');