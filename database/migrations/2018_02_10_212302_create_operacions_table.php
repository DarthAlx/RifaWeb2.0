<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('orden_id')->nullable(true);
            $table->integer('codigo_id')->nullable(true);
            $table->bigInteger('rt');
            $table->double('pesos');
            $table->double('iva')->default(0);
            $table->double('impuesto')->default(0);
            $table->string('tipo');
            $table->string('metodo')->nullable(true);

            $table->dateTime('fecha');
            $table->integer('paquete_id')->nullable(true);
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
        Schema::dropIfExists('operaciones');
    }
}
