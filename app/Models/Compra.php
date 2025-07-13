<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'volumen_total',
        'id_usuario',
        'id_metodo_pago'
    ];
    protected $casts = [
        'total' => 'decimal:2',
        'volumen_total' => 'decimal:2',
        'id_usuario' => 'integer',
        'id_metodo_pago' => 'integer'
    ];
    protected $hidden = [
        'updated_at',
    ];

    public function compra()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }
    public function asignacion()
    {
        return $this->hasOne(Asignacion::class, 'id_compra');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function volumenTotal()
    {
        return $this->hasMany(DetalleCompra::class, 'id_compra')
            ->with('producto')
            ->get()
            ->sum(function ($detalle) {
                return ($detalle->producto->volumen ?? 0) * $detalle->cantidad;
            });
    }
}
