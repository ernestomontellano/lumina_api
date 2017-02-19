<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('usuarios')->delete();
        $regs = array(
            [
                'id' => 1,
                'email' => 'admin@lumina.gallery',
                'password' => 'admin',
                'nombre' => 'admin',
                'apellido' => 'admin',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('usuarios')->insert($reg);
        }
    }

}
