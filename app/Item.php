<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
	protected $fillable = ['orden_id','producto_id', 'producto', 'boletos','cantidad', 'precio','fecha'];

	public function orden(){
	    return $this->belongsTo('App\Orden');
	}
	public function productorel(){
	    return $this->belongsTo('App\Producto');
	}
}
