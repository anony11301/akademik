<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\KelasController;

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


Route::group(['middleware' => ['isManagement']], function(){
    Route::get('/dashboard-management', [ManagementController::class, 'index'])->name('dashboard-management');
    Route::get('/dashboard-management-kelas', [KelasController::class, 'index'])->name('dashboard-management-kelas');
    Route::get('/dashboard-management-tambah-kelas', [KelasController::class, 'create'])->name('dashboard-management-tambah-kelas');
    Route::post('/simpan-data', [KelasController::class, 'store'])->name('kelas.store');
    Route::delete('/delete-kelas/{id}', [KelasController::class, 'destroy'])->name('delete-kelas');
});
