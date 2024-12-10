<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Api\DeliveryApiController;
use App\Http\Controllers\Api\DeliveryUpdateApiController;
use App\Http\Controllers\Api\DispatcherApiController;
use App\Http\Controllers\Api\DriverApiController;

Route::prefix('v1')->group(function () {
    Route::get('deliveries', [DeliveryApiController::class, 'index']);
    Route::get('deliveries/{delivery}', [DeliveryApiController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('deliveries', [DeliveryApiController::class, 'store']);
        Route::put('deliveries/{delivery}', [DeliveryApiController::class, 'update']);
        Route::delete('deliveries/{delivery}', [DeliveryApiController::class, 'destroy']);
    });

    Route::apiResource('delivery-updates', DeliveryUpdateApiController::class);
    Route::apiResource('dispatchers', DispatcherApiController::class);
    Route::apiResource('drivers', DriverApiController::class);
});
