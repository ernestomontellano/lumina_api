<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtiquetasTable extends Migration
{

    public function up()
    {
        Schema::create('etiquetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('etiqueta', 50);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('etiquetas');
    }

}
