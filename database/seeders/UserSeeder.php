<?php

namespace Database\Seeders;

use App\Models\Distribuidor;
use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehiculo;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Carlos Rodriguez',
            'telefono' => '75431298',
            'email' => 'cliente1@gmail.com',
            'rol' => 'cliente',
            'password' => bcrypt('123456789')
        ]);
        Ubicacion::create([
            'latitud' => -17.7622,
            'longitud' => -63.1657,
            'id_usuario' => $user->id
        ]);
        $user = User::factory()->create([
            'name' => 'Juan Perez',
            'telefono' => '70912345',
            'email' => 'test1@gmail.com',
            'rol' => 'distribuidor',
            'password' => bcrypt('123456789')
        ]);
        Ubicacion::create([
            'latitud' => -17.7650,
            'longitud' => -63.1700,
            'id_usuario' => $user->id
        ]);
        $distribuidor = Distribuidor::create([
            'estado_disponibilidad' => 'libre',
            'id_usuario' => $user->id
        ]);
        Vehiculo::create([
            'marca' => 'Mitsubishi',
            'modelo' => 'L200',
            'placa' => 'XYZ789',
            'capacidad_carga' => '25.5',
            'anio' => '2020',
            'id_distribuidor' => $distribuidor->id
        ]);

        $user = User::factory()->create([
            'name' => 'Maria Garcia',
            'telefono' => '76543210',
            'email' => 'test2@gmail.com',
            'rol' => 'distribuidor',
            'password' => bcrypt('123456789')
        ]);
        Ubicacion::create([
            'latitud' => -17.7705,
            'longitud' => -63.1808,
            'id_usuario' => $user->id
        ]);
        $distribuidor = Distribuidor::create([
            'estado_disponibilidad' => 'libre',
            'id_usuario' => $user->id
        ]);
        
        Vehiculo::create([
            'marca' => 'Ford',
            'modelo' => 'Ranger',
            'placa' => 'ABC123',
            'capacidad_carga' => '35.5',
            'anio' => '2022',
            'id_distribuidor' => $distribuidor->id
        ]);

        // $user = User::factory()->create([
        //     'name' => 'dist 3',
        //     'telefono' => '7989384',
        //     'email' => 'dist3@gmail.com',
        //     'rol' => 'distribuidor',
        //     'password' => bcrypt('123456789')
        // ]);
        // Ubicacion::create([
        //     'latitud' => -17.7603,
        //     'longitud' => -63.1602,
        //     'id_usuario' => $user->id
        // ]);
        // $distribuidor = Distribuidor::create([
        //     'estado_disponibilidad' => 'libre',
        //     'id_usuario' => $user->id
        // ]);
        
        // Vehiculo::create([
        //     'marca' => 'ford',
        //     'modelo' => 'f150',
        //     'placa' => '789GHI',
        //     'capacidad_carga' => '18.0',
        //     'anio' => '2010',
        //     'id_distribuidor' => $distribuidor->id
        // ]);

        // $user = User::factory()->create([
        //     'name' => 'dist 4',
        //     'telefono' => '7989384',
        //     'email' => 'dist4@gmail.com',
        //     'rol' => 'distribuidor',
        //     'password' => bcrypt('123456789')
        // ]);
        // Ubicacion::create([
        //     'latitud' => -17.7557,
        //     'longitud' => -63.1755,
        //     'id_usuario' => $user->id
        // ]);
        // $distribuidor = Distribuidor::create([
        //     'estado_disponibilidad' => 'libre',
        //     'id_usuario' => $user->id
        // ]);
        
        // Vehiculo::create([
        //     'marca' => 'chevrolet',
        //     'modelo' => 'silverado',
        //     'placa' => '321ZYX',
        //     'capacidad_carga' => '22.5',
        //     'anio' => '2018',
        //     'id_distribuidor' => $distribuidor->id
        // ]);
    }
}
