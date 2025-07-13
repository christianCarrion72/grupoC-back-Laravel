<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\AsignacionDistribuidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Compra;
use App\Models\Distribuidor;
use App\Models\Observacion;
use App\Models\Vehiculo;


class AsignacionController extends Controller
{
    public function index() {}


    public function create()
    {
        //
    }

    public function insertar(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'id_compra' => ['required', 'exists:compras,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $asignacion = new Asignacion();
        $asignacion->id_compra = request()->input('id_compra');
        $resultado = $asignacion->asignarDistribuidor();


        return response()->json([
            'status' => $resultado
        ]);
    }

    public function show($id)
    {
        $asignacion = Asignacion::find($id);

        if (!$asignacion) {
            return response()->json(['message' => 'Asignacion no encontrada'], 404);
        }

        return response()->json(['data' => $asignacion], 200);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::find($id);

        if (!$asignacion) {
            return response()->json(['message' => 'Asignacion no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'fecha_asignado' => 'sometimes|required|date',
            'id_usuario' => 'sometimes|required|exists:users,id',
        ]);

        if (isset($validatedData['id_usuario'])) {
            $asignacion->id_usuario = $validatedData['id_usuario'];
        }
        if (isset($validatedData['fecha_asignado'])) {
            $asignacion->fecha_asignado = $validatedData['fecha_asignado'];
        }

        $asignacion->save();

        return response()->json([
            'message' => 'Asignacion actualizada exitosamente',
            'data' => $asignacion
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
    public function insertarObservacion(Request $request)
    {
        $validator = validator($request->all(), [
            'id_asignacion' => ['required', 'integer'],
            'id_distribuidor' => ['required', 'integer'],
            'ubicacion_entrega' => ['required', 'string'],
            'observacion' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $tipoObservacion = $request->input('observacion');
        $observacionString = "";
        if ($tipoObservacion == 1) {
            $observacionString = "entregado";
        } elseif ($tipoObservacion == 2) {
            $observacionString = "no entregado";
        } elseif ($tipoObservacion == 3) {
            $observacionString = "producto incorrecto";
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No existe tal opción de observación.'
            ], 400);
        }

        $observacion = new Observacion();
        $observacion->id_asignacion = $request->input('id_asignacion');
        $observacion->id_distribuidor = $request->input('id_distribuidor');
        $observacion->ubicacion_entrega = $request->input('ubicacion_entrega');
        $observacion->hora_entrega = now()->format('H:i:s');
        $observacion->observaciones = $observacionString;
        $observacion->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Observación registrada exitosamente.',
            'observacion' => $observacion
        ], 201);
    }
    public function mostrar()
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No autorizado'
            ], 403);
        }

        $distribuidor = Distribuidor::where('id_usuario', auth()->id())->first();
        if (!$distribuidor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Distribuidor no encontrado'
            ], 404);
        }

        $asignacion = new Asignacion();
        $asignacion->id_distribuidor = $distribuidor->id;

        $detalles = $asignacion->asignacionDetalle();

        return response()->json([
            'status' => 'success',
            'data' => $detalles
        ]);
    }
    public function cambiarEstado($id, $estado)
{
    $user = auth()->user();
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'No autorizado'
        ], 403);
    }

    $asignacion = Asignacion::find($id);
    if (!$asignacion) {
        return response()->json([
            'status' => 'error',
            'message' => 'Asignación no encontrada'
        ], 404);
    }

    $estadosValidos = ['en curso', 'entregado', 'no entregado', 'producto incorrecto'];
    if (!in_array($estado, $estadosValidos)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Estado inválido'
        ], 422);
    }

    $asignacion->estado = $estado;
    $asignacion->updated_at = now();
    $asignacion->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Estado actualizado exitosamente',
        'data' => [
            'id' => $asignacion->id,
            'estado' => $asignacion->estado,
        ]
    ], 200);
}
}
