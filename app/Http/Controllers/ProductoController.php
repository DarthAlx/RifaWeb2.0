<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Poplets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'sku' => 'required|string|unique:productos',
            'ganador' => 'required|string|min:3|confirmed'
        ]);
    }
	public function store(Request $request)
    {

    	$producto = new Producto($request->all());
        $producto->nombre=$request->nombre;
        $producto->sku=$request->sku;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->precio_especial=$request->precio_especial;
        $producto->boletos=$request->boletos;
        $producto->minimo=$request->minimo;
        $producto->fecha_limite=date_create($request->fecha_limite);
        

        //categoria
        if (isset($request->categoria)) {
          $producto->categoria=implode(",", $request->categoria);
        }
        else{
            Session::flash('mensaje', 'Selecciona o crea por lo menos una categoría.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
        }

        //habilitado
		if (isset($request->habilitado)) {
			$producto->habilitado=1;
		}
		else{
			$producto->habilitado=0;
		}
        //destacado
        if (isset($request->destacado)) {
            $producto->destacado=1;
        }
        else{
            $producto->destacado=0;
        }

        //producto general
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

        if ($request->ganador||$request->melate) {
            //ganador
        }


        //guardar
        if ($producto->save()) {
            Session::flash('mensaje', 'Producto publicado con exito.');
            Session::flash('class', 'success');
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
        }

        //poplets
        if ($request->poplets) {
            for ($i=1; $i <= intval($request->poplets); $i++) { 
                $poplet = new Poplets();
               if ($request->hasFile('poplet'.$i)) {
                  $file = $request->file('poplet'.$i);

                  if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
                    $name = $request->sku . "-" . $i . "-" . time()."." . $file->getClientOriginalExtension();
                    $path = base_path('uploads/productos/poplets');
                    $file->move($path, $name);
                    $poplet->imagen = $name;
                    $poplet->producto_id = $producto->id;
                    $poplet->save();
                    }


                  else{
                    Session::flash('mensaje', 'El archivo no es una imagen valida.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/productos/nuevo'))->withInput();
                  }

                }
            }
            
        }



        return redirect()->intended(url('/productos'))->withInput();
        



    }
}
