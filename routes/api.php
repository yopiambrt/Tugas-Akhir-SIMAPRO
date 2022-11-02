<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "/base"], function () {

    Route::group(["prefix" => "/territory"], function () {
        Route::get('/province', [BaseController::class , 'province']);
        Route::get('/city', [BaseController::class , 'city']);
    });

    Route::get('/agama', [BaseController::class , 'agama']);

    Route::group(["prefix" => "/master"], function () {
        Route::get('/jenis_usaha', [BaseController::class , 'jenis_usaha']);
        Route::get('/level_usaha', [BaseController::class , 'level_usaha']);
        Route::get('/kriteria_usaha', [BaseController::class , 'kriteria_usaha']);
        Route::get('/kriteria_pekerja_lepas', [BaseController::class , 'kriteria_pekerja_lepas']);
        Route::get('/status_pekerjaan', [BaseController::class , 'status_pekerjaan']);
        Route::get('/kategori_pekerjaan', [BaseController::class , 'kategori_pekerjaan']);
        Route::get('/level_instansi', [BaseController::class , 'level_instansi']);
        Route::get('/universitas_jenjang', [BaseController::class , 'universitas_jenjang']);
        Route::get('/universitas_level', [BaseController::class , 'universitas_level']);
        Route::get('/universitas_kategori', [BaseController::class , 'universitas_kategori']);
        Route::get('/jenis_perusahaan', [BaseController::class , 'jenis_perusahaan']);
        Route::get('/pendidikan', [BaseController::class , 'pendidikan']);
    });

});
