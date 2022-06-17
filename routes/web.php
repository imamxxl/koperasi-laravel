<?php

use App\Http\Controllers\Agen\AnggotaController;
use App\Http\Controllers\Anggota\PinjamanController;
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

Route::get('/', function () {
    return view('layout/template');
});

// route::view('/dashboard', 'admin.dashboard.index');
// route::view('/laporan', 'agen.laporan.index');
// route::view('/angsuran', 'anggota.angsuran.index');


// anggota
// Route::get('/pinjaman_anggota', [PinjamanController::class, 'index'])->name('pinjaman-anggota');

Route::resource('pinjaman_anggota', PinjamanController::class);
Route::resource('anggota', AnggotaController::class);
// route::view('/pinjaman_anggota', 'anggota.pinjaman.index');
// route::view('/angsuran_anggota', 'anggota.angsuran.index');