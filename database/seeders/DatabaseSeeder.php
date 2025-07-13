<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'rol' => 'admin',
            'password' => bcrypt('123456789')
        ]);
        //$this->call(PagosTableSeeder::class);
        $this->call([
            TipoProductoSeeder::class,
            ProductoSeeder::class,
            UserSeeder::class,
            MetodoPagoSeeder::class
        ]);
 
    }
}
