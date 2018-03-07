<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';
	protected $fillable = ['rt', 'precio','iva','impuesto','impuestot'];

	public function operacion(){
	    return $this->hasMany('App\Operacion');
	}
}
