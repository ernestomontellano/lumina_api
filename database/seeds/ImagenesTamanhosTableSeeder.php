<?php

use Illuminate\Database\Seeder;

class ImagenesTamanhosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('imagenestamanhos')->delete();
        $regs = array(
            [
                'id' => 1,
                'imagenes_id' => 1,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'imagenes_id' => 1,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 3,
                'imagenes_id' => 2,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 8,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 4,
                'imagenes_id' => 2,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 4,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 5,
                'imagenes_id' => 3,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 6,
                'imagenes_id' => 3,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 7,
                'imagenes_id' => 4,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 8,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 8,
                'imagenes_id' => 4,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 4,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 9,
                'imagenes_id' => 5,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 10,
                'imagenes_id' => 5,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 11,
                'imagenes_id' => 6,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 8,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 12,
                'imagenes_id' => 6,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 4,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 13,
                'imagenes_id' => 7,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 14,
                'imagenes_id' => 7,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 15,
                'imagenes_id' => 8,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 8,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 16,
                'imagenes_id' => 8,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 4,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 17,
                'imagenes_id' => 9,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 18,
                'imagenes_id' => 9,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 19,
                'imagenes_id' => 10,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 8,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 20,
                'imagenes_id' => 10,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 4,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 21,
                'imagenes_id' => 11,
                'tamanhos_id' => 1,
                'preciobs' => '760',
                'preciosus' => '110',
                'disponible' => 10,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 22,
                'imagenes_id' => 11,
                'tamanhos_id' => 2,
                'preciobs' => '860',
                'preciosus' => '125',
                'disponible' => 5,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenestamanhos')->insert($reg);
        }
    }

}
