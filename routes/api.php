<?php

use App\Http\Controllers\api\admin\AdminDashboardController;
use App\Http\Controllers\Api\admin\AdminDataAkunUserController;
use App\Http\Controllers\api\admin\GriyaRumahController;
use App\Http\Controllers\api\admin\PengaturanAkunController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\krama\KramaDashboardController;
use App\Http\Controllers\api\krama\KramaPemuputKaryaController;
use App\Http\Controllers\api\krama\KramaProfileController;
use App\Http\Controllers\api\krama\KramaReservasiController;
use App\Http\Controllers\api\krama\KramaUpacaraController;
use App\Http\Controllers\api\location\LocationController;
use App\Http\Controllers\api\NotificationController;
use App\Http\Controllers\api\RegisController;
use App\Http\Controllers\api\sulinggih\SulinggihDashboardController;
use App\Http\Controllers\api\sulinggih\SulinggihMuputController;
use App\Http\Controllers\api\sulinggih\SulinggihReservasiController;
use App\Http\Controllers\api\sulinggih\SulinggihTangkilController;
use App\Http\Controllers\api\yadnya\YadnyaController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::post('login', [AuthController::class, 'loginUser']);

Route::get('unathorized', [AuthController::class, 'unauthorized'])->name('api.unathorized');

// LUPA PASSWORD
Route::post('request/email/token', [AuthController::class, 'lupaPassword']);
Route::post('check/email/token', [AuthController::class, 'checkToken']);
Route::post('create/new/password', [AuthController::class, 'createNewPassword']);
// END

// REGISTER
Route::prefix('register')->group(function () {
    Route::post('check/nik', [RegisController::class, 'checkNik']);
    Route::post('post/krama', [RegisController::class, 'postRegisterKrama']);
    Route::post('post/sulinggih', [RegisController::class, 'postRegisterSulinggih']);

    Route::get('get/sulinggih', [RegisController::class, 'getAllSulinggih']);
    Route::get('get/griya', [RegisController::class, 'getAllGriya']);

    // LOCATION
    Route::prefix('location')->group(function () {
        Route::get('provinsi', [LocationController::class, 'getProvinsi']);
        Route::get('kabupaten/{id_provinsi}', [LocationController::class, 'getKabupaten']);
        Route::get('kecamatan/{id_kabupaten}', [LocationController::class, 'getKecamatan']);
        Route::get('desadinas/{id_kecamatan}', [LocationController::class, 'getDesaDinas']);
        Route::get('banjardinas/{id_desa_dinas}', [LocationController::class, 'getBanjarDinas']);
        Route::get('desaadat', [LocationController::class, 'getDesaAdat']);

        Route::get('kecamatanbyprovinsi/{id_provinsi}', [LocationController::class, 'getKecamatanByProvinsiId']);
    });
    // END
});
// END

// END

