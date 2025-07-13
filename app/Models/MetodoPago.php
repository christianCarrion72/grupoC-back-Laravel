<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'metodo'
    ];

    protected $casts = [
        'metodo' => 'string',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
