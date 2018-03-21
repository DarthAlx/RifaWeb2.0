<?php

namespace App;
use App\Notifications\RecuperaciónDeContraseña;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'tel', 'genero', 'avatar', 'is_admin', 'status', 'rt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialProvider(){
        return $this->hasMany('App\SocialProvider');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RecuperaciónDeContraseña($token));
    }

    public function mensajes(){
        return $this->hasMany('App\Mensaje');
    }
    public function operaciones(){
        return $this->hasMany('App\Operacion')->orderBy('fecha','desc');
    }
    public function ordenes(){
        return $this->hasMany('App\Orden')->orderBy('created_at','desc');
    }
    public function tarjetas(){
        return $this->hasMany('App\Tarjeta');
    }

    public function ganadas(){
        return $this->hasMany('App\Ganador')->orderBy('fecha','desc');
    }
    public function codigos(){
        return $this->hasMany('App\Codigo');
    }
    public function notificaciones(){
        return $this->hasMany('App\Notificacion');
    }
}
