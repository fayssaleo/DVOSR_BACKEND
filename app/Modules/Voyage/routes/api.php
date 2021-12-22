<?php

use App\Modules\Voyage\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/voyages'

], function ($router) {
    Route::get('/allVoyages/{date}', [VoyageController::class, 'allVoyages']);
    Route::post('/create', [VoyageController::class, 'create']);
    Route::post('/update', [VoyageController::class, 'update']);
    Route::get('/', [VoyageController::class, 'index']);
    Route::get('/showAll', [VoyageController::class, 'indexAll']);
    Route::get('/{id}', [VoyageController::class, 'get']);
    Route::get('/getActionHistory/{vessel_id}', [VoyageController::class, 'getActionHistory']);
    Route::post('/delete', [VoyageController::class, 'delete']);
    Route::post('/CraneVoyageDelete', [VoyageController::class, 'CraneVoyageDelete']);
    Route::post('/saveOrUpdateVoyage', [VoyageController::class, 'saveOrUpdateVoyage']);
    Route::post('/deleteOtherDelay', [VoyageController::class, 'deleteOtherDelay']);

});
