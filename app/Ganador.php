<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganador extends Model
{
    protected $table = 'ganadores';
	protected $fillable = ['user_id','producto', 'loteria', 'imagen', 'boleto', 'fecha'];

	public function user(){
	    return $this->belongsTo('App\User');
	}
}
