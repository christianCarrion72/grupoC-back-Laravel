<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\Compra;
use App\Models\Distribuidor;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Asignacion extends Model
{
    protected $fillable = [
        'fecha_asignada',
        'distancia',
        'tiempo',
        'estado',
        'id_compra',
        'id_distribuidor'
    ];

    protected $casts = [
        'fecha_asignada' => 'datetime',
        'distancia' => 'decimal:2',
        'tiempo' => 'decimal:2',
        'estado' => 'string',
        'id_compra' => 'integer',
        'id_distribuidor' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class, 'id_distribuidor');
    }


    public function asignarDistribuidor()
    {
        $compra = Compra::find($this->id_compra);
        if (!$compra) {
            return response()->json(['error' => 'Compra no encontrada'], 404);
        }

        $ubicacionCliente = Ubicacion::where('id_usuario', $compra->id_usuario)->first();
        if (!$ubicacionCliente) {
            return response()->json(['error' => 'Ubicación del cliente no encontrada'], 404);
        }

        $latCliente = $ubicacionCliente->latitud;
        $longCliente = $ubicacionCliente->longitud;
        $distribuidorCercano = null;
        $mejorRuta = null;

        $distribuidores = (new Distribuidor())->getDistribuidores();

        foreach ($distribuidores as $distribuidor) {
            $volumen = $distribuidor->distribuidor?->volumenVehiculo() ?? 0;
            if ($compra->compra_total > $volumen) {
                continue;
            }

            $ubicacionDistribuidor = Ubicacion::where('id_usuario', $distribuidor->id)->first();
            if (!$ubicacionDistribuidor) {
                continue;
            }

            $ruta = $this->obtenerRuta(
                $longCliente,
                $latCliente,
                $ubicacionDistribuidor->longitud,
                $ubicacionDistribuidor->latitud
            );

            if (!$ruta) {
                continue;
            }

            if (!$mejorRuta || $ruta['distancia'] < $mejorRuta['distancia']) {
                $distribuidorCercano = $distribuidor;
                $mejorRuta = $ruta;
            }
        }

        if (!$distribuidorCercano) {
            Log::warning('❌ No se encontró distribuidor válido');
            return response()->json(['error' => 'No se encontró distribuidor con capacidad o ruta válida'], 404);
        }

        // Guardar la asignación
        $asignacion = self::create([
            'fecha_asignada' => now(),
            'distancia' => $mejorRuta['distancia'] / 1000,
            'tiempo' => $mejorRuta['duracion'] / 60,
            'id_compra' => $this->id_compra,
            'id_distribuidor' => $distribuidorCercano->distribuidor->id,
        ]);

        Log::info("🎯 Distribuidor ID {$distribuidorCercano->id} asignado correctamente");

        return response()->json([
            'message' => 'Distribuidor asignado correctamente',
            'asignacion' => $asignacion,
            'distribuidor' => [
                'id' => $distribuidorCercano->id,
                'nombre' => $distribuidorCercano->nombre ?? null,
            ],
            'distancia_km' => round($asignacion->distancia, 2),
            'duracion_min' => round($asignacion->tiempo, 2),
        ]);
    }


    protected function obtenerRuta($longOrigen, $latOrigen, $longDestino, $latDestino)
    {
        $url = "http://router.project-osrm.org/route/v1/driving/" .
            floatval($longOrigen) . "," . floatval($latOrigen) . ";" .
            floatval($longDestino) . "," . floatval($latDestino) . "?overview=false";

        Log::debug("➡️ OSRM URL: $url");

        try {
            $response = Http::timeout(5)->get($url);
            if ($response->successful()) {
                $data = $response->json();
                $route = $data['routes'][0] ?? null;

                if ($route) {
                    return [
                        'distancia' => $route['distance'], // en metros
                        'duracion' => $route['duration'],  // en segundos
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::warning("Error al conectar con OSRM: " . $e->getMessage());
        }

        return null;
    }
    public function asignacionDetalle()
    {
        $asignaciones = self::with(['compra.usuario'])
            ->where('id_distribuidor', $this->id_distribuidor)
            ->where('estado', 'en curso')
            ->orderByDesc('fecha_asignada')
            ->get();

        return $asignaciones->map(function ($a) {
            return [
                'id' => $a->id,
                'id_compra' => $a->id_compra,
                'id_distribuidor' => $a->id_distribuidor,
                'fecha_asignada' => $a->fecha_asignada,
                'estado' => $a->estado,
                'volumen_total' => $a->compra->volumen_total ?? null,
                'cliente_nombre' => $a->compra->usuario->name ?? null,
                'distancia_km' => $a->distancia ?? null,
                'tiempo_min' => $a->tiempo ?? null,
            ];
        });
    }
}
