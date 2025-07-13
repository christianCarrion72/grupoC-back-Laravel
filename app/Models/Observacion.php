<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'ubicacion_entrega',
        'hora_entrega',
        'observaciones',
        'id_asignacion',
        'id_distribuidor'
    ];
    protected $casts = [
        'ubicacion_entrega' => 'string',
        'hora_entrega' => 'time',
        'observaciones' => 'string',    
        'id_asignacion' => 'integer',
        'id_distribuidor' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'id_asignacion');
    }
    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class, 'id_distribuidor');
    }
}
