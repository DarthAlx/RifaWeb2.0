<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
	protected $fillable = ['sku', 'nombre', 'descripcion','habilitado', 'destacado', 'precio', 'precio_especial', 'boletos', 'imagen', 'vendidos', 'minimo', 'fecha_limite','loteria','ganador', 'categoria'];

	public function poplets(){
	    return $this->hasMany('App\Poplets');
	}
	public function relacionados(){
	    return $this->hasMany('App\Relacionados');
	}
	public function slider(){
	    return $this->hasOne('App\Slider');
	}
}
