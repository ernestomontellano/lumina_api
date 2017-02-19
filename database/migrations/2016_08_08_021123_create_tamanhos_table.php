<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTamanhosTable extends Migration
{

    public function up()
    {
        Schema::create('tamanhos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tamanho', 250);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('tamanhos');
    }

}
