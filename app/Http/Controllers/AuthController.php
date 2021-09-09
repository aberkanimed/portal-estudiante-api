<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Validar los datos
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        // Encrypt Password
        $credentials['password'] = Hash::make($credentials['password']);

        // Crear usuario nuevo
        $usuario = User::create($credentials);

        // Generar el token
        $token =  $usuario->createToken('TokenUsuario')->plainTextToken;

        // Devolver una respuesta
        $respuesta = [
            'data' => [
                'usuario' => $usuario,
                'token' => $token
            ],
        ];

        return response()->json($respuesta);
    }
}
