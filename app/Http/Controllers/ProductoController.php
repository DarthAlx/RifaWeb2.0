<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
	public function store(Request $request)
    {
    	$producto = new Producto($request->all());
        $producto->nombre=$request->nombre;
        $producto->sku=$request->sku;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->precio_especial=$request->precio_especial;
        $producto->boletos=$request->boletos;
        $producto->vendidos=$request->vendidos;
        $producto->minimo=$request->minimo;
        $producto->fecha_limite=date_create($request->fecha_limite);
        $producto->categoria=$request->categoria;

        
		if (isset($request->categoria)) {
			$categorias="";
			foreach ($request->categoria as $categoria) {
				$categorias.=$categoria;
			}
		}
		else{
			$producto->habilitado=0;
		}

		if (isset($request->habilitado)) {
			$producto->habilitado=1;
		}
		else{
			$producto->habilitado=0;
		}

        if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = $request->sku . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/productos/');
            $file-> move($path, $name);
            $producto->imagen = $name;
            }


          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
          }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/productos/nuevo'))->withInput();
        }


        if ($producto->save()) {
        	Session::flash('mensaje', 'Producto publicado con exito.');
          	Session::flash('class', 'success');
          	return redirect()->intended(url('/productos'))->withInput();
        }
        else{
        	Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
        }
    }
}
