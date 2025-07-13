<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoProducto;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoProducto::create([
            'tipo' => 'Zapatillas'
        ]);
        TipoProducto::create([
            'tipo' => 'Botas'
        ]);
        TipoProducto::create([
            'tipo' => 'Sandalias'
        ]);
        TipoProducto::create([
            'tipo' => 'Tenis'
        ]);
        TipoProducto::create([
            'tipo' => 'Mocasines'
        ]);
        
    }
}
