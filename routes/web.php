<?php

use App\Http\Controllers\api\AuthController as ApiAuthController;
use App\Http\Controllers\api\location\LocationController;
use App\Http\Controllers\web\admin\dashboard\AdminDashboardController;
use App\Http\Controllers\web\admin\manajemen_akun\DataAkunController;
use App\Http\Controllers\web\admin\manajemen_akun\ManajemenAkunController;
use App\Http\Controllers\web\admin\masterData\MasteDataGriyaController;
use App\Http\Controllers\web\admin\masterData\MasterDataUpacaraController;
use App\Http\Controllers\web\admin\masterdata\MasterDataWilayahController;
use App\Http\Controllers\web\AjaxController;
use App\Http\Controllers\web\auth\AuthController;
use App\Http\Controllers\web\auth\ProfileController;
use App\Http\Controllers\web\auth\RegisterController;
use App\Http\Controllers\web\GetImageController;
use App\Http\Controllers\web\krama\dashboard\KramaDashboardController;
use App\Http\Controllers\web\krama\KramaController;
use App\Http\Controllers\web\krama\reservasi\KramaReservasiController;
use App\Http\Controllers\web\krama\upacaraku\KramaUpacarakuController;
use App\Http\Controllers\web\NotifyController;
use App\Http\Controllers\web\pemuput_karya\dashboard\PemuputDashboardController;
use App\Http\Controllers\web\pemuput_karya\manajemen_reservasi\ReservasiMasukController;
use App\Http\Controllers\web\pemuput_karya\manajemen_reservasi\RiwayatReservasiController;
use App\Http\Controllers\web\pemuput_karya\muput_upacara\KonfirmasiMuputController;
use App\Http\Controllers\web\pemuput_karya\muput_upacara\KonfirmasiTangkilController;
use App\Http\Controllers\web\pemuput_karya\PemuputKaryaController;
use App\Http\Controllers\web\sanggar\dashboard\DashboardController;
use App\Http\Controllers\web\sanggar\dashboard\SanggarDashboardController;
use App\Http\Controllers\web\sanggar\manajemen_reservasi\ReservasiMasukController as SanggarReservasiController;
use App\Http\Controllers\web\sanggar\manajemen_reservasi\SanggarRiwayatReservasiController;
use App\Http\Controllers\web\sanggar\muput_upacara\KonfirmasiMuputController as SanggarKonfirmasiMuput;
use App\Http\Controllers\web\sanggar\muput_upacara\SanggarKonfirmasiPenguleman;
use App\Http\Controllers\web\sanggar\SanggarController;
use App\Http\Controllers\WilayahController;
use App\Http\Livewire\Krama\CreateReservasi;
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
    return view('pages.auth.login');
})->middleware(['guest']);

//AUTH SISTEM
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('login/select-account', [AuthController::class, 'selectAccount'])->name('select-account')->middleware('permission:login');
    Route::get('switch/account/{tipe}', [AuthController::class, 'switchAccount'])->name('switch-account')->middleware('permission:login');

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('register')->group(function () {
        Route::get('index', [RegisterController::class, 'regisIndex'])->name('auth.register.index');
        Route::get('{akun}', [RegisterController::class, 'regisFormAkun'])->name('auth.register.form.akun');

        Route::post('sulinggih', [RegisterController::class, 'storeRegisSulinggih'])->name('auth.register.akun.sulinggih.store');
        Route::post('sanggar', [RegisterController::class, 'storeRegisSanggar'])->name('auth.register.akun.sanggar.store');
        Route::post('pemangku', [RegisterController::class, 'storeRegisPemangku'])->name('auth.register.akun.pemangku.store');
        Route::post('krama', [RegisterController::class, 'storeRegisKrama'])->name('auth.register.akun.krama.store');
        Route::post('serati', [RegisterController::class, 'storeRegisSerati'])->name('auth.register.akun.serati.store');

    });

    Route::prefix('lupa-password')->group(function () {
        Route::get('index', [AuthController::class, 'index'])->name('auth.lupa-password.lading');
        Route::post('request/email/token', [ApiAuthController::class, 'lupaPassword'])->name('auth.lupa-password.request.token');
        Route::post('check/email/token', [ApiAuthController::class, 'checkToken'])->name('auth.lupa-password.check.token');
        Route::post('create/new/password', [ApiAuthController::class, 'createNewPassword'])->name('auth.lupa-password.new.password');
    });

    Route::prefix('profile')->group(function () {
        Route::put('akun/update', [ProfileController::class, 'updateAkun'])->name('profile.akun.update');
        Route::put('password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::put('data-diri/update', [ProfileController::class, 'updateDataDiri'])->name('profile.data-diri.update');
    });

});
//AUTH SISTEM


