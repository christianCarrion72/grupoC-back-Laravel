<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'marca',
        'modelo',
        'placa',
        'capacidad_carga',
        'anio',
        'id_distribuidor'
    ];
    protected $casts = [
        'marca' => 'string',
        'modelo' => 'string',
        'placa' => 'string',
        'capacidad_carga'=> 'float',
        'anio' => 'string',
        'id_distribuidor' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class, 'id_distribuidor');
    }
    public static function crearVehiculo($id_distribuidori){
        return self::create([
            'id_distribuidor' => $id_distribuidori
        ]);
    }
}
