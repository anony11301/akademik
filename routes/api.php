<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\AbsenApi;
use App\Http\Controllers\Api\KelasApi;
use App\Http\Controllers\Api\SiswaApi;
use App\Http\Controllers\Api\UsersApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/siswa', [SiswaApi::class, 'index']);
Route::get('/kelas', [KelasApi::class, 'index']);
Route::get('/users', [UsersApi::class, 'index']);
Route::get('/absensi', [AbsenApi::class, 'index']);
