<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';
	protected $fillable = ['user_id', 'order_id', 'folio', 'status'];

	public function user(){
	    return $this->belongsTo('App\User');
	}
	public function operacion(){
	    return $this->hasOne('App\Operacion');
	}
	public function items(){
	    return $this->hasMany('App\Item');
	}
}
