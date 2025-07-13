<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use Illuminate\Http\Request;
use App\Models\Compra;
use Illuminate\Support\Facades\Validator;
use App\Models\DetalleCompra;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
    }

    public function show($id)
    {
        $compra = Compra::with('pago')->find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        return response()->json($compra);
    }
    public function crear()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        $compra = new Compra();
        $compra->id_usuario = $user->id;
        $compra->save();
        $comprafinal = Compra::find($compra->id);

        $asignacion = new Asignacion();
        $asignacion->id_compra = $compra->id;
        $a = $asignacion->asignarDistribuidor();

        return response()->json(['message' => 'Compra created successfully', 'compra' => $comprafinal], 201);
    }
    public function update(Request $request, $id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        $compra->cantidad = $request->cantidad;
        $compra->destino = $request->destino;
        $compra->estadoEntrega = $request->estadoEntrega;
        $compra->save();
        return response()->json(['message' => 'Compra updated successfully', 'compra' => $compra]);
    }
    public function destroy($id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        $compra->delete();
        return response()->json(['message' => 'Compra deleted successfully']);
    }
    public function showPagos($id)
    {
        $compra = Compra::with('pago')->find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        return response()->json($compra->pago);
    }
    public function storeDetalle(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cantidad' => 'required|integer',
                'subtotal' => 'required|numeric',
                'id_compra' => 'required|integer|exists:compras,id',
                'id_producto' => 'required|integer|exists:productos,id'
            ],
            [
                'required' => 'El campo :attribute es obligatorio.',
                'integer' => 'El campo :attribute debe ser un número entero.',
                'exists' => 'El :attribute seleccionado no es válido.',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $detalle = new DetalleCompra();
        $detalle->cantidad = $request->cantidad;
        $detalle->subtotal = $request->subtotal;
        $detalle->id_compra = $request->id_compra;
        $detalle->id_producto = $request->id_producto;
        $detalle->save();

        return response()->json(['message' => 'Detalle de compra creado correctamente', 'detalle' => $detalle], 201);
    }

    public function calcularTotal(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_metodo_pago' => 'required|integer|exists:metodo_pagos,id'
            ],
            [
                'required' => 'El campo :attribute es obligatorio.',
                'integer' => 'El campo :attribute debe ser un número entero.',
                'exists' => 'El :attribute seleccionado no es válido.',
            ]
        );
        $detalles = DetalleCompra::where('id_compra', $id)->get();
        if ($detalles->isEmpty()) {
            return response()->json(['message' => 'No hay detalles de compra para calcular el total'], 404);
        }
        $total = $detalles->sum('subtotal');
        $compra = Compra::find($id);
        $compra->total = $total;
        $compra->volumen_total = $compra->volumenTotal();
        $compra->id_metodo_pago = $request->id_metodo_pago;
        $compra->save();
        return response()->json(['message' => 'Total calculado y guardado correctamente', 'total' => $compra]);
    }

    public function getCompras($filtro)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No autorizado'
            ], 403);
        }

        $estados = [
            1 => 'en curso',
            2 => 'entregado',
            3 => 'no entregado',
            4 => 'producto incorrecto'
        ];

        $estado = $estados[$filtro] ?? null;
        if (!$estado) {
            return response()->json([
                'status' => 'error',
                'message' => 'Filtro inválido'
            ], 400);
        }

        $compras = Compra::where('id_usuario', auth()->id())
            ->whereHas('asignacion', function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->get();

        if ($compras->isEmpty()) {
            return response()->json([
                'status' => 'empty',
                'message' => 'No se encontraron compras registradas'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $compras
        ]);
    }
}
