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
            'nombre' => 'Nike Air Max Runner',
            'descripcion' => 'Zapatillas deportivas con tecnología de amortiguación Air, perfectas para running.',
            'precio' => 289.99,
            'volumen' => 5,
            'stock' => 50,
            'id_tipo' => 1,
            //'imagen' => 'imagenes_productos/zapatero.jpg',
            'imagen' => 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/f6105318-3c83-4836-ab5b-96f2cd95de00/AIR+ZOOM+PEGASUS+41.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 2
        DB::table('productos')->insert([
            'nombre' => 'Oxford Premium Executive',
            'descripcion' => 'Zapatos de cuero italiano con acabado brillante, perfectos para ocasiones formales.',
            'precio' => 349.99,
            'volumen' => 12,
            'stock' => 30,
            'id_tipo' => 2,
            //'imagen' => 'imagenes_productos/zapato2.jpg',
            'imagen' => 'https://m.media-amazon.com/images/I/61EsCIhQ0AL._AC_UY900_.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Producto 3
        DB::table('productos')->insert([
            'nombre' => 'Timberland Urban Explorer',
            'descripcion' => 'Botines de cuero nobuck resistentes al agua, ideales para el estilo urbano.',
            'precio' => 219.99,
            'volumen' => 6,
            'stock' => 40,
            'id_tipo' => 3,
            //'imagen' => 'imagenes_productos/zapito.jpg',
            'imagen' => 'https://i.ebayimg.com/thumbs/images/g/gwIAAOSwA3hlmGSu/s-l1200.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Producto 4
        DB::table('productos')->insert([
            'nombre' => 'Adidas Boost Elite',
            'descripcion' => 'Zapatillas ultraligeras con tecnología Boost, diseñadas para alto rendimiento.',
            'precio' => 279.99,
            'volumen' => 4,
            'stock' => 50,
            'id_tipo' => 1,
            //'imagen' => 'imagenes_productos/zapato4.jpg',
            'imagen' => 'https://i.ebayimg.com/images/g/UdgAAOSwd7RfsWRf/s-l1200.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 5
        DB::table('productos')->insert([
            'nombre' => 'Havaianas Premium Resort',
            'descripcion' => 'Sandalias de diseñador con detalles metálicos, perfectas para días de playa.',
            'precio' => 159.99,
            'volumen' => 8,
            'stock' => 30,
            'id_tipo' => 2,
            //'imagen' => 'imagenes_productos/zapato5.jpg',
            'imagen' => 'https://m.media-amazon.com/images/I/51QF850RRYL._UY900_.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 6
        DB::table('productos')->insert([
            'nombre' => 'Red Wing Heritage',
            'descripcion' => 'Botas artesanales de cuero premium con costuras reforzadas y suela Goodyear.',
            'precio' => 389.99,
            'volumen' => 15,
            'stock' => 25,
            'id_tipo' => 3,
            //'imagen' => 'imagenes_productos/zapato6.jpg',
            'imagen' => 'https://m.media-amazon.com/images/I/51RvnWqwWmL._SY900_.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Producto 7
        DB::table('productos')->insert([
            'nombre' => 'Vans Classic Edition',
            'descripcion' => 'Zapatillas clásicas de lona con diseño minimalista y plantilla ComfortCush.',
            'precio' => 179.99,
            'volumen' => 10,
            'stock' => 60,
            'id_tipo' => 4,
            //'imagen' => 'imagenes_productos/zapato7.jpg',
            'imagen' => 'https://i.ebayimg.com/images/g/PUsAAOSwSYVf4-l9/s-l400.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
