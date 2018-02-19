<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    protected $table = 'operaciones';
	protected $fillable = ['user_id', 'orden_id', 'codigo_id', 'rt', 'pesos', 'tipo', 'fecha'];

	public function user(){
	    return $this->belongsTo('App\User');
	}
	public function orden(){
	    return $this->belongsTo('App\Orden');
	}
	public function codigo(){
	    return $this->belongsTo('App\Codigo');
	}
}

