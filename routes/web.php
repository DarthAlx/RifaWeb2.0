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
    return view('inicio');
});


Route::get('/', function () {
	$productos=App\Producto::where('destacado',1)->orderBy('nombre','asc')->get();
	$slides=App\Slider::orderBy('orden','asc')->get();
	return view('inicio2', ['productos'=>$productos,'slides'=>$slides]);
    return view('inicio');
});



Route::get('/rifas/{catalogo}', function ($catalogo) {
	$categoria=App\Categoria::where('nombre',$catalogo)->first();
	$fuente=App\Fuente::where('nombre',$catalogo)->first();
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

 Route::get('removefromcart/{id}', 'OrdenController@destroy');

  Route::post('updatecart', 'OrdenController@updatecart');


Route::get('/perfil', function () {
    return view('perfil');
})->middleware('auth');


Route::get('/rifa/{slug}', function ($slug) {
	$producto=App\Producto::where('slug',$slug)->first();
    return view('producto',['producto'=>$producto]);
});


Route::post('leermensaje', 'MensajeController@read')->middleware('auth');






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
    return view('admin');
	});

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
	Route::post('cambiar-contrasena', 'UserController@changepass');

	Route::delete('eliminar-usuario', 'UserController@destroy');

});


