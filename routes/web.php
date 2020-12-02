<?php
// namespace App\Http\Controllers;

use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SlideController;

use App\Http\Controllers\PageController;



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

Route::get('/', [PageController::class, 'index']);

Route::get('lien-he', [PageController::class, 'lienhe']);

Route::get('admin/login', [UserController::class, 'loginAdmin']);
Route::get('admin', [UserController::class, 'loginAdmin']);

Route::get('admin/logout', [UserController::class, 'logoutAdmin']);


Route::post('admin/login', [UserController::class, 'postloginAdmin']);


Route::group(['prefix' => 'admin', 'middleware' => 'adminlogin'], function () {
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

        Route::get('sua/{id}', [TinTucController::class, 'getSua']);
        Route::post('sua/{id}', [TinTucController::class, 'postSua']);

        Route::get('them', [TinTucController::class, 'getThem']);
        Route::post('them', [TinTucController::class, 'postThem']);

        Route::get('xoa/{id}', [TinTucController::class, 'postXoa']);

    });
     Route::group(['prefix' => 'slide'], function () {
        Route::get('danhsach', [SlideController::class, 'getDanhSach']);

        Route::get('sua/{id}', [SlideController::class, 'getSua']);
        Route::post('sua/{id}', [SlideController::class, 'postSua']);

        Route::get('them', [SlideController::class, 'getThem']);
        Route::post('them', [SlideController::class, 'postThem']);

        Route::get('xoa/{id}', [SlideController::class, 'postXoa']);

    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', [UserController::class, 'getDanhSach']);

        Route::get('sua/{id}', [UserController::class, 'getSua']);
        Route::post('sua/{id}', [UserController::class, 'postSua']);

        Route::get('them', [UserController::class, 'getThem']);
        Route::post('them', [UserController::class, 'postThem']);

        Route::get('xoa/{id}', [UserController::class, 'postXoa']);

    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('xoa/{id}/{idTinTuc}', [CommentController::class, 'postXoa']);
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', [AjaxController::class, 'getLoaiTin'])->name('idTheLoai.show');
    });
    
});

