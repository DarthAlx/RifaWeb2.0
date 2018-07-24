<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trivia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TriviaController extends Controller
{
    public function store(Request $request)
    {
    	$trivia = new Trivia($request->all());
		//guardar
        if ($trivia->save()) {
            Session::flash('mensaje', 'Trivia publicada con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/trivias'));
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/trivias'))->withInput();
        }
    }



    public function destroy(Request $request)
        {
          $trivia = Trivia::find($request->eliminar);
          $trivia->delete();
          Session::flash('mensaje', 'Trivia eliminada con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/trivias/'));
        }


    public function update(Request $request){
    	$trivia = Trivia::find($request->id);
        $trivia->pregunta=$request->pregunta;
        $trivia->a=$request->a;
        $trivia->b=$request->b;
        $trivia->c=$request->c;
        $trivia->respuesta=$request->respuesta;

//guardar
        if ($trivia->save()) {
            Session::flash('mensaje', 'Trivia actualizada con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/trivias/'));
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/trivias/'))->withInput();
        }
    }
}
