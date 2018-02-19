<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Operacion;
use App\Codigo;


class CodigoController extends Controller
{


	public function store(Request $request)
    {
    	$codigo = new Codigo($request->all());
    	$codigo->codigo=strtoupper($request->codigo);
    	$codigo->inicio=date_create($request->inicio);
    	$codigo->fin=date_create($request->fin);
    	if (!$request->user_id) {
    		$codigo->user_id=null;
    	}
    	else{
    		$usuario= User::where('email', $request->user_id)->first();
    		$codigo->user_id=$usuario->id;
    	}



		//guardar
        if ($codigo->save()) {
            Session::flash('mensaje', 'Código publicado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/codigos'))->withInput();
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/codigos'))->withInput();
        }
    }

    public function destroy(Request $request)
        {
          $codigo = Codigo::find($request->eliminar);
          $codigo->delete();
          Session::flash('mensaje', 'Código eliminado con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/codigos/'))->withInput();
        }


    public function update(Request $request){
    	$codigo = Codigo::find($request->id);
        $codigo->codigo=strtoupper($request->codigo);
		$codigo->rt=$request->rt;
		$codigo->inicio=date_create($request->inicio);
    	$codigo->fin=date_create($request->fin);
    	if (!$request->user_id) {
    		$codigo->user_id=null;
    	}else{
    		$usuario= User::where('email', $request->user_id)->first();
    		$codigo->user_id=$usuario->id;
    	}
		$codigo->usos=$request->usos;

		//guardar
        if ($codigo->save()) {
            Session::flash('mensaje', 'Código actualizado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/codigos/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/codigos/'))->withInput();
        }
    }


    public function regalo()
    {

		$usuario=User::find(Auth::user()->id);
		$share=Operacion::where('user_id',$usuario->id)->where('tipo','Share')->orderBy('fecha','desc')->first();

		if ($share) {
			$fecha=date_create($share->fecha);
			$hoy=date_create(date("Y-m-d H:i:s"));
			$interval = date_diff($fecha, $hoy);
			$intervalo = intval($interval->format('%R%a'));
			if ($intervalo>15) {
				$regalo = new Operacion();
		    	$regalo->user_id=Auth::user()->id;
		    	$regalo->rt= 100;
		    	$regalo->pesos= 0;
		    	$regalo->tipo= 'Share';
		    	$regalo->fecha= date_create(date("Y-m-d H:i:s"));
		    	$regalo->orden_id= 0;
		    	$regalo->save();

		    	
		    	$usuario->rt=$usuario->rt+$regalo->rt;
		    	$usuario->save();

		    	echo "
					<div id='modalregalo' class='modal'>
					    <div class='modal-content'>
					      <h4>¡Gracias por compartir!</h4>
					      <p>Recibiste 100 RifaTokens</p>
					      <p>Vuelve en 2 semanas para obtener una nueva recompensa.</p>

					    </div>
					    <div class='modal-footer'>
					    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cancelar</a> 
					    </div>
					  </div>

					  <script type='text/javascript'>
					  $('#modalregalo').modal();
						$('#modalregalo').modal('open');
						console.log('mas15dias');
					  </script>
		    	";
			}

			else{
				echo "
					  <script type='text/javascript'>
						console.log('menos15dias');
					  </script>
		    	";
			}

		}
		else{
			$regalo = new Operacion();
		    	$regalo->user_id=Auth::user()->id;
		    	$regalo->rt= 100;
		    	$regalo->pesos= 0;
		    	$regalo->tipo= 'Share';
		    	$regalo->fecha= date_create(date("Y-m-d H:i:s"));
		    	$regalo->orden_id= 0;
		    	$regalo->save();

		    	
		    	$usuario->rt=$usuario->rt+$regalo->rt;
		    	$usuario->save();

		    	echo "
					<div id='modalregalo' class='modal'>
					    <div class='modal-content'>
					      <h4>¡Gracias por compartir!</h4>
					      <p>Recibiste 100 RifaTokens</p>
					      <p>Vuelve en 2 semanas para obtener una nueva recompensa.</p>

					    </div>
					    <div class='modal-footer'>
					    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cancelar</a> 
					    </div>
					  </div>

					  <script type='text/javascript'>
					  $('#modalregalo').modal();
						$('#modalregalo').modal('open');
						console.log('primer share');
					  </script>
		    	";
		}

    }
}
