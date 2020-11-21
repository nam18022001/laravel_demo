<?php
// namespace App\Http\Controllers;

use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach', [TheLoaiController::class, 'getDanhSach']);

        Route::get('sua/{id}', [TheLoaiController::class, 'getSua']);
        Route::post('sua/{id}', [TheLoaiController::class, 'postSua']);
        
        Route::get('them', [TheLoaiController::class, 'getThem']);
        Route::post('them', [TheLoaiController::class, 'postThem']);
        
        Route::get('xoa/{id}', [TheLoaiController::class, 'postXoa']);

    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach', [LoaiTinController::class, 'getDanhSach']);

        Route::get('sua/{id}', [LoaiTinController::class, 'getSua']);
        Route::post('sua/{id}', [LoaiTinController::class, 'postSua']);
        
        Route::get('them', [LoaiTinController::class, 'getThem']);
        Route::post('them', [LoaiTinController::class, 'postThem']);
        
        Route::get('xoa/{id}', [LoaiTinController::class, 'postXoa']);

    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', [TinTucController::class, 'getDanhSach']);
        Route::get('sua', [TinTucController::class, 'getSua']);
        Route::get('them', [TinTucController::class, 'getThem']);

        Route::get('xoa/{id}', [TinTucController::class, 'postXoa']);

    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', [UserController::class, 'getDanhSach']);
        Route::get('sua', [UserController::class, 'getSua']);
        Route::get('them', [UserController::class, 'getThem']);

    });
    
});