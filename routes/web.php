<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;

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
<<<<<<< HEAD
Route::get('/dashboard-managemen', [ManagementController::class, 'index'])->name('dashboard-managemen');
=======
>>>>>>> b8ea9ba206b481136c033de05fae94b02d9fafc7
