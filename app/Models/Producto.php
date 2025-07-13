<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'precio',
        'volumen',
        'stock',
        'descripcion',
        'imagen',
        'id_tipo'
    ];
    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'imagen' => 'string',

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_tipo');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


}
