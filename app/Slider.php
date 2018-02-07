<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
	protected $fillable = ['tipo', 'producto_id', 'imagen','titulo', 'subtitulo', 'accion', 'slider', 'orden'];

	public function producto(){
	    return $this->BelongsTo('App\Producto');
	}
}
