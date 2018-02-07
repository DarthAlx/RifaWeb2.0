<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->integer('producto_id')->nullable(true);
            $table->string('imagen')->nullable(true);
            $table->string('titulo')->nullable(true);
            $table->string('subtitulo')->nullable(true);
            $table->string('accion')->nullable(true);
            $table->string('enlace')->nullable(true);
            $table->integer('orden');
            $table->collation = 'utf8_spanish_ci';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider');
    }
}
