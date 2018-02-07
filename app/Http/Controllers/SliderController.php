<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function store(Request $request)
    {
    	$slide = new Slider();
    	$tipo = $request->tipo;
    	$slide->tipo=$tipo;

    	if($tipo=="Producto"){
    		$producto=Producto::where('nombre',$request->producto_id)->first();
    		$slide->producto_id=$producto->id;
    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}

    	if($tipo=="Texto"){
    		$slide->titulo=$request->titulo;
    		$slide->subtitulo=$request->subtitulo;
    		$slide->accion=$request->accion;
    		$slide->enlace=$request->enlace;
    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}

    	if($tipo=="Imagen"){


		if ($request->hasFile('imagen')) {
          	$file = $request->file('imagen');
          	if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
	            $name = $request->orden . "-". time()."." . $file->getClientOriginalExtension();
	            $path = base_path('uploads/slider/');
	            $file-> move($path, $name);
	            $slide->imagen = $name;
            }


	        else{
	            Session::flash('mensaje', 'El archivo no es una imagen valida.');
	            Session::flash('class', 'danger');
	            return redirect()->intended(url('/slider'))->withInput();
	        }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/slider'))->withInput();
        }
        	$slide->enlace=$request->enlace;
    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}


    
    }



    public function destroy(Request $request)
        {
          $slide = Slider::find($request->eliminar);
          $slide->delete();
          Session::flash('mensaje', 'Slide eliminado con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
        }


    public function update(Request $request){
    	 $slide = Fuente::find($request->id);
        $slide->nombre=ucfirst($request->nombre);
//guardar
        if ($slide->save()) {
            Session::flash('mensaje', 'Lotería actualizada con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slides/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/slides/'))->withInput();
        }










        $slide = Slider::find($request->id);
    	$tipo = $request->tipo;
    	$slide->tipo=$tipo;

    	if($tipo=="Producto"){
    		$slide->producto_id=$request->id;
    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}

    	elseif($tipo=="Texto"){
    		$slide->titulo=$request->titulo;
    		$slide->subtitulo=$request->subtitulo;
    		$slide->accion=$request->accion;
    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}

    	elseif($tipo=="Imagen"){


		if ($request->hasFile('imagen')) {
          	$file = $request->file('imagen');
          	if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
	            $name = $request->orden . "-". time()."." . $file->getClientOriginalExtension();
	            $path = base_path('uploads/slider/');
	            File::delete($path . $slide->imagen);
	            $file-> move($path, $name);
	            $slide->imagen = $name;
            }


	        else{
	            Session::flash('mensaje', 'El archivo no es una imagen valida.');
	            Session::flash('class', 'danger');
	            return redirect()->intended(url('/slider'))->withInput();
	        }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/slider'))->withInput();
        }

    		$slide->orden=$request->orden;
    		$slide->save();
    		Session::flash('mensaje', 'Slide publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slider'))->withInput();
    	}
    	else{
    		Session::flash('mensaje', 'Algo salió mal.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/slider'))->withInput();
    	}
    }
}
