<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccesoRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Agregar
use Illuminate\Validation\ValidationException; // Agregar

class AutenticarController extends Controller
{
    public function registro(RegistroRequest $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'res' => true,
            'message' => 'Usuario registrado Correctamente'
        ], 200);
    }

    // La idea de este metodo es poder controlar el acceso de un usuario a las rutas de la api
    // Para esto se le otorga un token (un string) que lo utiliza como una clave para usar las rutas
    public function acceso(AccesoRequest $request) {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) { // El usuario debe existir y la clave debe coincidir
            throw ValidationException::withMessages([
                'message' => ['TLas credenciales son incorrectas.'],
            ]);
        }
    
        $token = $user->createToken($request->email)->plainTextToken; // Crea un token y le asigna al usuario con el email dado.

        return response()->json([
            'res' => true,
            'token' => $token
        ], 200);
    }

    // Eliminar el token genereado a un usuario (Logout)
    public function cerrarSesion(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'res' => true,
            'message' => 'Token eliminado correctamente.'
        ], 200);
    }
}