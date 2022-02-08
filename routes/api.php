<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\krama\KramaDashboardController;
use App\Http\Controllers\api\krama\KramaPemuputKaryaController;
use App\Http\Controllers\api\krama\KramaProfileController;
use App\Http\Controllers\api\krama\KramaReservasiController;
use App\Http\Controllers\api\krama\KramaUpacaraController;
use App\Http\Controllers\api\location\LocationController;
use App\Http\Controllers\api\sulinggih\SulinggihDashboardController;
use App\Http\Controllers\api\sulinggih\SulinggihReservasiController;
use App\Http\Controllers\api\yadnya\YadnyaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// AUTH
    Route::post('login',[AuthController::class,'loginUser']);

    Route::get('unathorized',[AuthController::class,'unauthorized'])->name('api.unathorized');

    // LUPA PASSWORD
        Route::post('request/email/token',[AuthController::class,'lupaPassword']);
        Route::post('check/email/token',[AuthController::class,'checkToken']);
        Route::post('create/new/password',[AuthController::class,'createNewPassword']);
    // END
// END

// SACTUM MIDDLEWARE
Route::middleware('auth:sanctum')->group(function(){

    // SERVICE
        Route::prefix('service')->group(function(){

            // LOCATION
                Route::prefix('location')->group(function(){
                    Route::get('provinsi',[LocationController::class,'getProvinsi']);
                    Route::get('kabupaten/{id_provinsi}',[LocationController::class,'getKabupaten']);
                    Route::get('kecamatan/{id_kabupaten}',[LocationController::class,'getKecamatan']);
                    Route::get('desadinas/{id_kecamatan}',[LocationController::class,'getDesaDinas']);
                    Route::get('banjardinas/{id_desa_dinas}',[LocationController::class,'getBanjarDinas']);
                    Route::get('desaadat',[LocationController::class,'getDesaAdat']);

                    Route::get('kecamatanbyprovinsi/{id_provinsi}',[LocationController::class,'getKecamatanByProvinsiId']);
                });
            // END

            // JENIS UPACARA
                Route::prefix('upacara')->group(function(){
                    Route::get('jenis/{jenis_yadnya}',[YadnyaController::class,'getUpacara']);
                });
            /// END

            // PEMUPUT  KARYA
                Route::prefix('pemuput')->group(function(){
                    Route::post('show',[KramaPemuputKaryaController::class,'index']);
                });
            // END

        });
    // END

    // KRAMA
        Route::prefix('krama')->middleware(['ability:role:krama_bali'])->group(function(){
            // KRAMA HOME FRAGMENT
                Route::get('home',[KramaDashboardController::class,'index']);
            // END

            // KRAMA PROFILE FRAGMENT
                Route::get('profile',[KramaProfileController::class,'index']);
            // END

            // KRAMA UPCARA
                Route::prefix('upacara')->group(function(){
                    Route::post('show',[KramaUpacaraController::class,'index']);
                    Route::post('create',[KramaUpacaraController::class,'store']);
                    Route::get('detail/{id_upacara?}',[KramaUpacaraController::class,'show']);
                });
            // END

            // KRAMA RESERVASI
                Route::prefix('reservasi')->group(function(){
                    Route::post('store',[KramaReservasiController::class,'store']);
                });
            // END
        });
    // END

    // SULINGGIH
        Route::prefix('sulinggih')->middleware(['ability:role:sulinggih'])->group(function(){
            // SULINGGIH HOME FRAGMENT
                Route::get('home',[SulinggihDashboardController::class,'index']);
            // END

            // SULINGGIH RESERVASI FRAGMENT
                Route::post('reservasi',[SulinggihReservasiController::class,'index']);
                Route::get('reservasi/detail/{id_reservasi}',[SulinggihReservasiController::class,'show']);
            // END
        });
    // END

    // LOGOUT
        Route::post('logout',[AuthController::class,'logoutUser']);
    // END
});
