<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
     protected $table = 'notificaciones';
	protected $fillable = ['user_id', 'tipo', 'mensaje', 'visto'];

	public function user(){
	    return $this->belongsTo('App\User');
	}
}
