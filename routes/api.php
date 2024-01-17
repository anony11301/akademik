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
use App\Models\Absensi;
use App\Models\DataPelanggaran;
use App\Models\Pelanggaran;
use Database\Seeders\Users;

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
Route::get('/absensi/{id_kelas}', [AbsenApi::class, 'show']);
Route::get('/absensi/detail/{NIS}', [AbsenApi::class, 'detail']);
Route::get('/pelanggaran', [PelanggaranApi::class, 'index']); //Get All Pelanggaran
Route::get('/data-pelanggaran', [DataPelanggaranApi::class, 'index']); //Get All Data Pelanggaran
Route::get('/data-pelanggaran/{id_pelanggaran}', [DataPelanggaranApi::class, 'show']);

/* ----- POST ----- */
Route::post('/create-siswa', [SiswaApi::class, 'store']); //Create Siswa
Route::post('/create-kelas', [KelasApi::class, 'store']); //Create Kelas
Route::post('/create-users', [UsersApi::class, 'store']); //Create Users
Route::post('/create-absen', [AbsenApi::class, 'store']); //Create Absen
Route::post('/create-data-pelanggaran', [DataPelanggaranApi::class, 'store']); //Create Data Pelanggaran
Route::post('/create-pelanggaran', [PelanggaranApi::class, 'store']); //Create Pelanggaran

/* ----- PUT ----- */
Route::put('/update-siswa/{NISN}', [SiswaApi::class, 'update']); //Update Siswa
Route::put('/update-kelas/{id}', [KelasApi::class, 'update']); //Update Kelas
Route::put('/update-users/{id}', [UsersApi::class, 'update']); //Users Users
Route::put('/update-absen/{id}', [AbsenApi::class, 'update']); //Absen Absen
Route::put('/update-data-pelanggaran/{id}', [DataPelanggaranApi::class, 'update']); //Data Pelanggaran Data Pelanggaran
Route::put('/update-pelanggaran/{id}', [PelanggaranApi::class, 'update']); //Pelanggaran Pelanggaran

/* ----- DELETE ----- */
Route::delete('/delete-siswa/{NISN}', [SiswaApi::class, 'destroy']); //Delete Siswa
Route::delete('/delete-kelas/{id}', [KelasApi::class, 'destroy']); //Delete Kelas
Route::delete('/delete-users/{id}', [UsersApi::class, 'destroy']); //Delete Users
Route::delete('/delete-absen/{id}', [AbsenApi::class, 'destroy']); //Delete Absen
Route::delete('/delete-data-pelanggaran/{id}', [DataPelanggaranApi::class, 'destroy']); //Delete Data Pelanggaran
Route::delete('/delete-pelanggaran/{id}', [PelanggaranApi::class, 'destroy']); //Delete Pelanggaran
