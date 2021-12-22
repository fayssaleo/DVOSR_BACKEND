<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Vessel\Http\Controllers\VesselController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/vessels'
], function ($router) {
    Route::get('/', [VesselController::class, 'index']);
    Route::get('/{id}/', [VesselController::class, 'get']);
    Route::post('/create', [VesselController::class, 'create']);
    Route::post('/update', [VesselController::class, 'update']);
    Route::post('/delete', [VesselController::class, 'delete']);
});
