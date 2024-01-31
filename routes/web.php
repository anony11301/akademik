<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DataPelanggaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PelanggaranController;

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
Route::get('absensi', [GuestController::class, 'index'])->name('absensi');
Route::get('absensi/{id}', [GuestController::class, 'show'])->name('absensi-detail');

Route::get('/create-siswa', [SiswaController::class, 'create']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::get('/management-kelas', [KelasController::class, 'index'])->name('management-kelas');
    Route::get('/management-siswa', [SiswaController::class, 'index'])->name('management-siswa');
    Route::get('/data-siswa/{id}', [SiswaController::class, 'show'])->name('data-siswa');
    Route::get('/absen-show/{id}', [GuruController::class, 'show'])->name('absen.show');
});


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
    Route::get('/management-tambah-siswa/{id}', [SiswaController::class, 'create'])->name('management-tambah-siswa');
    // Route::get('/data-siswa/{id}', [SiswaController::class, 'show'])->name('data-siswa');
    Route::post('/simpan-data-siswa/{id}', [SiswaController::class, 'store'])->name('siswa.store');
    Route::delete('/delete-siswa/{NISN}', [SiswaController::class, 'destroy'])->name('delete-siswa');
    Route::get('/edit-siswa/{NISN}', [SiswaController::class, 'edit'])->name('edit-siswa');
    Route::put('/update-siswa/{NISN}', [SiswaController::class, 'update'])->name('update-siswa');

    //Pelanggaran
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran');
    Route::get('/pelanggaran-show/{id}', [DataPelanggaranController::class, 'detail'])->name('pelanggaran-show');
    Route::get('/tambah-pelanggaran', [PelanggaranController::class, 'create'])->name('add-pelanggaran');
    Route::post('/save-pelanggaran', [PelanggaranController::class, 'store'])->name('save-pelanggaran');
    Route::get('/edit-pelanggaran/{id}', [PelanggaranController::class, 'edit'])->name('edit-pelanggaran');
    Route::post('/update-pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('update-pelanggaran');
    Route::delete('delete-pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('delete-pelanggaran');

    //Data Pelanggaran
    Route::get('/data-pelanggaran', [DataPelanggaranController::class, 'index'])->name('data-pelanggaran');
    Route::get('/data-pelanggaran/{kelas_id}', [DataPelanggaranController::class, 'show'])->name('data-pelanggaran-kelas');
    Route::post('/save-data-pelanggaran/{id}', [DataPelanggaranController::class, 'store'])->name('save-data-pelanggaran');
    Route::get('/rekap-pelanggaran', [DataPelanggaranController::class, 'detail'])->name('rekap-pelanggaran');
});

Route::group(['middleware' => ['isGuru']], function () {
    Route::get('/dashboard-guru', [ManagementController::class, 'index'])->name('dashboard-guru');

    //Guru
    Route::get('/kelas-select', [GuruController::class, 'index'])->name('kelas.select');
    Route::get('/absen-select', [GuruController::class, 'select'])->name('absen.select');
    Route::get('/absen/{kelas_id}', [GuruController::class, 'create'])->name('absen.create');
    Route::post('/absen/store', [GuruController::class, 'store'])->name('absen.store');
});





// Route Excel
Route::get('excel-export', [KelasController::class, 'exportExcel']);
Route::get('/excel-export-siswa/{id}', [SiswaController::class, 'exportSiswaByKelas'])->name('excel-export-siswa');
Route::get('excel-export-pelanggaran', [DataPelanggaranController::class, 'export']);
route::get('excel-export-jenis', [PelanggaranController::class, 'export']);
Route::get('/excel-export-absen/{id}', [GuruController::class, 'export'])->name('excel-export-absen');


//Route Import Excel
Route::post('/pages/management/siswa/import_excel/{id}', [SiswaController::class, 'import_excel'])->name('import-siswa');

Route::get('/download-template-excel', function () {
    $file = public_path('templates/template_siswa.xlsx'); // Sesuaikan dengan lokasi file Excel kosong
    $headers = ['Content-Type: application/vnd.ms-excel'];
    $fileName = 'template_siswa.xlsx'; // Ganti dengan nama file Excel kosong Anda
    return response()->download($file, $fileName, $headers);
})->name('download-template-excel');
