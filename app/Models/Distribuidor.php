<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;
    protected $table = 'distribuidors';
    protected $fillable = [
        'estado_disponibilidad',
        'id_usuario'
    ];
    protected $casts = [
        'estado_disponibilidad' => 'string',
        'id_usuario' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class, 'id_distribuidor');
    }

    public function getDistribuidores()
    {
        return User::where('rol', 'distribuidor')
            ->whereHas('distribuidor', function ($query) {
                $query->where('estado_disponibilidad', 'libre');
            })
            ->with(['ubicacion', 'distribuidor'])
            ->get();
    }

    public function volumenVehiculo()
    {

        return $this->vehiculo->capacidad_carga ?? 0;
    }
    public static function crearDistribuidor($id_usuario){
        return self::create([
            'estado_disponibilidad' => 'libre',
            'id_usuario' => $id_usuario
        ]);
    }
}