// ROUTE ADMIN
Route::group(['prefix'=>'admin','middleware'=>'permission:admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // MASTER DATA ADMIN
    Route::prefix('master-data')->group(function () {
        // MASTER DATA UPACARA ADMIN
        Route::prefix('upacara')->group(function () {
            Route::get('index', [MasterDataUpacaraController::class, 'indexDataUpacara'])->name('admin.master-data.upacara.index');
            Route::get('create', [MasterDataUpacaraController::class, 'createDataUpacara'])->name('admin.master-data.upacara.create');
            Route::post('store', [MasterDataUpacaraController::class, 'storeDataUpacara'])->name('admin.master-data.upacara.store');
            Route::get('detail/{id}', [MasterDataUpacaraController::class, 'detailDataUpacara'])->name('admin.master-data.upacara.detail');
            Route::get('edit/{id}', [MasterDataUpacaraController::class, 'editDataUpacara'])->name('admin.master-data.upacara.edit');
            Route::put('update', [MasterDataUpacaraController::class, 'updateUpacara'])->name('admin.master-data.upacara.update');
            Route::delete('delete', [MasterDataUpacaraController::class, 'deleteUpacara'])->name('admin.master-data.upacara.delete');

            Route::prefix('tahapan-upacara')->group(function () {
                Route::post('store', [MasterDataUpacaraController::class, 'storeTahapanUpacara'])->name('admin.master-data.upacara.tahapan.store');
                Route::put('update', [MasterDataUpacaraController::class, 'updateTahapanUpacara'])->name('admin.master-data.upacara.tahapan.update');
                Route::delete('delete', [MasterDataUpacaraController::class, 'deleteTahapanUpacara'])->name('admin.master-data.upacara.tahapan.delete');
                Route::get('detail/{id?}', [MasterDataUpacaraController::class, 'detailTahapanUpacara'])->name('admin.master-data.upacara.tahapan.detail');
            });

        });
        // MASTER DATA UPACARA ADMIN

        // MASTER DATA GRIYA
        Route::prefix('griya')->group(function () {
            Route::get('index', [MasteDataGriyaController::class, 'indexDataGriya'])->name('admin.master-data.griya.index');
            Route::get('create', [MasteDataGriyaController::class, 'createDataGriya'])->name('admin.master-data.griya.create');
            Route::post('store', [MasteDataGriyaController::class, 'storeDataGriya'])->name('admin.master-data.griya.store');
            Route::get('detail/{id}', [MasteDataGriyaController::class, 'detailDataGriya'])->name('admin.master-data.griya.detail');
            Route::get('edit/{id}', [MasteDataGriyaController::class, 'editDataGriya'])->name('admin.master-data.griya.edit');
            Route::put('update', [MasteDataGriyaController::class, 'updateDataGriya'])->name('admin.master-data.griya.update');
            Route::delete('delete', [MasteDataGriyaController::class, 'deleteDataGriya'])->name('admin.master-data.griya.delete');
        });
        // MASTER DATA GRIYA

        // MASTER DATA WILAYAH SISTEM
        Route::prefix('wilayah')->group(function () {
            Route::get('desa', [MasterDataWilayahController::class, 'indexDesaDinas'])->name('admin.master-data.desa.index');
            Route::get('banjar', [MasterDataWilayahController::class, 'indexBanjar'])->name('admin.master-data.banjar.index');
            Route::get('kecamatan', [MasterDataWilayahController::class, 'indexKecamatan'])->name('admin.master-data.kecamatan.index');
            Route::get('kabupaten', [MasterDataWilayahController::class, 'indexKabupaten'])->name('admin.master-data.kabupaten.index');
        });
        // MASTER DATA WILAYAH SISTEM

    });
    // MASTER DATA ADMIN

    // MANAJEMEN AKUN
    Route::prefix('manajemen-akun')->group(function () {
        // VERIFIKASI DATA AKUN
        Route::prefix('verifikasi')->group(function () {
            Route::get('index', [ManajemenAkunController::class, 'indexVerifikasi'])->name('admin.manajemen-akun.verifikasi.index');

            Route::put('serati/konfiramsi', [ManajemenAkunController::class, 'konfirmasiSerati'])->name('admin.manajemen-akun.verifikasi.serati');
            Route::put('sanggar/konfiramsi', [ManajemenAkunController::class, 'konfirmasiSanggar'])->name('admin.manajemen-akun.verifikasi.sanggar');
            Route::put('pemuput-karya/konfiramsi', [ManajemenAkunController::class, 'konfirmasiPemuput'])->name('admin.manajemen-akun.verifikasi.pemuput-karya');

            Route::get('serati/detail/{id?}', [ManajemenAkunController::class, 'detailSerati'])->name('admin.manajemen-akun.verifikasi.detail.serati');
            Route::get('sanggar/detail/{id?}', [ManajemenAkunController::class, 'detailSangar'])->name('admin.manajemen-akun.verifikasi.detail.sanggar');
            Route::get('pemuput-karya/detail/{id?}', [ManajemenAkunController::class, 'detailPemuput'])->name('admin.manajemen-akun.verifikasi.detail.pemuput-karya');

        });
        // VERIFIKASI DATA AKUN

        // DATA AKUN USER
        Route::prefix('data-akun')->group(function () {
            Route::get('index', [DataAkunController::class, 'index'])->name('admin.manajemen-akun.data-akun.index');
            Route::get('detail/krama/{id?}', [DataAkunController::class, 'detailKrama'])->name('admin.manajemen-akun.data-akun.krama.detail');
            Route::get('detail/serati/{id?}', [DataAkunController::class, 'detailSerati'])->name('admin.manajemen-akun.data-akun.serati.detail');
            Route::get('detail/sanggar/{id?}', [DataAkunController::class, 'detailSanggar'])->name('admin.manajemen-akun.data-akun.sanggar.detail');
            Route::get('detail/pemuput-karya/{id?}', [DataAkunController::class, 'detailPemuput'])->name('admin.manajemen-akun.data-akun.pemuput-karya.detail');

        });
        // DATA AKUN USER
    });
    // MANAJEMEN AKUN
});
// ROUTE ADMIN

