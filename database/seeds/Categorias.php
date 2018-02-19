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
            'slug'=>'videojuegos',
        ]);
        DB::table('categorias')->insert([
            'nombre'=>'Celulares',
            'slug'=>'celulares',
        ]);
        DB::table('categorias')->insert([
            'nombre'=>'Tabletas',
            'slug'=>'tabletas',
        ]);
        DB::table('categorias')->insert([
            'nombre'=>'Relojes',
            'slug'=>'relojes',
        ]);
        DB::table('categorias')->insert([
            'nombre'=>'Audio',
            'slug'=>'audio',
        ]);


        DB::table('fuentes')->insert([
            'nombre'=>'Melate',
            'slug'=>'melate',
        ]);
        DB::table('fuentes')->insert([
            'nombre'=>'Lotería Nacional',
            'slug'=>'loteria-nacional',
        ]);
    }
}
