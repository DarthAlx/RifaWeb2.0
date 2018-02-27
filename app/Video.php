<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
	protected $fillable = ['producto_id', 'video'];

	public function producto(){
	    return $this->belongsTo('App\Producto');
	}
}