// ROUTE KRAMA
Route::group(['prefix'=>'krama','middleware'=>'permission:krama'], function () {
    Route::get('dashboard', [KramaDashboardController::class, 'index'])->name('krama.dashboard');
    Route::get('send/notif', [KramaController::class, 'sendNotif']);
    Route::get('profile', [KramaController::class, 'profile'])->name('krama.profile');

    Route::prefix('manajemen-upacara')->group(function () {
        Route::get('index', [KramaUpacarakuController::class, 'indexUpacaraku'])->name('krama.manajemen-upacara.upacaraku.index');
        Route::get('create', [KramaUpacarakuController::class, 'createUpacaraku'])->name('krama.manajemen-upacara.upacaraku.create');
        Route::post('store', [KramaUpacarakuController::class, 'storeUpacaraku'])->name('krama.manajemen-upacara.upacaraku.store');
        Route::get('detail/{id}', [KramaUpacarakuController::class, 'detailUpacaraku'])->name('krama.manajemen-upacara.upacaraku.detail');
        Route::get('edit/{id}', [KramaUpacarakuController::class, 'editUpacaraku'])->name('krama.manajemen-upacara.upacaraku.edit');
        Route::put('update', [KramaUpacarakuController::class, 'updateUpacaraku'])->name('krama.manajemen-upacara.upacaraku.update');
        Route::put('delete', [KramaUpacarakuController::class, 'deleteUpacaraku'])->name('krama.manajemen-upacara.upacaraku.delete');
    });

    Route::prefix('manajemen-reservasi')->group(function () {
        Route::get('index', [KramaReservasiController::class, 'indexReservasi'])->name('krama.manajemen-reservasi.index');
        Route::get('create/{id?}', [KramaReservasiController::class, 'createReservasi'])->name('krama.manajemen-reservasi.create');
        Route::get('detail/{id?}', [KramaReservasiController::class, 'detailReservasi'])->name('krama.manajemen-reservasi.detail');
        Route::post('store', [KramaReservasiController::class, 'storeReservasi'])->name('krama.manajemen-reservasi.store');
        Route::put('delete', [KramaReservasiController::class, 'deleteReservasi'])->name('krama.manajemen-reservasi.delete');

        Route::post('ajax/store', [KramaReservasiController::class, 'ajaxStoreReservasi'])->name('krama.manajemen-reservasi.ajax.store');
        Route::put('ajax/update', [KramaReservasiController::class, 'ajaxUpdateReservasi'])->name('krama.manajemen-reservasi.ajax.update');
        Route::put('ajax/delete', [KramaReservasiController::class, 'ajaxDeleteReservasi'])->name('krama.manajemen-reservasi.ajax.delete');
    });

    Route::put('store/rating', [KramaReservasiController::class, 'storeRating'])->name('krama.store.rating');
});
// ROUTE KRAMA

