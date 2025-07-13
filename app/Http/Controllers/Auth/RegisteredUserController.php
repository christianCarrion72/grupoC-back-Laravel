<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Ubicacion;
use App\Models\Distribuidor;
use App\Models\Vehiculo;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);

        Ubicacion::create([
            'id_usuario' => $user->id,
            'latitud' => -17.783327,   // Coordenada aproximada
            'longitud' => -63.182140   // Coordenada aproximada
        ]);

        if ($request->rol == 'distribuidor') {
           $r = Distribuidor::crearDistribuidor($user->id);
           Vehiculo::crearVehiculo($r->id);
        }

        event(new Registered($user));

        Auth::login($user);

        // Generar un token de Sanctum para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user, // Opcional: puedes devolver los datos del usuario
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201); // Código de estado 201 para "Created"
    }
}
