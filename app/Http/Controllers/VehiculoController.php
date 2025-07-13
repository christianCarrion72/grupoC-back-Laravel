<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;


class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::where('user_id', auth()->id())->get();
        return response()->json($vehiculos);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->anio = $request->anio;
        $vehiculo->user_id = auth()->id();
        $vehiculo->save();
        return response()->json($vehiculo, 201);
    }



    public function show($id)
    {
        $vehiculo = Vehiculo::where('user_id', auth()->id())->find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        return response()->json($vehiculo);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
