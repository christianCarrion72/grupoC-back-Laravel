<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribuidor;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class DistribuidorController extends Controller
{
    public function index()
    {
        $distribuidores = new Distribuidor();
        $distribuidores = $distribuidores->getDistribuidores();

        if ($distribuidores->isEmpty()) {
            return response()->json([
                'status' => 'empty',
                'message' => 'No se encontraron distribuidores.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $distribuidores
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_vehiculo' => 'required|string',
            'estado_disponibilidad' => 'required|string',
            'id_usuario' => 'required|exists:users,id',
        ]);

        try {
            $distribuidor = Distribuidor::create($validatedData);
            return response()->json($distribuidor, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create distribuidor', 'error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        $user = User::find($id);
        if (!$user || $user->rol !== 'distribuidor') {
            return response()->json(['message' => 'Distribuidor not found'], 404);
        }
        // Obtener el usuario completo con relaciones
        $userCompleto = User::with([
            'distribuidor',
            'distribuidor.vehiculo',
            'ubicacion'
        ])->find($id);
        if (!$userCompleto) {
            return response()->json(['message' => 'Distribuidor not found'], 404);
        }

        return response()->json($userCompleto);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $distribuidor = Distribuidor::where('id_usuario', $user->id)->find($id);

        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor not found'], 404);
        }

        $validatedData = $request->validate([
            'tipo_vehiculo' => 'string',
            'estado_disponibilidad' => 'string',
            'id_usuario' => 'exists:users,id',
        ]);

        try {
            $distribuidor->update($validatedData);
            return response()->json($distribuidor);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update distribuidor', 'error' => $e->getMessage()], 500);
        }
    }
    public function registrar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'correo' => 'required|string',
            'telefono' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => request()->input('nombre'),
            'telefono' => request()->input('telefono'),
            'email' => request()->input('correo'),
            'rol' => 'distribuidor',
            'password' => bcrypt(request()->input('password'))
        ]);
        $distribuidor = Distribuidor::create([
            'estado_disponibilidad' => 'libre',
            'id_usuario' => $user->id
        ]);
        $vehiculo = Vehiculo::create([
            'id_distribuidor' => $distribuidor->id
        ]);
    }
    public function registrarVehiculo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'marca' => ['required', 'string'],
            'modelo' => ['required', 'string'],
            'placa' => ['required', 'string', 'unique:vehiculos,placa'],
            'capacidad_carga' => ['required', 'numeric'],
            'anio' => ['required', 'string'],
            'id_distribuidor' => ['required', 'integer', 'exists:distribuidores,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buscar el distribuidor por el id_usuario recibido como $id
            $distribuidor = Distribuidor::where('id_usuario', $id)->first();

            if (!$distribuidor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Distribuidor no encontrado.'
                ], 404);
            }

            // Buscar el vehículo asociado al distribuidor
            $vehiculo = Vehiculo::where('id_distribuidor', $distribuidor->id)->first();

            if (!$vehiculo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vehículo no encontrado para este distribuidor.'
                ], 404);
            }

            // Actualizar el vehículo con los datos validados
            $vehiculo->update($validator->validated());
            return response()->json([
                'status' => 'success',
                'data' => $vehiculo
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo registrar el vehículo.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function cambiarEstado()
    {
        $user = auth()->user();
        $dis = Distribuidor::where('id_usuario', $user->id)->firstOrFail();

        $dis->estado_disponibilidad = ($dis->estado_disponibilidad === 'libre')
            ? 'no libre' : 'libre';

        $dis->save();

        return response()->json([
            'status' => 'success',
            'estado' => $dis->estado_disponibilidad
        ]);
    }

    public function obtenerEstado()
    {
        $user = auth()->user();
        $dis = Distribuidor::where('id_usuario', $user->id)->firstOrFail();

        return response()->json([
            'status' => 'success',
            'estado' => $dis->estado_disponibilidad
        ]);
    }
    public function getVehiculo()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No autorizado'
            ], 403);
        }

        $distribuidor = Distribuidor::where('id_usuario', $user->id)->first();
        if (!$distribuidor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Distribuidor no encontrado'
            ], 404);
        }

        $vehiculo = Vehiculo::where('id_distribuidor', $distribuidor->id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $vehiculo ?: null // Devuelve null si no hay vehículo
        ], 200);
    }

    public function updateVehiculo(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No autorizado'
            ], 403);
        }

        $distribuidor = Distribuidor::where('id_usuario', $user->id)->first();
        if (!$distribuidor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Distribuidor no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'placa' => 'required|string|max:50',
            'capacidad_carga' => 'required|numeric|min:0',
            'anio' => 'required|string|size:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $vehiculo = Vehiculo::where('id_distribuidor', $distribuidor->id)->first();
        $data = [
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'placa' => $request->placa,
            'capacidad_carga' => $request->capacidad_carga,
            'anio' => $request->anio,
            'id_distribuidor' => $distribuidor->id,
        ];

        if ($vehiculo) {
            $vehiculo->update($data);
        } else {
            $vehiculo = Vehiculo::create($data);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehículo actualizado exitosamente',
            'vehiculo' => $vehiculo
        ], 200);
    }
}
