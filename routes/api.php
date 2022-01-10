<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\krama\KramaDashboardController;
use App\Http\Controllers\api\krama\KramaProfileController;
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
    
    // KRAMA
        Route::prefix('krama')->group(function(){
            // KRAMA HOME FRAGMENT
                Route::get('home',[KramaDashboardController::class,'index']);
            // END

            // KRAMA PROFILE FRAGMENT
                Route::get('profile',[KramaProfileController::class,'index']);
            // END
        });
    // END
});
