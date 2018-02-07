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
    	
    	if ($request->tipo=="Individual") {
    		$mensaje=new Mensaje($request->all());
	    	$mensaje->sender_id=Auth::user()->id;
	    	$mensaje->fecha=date('Y-m-d');
    		$destinatario= User::where('name', $request->destinatario)->orWhere('email', $request->destinatario)->first();
    		$mensaje->user_id=$destinatario->id;
    		if ($destinatario) {
	    		if ($mensaje->save()) {
	    		Session::flash('mensaje', 'Mensaje enviado correctamente.');
		        Session::flash('class', 'success');
		        return redirect()->intended(url('/mensajes'))->withInput();
		    	}
		    	else
		    	{
		    		Session::flash('mensaje', 'No se pudo enviar el mensaje, intentalo nuevamente.');
			        Session::flash('class', 'danger');
			        return redirect()->intended(url('/mensajes'))->withInput();
		    	}
	    	}
	    	else{
	    		Session::flash('mensaje', 'No se puede encontrar al destinatario.');
		        Session::flash('class', 'danger');
		        return redirect()->intended(url('/mensajes'))->withInput();
	    	}
    	}
    	elseif ($request->tipo=="Masivo") {
    		$destinatarios= User::where('is_admin', 0)->get();
    		foreach ($destinatarios as $destinatario) {
    			$mensaje=new Mensaje($request->all());
		    	$mensaje->sender_id=Auth::user()->id;
		    	$mensaje->fecha=date('Y-m-d');
    			$mensaje->user_id=$destinatario->id;
	    		$mensaje->save();
		    		
			        
    		}
    		Session::flash('mensaje', 'Mensaje enviado correctamente.');
			Session::flash('class', 'success');
    		return redirect()->intended(url('/mensajes'))->withInput();
    		
    	}
    	
    	
    	

		
    }

    public function read(Request $request)
    {
		$mensaje=Mensaje::find($request->mensaje);
		$mensaje->leido=1;
		$mensaje->save();

    }
}
