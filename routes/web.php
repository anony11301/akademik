<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\GuruController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/create-siswa', [SiswaController::class, 'create']);


Route::group(['middleware' => ['isManagement'], 'prefix' => 'management'], function () {
    Route::get('/dashboard-management', [ManagementController::class, 'index'])->name('dashboard-management');

    //Kelas
    // Route::get('/management-kelas', [KelasController::class, 'index'])->name('management-kelas');
    Route::get('/management-tambah-kelas', [KelasController::class, 'create'])->name('management-tambah-kelas');
    Route::post('/simpan-data-kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/edit-kelas/{id}', [KelasController::class, 'edit'])->name('edit-kelas');
    Route::post('/update-kelas/{id}', [KelasController::class, 'update'])->name('update-kelas');
    Route::delete('/delete-kelas/{id}', [KelasController::class, 'destroy'])->name('delete-kelas');

    //Siswa
    // Route::get('/management-siswa', [SiswaController::class, 'index'])->name('management-siswa');
    Route::get('/management-tambah-siswa', [SiswaController::class, 'create'])->name('management-tambah-siswa');
    // Route::get('/data-siswa/{id}', [SiswaController::class, 'show'])->name('data-siswa');
    Route::post('/simpan-data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::delete('/delete-siswa/{NIS}', [SiswaController::class, 'destroy'])->name('delete-siswa');
    Route::get('/edit-siswa/{NIS}', [SiswaController::class, 'edit'])->name('edit-siswa');
    Route::put('/update-siswa/{NIS}', [SiswaController::class, 'update'])->name('update-siswa');

    //Absen
    // Route::get('/absen-select', [AbsenController::class, 'select'])->name('absen.select');
    // Route::get('/absen-show/{id}', [AbsenController::class, 'show'])->name('absen.show');


});

Route::group(['middleware' => ['isGuru']], function () {
    Route::get('/dashboard-guru', [ManagementController::class, 'index'])->name('dashboard-guru');

    //Guru
    Route::get('/kelas-select', [GuruController::class, 'index'])->name('kelas.select');
    Route::get('/absen-select', [GuruController::class, 'select'])->name('absen.select');
    Route::get('/absen/{kelas_id}', [GuruController::class, 'create'])->name('absen.create');
    Route::post('/absen/store', [GuruController::class, 'store'])->name('absen.store');
    
    


});

Route::group( ['middleware' => ['auth']], function(){
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::get('/management-kelas', [KelasController::class, 'index'])->name('management-kelas');
    Route::get('/management-siswa', [SiswaController::class, 'index'])->name('management-siswa');
    Route::get('/data-siswa/{id}', [SiswaController::class, 'show'])->name('data-siswa');
    Route::get('/absen-show/{id}', [GuruController::class, 'show'])->name('absen.show');
});



// Route Excel
Route::get('excel-export', [KelasController::class, 'exportExcel']);
Route::get('excel-export', [AbsenController::class, 'exportExcel']);
