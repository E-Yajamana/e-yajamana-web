<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\krama\KramaDashboardController;
use App\Http\Controllers\api\krama\KramaProfileController;
use App\Http\Controllers\api\krama\KramaUpacaraController;
use App\Http\Controllers\api\location\LocationController;
use App\Http\Controllers\api\yadnya\YadnyaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// AUTH
    Route::post('login',[AuthController::class,'loginUser']);

    Route::get('unathorized',[AuthController::class,'unauthorized'])->name('api.unathorized');
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
                    Route::get('desaadat',[LocationController::class,'getDesaAdat']);
                });
            // END

            // JENIS UPACARA
                Route::prefix('upacara')->group(function(){
                    Route::get('jenis/{jenis_yadnya}',[YadnyaController::class,'getUpacara']);
                });
            /// END

        });
    // END
    
    // KRAMA
        Route::prefix('krama')->group(function(){
            // KRAMA HOME FRAGMENT
                Route::get('home',[KramaDashboardController::class,'index']);
            // END

            // KRAMA PROFILE FRAGMENT
                Route::get('profile',[KramaProfileController::class,'index']);
            // END
            
            // KRAMA UPCARA
                Route::prefix('upacara')->group(function(){
                    Route::post('create',[KramaUpacaraController::class,'store']);
                });
            // END
        });
    // END

    // LOGOUT
        Route::post('logout',[AuthController::class,'logoutUser']);
    // END
});
