<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
	protected $fillable = ['orden_id','producto_id', 'producto', 'boletos'];

	public function orden(){
	    return $this->hasOne('App\Orden');
	}
}
