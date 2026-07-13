<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/hora-servidor', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timestamp' => Carbon::now()->timestamp
    ]);
});

//USUARIO
Route::get('/usuarios', [UserController::class, 'index']);
Route::get('/usuarios/list', [UserController::class, 'list']);
Route::post('/usuarios/store', [UserController::class, 'store']);
Route::post('/usuarios/update/{id}', [UserController::class, 'update']);
Route::delete('/usuarios/delete/{id}', [UserController::class, 'delete']);


Route::get('/', function () {
    return view('welcome');
});



Route::get('/GetUser-Full',[UserController::class, 'GetUserFull']);

