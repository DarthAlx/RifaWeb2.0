<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CatalogoController extends Controller
{
    public function store(Request $request)
    {
    	$catalogo = new Categoria($request->all());
    	$catalogo->nombre=ucfirst($request->nombre);
        $catalogo->slug = str_slug($request->nombre, '-');

		//guardar
        if ($catalogo->save()) {
            Session::flash('mensaje', 'Catálogo publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/catalogos'))->withInput();
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/catalogos'))->withInput();
        }
    }



    public function destroy(Request $request)
        {
          $catalogo = Categoria::find($request->eliminar);
          $catalogo->delete();
          Session::flash('mensaje', 'Catálogo eliminado con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/catalogos/'))->withInput();
        }


    public function update(Request $request){
    	 $catalogo = Categoria::find($request->id);
        $catalogo->nombre=ucfirst($request->nombre);
        $catalogo->slug = str_slug($request->nombre, '-');

//guardar
        if ($catalogo->save()) {
            Session::flash('mensaje', 'Catálogo actualizado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/catalogos/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/catalogos/'))->withInput();
        }
    }
    
}
