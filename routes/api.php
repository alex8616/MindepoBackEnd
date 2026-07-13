<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AsistenciaController;


Route::get('/hora-servidor', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timestamp' => Carbon::now()->timestamp
    ]);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/estado-jornada', [AsistenciaController::class, 'estadoJornada']);
    Route::post('/asistencias', [AsistenciaController::class, 'store']);
});