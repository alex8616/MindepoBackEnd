<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'device_id' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'Usuario no encontrado'
        ], 401);
    }

    if (!$user->activo) {
        return response()->json([
            'message' => 'Usuario desactivado'
        ], 403);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Contraseña incorrecta'
        ], 401);
    }

    // Primer dispositivo que inicia sesión
    if (!$user->device_id) {

        $user->device_id = $request->device_id;

        $user->save();
    }

    // Bloquear otros dispositivos
    if ($user->device_id !== $request->device_id) {

        return response()->json([
            'message' => 'Esta cuenta ya está registrada en otro dispositivo.'
        ], 403);
    }

    // Eliminar tokens anteriores
    $user->tokens()->delete();

    // Crear nuevo token
    $token = $user->createToken('mobile-app')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Inicio de sesión correcto.',
        'token' => $token,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'codigo_empleado' => $user->codigo_empleado,
            'cargo' => $user->cargo,
        ]
    ]);
}
    public function me(Request $request)
    {
        return response()->json(
            $request->user()
        );
    }

    public function logout(Request $request)
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Sesión cerrada'
        ]);
    }
}