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
            'name' => 'luis',
            'telefono' => '7989384',
            'email' => 'luis@gmail.com',
            'rol' => 'cliente',
            'password' => bcrypt('123456789')
        ]);
        Ubicacion::create([
            'latitud' => -17.7622,
            'longitud' => -63.1657,
            'id_usuario' => $user->id
        ]);
        $user = User::factory()->create([
            'name' => 'dist 1',
            'telefono' => '7989384',
            'email' => 'dist1@gmail.com',
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
            'marca' => 'toyota',
            'modelo' => 'izu 12',
            'placa' => '123ABC',
            'capacidad_carga' => '20.0',
            'anio' => '2002',
            'id_distribuidor' => $distribuidor->id
        ]);

        $user = User::factory()->create([
            'name' => 'dist 2',
            'telefono' => '7989384',
            'email' => 'dist2@gmail.com',
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
            'marca' => 'nissan',
            'modelo' => 'np300',
            'placa' => '456DEF',
            'capacidad_carga' => '40',
            'anio' => '2015',
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
