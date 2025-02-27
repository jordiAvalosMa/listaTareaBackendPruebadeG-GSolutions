<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('tareas', TareaController::class)->only(['index', 'store', 'update']);

Route::get('tareas/estado/{completada}', [TareaController::class, 'filtradas']);
