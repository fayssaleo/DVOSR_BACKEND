<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Code\Http\Controllers\CodeController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/codes'

], function ($router) {
    Route::get('/', [CodeController::class, 'index']);
    Route::post('/create', [CodeController::class, 'create']);
    Route::get('/{id}', [CodeController::class, 'get']);
    Route::post('/update', [CodeController::class, 'update']);
    Route::post('/delete', [CodeController::class, 'delete']);
});
