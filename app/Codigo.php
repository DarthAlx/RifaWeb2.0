<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    protected $table = 'codigos';
	protected $fillable = [ 'codigo','rt','user_id', 'inicio', 'fin', 'usos'];

	public function user(){
	    return $this->belongsTo('App\User');
	}

	public function aplicaciones(){
	    return $this->hasMany('App\Operacion');
	}
}
