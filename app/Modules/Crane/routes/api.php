<?php

use App\Modules\Crane\Http\Controllers\CraneController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/cranes'

], function ($router) {
    Route::get('/', [CraneController::class, 'index']);
    Route::get('/{id}', [CraneController::class, 'get']);
    Route::post('/create', [CraneController::class, 'create']);
    Route::post('/update', [CraneController::class, 'update']);
    Route::post('/delete', [CraneController::class, 'delete']);

});
