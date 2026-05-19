<?php

namespace App\Http\Controllers;

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
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

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

        if (!Hash::check(
            $request->password,
            $user->password
        )) {
            return response()->json([
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        $token = $user->createToken(
            'mobile-app'
        )->plainTextToken;

        return response()->json([
            'token' => $token,

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
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