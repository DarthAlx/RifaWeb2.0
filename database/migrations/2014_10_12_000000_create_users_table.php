<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60)->default('face_account');
            $table->date('dob');
            $table->string('tel');
            $table->string('genero');
            $table->string('avatar')->default(url('/img/dummy.png'));
            $table->boolean('is_admin')->default(false);
            $table->string('status')->default('Activo');
            $table->bigInteger('rt')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
