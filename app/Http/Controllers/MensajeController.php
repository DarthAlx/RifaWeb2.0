<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MensajeController extends Controller
{
    public function send(Request $request)
    {
    	$mensaje=new Mensaje($request->all());
    	$mensaje->sender_id=Auth::user()->id;
    	$destinatario= User::where('name', $request->destinatario)->first();
    	$mensaje->user_id=$destinatario->id;
    	$mensaje->fecha=date('Y-m-d');
    	
    	if ($mensaje->save()) {
    		Session::flash('mensaje', 'Mensaje enviado correctamente.');
	        Session::flash('class', 'success');
	        return redirect()->intended(url('/mensajes'))->withInput();
    	}
    	else
    	{
    		Session::flash('mensaje', 'No se pudo enviar el mensaje, intentalo nuevamente.');
	        Session::flash('class', 'danger');
	        return redirect()->intended(url('/enviar-mensaje'))->withInput();
    	}

		
    }
}