// SACTUM MIDDLEWARE
Route::middleware('auth:sanctum')->group(function () {

    // SERVICE
    Route::prefix('service')->group(function () {

        // LOCATION
        Route::prefix('location')->group(function () {
            Route::get('provinsi', [LocationController::class, 'getProvinsi']);
            Route::get('kabupaten/{id_provinsi}', [LocationController::class, 'getKabupaten']);
            Route::get('kecamatan/{id_kabupaten}', [LocationController::class, 'getKecamatan']);
            Route::get('desadinas/{id_kecamatan}', [LocationController::class, 'getDesaDinas']);
            Route::get('banjardinas/{id_desa_dinas}', [LocationController::class, 'getBanjarDinas']);
            Route::get('desaadat', [LocationController::class, 'getDesaAdat']);

            Route::get('kecamatanbyprovinsi/{id_provinsi}', [LocationController::class, 'getKecamatanByProvinsiId']);
        });
        // END

        // JENIS UPACARA
        Route::prefix('upacara')->group(function () {
            Route::get('jenis/{jenis_yadnya}', [YadnyaController::class, 'getUpacara']);
        });
        /// END

        // PEMUPUT  KARYA
        Route::prefix('pemuput')->group(function () {
            Route::post('show', [KramaPemuputKaryaController::class, 'index']);
        });
        // END
    });
    // END

    // KRAMA
    Route::prefix('krama')->middleware(['ability:role:krama'])->group(function () {
        // KRAMA HOME FRAGMENT
        Route::get('home', [KramaDashboardController::class, 'index']);
        // END

        // KRAMA FAVORIT
        Route::post('favorit', [KramaPemuputKaryaController::class, 'setFavorite']);
        // END

        // KRAMA PROFILE FRAGMENT
        Route::get('profile', [KramaProfileController::class, 'index']);
        Route::get('detail/profile', [KramaProfileController::class, 'detail']);
        // END

        // KRAMA UPCARA
        Route::prefix('upacara')->group(function () {
            Route::post('show', [KramaUpacaraController::class, 'index']);
            Route::post('create', [KramaUpacaraController::class, 'store']);
            Route::get('detail/{id_upacara?}', [KramaUpacaraController::class, 'show']);
            Route::post('delete/{id_upacara?}', [KramaUpacaraController::class, 'destroy']);
        });
        // END

        // KRAMA RESERVASI
        Route::prefix('reservasi')->group(function () {
            Route::post('store', [KramaReservasiController::class, 'store']);
            Route::post('batal', [KramaReservasiController::class, 'destroy']);
            Route::post('update', [KramaReservasiController::class, 'update']);
            Route::get('show/{id_reservasi?}', [KramaReservasiController::class, 'show']);
        });
        // END

    });
    // END

    // SULINGGIH
    Route::prefix('sulinggih')->middleware(['ability:role:pemuput_karya'])->group(function () {
        // SULINGGIH HOME FRAGMENT
        Route::get('home', [SulinggihDashboardController::class, 'index']);
        // END

        // SULINGGIH RESERVASI FRAGMENT
        Route::post('reservasi', [SulinggihReservasiController::class, 'index']);
        Route::post('reservasi/update', [SulinggihReservasiController::class, 'update']);
        Route::post('reservasi/tolak', [SulinggihReservasiController::class, 'tolakReservasi']);
        Route::get('reservasi/detail/{id_reservasi}', [SulinggihReservasiController::class, 'show']);
        // END

        // SULINGGIH KONFIRMASI TANGKIL
        Route::get('tangkil/detail/{id_reservasi}', [SulinggihTangkilController::class, 'getDetailTangkil']);
        Route::post('tangkil/konfirmasi', [SulinggihTangkilController::class, 'konfirmasiTangkil']);
        // END

        // SULINGGIH KONFIRMASI MUPUT
        Route::get('muput/detail/{id_reservasi}', [SulinggihMuputController::class, 'getDetailMuput']);
        Route::post('puput', [SulinggihMuputController::class, 'puputKarya']);
        // END
    });
    // END

    // SULINGGIH
    Route::prefix('admin')->middleware(['ability:role:admin'])->group(function () {
        // HOME FRAGMENT
        Route::get('dashboard', [AdminDashboardController::class, 'index']);
        // END

        // DATA AKUN USER
        Route::get('dataakunuser/{status?}', [AdminDataAkunUserController::class, 'index']);
        // END

        // MASTER DATA
        Route::prefix('masterdata')->group(function () {
            Route::get('griyarumah/{nama?}/{idBanjarDinas?}', [GriyaRumahController::class, 'index']);
        });
        // END

        // PENGATURAN AKUN
        Route::prefix('pengaturanakun')->group(function () {
            Route::get('akun/{nama?}/{status?}', [PengaturanAkunController::class, 'index']);
        });
        // END
    });
    // END

    // NOTIFICATION
    Route::get('notification/{status}', [NotificationController::class, 'getNotificationByIdUserandStatus']);
    Route::post('read/notification', [NotificationController::class, 'readNotification']);
    Route::post('unread/notification', [NotificationController::class, 'unreadNotification']);
    Route::post('delete/notification', [NotificationController::class, 'deleteNotification']);
    Route::post('send/notification', [NotificationController::class, 'sendNotification']);
    // END

    // LOGOUT
    Route::post('logout', [AuthController::class, 'logoutUser']);
    // END

    // ASK NEW ROLE
    Route::post('asknewrole', [AuthController::class, 'askForTokenRole']);
    // END

});
