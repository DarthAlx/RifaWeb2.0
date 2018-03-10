<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paquete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaqueteController extends Controller
{
    public function update(Request $request){
    	$paquete = Paquete::find($request->paquete);
        $paquete->rt=$request->rt;
        $paquete->precio = $request->precio;
        $iva=$request->precio*0.16;
        $impuesto=($request->precio*0.029)+2.5;
        $impuestot=$request->precio*0.035;
        $impuestomasiva=($impuesto*0.16)+$impuesto;
        $impuestotmasiva=($impuestot*0.16)+$impuestot;
        $paquete->iva=round(str_replace(",","",$iva), 2, PHP_ROUND_HALF_UP);
        $paquete->impuesto=round(str_replace(",","",$impuestomasiva), 2, PHP_ROUND_HALF_UP);
        $paquete->impuestot=round(str_replace(",","",$impuestotmasiva), 2, PHP_ROUND_HALF_UP);
        //habilitado
		if (isset($request->habilitado)) {
			$paquete->habilitado=1;
		}
		else{
			$paquete->habilitado=0;
		}
		//guardar
        if ($paquete->save()) {
            Session::flash('mensaje', 'Paquete actualizado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/rifatokens/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/rifatokens/'))->withInput();
        }
    }
}
