<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 30; $i++) {
        //     DB::table('productos')->insert([
        //         'nombre' => fake()->words(2, true),
        //         'descripcion' => fake()->sentence(9),
        //         'precio' => fake()->numberBetween(50, 200),
        //         'volumen' => fake()->randomFloat(2, 0.5, 2.5), // volumen en litros, por ejemplo
        //         'stock' => fake()->numberBetween(30, 100),
        //         'id_tipo' => fake()->numberBetween(1, 5),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        // Producto 1
        DB::table('productos')->insert([
            'nombre' => 'Zapato Deportivo Pro',
            'descripcion' => 'Zapato ideal para correr con amortiguación avanzada.',
            'precio' => 250.00,
            'volumen' => 5,
            'stock' => 50,
            'id_tipo' => 1,
            'imagen' => 'imagenes_productos/zapatero.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 2
        DB::table('productos')->insert([
            'nombre' => 'Zapato Elegante Formal',
            'descripcion' => 'Perfecto para eventos nocturnos, estilo clásico y cómodo.',
            'precio' => 310.00,
            'volumen' => 12,
            'stock' => 30,
            'id_tipo' => 2,
            'imagen' => 'imagenes_productos/zapato2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Producto 3
        DB::table('productos')->insert([
            'nombre' => 'Botín Casual Urbano',
            'descripcion' => 'Botín resistente para uso diario, diseño moderno.',
            'precio' => 180.00,
            'volumen' => 6,
            'stock' => 40,
            'id_tipo' => 3,
            'imagen' => 'imagenes_productos/zapito.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Producto 4
        DB::table('productos')->insert([
            'nombre' => 'Zapatilla Deportiva Pro',
            'descripcion' => 'Zapatilla ligera para running, con amortiguación avanzada.',
            'precio' => 250.00,
            'volumen' => 4,
            'stock' => 50,
            'id_tipo' => 1,
            'imagen' => 'imagenes_productos/zapato4.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 5
        DB::table('productos')->insert([
            'nombre' => 'Sandalia Verano',
            'descripcion' => 'Sandalia cómoda y elegante para climas cálidos.',
            'precio' => 120.00,
            'volumen' => 8,
            'stock' => 30,
            'id_tipo' => 2,
            'imagen' => 'imagenes_productos/zapato5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 6
        DB::table('productos')->insert([
            'nombre' => 'Bota de Cuero Clásica',
            'descripcion' => 'Bota de cuero genuino, ideal para ocasiones formales.',
            'precio' => 300.00,
            'volumen' => 15,
            'stock' => 25,
            'id_tipo' => 3,
            'imagen' => 'imagenes_productos/zapato6.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 7
        DB::table('productos')->insert([
            'nombre' => 'Zapato Casual Minimalista',
            'descripcion' => 'Zapato de diseño sencillo para uso versátil.',
            'precio' => 150.00,
            'volumen' => 10,
            'stock' => 60,
            'id_tipo' => 4,
            'imagen' => 'imagenes_productos/zapato7.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
