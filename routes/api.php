<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\AbsenApi;
use App\Http\Controllers\Api\DataPelanggaranApi;
use App\Http\Controllers\Api\KelasApi;
use App\Http\Controllers\Api\PelanggaranApi;
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

/* ----- GET ----- */
Route::get('/siswa', [SiswaApi::class, 'index']); //Get All Siswa
Route::get('/siswa/{id_kelas}', [SiswaApi::class, 'show']); //Get Siswa By ID Kelas
Route::get('/kelas', [KelasApi::class, 'index']); //Get All Kelas
Route::get('/users', [UsersApi::class, 'index']); //Get All Users
Route::get('/absensi', [AbsenApi::class, 'index']); //Get All Absensi
Route::get('/pelanggaran', [PelanggaranApi::class, 'index']); //Get All Pelanggaran
Route::get('/data-pelanggaran', [DataPelanggaranApi::class, 'index']); //Get All Data Pelanggaran

/* ----- POST ----- */
Route::post('/create-siswa', [SiswaApi::class, 'store']); //Create Siswa

/* ----- PUT ----- */
Route::put('/update-siswa/{NIS}', [SiswaApi::class, 'update']); //Update Siswa

/* ----- DELETE ----- */
Route::delete('/delete-siswa/{NIS}', [SiswaApi::class, 'destroy']); //Delete Siswa