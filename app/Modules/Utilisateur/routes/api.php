<?php

use Illuminate\Support\Facades\Route;
use \App\Modules\Utilisateur\Http\Controllers\UtilisateurController;
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/utilisateurs'

], function ($router) {
    Route::post('/logout', [UtilisateurController::class, 'logout']);
    Route::get('/', [UtilisateurController::class, 'index']);
    Route::get('/{id}', [UtilisateurController::class, 'get']);
    Route::post('/create', [UtilisateurController::class, 'create']);
    Route::post('/update', [UtilisateurController::class, 'update']);
    Route::post('/changePassword', [UtilisateurController::class, 'changePassword']);
    Route::post('/delete', [UtilisateurController::class, 'delete']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'api/utilisateurs'

], function ($router) {
    Route::post('/register', [UtilisateurController::class, 'register']);
    Route::post('/login', [UtilisateurController::class, 'login']);

});

