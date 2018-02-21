<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
	protected $fillable = ['sku', 'nombre', 'slug', 'descripcion','habilitado', 'destacado', 'precio', 'precio_especial', 'boletos', 'imagen', 'vendidos', 'minimo', 'fecha_limite','loteria','ganador', 'categoria', 'fundacion', 'multiplicador'];

	public function poplets(){
	    return $this->hasMany('App\Poplets');
	}
	public function relacionados(){
	    return $this->hasMany('App\Relacionados');
	}
	public function slider(){
	    return $this->hasOne('App\Slider');
	}
	public function items(){
	    return $this->hasMany('App\Item');
	}

	public function regalo(){
	    return $this->hasOne('App\Regalo');
	}
}
