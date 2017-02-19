<?php

use Illuminate\Database\Seeder;

class ContenidosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('contenidos')->delete();
        $regs = array(
            [
                'id' => 1,
                'state' => 'contacto',
                'contenido' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquet purus a ipsum varius, quis molestie odio blandit. Nullam nulla magna, elementum sit amet fringilla quis, ultrices a ipsum.',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('contenidos')->insert($reg);
        }
    }

}
