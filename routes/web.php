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


Route::post('/webhook', function () {
	$ganadores=App\Ganador::orderBy('created_at','desc')->get();
    	return view('ganadores', ['ganadores'=>$ganadores]);
});
//Route::get('regalo', 'CodigoController@regalo');





Route::get('/', function () {
	
	$productos=App\Producto::where('destacado',1)->orderBy('nombre','asc')->where('habilitado',1)->get();
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
		$productos=App\Producto::where('categoria', 'like', '%'.$categoria->id.'%')->where('habilitado',1)->paginate(20);
		return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
	}
	elseif ($fuente) {
		$productos=App\Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->where('habilitado',1)->paginate(20);
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
	$productos=App\Producto::orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
	return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'catalogo'=>$catalogo,'fuentes'=>$fuentes]);
});



Route::post('rifas', 'ProductoController@search');


Route::get('/rifas-ganadas', function () {
	$ganadores=App\Ganador::orderBy('created_at','desc')->get();
    	return view('ganadores', ['ganadores'=>$ganadores]);
});
Route::get('/regalar/{id}', 'ProductoController@regalarboleto')->middleware('auth');;

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

Route::get('/canjear', function () {
	$codigo="";
    return view('canjear', ['codigo'=>$codigo]);
})->middleware('auth');

Route::post('canjear', 'OperacionController@canjear')->middleware('auth');


Route::get('/canjear/{id}', function ($id) {
		$codigo=$id;

		return view('canjear', ['codigo'=>$codigo]);

	    
	});



Route::post('cambiar-contrasena-user', 'UserController@changepassuser')->middleware('auth');

Route::get('/rifa/{slug}', function ($slug) {
	$producto=App\Producto::where('slug',$slug)->where('habilitado',1)->first();
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
	      $day = date('d');
	      $from= date('Y-m-d', mktime(0,0,0, 1, 1, $year));
	      $day = date("d", mktime(0,0,0, 12, 31, $year+1));
	      $to = date('Y-m-d', mktime(0,0,0, 12, 31, $year));

		$ventas=App\Operacion::whereBetween('fecha', array($from, $to))->sum('pesos');
		$rt=App\Operacion::whereBetween('fecha', array($from, $to))->sum('rt');
		$boletos=App\Item::whereBetween('created_at', array($from, $to))->sum('cantidad');
		$usuarios=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('status','Activo')->count();
		$mujeres=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('status','Activo')->where('genero','Femenino')->count();
		$hombres=App\User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('status','Activo')->where('genero','Masculino')->count();
		$productos=App\Producto::all();
		$rifasactivas=App\Producto::where('ganador',null)->whereBetween('fecha_limite', array($from, $to))->count();
		$rifastotales=App\Ganador::whereBetween('fecha', array($from, $to))->count();
		$rifascanceladas=App\Cancelada::whereBetween('fecha', array($from, $to))->count();
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

			
	
    	return view('admin', ['ventas'=>$ventas,'boletos'=>$boletos,'rt'=>$rt,'rifastotales'=>$rifastotales,'rifasactivas'=>$rifasactivas,'rifascanceladas'=>$rifascanceladas,'usuarios'=>$usuarios,'mujeres'=>$mujeres,'hombres'=>$hombres,'labels'=>$labels,'data'=>$data,'from'=>$from,'to'=>$to]);
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

	Route::get('/canceladas', function () {
		$canceladas=App\Cancelada::all();
	    return view('admin.canceladas', ['canceladas'=>$canceladas]);
	});



	Route::post('cambiar-contrasena', 'UserController@changepass');

	Route::delete('eliminar-usuario', 'UserController@destroy');

	Route::post('asignar-ganador', 'ProductoController@ganador');




	Route::post('agregar-codigo', 'CodigoController@store');

	Route::get('/codigos', function () {
		$codigos=App\Codigo::orderBy('created_at','desc')->get();

		$usuarios=App\User::where('is_admin',0)->where('status','Activo')->orderBy('name','asc')->get();
		/*if ($usuarios) {
			$string = "{";
			foreach ($usuarios as $usuario) {
				$string .="'".$usuario->email."'".":"."'".$usuario->avatar."',";
	        }
	        $string.="}";
	        $usuariosjson=json_encode($string);
		}*/

	    return view('admin.codigos', ['codigos'=>$codigos,'usuarios'=>$usuarios]);
	});


	Route::get('/agregar-codigo', function () {
		$codigos=App\Codigo::orderBy('created_at','desc')->get();

		$usuarios=App\User::where('is_admin',0)->where('status','Activo')->orderBy('name','asc')->get();
		/*if ($usuarios) {
			$string = "{";
			foreach ($usuarios as $usuario) {
				$string .="'".$usuario->email."'".":"."'".$usuario->avatar."',";
	        }
	        $string.="}";
	        $usuariosjson=json_encode($string);
		}*/

	    return view('admin.codigonuevo', ['codigos'=>$codigos,'usuarios'=>$usuarios]);
	});


	Route::get('/actualizar-codigo/{id}', function ($id) {
		$codigo=App\Codigo::find($id);

		$usuarios=App\User::where('is_admin',0)->where('status','Activo')->orderBy('name','asc')->get();
		/*if ($usuarios) {
			$string = "{";
			foreach ($usuarios as $usuario) {
				$string .="'".$usuario->email."'".":"."'".$usuario->avatar."',";
	        }
	        $string.="}";
	        $usuariosjson=json_encode($string);
		}*/

	    return view('admin.codigoupdate', ['codigo'=>$codigo,'usuarios'=>$usuarios]);
	});

	Route::delete('eliminar-codigo', 'CodigoController@destroy');

	Route::post('actualizar-codigo', 'CodigoController@update');


	Route::get('/regalo-update', function () {
		$regalo=App\Regalo::first();
		$productos=App\Producto::where('habilitado',1)->orderBy('nombre','asc')->get();
		if (!$productos->isEmpty()) {
			$string = "{";
			foreach ($productos as $producto) {
				$string .="'".$producto->nombre."'".":"."'".url('uploads/productos')."/".$producto->imagen."',";
	        }
	        $string.="}";
	        $productojson=json_encode($string);
		}
	    return view('admin.regalo', ['regalo'=>$regalo,'productos'=>$productojson]);
	});

	Route::post('regalo-update', 'CodigoController@regalo_update');

	


});


