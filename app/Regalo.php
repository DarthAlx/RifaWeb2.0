<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regalo extends Model
{
        protected $table = 'regalo';
	protected $fillable = ['tipo', 'rt', 'producto_id', 'boletos','dias'];

	public function producto(){
	    return $this->belongsTo('App\Producto');
	}
	
}
