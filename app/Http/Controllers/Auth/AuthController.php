<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login( LoginRequest $request )
    {
        // OBTENER CREDENCIALES
        $credentials = $request->validated();

        // VERIFICAR CONTRASEÑA
        if( !Auth::attempt($credentials) )
        {
            return response()->json([
                "message" => "Credenciales incorrectas",
            ], 401);
        }

        $user = User::find( Auth::user()['id'] );

        // CREAR TOKEN
        $token = $user->createToken('token')->plainTextToken;  

        return response()->json([
            "user" => new UserResource($user),
            "token" => $token
        ]);

    }

    public function logout( Request $request )
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            "message" => "Sesion cerrada correctamente"
        ]);

    }

    public function register()
    {

    }

    public function checkToken( Request $request )
    {
        $user = $request->user();

        return response()->json([
            "user" => new UserResource($user)
        ]);

    }
}
