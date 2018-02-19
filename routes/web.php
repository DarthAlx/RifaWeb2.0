<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/1', function () {
    	$usuario=App\User::find(Auth::user()->id);
		$share=App\Operacion::where('user_id',$usuario->id)->where('tipo','Share')->orderBy('fecha','desc')->first();

		if ($share) {
			$fecha=date_create($share->fecha);
			$hoy=date_create(date("Y-m-d H:i:s"));
			$interval = date_diff($fecha, $hoy);
			$intervalo = intval($interval->format('%R%a'));
			if ($intervalo>15) {
				$regalo = new App\Operacion();
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
						console.log(".$intervalo.");
					  </script>
		    	";
			}
			else{
				echo "
					  <script type='text/javascript'>
						console.log(".$intervalo.");
					  </script>
		    	";
			}

		}
});





Route::get('/', function () {
	
	$productos=App\Producto::where('destacado',1)->orderBy('nombre','asc')->get();
	$slides=App\Slider::orderBy('orden','asc')->get();
	return view('inicio2', ['productos'=>$productos,'slides'=>$slides]);
    return view('inicio');

     
});



Route::get('/rifas/{catalogo}', function ($catalogo) {
	$categoria=App\Categoria::where('slug',$catalogo)->first();
	$fuente=App\Fuente::where('slug',$catalogo)->first();
	$categorias=App\Categoria::orderBy('nombre','asc')->get();
	$fuentes=App\Fuente::orderBy('nombre','asc')->get();
	if ($categoria) {
		$productos=App\Producto::where('categoria', 'like', '%'.$categoria->id.'%')->paginate(20);
		return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
	}
	elseif ($fuente) {
		$productos=App\Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->paginate(20);
		return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
	}
	else{
		return redirect()->intended(url('/404'));
	}
	
});

Route::post('rifas/{catalogo}', 'ProductoController@searchcatalogo');

Route::get('/rifas', function () {
	$catalogo="Todos";
	$categorias=App\Categoria::orderBy('nombre','asc')->get();
	$fuentes=App\Fuente::orderBy('nombre','asc')->get();
	$productos=App\Producto::orderBy('nombre','asc')->paginate(20);
	return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'catalogo'=>$catalogo,'fuentes'=>$fuentes]);
});



Route::post('rifas', 'ProductoController@search');

Route::post('carrito', 'OrdenController@addtocart');
Route::get('/carrito', function () {
  $items=Cart::content();
  
  return view('carrito',['items'=>$items]);
});

Route::get('/checkout', function () {
  $items=Cart::content();
  return view('checkout',['items'=>$items]);
});
Route::post('checkout', 'OrdenController@cargo');

 Route::get('removefromcart/{id}', 'OrdenController@destroy');
 Route::post('removefromcartpost', 'OrdenController@destroypost');

  Route::post('updatecart', 'OrdenController@updatecart');
  Route::post('updatecartpost', 'OrdenController@updatecartpost');
  Route::post('carritopost', 'OrdenController@addtocartpost');


Route::get('/perfil', function () {
    return view('perfil');
})->middleware('auth');

Route::post('cambiar-contrasena-user', 'UserController@changepassuser')->middleware('auth');

Route::get('/rifa/{slug}', function ($slug) {
	$producto=App\Producto::where('slug',$slug)->first();
    return view('producto',['producto'=>$producto]);
});


Route::post('leermensaje', 'MensajeController@read')->middleware('auth');


Route::delete('eliminar-tarjeta', 'TarjetaController@destroy')->middleware('auth');

Route::post('traertarjeta', 'TarjetaController@traertarjeta')->middleware('auth');

Route::post('regalo', 'CodigoController@regalo')->middleware('auth');



// Authentication routes...
Route::get('entrar', 'Auth\LoginController@showLoginForm');
Route::post('entrar', 'Auth\LoginController@login');

Route::get('acceso', 'RolesController@index');

Route::get('/salir', function () {
    Auth::logout();
    return redirect()->intended('/');
})->middleware('auth');

// Registration routes...
Route::get('registro', 'Auth\RegisterController@showRegistrationForm');
Route::post('registro', 'Auth\RegisterController@register');


Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Facebook

Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/retorno', 'Auth\LoginController@handleProviderCallback');



