<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitud',
        'longitud',
        'id_usuario'
    ];
    protected $casts = [
        'latitud' => 'decimal:7',
        'longitud' => 'decimal:7',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function getLatitud($id_usuario)
    {
        $ubicacion = Ubicacion::where('id_usuario', $id_usuario)->first();
        return $ubicacion ? $ubicacion->latitud : null;
    }
    public function getLongitud($id_usuario)
    {
        $ubicacion = Ubicacion::where('id_usuario', $id_usuario)->first();
        return $ubicacion ? $ubicacion->longitud : null;
    }
    public function updateUbicacion($id_usuario, $latitud, $longitud)
    {
        $ubicacion = Ubicacion::where('id_usuario', $id_usuario)->first();
        if ($ubicacion) {
            $ubicacion->latitud = $latitud;
            $ubicacion->longitud = $longitud;
            $ubicacion->save();
            return $ubicacion;
        } else {
            $ubicacion = new Ubicacion();
            $ubicacion->id_usuario = $id_usuario;
            $ubicacion->latitud = $latitud;
            $ubicacion->longitud = $longitud;
            $ubicacion->save();
            return $ubicacion;
        };
    }

    public static function getUbicacionesRuta($id_compra, $id_distribuidor)
    {
        $compra = Compra::with('usuario')->find($id_compra);
        $distribuidor = Distribuidor::with('usuario')->find($id_distribuidor);

        if (!$compra || !$distribuidor) {
            return null;
        }

        $ubicacionCliente = self::where('id_usuario', $compra->id_usuario)->first();
        $ubicacionDistribuidor = self::where('id_usuario', $distribuidor->id_usuario)->first();

        return [
            'cliente' => [
                'id_compra' => $id_compra,
                'nombre' => optional($compra->usuario)->name,
                'latitud' => optional($ubicacionCliente)->latitud,
                'longitud' => optional($ubicacionCliente)->longitud,
            ],
            'distribuidor' => [
                'id_distribuidor' => $id_distribuidor,
                'nombre' => optional($distribuidor->usuario)->name,
                'latitud' => optional($ubicacionDistribuidor)->latitud,
                'longitud' => optional($ubicacionDistribuidor)->longitud,
            ]
        ];
    }
}
