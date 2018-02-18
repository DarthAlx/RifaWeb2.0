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
    	$regalo = new Operacion();
    	$regalo->user_id=Auth::user()->id;
    	$regalo->rt= 100;
    	$regalo->tipo= 'Share';
    	$regalo->fecha= date_create(date("Y-m-d H:i:s"));
    	$regalo->save();

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
				$('#regalo').modal('open');
			  </script>
    	";
    }
}