Route::group(['middleware' => 'admin'], function(){


	Route::get('/admin', function () {
		$month = date('m');
	      $year = date('Y');
	      $from= date('Y-m-d', mktime(0,0,0, $month, 1, $year));
	      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
	      $to = date('Y-m-d', mktime(0,0,0, $month, $day, $year));

		$ventas=App\Operacion::whereBetween('fecha', array($from, $to))->sum('pesos');
		$rt=App\Operacion::whereBetween('fecha', array($from, $to))->sum('rt');
		$boletos=App\Item::whereBetween('created_at', array($from, $to))->sum('cantidad');
		$usuarios=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->count();
		$mujeres=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('genero','Femenino')->count();
		$hombres=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('genero','Masculino')->count();
		$productos=App\Producto::all();
		$boletos1=array();
		$labels="";
		$data=array();
		foreach ($productos as $producto) {
			$items=App\Item::whereBetween('created_at', array($from, $to))->where('producto_id',$producto->id)->sum('cantidad');
			$boletos1[]=array('nombre' => $producto->nombre, 'boletos' => $items);
			
		}
		foreach ($boletos1 as $boleto) {
			$labels.="'".$boleto['nombre']."',";
			$data[]=intval($boleto['boletos']);
		}

			
	
    	return view('admin', ['ventas'=>$ventas,'boletos'=>$boletos,'rt'=>$rt,'usuarios'=>$usuarios,'mujeres'=>$mujeres,'hombres'=>$hombres,'labels'=>$labels,'data'=>$data,'from'=>$from,'to'=>$to]);
	});

	Route::post('admin', 'HomeController@admin');

	Route::get('/productos', function () {
		$productos=App\Producto::orderBy('nombre','asc')->get();
	    return view('admin.productos', ['productos'=>$productos]);
	});

	Route::get('/productos/nuevo', function () {
		$categorias=App\Categoria::orderBy('nombre','asc')->get();
		$loterias=App\Fuente::orderBy('nombre','asc')->get();
	    return view('admin.productonuevo', ['categorias'=>$categorias,'loterias'=>$loterias]);
	});

	Route::get('/producto/{id}', function ($id) {
		$producto=App\Producto::find($id);
		$categorias=App\Categoria::orderBy('nombre','asc')->get();
		$loterias=App\Fuente::orderBy('nombre','asc')->get();
		if ($producto) {
			return view('admin.productosupdate', ['categorias'=>$categorias,'producto'=>$producto,'loterias'=>$loterias]);
		}
		else{
			return redirect()->intended(url('/404'));
		}
	    
	});

	Route::post('agregar-producto', 'ProductoController@store');
	Route::post('producto/{id}', 'ProductoController@update');

	Route::delete('eliminar-producto', 'ProductoController@destroy');



	Route::post('agregar-catalogo', 'CatalogoController@store');

	Route::get('/catalogos', function () {
		$catalogos=App\Categoria::orderBy('nombre','asc')->get();
	    return view('admin.catalogos', ['catalogos'=>$catalogos]);
	});

	Route::delete('eliminar-catalogo', 'CatalogoController@destroy');

	Route::post('actualizar-catalogo', 'CatalogoController@update');


	Route::post('agregar-loteria', 'LoteriaController@store');

	Route::get('/loterias', function () {
		$loterias=App\Fuente::orderBy('nombre','asc')->get();
	    return view('admin.loterias', ['loterias'=>$loterias]);
	});

	Route::delete('eliminar-loteria', 'LoteriaController@destroy');

	Route::post('actualizar-loteria', 'LoteriaController@update');

	Route::get('/mensajes', function () {
		$mensajes=App\Mensaje::orderBy('created_at','desc')->get();
		$usuarios=App\User::where('is_admin',0)->where('status','Activo')->orderBy('name','asc')->get();
		if ($usuarios) {
			$string = "{";
			foreach ($usuarios as $usuario) {
				$string .="'".$usuario->name."'".":"."'".$usuario->avatar."',"."'".$usuario->email."'".":"."'".$usuario->avatar."',";
	        }
	        $string.="}";
	        $usuariosjson=json_encode($string);
		}
	  
		    return view('admin.mensajes', ['mensajes'=>$mensajes,'usuarios'=>$usuariosjson]);
		
		
	});


	Route::post('enviar-mensaje', 'MensajeController@send');



	Route::get('/slider', function () {
		$slides=App\Slider::orderBy('orden','asc')->get();
		$productos=App\Producto::where('habilitado',1)->orderBy('nombre','asc')->get();
		if (!$productos->isEmpty()) {
			$string = "{";
			foreach ($productos as $producto) {
				$string .="'".$producto->nombre."'".":"."'".url('uploads/productos')."/".$producto->imagen."',";
	        }
	        $string.="}";
	        $productojson=json_encode($string);
		}
	    return view('admin.slider', ['slides'=>$slides,'productos'=>$productojson]);
	});
	Route::post('agregar-slide', 'SliderController@store');

	

	Route::delete('eliminar-slide', 'SliderController@destroy');

	Route::post('actualizar-slide', 'SliderController@update');


	Route::get('/crm', function () {
		$usuarios=App\User::where('is_admin',0)->where('status','Activo')->orderBy('name','asc')->get();
	    return view('admin.usuarios', ['usuarios'=>$usuarios]);
	});

	Route::get('/usuario/{id}', function ($id) {
		$usuario=App\User::find($id);
		if ($usuario) {
			return view('admin.usuario', ['usuario'=>$usuario]);
		}
		else{
			return redirect()->intended(url('/404'));
		}
	    
	});

	Route::get('/ordenes', function () {
		$ordenes=App\Orden::all();
	    return view('admin.ordenes', ['ordenes'=>$ordenes]);
	});

	Route::get('/ganadores', function () {
		$ganadores=App\Ganador::all();
	    return view('admin.ganadores', ['ganadores'=>$ganadores]);
	});



	Route::post('cambiar-contrasena', 'UserController@changepass');

	Route::delete('eliminar-usuario', 'UserController@destroy');

	Route::post('asignar-ganador', 'ProductoController@ganador');

});


