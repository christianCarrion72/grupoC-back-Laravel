<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo'
    ];
    protected $casts = [
        'tipo' => 'string',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_tipo');
    }
}
