<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        $data = $productos->map(function ($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'volumen' => $producto->volumen,
                'id_tipo' => $producto->id_tipo,
                'imagen_url' => $producto->imagen
                    ? asset('storage/' . $producto->imagen)
                    : null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        // $user = auth()->user();
        // if (!$user) {
        //     return response()->json(['message' => 'No autenticado'], 401);
        // }
        $producto = Producto::with(['tipoProducto'])
            ->find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'id_tipo' => 'required|exists:tipo_productos,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $validator->validated();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $ruta = $imagen->store('imagenes_productos', 'public'); // almacena en /storage/app/public/imagenes_productos
            $data['imagen'] = $ruta;
        }

        $data['id_usuario'] = auth()->id();

        $producto = Producto::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $producto,
            'url_imagen' => $producto->imagen ? asset('storage/' . $producto->imagen) : null
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->rol !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'volumen' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validatedData = $validator->validated();

        $producto->update([
            'nombre' => $validatedData['nombre'],
            'precio' => $validatedData['precio'],
            'volumen' => $validatedData['volumen'],
            'stock' => $validatedData['stock'],
            'descripcion' => $validatedData['descripcion'],

        ]);

        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $producto = Producto::where('id_usuario', $user->id)->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado'], 200);
    }

    public function exists($nombre)
    {
        $user = auth()->user();
        $producto = Producto::where('id_usuario', $user->id)->where('nombre', $nombre)->first();

        if ($producto) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
    public function indexFiltro($id)
    {
        $productos = Producto::where('id_tipo', $id)->get();

        if ($productos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron productos para este tipo'], 404);
        }

        return response()->json($productos);
    }
}
