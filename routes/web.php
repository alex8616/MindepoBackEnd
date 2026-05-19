<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hora-servidor', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timestamp' => Carbon::now()->timestamp
    ]);
});

Route::post('/api/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'Usuario no encontrado'
        ], 401);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Contraseña incorrecta'
        ], 401);
    }

    if (!$user->activo) {
        return response()->json([
            'message' => 'Usuario desactivado'
        ], 403);
    }

    // SI NO TIENE DEVICE ASIGNADO → LO REGISTRA
    if (!$user->device_id) {
        $user->device_id = $request->device_id;
        $user->save();
    }

    // BLOQUEO REAL
    if ($user->device_id !== $request->device_id) {
        return response()->json([
            'message' => 'Esta cuenta ya está usada en otro dispositivo'
        ], 403);
    }

    return response()->json([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]
    ]);
});

Route::get('/GetUser-Full',[UserController::class, 'GetUserFull']);
