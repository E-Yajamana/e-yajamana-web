<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KramaController;
use App\Http\Controllers\SulinggihController;
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
    return view('pages/auth/register/krama-bali');
});


Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('register', [AuthController::class, 'registerHome'])->name('auth.register.home');
    Route::get('register/krama', [AuthController::class, 'registerKrama'])->name('auth.register.krama');

});




Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('master-data/kabupaten', [AdminController::class, 'kabupatenShow'])->name('admin.master-data.kabupaten.show');
    Route::get('master-data/kecamatan', [AdminController::class, 'kecamatanShow'])->name('admin.master-data.kecamatan.show');
    Route::get('master-data/desa', [AdminController::class, 'desaShow'])->name('admin.master-data.desa.show');
    Route::get('master-data/upacara', [AdminController::class, 'upacaraShow'])->name('admin.master-data.upacara.show');
    Route::get('master-data/upacara/detail/id', [AdminController::class, 'upacaraDetail'])->name('admin.master-data.upacara.detail');

    Route::get('pengaturan-akun/verifikasi', [AdminController::class, 'verifikasiShow'])->name('admin.verify.show');
    Route::get('pengaturan-akun/verifikasi/detail/id', [AdminController::class, 'verifikasiDetail'])->name('admin.verify.detail');
    Route::get('data-akun', [AdminController::class, 'dataAkunShow'])->name('admin.data-akun.show');
    Route::get('data-akun/detail/id', [AdminController::class, 'dataAkunDetail'])->name('admin.data-akun.detail');

    // Route::get('data-akun/detail/id', [AdminController::class, 'dataAkunDetail'])->name('admin.data-akun.detail');

});


Route::prefix('krama')->group(function () {
    Route::get('', [KramaController::class, 'index'])->name('krama.dashboard');
    Route::get('data-upacara', [KramaController::class, 'dataUpacaraShow'])->name('krama.data-upacara');
    Route::get('data-upacara2', [KramaController::class, 'dataUpacaraShow2'])->name('krama.data-upacara2');
    Route::get('data-upacara/detail', [KramaController::class, 'dataUpacaraDetail'])->name('krama.data-upacara.detail');
    Route::get('data-upacara/create', [KramaController::class, 'dataUpacaraCreate'])->name('krama.data-upacara.create');
    Route::get('reservasi', [KramaController::class, 'reservasi'])->name('krama.reservasi.create');


});



Route::prefix('sulinggih')->group(function () {
    Route::get('', [SulinggihController::class, 'index'])->name('sulinggih.dashboard');
    Route::get('reservasi', [SulinggihController::class, 'dataReservasi'])->name('sulinggih.reservasi');

});



