<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxWilayahDropdown;
use App\Http\Controllers\api\location\LocationController;
use App\Http\Controllers\KramaController;
use App\Http\Controllers\SulinggihController;
use App\Http\Controllers\web\admin\dashboard\AdminDashboardController;
use App\Http\Controllers\web\admin\manajemen_akun\ManajemenAkunController;
use App\Http\Controllers\web\admin\masterData\MasterDataUpacaraController;
use App\Http\Controllers\web\admin\masterdata\MasterDataWilayahController;
use App\Http\Controllers\web\auth\AuthController;
use App\Http\Controllers\web\auth\RegisterController;
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

Route::get('/', function () {
    return view('pages/auth/register/krama-bali');
});


Route::prefix('auth')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('register')->group(function () {
        Route::get('index', [RegisterController::class, 'regisIndex'])->name('auth.register.index');
        Route::get('{akun?}', [RegisterController::class, 'regisFormAkun'])->name('auth.register.form.akun');

        Route::post('krama', [RegisterController::class, 'regisKrama'])->name('auth.register.akun.krama');

    });





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

        Route::get('desa', [MasterDataWilayahController::class, 'indexDesaDinas'])->name('admin.master-data.desa.index');
        Route::get('desa-adat', [MasterDataWilayahController::class, 'indexDesaAdat'])->name('admin.master-data.desa-adat.index');
        Route::get('kecamatan', [MasterDataWilayahController::class, 'indexKecamatan'])->name('admin.master-data.kecamatan.index');
        Route::get('kabupaten', [MasterDataWilayahController::class, 'indexKabupaten'])->name('admin.master-data.kabupaten.index');

    });

    Route::prefix('manajemen-akun')->group(function () {
        Route::get('pengaturan-akun/verifikasi', [ManajemenAkunController::class, 'indexVerifikasi'])->name('admin.manajemen-akun.verifikasi.index');
        Route::get('pengaturan-akun/verifikasi/detail/{id?}', [ManajemenAkunController::class, 'detailVerifikasi'])->name('admin.manajemen-akun.verifikasi.detail');

        Route::get('data-akun', [ManajemenAkunController::class, 'dataAkunIndex'])->name('admin.manajemen-akun.data-akun.index');
        Route::get('data-akun/detail/{id?}', [ManajemenAkunController::class, 'indexVerifikasi'])->name('admin.manajemen-akun.data-akun.detail');

    });

});




Route::prefix('admin')->group(function () {
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('master-data/upacara/detail/id', [AdminController::class, 'upacaraDetail'])->name('admin.master-data.upacara.detail');

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

Route::prefix('ajax')->group(function () {
    Route::get('kabupaten/{id?}', [LocationController::class, 'getKabupaten']);
    Route::get('kecamatan/{id}', [LocationController::class, 'getKecamatan']);
    Route::get('desa/{id}', [LocationController::class, 'getDesaDinas']);
});


Route::prefix('wilayah')->group(function () {
    Route::get('provinsi', [WilayahController::class, 'provinsi'])->name('wilayah.provinsi');
    Route::get('kabupaten', [WilayahController::class, 'kabupaten'])->name('wilayah.kabupaten');
    Route::get('kecamatan', [WilayahController::class, 'kecamatan'])->name('wilayah.kecamatan');
    Route::get('desa', [WilayahController::class, 'desa'])->name('wilayah.desa');
    Route::get('test', [WilayahController::class, 'test'])->name('wilayah.test');
});


