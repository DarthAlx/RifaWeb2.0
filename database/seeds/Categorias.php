<?php

use Illuminate\Database\Seeder;

class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre'=>'Videojuegos',
        ]);
        DB::table('categorias')->insert([
            'nombre'=>'Celulares',
        ]);
    }
}
