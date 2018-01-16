<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('nombre');
            $table->string('descripcion');
            $table->boolean('habilitado')->default(true);
            $table->string('precio');
            $table->string('precio_especial')->nullable(true);
            $table->integer('boletos');
            $table->integer('vendidos')->default(0);
            $table->string('imagen');
            $table->integer('minimo');
            $table->date('fecha_limite');
            $table->string('categoria');
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
        Schema::dropIfExists('productos');
    }
}
