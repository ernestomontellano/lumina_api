<?php

use Illuminate\Database\Seeder;

class FotografosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('fotografos')->delete();
        $regs = array(
            [
                'id' => 1,
                'nombre' => 'Sebastián Ormachea',
                'biografia' => '<p>Su trabajo siempre se basa en la forma en que ve el mundo, tratando de retratar la realidad y congelar momentos únicos, como fotógrafo documentalista y editorial se concentra en crear imágenes con mucha energía y un estilo especial.<br>Con su fotografía autoral trata de representar su vida personal: "lo que soy y lo que siento" Siempre está en la búsqueda de oportunidades que lo lleven a lugares nuevos, lo que se refleja en la variedad y diversidad de sus imágenes.</p>',
                'imagen' => 'http://localhost:8000/archivos/fotografos/foto-sebas.png',
                'soportes_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'nombre' => 'Tony Suarez',
                'biografia' => '<p>Su trabajo siempre se basa en la forma en que ve el mundo, tratando de retratar la realidad y congelar momentos únicos, como fotógrafo documentalista y editorial se concentra en crear imágenes con mucha energía y un estilo especial.<br>Con su fotografía autoral trata de representar su vida personal: "lo que soy y lo que siento" Siempre está en la búsqueda de oportunidades que lo lleven a lugares nuevos, lo que se refleja en la variedad y diversidad de sus imágenes.</p>',
                'imagen' => 'http://localhost:8000/archivos/fotografos/foto-tony.jpg',
                'soportes_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('fotografos')->insert($reg);
        }
    }

}
