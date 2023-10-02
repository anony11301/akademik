<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

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


Route::group(['middleware' => ['isManagement']], function(){
    Route::get('/dashboard-management', [ManagementController::class, 'index'])->name('dashboard-management');
    Route::get('/management-kelas', [KelasController::class, 'index'])->name('management-kelas');
    Route::get('/management-siswa', [SiswaController::class, 'index'])->name('management-siswa');
    Route::get('/management-tambah-kelas', [KelasController::class, 'create'])->name('management-tambah-kelas');
    Route::post('/simpan-data', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/edit-kelas/{id}', [KelasController::class, 'edit'])->name('edit-kelas');
    Route::post('/update-kelas/{id}', [KelasController::class, 'update'])->name('update-kelas');
    Route::delete('/delete-kelas/{id}', [KelasController::class, 'destroy'])->name('delete-kelas');
});

// Route Excel
Route::get('excel-export',[KelasController::class, 'exportExcel']);
