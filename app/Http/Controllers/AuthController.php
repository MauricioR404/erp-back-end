<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar credenciales
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar iniciar sesión
        if (!Auth::attempt($credentials)) {
            return response()->json(['mensaje' => 'Credenciales inválidas'], 401);
        }

        // Retornar token como string simple
        return response()->json([
            'token' => $request->user()->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // <- Revoca todos los tokens
        return response()->json(['mensaje' => 'Sesión cerrada']);
    }
}