// PEMUPUT KARYA (SULINGGIH & PEMANGKU)
Route::group(['prefix'=>'pemuput-karya','middleware'=>'permission:pemuput'], function ()  {
    Route::get('profile', [PemuputKaryaController::class, 'profile'])->name('pemuput-karya.profile');
    Route::get('dashboard', [PemuputDashboardController::class, 'index'])->name('pemuput-karya.dashboard');
    Route::get('calender', [PemuputDashboardController::class, 'calenderIndex'])->name('pemuput-karya.calender');


    Route::prefix('manajemen-reservasi')->group(function () {
        Route::get('reservasi-masuk/index', [ReservasiMasukController::class, 'index'])->name('pemuput-karya.manajemen-reservasi.index');
        Route::get('reservasi-masuk/detail/{id}', [ReservasiMasukController::class, 'detailReservasi'])->name('pemuput-karya.manajemen-reservasi.detail');
        Route::put('reservasi-masuk/update', [ReservasiMasukController::class, 'update'])->name('pemuput-karya.manajemen-reservasi.verifikasi.update');

        Route::get('riwayat/index', [RiwayatReservasiController::class, 'index'])->name('pemuput-karya.manajemen-reservasi.riwayat.index');
        Route::get('riwayat/detail/{id}', [RiwayatReservasiController::class, 'detail'])->name('pemuput-karya.manajemen-reservasi.riwayat.detail');
    });

    Route::prefix('muput-upacara')->group(function () {
        Route::get('konfimasi-tangkil/index', [KonfirmasiTangkilController::class, 'indexKonfirmasiTangkil'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.index');
        Route::get('konfimasi-tangkil/detail/{id?}', [KonfirmasiTangkilController::class, 'detailKonfirmasiTangkil'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.detail');
        Route::get('konfimasi-tangkil/edit/{id?}', [KonfirmasiTangkilController::class, 'editKonfirmasiTangkil'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.edit');
        Route::put('konfimasi-tangkil/update-data', [KonfirmasiTangkilController::class, 'updateData'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.update-data');
        Route::put('konfimasi-tangkil/konfirmasi', [KonfirmasiTangkilController::class, 'updateKonfirmasi'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.update.terima');
        Route::put('konfimasi-tangkil/batal', [KonfirmasiTangkilController::class, 'updateBatal'])->name('pemuput-karya.muput-upacara.konfirmasi-tangkil.update.batal');

        Route::get('konfimasi-muput/index', [KonfirmasiMuputController::class, 'index'])->name('pemuput-karya.muput-upacara.konfirmasi-muput.index');
        Route::get('konfimasi-muput/detail/{id?}', [KonfirmasiMuputController::class, 'detail'])->name('pemuput-karya.muput-upacara.konfirmasi-muput.detail');
        Route::put('konfimasi-muput/konfirmasi', [KonfirmasiMuputController::class, 'konfirmasiMuput'])->name('pemuput-karya.muput-upacara.konfirmasi-muput.konfirmasi');
        Route::put('konfimasi-muput/batal', [KonfirmasiMuputController::class, 'batalMuput'])->name('pemuput-karya.muput-upacara.konfirmasi-muput.batal');
    });

});
// PEMUPUT KARYA (SULINGGIH & PEMANGKU)

// SANGGAR
Route::group(['prefix'=>'sanggar','middleware'=>'permission:sanggar'], function ()  {
    Route::get('', [SanggarController::class, 'testing']);
    Route::get('dashboard', [SanggarDashboardController::class, 'index'])->name('sanggar.dashboard');
    Route::post('set-session', [SanggarController::class, 'setSession'])->name('sanggar.session')->withoutMiddleware('permission:sanggar');

    Route::prefix('manajemen-sanggar')->group(function () {
        Route::get('index', [SanggarController::class, 'index'])->name('manajemen-sanggar.index');
        Route::put('update-data', [SanggarController::class, 'update'])->name('manajemen-sanggar.update');
        Route::post('add-anggota', [SanggarController::class, 'store'])->name('manajemen-sanggar.store');
        Route::delete('delete-anggota', [SanggarController::class, 'delete'])->name('manajemen-sanggar.delete');
    });

    Route::prefix('manajemen-reservasi')->group(function () {
        Route::get('reservasi-masuk/index', [SanggarReservasiController::class, 'index'])->name('sanggar.manajemen-reservasi.index');
        Route::get('reservasi-masuk/detail/{id}', [SanggarReservasiController::class, 'detailReservasi'])->name('sanggar.manajemen-reservasi.detail');
        Route::put('reservasi-masuk/update', [SanggarReservasiController::class, 'update'])->name('sanggar.manajemen-reservasi.verifikasi.update');

        Route::get('riwayat/index', [SanggarRiwayatReservasiController::class, 'index'])->name('sanggar.manajemen-reservasi.riwayat.index');
        Route::get('riwayat/detail/{id}', [SanggarRiwayatReservasiController::class, 'detail'])->name('sanggar.manajemen-reservasi.riwayat.detail');

    });

    Route::prefix('muput-upacara')->group(function () {
        Route::get('konfirmasi-penguleman/index', [SanggarKonfirmasiPenguleman::class, 'indexKonfirmasiTangkil'])->name('sanggar.muput-upacara.konfirmasi-tangkil.index');
        Route::get('konfirmasi-penguleman/edit/{id?}', [SanggarKonfirmasiPenguleman::class, 'editKonfirmasiTangkil'])->name('sanggar.muput-upacara.konfirmasi-tangkil.edit');
        Route::put('konfirmasi-penguleman/konfirmasi', [SanggarKonfirmasiPenguleman::class, 'updateKonfirmasi'])->name('sanggar.muput-upacara.konfirmasi-tangkil.update.terima');
        Route::put('konfirmasi-penguleman/batal', [SanggarKonfirmasiPenguleman::class, 'updateBatal'])->name('sanggar.muput-upacara.konfirmasi-tangkil.update.batal');

        Route::get('konfimasi-muput/index', [SanggarKonfirmasiMuput::class, 'index'])->name('sanggar.muput-upacara.konfirmasi-muput.index');
        Route::get('konfimasi-muput/detail/{id?}', [SanggarKonfirmasiMuput::class, 'detail'])->name('sanggar.muput-upacara.konfirmasi-muput.detail');
        Route::put('konfimasi-muput/konfirmasi', [SanggarKonfirmasiMuput::class, 'konfirmasiMuput'])->name('sanggar.muput-upacara.konfirmasi-muput.konfirmasi');
        Route::put('konfimasi-muput/batal', [KonfirmasiMuputController::class, 'batalMuput'])->name('sanggar.muput-upacara.konfirmasi-muput.batal');

    });
});
// SANGGAR


Route::prefix('get-image')->group(function () {
    Route::prefix('upacara')->group(function () {
        Route::get('{id?}', [GetImageController::class, 'upacara'])->name('image.upacara');
        Route::get('tahapan-upacara/{id?}', [GetImageController::class, 'tahapanUpacara'])->name('image.tahapan-upacara');
    });

    Route::prefix('reservasi')->group(function () {
        Route::get('bukti-muput/{id?}', [GetImageController::class, 'buktiMuput'])->name('image.bukti-upacara');
    });

    Route::prefix('user')->group(function () {
        Route::get('profile/{id?}', [GetImageController::class, 'profile'])->name('image.profile.user');
        Route::get('profile/sanggar/{id?}', [GetImageController::class, 'profileSanggar'])->name('image.profile.sanggar');
        Route::get('sk-pemuput/{id?}', [GetImageController::class, 'skPemuput'])->name('image.sk-pemuput');
        Route::get('sk-tanda-usaha/{id?}', [GetImageController::class, 'skSanggar'])->name('image.sk-sanggar');
    });
});

// SERVICE AJAX SISTEM
Route::prefix('ajax')->group(function () {
    Route::get('desa/{id}', [LocationController::class, 'getDesaDinas']);
    Route::get('kabupaten/{id?}', [LocationController::class, 'getKabupaten']);
    Route::get('kecamatan/{id}', [LocationController::class, 'getKecamatan']);
    Route::get('banjar-dinas/{id?}', [LocationController::class, 'getBanjarDinas'])->name('ajax.get-banjar-dinas');

    Route::prefix('upacara')->group(function () {
        Route::get('jenis-yadnya/{jenis?}', [AjaxController::class, 'jenisYadnya'])->name('ajax.get.jenis-yadnya');
        Route::get('tahapan/upacara/{id?}', [AjaxController::class, 'getTahapanUpacara'])->name('ajax.get.tahapan-upacara');
    });

    Route::prefix('reservasi')->group(function () {
        Route::get('keterangan/{id?}', [AjaxController::class, 'getKeteranganPergantian'])->name('ajax.get.keterangan-reservasi');
        Route::get('tahapan-reservasi/{id?}', [AjaxController::class, 'getDataTahapanReservasi'])->name('ajax.get.tahapan-reservasi');
        Route::post('pemuput/jadwal', [AjaxController::class, 'jadwalReservasiPemuput'])->name('ajax.jadwal-reservasi-pemuput');
        Route::get('krama/jadwal/{id?}', [AjaxController::class, 'jadwalReservasiKrama'])->name('ajax.jadwal-reservasi-krama');
    });

    Route::get('data-tangkil/{id?}', [AjaxController::class, 'getDataTangkilPemuputKarya'])->name('ajax.get.data-tangkil');

    Route::prefix('user')->group(function () {
        Route::get('penduduk/{nik?}', [AjaxController::class, 'getDataPenduduk'])->name('ajax.get.data-penduduk');
        Route::post('set-favorit', [AjaxController::class, 'setFavorit'])->name('ajax.set-favorit');

    });

});
// END SERVICE AJAX SISTEM


 // NOTIFICATION
 Route::patch('saveToken', [NotifyController::class, 'saveToken'])->name('notification.save-token');
 Route::post('send-notification', [NotifyController::class, 'sendNotify'])->name('send-notificaiton');
 // END NOTIFICATION


