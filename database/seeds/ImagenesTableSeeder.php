<?php

use Illuminate\Database\Seeder;

class ImagenesTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('imagenes')->delete();
        $regs = array(
            [
                'id' => 1,
                'nombre' => 'catalogo1',
                'codigo' => 'c1',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo1.jpg',
                'descripcion' => 'catalogo1',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'nombre' => 'catalogo2',
                'codigo' => 'c2',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo2.jpg',
                'descripcion' => 'catalogo2',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 3,
                'nombre' => 'catalogo3',
                'codigo' => 'c3',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo3.jpg',
                'descripcion' => 'catalogo3',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 4,
                'nombre' => 'catalogo4',
                'codigo' => 'c4',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo4.jpg',
                'descripcion' => 'catalogo4',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 5,
                'nombre' => 'catalogo5',
                'codigo' => 'c5',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo5.jpg',
                'descripcion' => 'catalogo5',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 6,
                'nombre' => 'catalogo6',
                'codigo' => 'c6',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo6.jpg',
                'descripcion' => 'catalogo6',
                'fotografos_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 7,
                'nombre' => 'catalogo7',
                'codigo' => 'c7',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo7.jpg',
                'descripcion' => 'catalogo7',
                'fotografos_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 8,
                'nombre' => 'catalogo8',
                'codigo' => 'c8',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo8.jpg',
                'descripcion' => 'catalogo8',
                'fotografos_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 9,
                'nombre' => 'catalogo9',
                'codigo' => 'c9',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo9.jpg',
                'descripcion' => 'catalogo9',
                'fotografos_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 10,
                'nombre' => 'catalogo10',
                'codigo' => 'c10',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo10.jpg',
                'descripcion' => 'catalogo10',
                'fotografos_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 11,
                'nombre' => 'catalogo11',
                'codigo' => 'c11',
                'imagen' => 'http://localhost:8000/archivos/imagenes/catalogo11.jpg',
                'descripcion' => 'catalogo11',
                'fotografos_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenes')->insert($reg);
        }
    }

}
