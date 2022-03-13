<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\PromoCodeController;
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

Route::prefix('v1')->group(function() {
    Route::post('generate-token', [AuthController::class, 'generateToken']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('promocode', PromoCodeController::class);
        Route::get('/validate-promo/{promocode}/{origin?}/{destination?}', [PromoCodeController::class, 'validatePromoCode']);
        Route::post('/set-location-variance/{promocode}', [PromoCodeController::class, 'setLocationVariance']);
        Route::post('/set-status/{promocode}', [PromoCodeController::class, 'setStatusPromoCode']);
    });
});



