<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Operacion;
use App\Codigo;
use App\Regalo;
use App\Orden;
use App\Producto;
use App\Item;


class CodigoController extends Controller
{


	public function store(Request $request)
    {
    	$codigo = new Codigo($request->all());
    	$codigo->codigo=strtoupper($request->codigo);
    	$codigo->inicio=date_create($request->inicio);
    	$codigo->fin=date_create($request->fin);
    	if (!isset($request->users)) {
    		$codigo->users=null;
    	}
    	else{
    		$codigo->users=implode(",",$request->users);
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
    	if (!isset($request->users)) {
    		$codigo->users=null;
    	}
    	else{
    		$codigo->users=implode(",",$request->users);
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

    public function regalo_update(Request $request)
    {
    	$regalo=Regalo::find(1);

    	if ($regalo) {
    		$regalo->tipo=$request->tipo;
    		$regalo->dias=$request->dias;
    		if ($request->tipo=="Share") {
    			$regalo->rt=$request->rt;
    			$regalo->producto_id=null;
    			$regalo->boletos=null;
    		}
    		else{
    			$producto=Producto::where('nombre',$request->producto)->first();
				$regalo->rt=null;
    			$regalo->producto_id=$producto->id;;
    			$regalo->boletos=$request->boletos;
    		}
    		# code...
    	}
    	else{
    		$regalo=new Regalo($request->all());

    	}

    	
    	//guardar
        if ($regalo->save()) {
            Session::flash('mensaje', 'Regalo actualizado con exito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/regalo-update/'))->withInput();
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/regalo-update/'))->withInput();
        }



    }


    public function regalo()
    {

		$usuario=User::find(Auth::user()->id);
		$gift=Regalo::first();
		if ($gift->tipo=="Share") {
			$share=Operacion::where('user_id',$usuario->id)->where('tipo','Share')->orderBy('fecha','desc')->first();

			if ($share) {
				$fecha=date_create($share->fecha);
				$hoy=date_create(date("Y-m-d H:i:s"));
				$interval = date_diff($fecha, $hoy);
				$intervalo = intval($interval->format('%R%a'));
				if ($intervalo>$gift->dias) {
					$regalo = new Operacion();
			    	$regalo->user_id=Auth::user()->id;
			    	$regalo->rt= $gift->rt;
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
						      <p>Vuelve en ".$gift->dias. " días para obtener una nueva recompensa.</p>

						    </div>
						    <div class='modal-footer'>
						    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cerrar</a> 
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
			    	$regalo->rt= $gift->rt;
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
						      <p>Vuelve en ".$gift->dias. " días para obtener una nueva recompensa.</p>

						    </div>
						    <div class='modal-footer'>
						    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cerrar</a> 
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
		elseif ($gift->tipo=="Ticket"){
			$product = Producto::find($gift->producto_id);
		

			$hayproduct = Producto::find($product->id);
          $hayboletos=(intval($hayproduct->vendidos)+(1*$hayproduct->multiplicador))<=intval($hayproduct->boletos);
          if (!$hayboletos) {
            Session::flash('mensaje', 'Lo sentimos, los boletos para '.$product->name.' se han terminado.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/carrito'))->withInput();

          }//hayboletos

	



			$operacion=Operacion::where('user_id',$usuario->id)->where('tipo','TicketGift')->orderBy('fecha','desc')->first();

			if ($operacion) {

				$orden=$ticket->orden;
	            foreach ($orden->items as $item) {
	                if ($item->producto==$product->nombre&&$item->fecha==$product->fecha_limite) {
	                    $yaregalado=true;
	                    break;
	                }
	                else{
	                    $yaregalado=false;
	                }
	            }



				$fecha=date_create($ticket->fecha);
				$hoy=date_create(date("Y-m-d H:i:s"));
				$interval = date_diff($fecha, $hoy);
				$intervalo = intval($interval->format('%R%a'));
				if (!$yaregalado&&$intervalo>$gift->dias) {
					$folio=Folio::first();
		            $guardar = new Orden();
		            $guardar->order_id="Regalo";
		            $guardar->folio="W".$folio->folio;
		            $guardar->user_id=Auth::user()->id;
		            $guardar->status='Regalo';
		            $guardar->save();

	

		            $regalo = new Operacion();
			    	$regalo->user_id=Auth::user()->id;
			    	$regalo->rt= 0;
			    	$regalo->pesos= 0;
			    	$regalo->tipo= 'TicketGift';
			    	$regalo->fecha= date_create(date("Y-m-d H:i:s"));
			    	$regalo->orden_id= $guardar->id;
			    	$regalo->save();


		             
		            
		            $boletos = $product->boletos;
		            $digitos = strlen(intval($boletos));

		            
		            $vendidos = $product->vendidos;
		            $tickets = array();

		            for ($i=$product->vendidos; $i <= ($product->vendidos+$gift->boletos)*$product->multiplicador; $i++) { 
		              $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
		              $tickets[]="t".$numero."t";
		            }

		            $product->vendidos=$vendidos+$gift->boletos;
		            $product->save();
		            
		            $item = new Item();
		            $item->orden_id = $guardar->id;
		            $item->producto = $product->nombre;
		            $item->producto_id = $product->id;
		            $item->boletos = implode(",", $tickets);
		            $item->cantidad = $gift->boletos;
		            $item->precio = 0;
		            $item->fecha = date_create($product->fecha_limite);
		            $item->save();

		            $folio->folio++;
          			$folio->save();

			    	echo "
						<div id='modalregalo' class='modal'>
						    <div class='modal-content'>
						      <h4>¡Gracias por compartir!</h4>
						      <p>Recibiste ".$gift->boletos. " boletos para la rifa de ".$product->nombre.".</p>
						      <p>Vuelve en ".$gift->dias. " días para obtener una nueva recompensa.</p>

						    </div>
						    <div class='modal-footer'>
						    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cerrar</a> 
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
						<div id='modalregalo' class='modal'>
						    <div class='modal-content'>
						      <h4>Ya estás participando en esta rifa.</h4>
						      
						      <p>Vuelve en ".$gift->dias. " días para obtener una nueva recompensa.</p>

						    </div>
						    <div class='modal-footer'>
						    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cerrar</a> 
						    </div>
						  </div>

						  <script type='text/javascript'>
						  $('#modalregalo').modal();
							$('#modalregalo').modal('open');
							console.log('menos15dias');
						  </script>
			    	";
				}

			}
			else {
				$guardar = new Orden();
		            $guardar->order_id="Regalo";
		            $guardar->folio=0;
		            $guardar->user_id=Auth::user()->id;
		            $guardar->status='Regalo';
		            $guardar->save();


		            $regalo = new Operacion();
			    	$regalo->user_id=Auth::user()->id;
			    	$regalo->rt= 0;
			    	$regalo->pesos= 0;
			    	$regalo->tipo= 'TicketGift';
			    	$regalo->fecha= date_create(date("Y-m-d H:i:s"));
			    	$regalo->orden_id= $guardar->id;
			    	$regalo->save();


		             
		            $product = Producto::find($gift->producto_id);
		            $boletos = $product->boletos;
		            $digitos = strlen(intval($boletos));

		            
		            $vendidos = $product->vendidos;
		            $tickets = array();

		            for ($i=$product->vendidos+1; $i <= ($product->vendidos+($gift->boletos*$product->multiplicador))-1; $i++) { 
		              $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
		              $tickets[]="t".$numero."t";
		            }

		            $product->vendidos=$vendidos+$gift->boletos;
		            $product->save();
		            
		            $item = new Item();
		            $item->orden_id = $guardar->id;
		            $item->producto = $product->nombre;
		            $item->producto_id = $product->id;
		            $item->boletos = implode(",", $tickets);
		            $item->cantidad = $gift->boletos;
		            $item->precio = 0;
		            $item->fecha = date_create($product->fecha_limite);
		            $item->save();

			    	echo "
						<div id='modalregalo' class='modal'>
						    <div class='modal-content'>
						      <h4>¡Gracias por compartir!</h4>
						      <p>Recibiste ".$gift->boletos. " boletos para la rifa de ".$product->nombre.".</p>
						      <p>Vuelve en ".$gift->dias. " días para obtener una nueva recompensa.</p>

						    </div>
						    <div class='modal-footer'>
						    	<a href='#!' class='modal-action modal-close waves-effect waves-green btn'>Cerrar</a> 
						    </div>
						  </div>

						  <script type='text/javascript'>
						  $('#modalregalo').modal();
							$('#modalregalo').modal('open');
							console.log('mas15dias');
						  </script>
			    	";
			}



		}
		
    }
}
