<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'subtoral',
        'id_producto',
        'id_compra'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'subtoral' => 'decimal:2',
        'id_producto' => 'integer',
        'id_compra' => 'integer'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');    
    }
    
}
