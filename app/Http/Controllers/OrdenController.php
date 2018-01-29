<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use Mail;
use Input;
use App\User;
use App\Producto;

class OrdenController extends Controller
{
    public function addtocart(Request $request)
    {
    	$producto=Producto::find($request->productoid);
    	if ($producto) {
    		# code...
    	}
      	Cart::add($producto->id,$producto->nombre,$request->cantidad,$producto->precio, ['imagen'=>$producto->imagen, 'loteria'=>$producto->loteria, 'descripcion' => $producto->descripcion]);
	    $items=Cart::content();
	    return redirect()->intended(url('/carrito'));
    }

    public function updatecart(Request $request)
    {

      Cart::update($request->rowId, $request->qty);
      return redirect()->intended(url('/carrito'));
    }
    public function destroy($rowId)
    {
      Cart::remove($rowId);
      Session::flash('mensaje', 'El producto se eliminó del carrito.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/carrito'));
    }
}
