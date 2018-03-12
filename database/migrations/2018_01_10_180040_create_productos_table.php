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
            $table->bigIncrements('id');
            $table->string('sku');
            $table->string('nombre');
            $table->string('slug');
            $table->longText('descripcion');
            $table->boolean('habilitado')->default(true);
            $table->boolean('destacado')->default(false);
            $table->boolean('gratuito')->default(false);
            $table->string('precio');
            $table->string('precio_especial')->nullable(true);
            $table->integer('boletos');
            $table->integer('vendidos')->default(0);
            $table->string('imagen');
            $table->integer('minimo');
            $table->dateTime('fecha_limite');
            $table->string('loteria');
            $table->string('ganador')->nullable(true);
            $table->string('categoria');
            $table->string('fundacion')->nullable(true);
            $table->integer('multiplicador')->default(1);
            $table->timestamps();
            $table->collation = 'utf8_spanish_ci';
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
