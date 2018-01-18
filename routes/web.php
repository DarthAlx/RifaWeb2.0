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


Route::get('/', function () {
    return view('inicio');
});



Route::get('/catalogo/{catalogo}', function ($catalogo) {
	$categoria=App\Categoria::where('nombre',$catalogo)->first();
	$categorias=App\Categoria::orderBy('nombre','asc')->get();
	if ($categoria) {
		$productos=App\Producto::where('categoria', 'like', '%'.$categoria->id.'%')->get();
		return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'catalogo'=>$catalogo]);
	}
	else{
		return redirect()->intended(url('/404'));
	}
	
});


Route::get('/perfil', function () {
    return view('perfil');
})->middleware('auth');







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


Route::get('/admin', function () {
    return view('admin');
})->middleware('admin');

Route::get('/productos/nuevo', function () {
	$categorias=App\Categoria::orderBy('nombre','asc')->get();
    return view('admin.productonuevo', ['categorias'=>$categorias]);
})->middleware('admin');

Route::post('agregar-producto', 'ProductoController@store')->middleware('admin');