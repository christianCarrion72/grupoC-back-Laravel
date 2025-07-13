<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function update(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email|max:255',
        ]);
        if ($Validator->fails()) {
            return response()->json($Validator->errors(), 422);
        }
        $user = User::find($id);
        $user->fill($request->only(['name', 'telefono', 'email']));
        $user->save();
        return response()->json($user);
    }

    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during login.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateUbicacion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        $ubicacion = Ubicacion::where('id_usuario', $user->id)->first();
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;
        $ubicacion->save();
        return response()->json(['message' => 'ubicacion actualizada', 'ubicacion' => $ubicacion]);
    }
    public function getUbicacion($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no autorizado o no encontrado.'
            ], 403);
        }

        $ubicacion = Ubicacion::where('id_usuario', $id)->first();

        if (!$ubicacion) {
            return response()->json([
                'status' => 'empty',
                'message' => 'Ubicación no encontrada para este usuario.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $ubicacion
        ]);
    }
    public function getUbicacionesRuta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_compra' => 'required|integer|exists:compras,id',
            'id_distribuidor' => 'required|integer|exists:distribuidors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $resultado = Ubicacion::getUbicacionesRuta(
            $request->input('id_compra'),
            $request->input('id_distribuidor')
        );

        return response()->json([
            'status' => 'success',
            'data' => $resultado
        ]);
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'rol' => 'required|in:cliente,distribuidor,admin',
            ]);

            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
                'rol' => $user->rol,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getUser()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No autorizado'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'telefono' => $user->telefono,
                'email' => $user->email,
                'rol' => $user->rol,
                'email_verified_at' => $user->email_verified_at,
            ]
        ], 200);
    }
}
