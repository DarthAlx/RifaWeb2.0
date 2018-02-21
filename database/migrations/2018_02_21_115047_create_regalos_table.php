<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegalosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regalo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->integer('rt')->nullable(true);
            $table->integer('producto_id')->nullable(true);
            $table->integer('boletos')->nullable(true);
            $table->integer('dias');
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
        Schema::dropIfExists('regalo');
    }
}
