<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fuente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoteriaController extends Controller
{
    public function store(Request $request)
    {
    	$loteria = new Fuente($request->all());
    	$loteria->nombre=ucfirst($request->nombre);
        $loteria->slug = str_slug($request->nombre, '-');

		//guardar
        if ($loteria->save()) {
            Session::flash('mensaje', 'Lotería publicada con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/loterias'))->withInput();
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/loterias'))->withInput();
        }
    }



    public function destroy(Request $request)
        {
          $loteria = Fuente::find($request->eliminar);
          $loteria->delete();
          Session::flash('mensaje', 'Lotería eliminada con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/loterias/'))->withInput();
        }


    public function update(Request $request){
    	 $loteria = Fuente::find($request->id);
        $loteria->nombre=ucfirst($request->nombre);
        $loteria->slug = str_slug($request->nombre, '-');
//guardar
        if ($loteria->save()) {
            Session::flash('mensaje', 'Lotería actualizada con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/loterias/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/loterias/'))->withInput();
        }
    }
}
