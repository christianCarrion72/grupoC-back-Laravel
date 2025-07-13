<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetodoPago::create([
            'metodo' => 'efectivo'
        ]);
        MetodoPago::create([
            'metodo' => 'cuenta bancaria'
        ]);
        MetodoPago::create([
            'metodo' => 'QR'
        ]);
    }
}
