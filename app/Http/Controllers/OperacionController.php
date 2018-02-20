<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperacionController extends Controller
{
    public function canjear(Request $request)
    {
    	$codigo = Codigo::where('codigo', $request->codigo)->first();
    	if ($codigo->exists()) {
            $inicio=strtotime($codigo->inicio);
            $fin=strtotime($codigo->fin);
            $ahora=strtotime(date("Y-m-d"));

            if($ahora>=$inicio&&$ahora<=$fin){
                $fechavalida=true;
            }
            else{
                $fechavalida=false;
            }

            if ($codigo->user_id!=null) {
                # code...
            }



    	}
    	$operacion = new Operacion();
    	$operaciones->nombre=ucfirst($request->nombre);
        $operaciones->slug = str_slug($request->nombre, '-');

		//guardar
        if ($operaciones->save()) {
            Session::flash('mensaje', 'Catálogo publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/operacioness'))->withInput();
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/operacioness'))->withInput();
        }
    }
}
