<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoportesTable extends Migration
{

    public function up()
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('soporte', 250);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('soportes');
    }

}
