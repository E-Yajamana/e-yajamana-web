<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KramaController;
use App\Http\Controllers\SulinggihController;
use App\Http\Controllers\web\admin\dashboard\AdminDashboardController;
use App\Http\Controllers\web\admin\masterData\MasterDataUpacaraController;
use App\Http\Controllers\web\auth\AuthController;
use App\Http\Controllers\WilayahController;
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

Route::get('test',function(){
    return view('layouts.email.lupa-password');
});

Route::get('/', function () {
    return view('pages/auth/register/krama-bali');
});


Route::prefix('auth')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');



    Route::get('register', [AuthController::class, 'registerLanding'])->name('auth.register.home');

    Route::get('register', [AuthController::class, 'registerLanding'])->name('auth.register.home');
    Route::get('register/krama', [AuthController::class, 'registerKrama'])->name('auth.register.krama');

    Route::get('lupa-password', [AuthController::class, 'lupaPasswordLanding'])->name('auth.lupa-password.lading');
    Route::get('lupa-password/verify-otp', [AuthController::class, 'verifyOTP'])->name('auth.lupa-password.verify-otp');
    Route::get('lupa-password/reset-password', [AuthController::class, 'resetPassword'])->name('auth.lupa-password.reset-password');

});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::prefix('master-data')->group(function () {
        Route::get('upacara', [MasterDataUpacaraController::class, 'indexDataUpacara'])->name('admin.master-data.upacara.index');
        Route::get('upacara/create', [MasterDataUpacaraController::class, 'createDataUpacara'])->name('admin.master-data.upacara.create');
        Route::post('upacara/store', [MasterDataUpacaraController::class, 'storeDataUpacara'])->name('admin.master-data.upacara.store');

    });
});




Route::prefix('admin')->group(function () {
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('master-data/kabupaten', [AdminController::class, 'kabupatenShow'])->name('admin.master-data.kabupaten.show');
    Route::get('master-data/kecamatan', [AdminController::class, 'kecamatanShow'])->name('admin.master-data.kecamatan.show');
    Route::get('master-data/desa', [AdminController::class, 'desaShow'])->name('admin.master-data.desa.show');
    // Route::get('master-data/upacara', [AdminController::class, 'upacaraShow'])->name('admin.master-data.upacara.show');
    Route::get('master-data/upacara/detail/id', [AdminController::class, 'upacaraDetail'])->name('admin.master-data.upacara.detail');

    Route::get('pengaturan-akun/verifikasi', [AdminController::class, 'verifikasiShow'])->name('admin.verify.show');
    Route::get('pengaturan-akun/verifikasi/detail/id', [AdminController::class, 'verifikasiDetail'])->name('admin.verify.detail');
    Route::get('data-akun', [AdminController::class, 'dataAkunShow'])->name('admin.data-akun.show');
    Route::get('data-akun/detail/id', [AdminController::class, 'dataAkunDetail'])->name('admin.data-akun.detail');

});


Route::prefix('krama')->group(function () {
    Route::get('', [KramaController::class, 'index'])->name('krama.dashboard');
    Route::get('data-upacara', [KramaController::class, 'dataUpacaraShow'])->name('krama.data-upacara');
    Route::get('data-upacara2', [KramaController::class, 'dataUpacaraShow2'])->name('krama.data-upacara2');
    Route::get('data-upacara/detail', [KramaController::class, 'dataUpacaraDetail'])->name('krama.data-upacara.detail');
    Route::get('data-upacara/create', [KramaController::class, 'dataUpacaraCreate'])->name('krama.data-upacara.create');

    Route::get('reservasi', [KramaController::class, 'showReservasi'])->name('krama.reservasi.show');
    Route::get('reservasi/create', [KramaController::class, 'createReservasi'])->name('krama.reservasi.create');

});


Route::prefix('sulinggih')->group(function () {
    Route::get('', [SulinggihController::class, 'index'])->name('sulinggih.dashboard');
    Route::prefix('manajemen-reservasi')->group(function () {
        Route::get('index', [SulinggihController::class, 'dataReservasi'])->name('sulinggih.manajemen-reservasi.index');
        Route::get('detail', [SulinggihController::class, 'detailReservasi'])->name('sulinggih.manajemen-reservasi.detail');
        Route::get('riwayat', [SulinggihController::class, 'riwayatReservasi'])->name('sulinggih.manajemen-reservasi.riwayat');
    });

    Route::prefix('manajemen-muput-upacara')->group(function () {
        Route::get('index', [SulinggihController::class, 'indexMuputUpacara'])->name('sulinggih.muput-upacara.index');
        Route::get('konfimasi-tangkil', [SulinggihController::class, 'konfrimasiTanggalTangkil'])->name('sulinggih.muput-upacara.konfirmasi.tangkil');
        Route::get('konfimasi-muput', [SulinggihController::class, 'konfrimasiMuput'])->name('sulinggih.muput-upacara.konfirmasi.upacara');

    });


});


Route::prefix('wilayah')->group(function () {
    Route::get('provinsi', [WilayahController::class, 'provinsi'])->name('wilayah.provinsi');
    Route::get('kabupaten', [WilayahController::class, 'kabupaten'])->name('wilayah.kabupaten');
    Route::get('kecamatan', [WilayahController::class, 'kecamatan'])->name('wilayah.kecamatan');
    Route::get('desa', [WilayahController::class, 'desa'])->name('wilayah.desa');
    Route::get('test', [WilayahController::class, 'test'])->name('wilayah.test');
});


