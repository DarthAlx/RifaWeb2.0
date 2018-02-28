<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancelada extends Model
{
    protected $table = 'canceladas';
	protected $fillable = ['user_id', 'orden_id', 'producto', 'rt','minimo','vendidos', 'fecha'];

	public function user(){
	    return $this->belongsTo('App\User');
	}
	public function orden(){
	    return $this->belongsTo('App\Orden');
	}


}
