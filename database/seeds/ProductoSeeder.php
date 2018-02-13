<?php

use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'sku'=>'XBX1',
            'nombre'=>'Xbox One',
            'slug'=>'xbox-one',
            'descripcion'=>'Consola de videojuegos de ultima generación, 1TB de disco duro.',
            'habilitado'=>1,
            'destacado'=>1,
            'precio'=>50,
            'boletos'=>500,
            'imagen'=>'XBX1-1517449728.png',
            'minimo'=>400,
            'fecha_limite'=>'2018-02-15',
            'loteria'=>'Lotería Nacional',
            'categoria'=>'1',
        ]);

        DB::table('productos')->insert([
            'sku'=>'IPDX',
            'nombre'=>'Iphone X',
            'slug'=>'iphone-x',
            'descripcion'=>'Teléfono celular de gama alta de la marca Apple.',
            'habilitado'=>1,
            'destacado'=>1,
            'precio'=>70,
            'boletos'=>800,
            'imagen'=>'IPDX-1517449802.png',
            'minimo'=>700,
            'fecha_limite'=>'2018-02-28',
            'loteria'=>'Melate',
            'categoria'=>'2',
        ]);

        DB::table('productos')->insert([
            'sku'=>'IWCP1',
            'nombre'=>'I Watch',
            'slug'=>'i-watch',
            'descripcion'=>'SmartWatch de la marca apple, se sincroniza con IPhone e IPad.',
            'habilitado'=>1,
            'destacado'=>1,
            'precio'=>40,
            'boletos'=>400,
            'imagen'=>'IWCP1-1517450059.png',
            'minimo'=>350,
            'fecha_limite'=>'2018-02-20',
            'loteria'=>'Melate',
            'categoria'=>'4',
        ]);

        DB::table('productos')->insert([
            'sku'=>'BBSND',
            'nombre'=>'Bocina Bose',
            'slug'=>'bocina-bose',
            'descripcion'=>'Bocina altavoz de la marca Bose, audio de gran calidad.',
            'habilitado'=>1,
            'destacado'=>1,
            'precio'=>20,
            'boletos'=>300,
            'imagen'=>'BBSND-1517450164.png',
            'minimo'=>280,
            'fecha_limite'=>'2018-02-28',
            'loteria'=>'Lotería Nacional',
            'categoria'=>'5',
        ]);


        DB::table('folio')->insert([
            'folio'=>10000
        ]);


            


    }
}
