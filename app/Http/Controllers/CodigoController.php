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
    public function regalo()
    {

		$usuario=User::find(Auth::user()->id);
		$share=Operacion::where('user_id',$usuario->id)->where('tipo','Share')->orderBy('fecha','desc')->first();

		if ($share) {
			$fecha=date_create($share->fecha);
			$hoy=date_create(date("Y-m-d H:i:s"));
			$interval = date_diff($hoy, $fecha);
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
