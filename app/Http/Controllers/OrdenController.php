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
use App\Item;
use App\Operacion;
use App\Folio;
use App\Tarjeta;

class OrdenController extends Controller
{
    public function addtocart(Request $request)
    {
    	$producto=Producto::find($request->productoid);
    	if ($producto) {
    		# code...
    	}
      	Cart::add($producto->id,$producto->nombre,$request->cantidad,$producto->precio, ['imagen'=>$producto->imagen, 'loteria'=>$producto->loteria, 'descripcion' => $producto->descripcion, 'slug' => $producto->slug]);
	    $items=Cart::content();
      Session::flash('toast', 'Boletos agregados al carrito.');
            
	    return redirect()->intended(url()->previous());
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
















    public function cargo(Request $request)
    {
      \Conekta\Conekta::setApiKey("key_ty3oYz86wwJVi8yCdqMwtw");
      $items=Cart::content();
      $usuario=User::find(Auth::user()->id);
      $rt=$usuario->rt;
      if ($rt>=Cart::total(2,'.',',')) {

        foreach ($items as $product) {
          $precio = $product->price*100;
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => $precio,
            'quantity' => $product->qty,
            'metadata' => array(      
              'id' => $product->id
            )
          );
        }

        $folio=Folio::first();

            $guardar = new Orden();
            $guardar->order_id="RifaTokens";
            $guardar->folio="W".$folio->folio;
            $guardar->user_id=Auth::user()->id;
            $guardar->status='Pagado';
            $guardar->save();

             $operacion = new Operacion();
             $operacion->user_id=Auth::user()->id;
             $operacion->orden_id = $guardar->id;
             $operacion->rt = round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP);
             $operacion->pesos = 0;
             $operacion->tipo ="Compra";
             $operacion->fecha = date_create(date("Y-m-d"));
             $operacion->save();

             

          foreach ($productos as $producto) {
            $product = Producto::find($producto['metadata']['id']);
            $boletos = $product->boletos;
            $digitos = strlen(intval($boletos));

            
            $vendidos = $product->vendidos;
            $tickets = array();

            for ($i=$product->vendidos+1; $i <= $product->vendidos+$producto['quantity']; $i++) { 
              $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
              $tickets[]="t".$numero."t";
            }

            $product->vendidos=$vendidos+$producto['quantity'];
            $product->save();
            
            $item = new Item();
            $item->orden_id = $guardar->id;
            $item->producto = $producto['name'];
            $item->producto_id = $producto['metadata']['id'];
            $item->boletos = implode(",", $tickets);
            $item->cantidad = $producto['quantity'];
            $item->precio = $producto['unit_price']/100;
            $item->fecha = date_create($product->fecha_limite);
            $item->save();
          }
    


          $folio->folio++;
          $folio->save();

          $usuario->rt = $usuario->rt-round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP);
          $usuario->save();
          Cart::destroy();
          //$this->sendinvoice($order->id);
          //$this->sendclassrequest($order->id);
          Session::flash('total', $operacion->rt);
       
          return view('receipt', ['orden'=>$guardar]);

      }
      else{
        
        foreach ($items as $product) {
          $precio = $product->price*100;
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => $precio,
            'quantity' => $product->qty,
            'metadata' => array(      
              'id' => $product->id
            )
          );
        }
        $descuentos[]=array(
            'code'   => 'RifaTokens',
            'amount' => $rt,
            'type'   => 'sign'
          );
      
  



        try{

            $order=\Conekta\Order::create(array(
              'currency' => 'MXN',
              "customer_info" => array(
                "name" => ''.Auth::user()->name,
                "email" => ''.Auth::user()->email,
                "phone" => "+521".Auth::user()->tel
              ), //customer_info
              'line_items' => $productos,
              

              'discount_lines' => $descuentos,
              'charges' => array(
                array(
                  'payment_method' => array(
                    'type' => 'card',
                    "token_id" => $request->tokencard
                  )
                )
              )
            ));


            if (isset($request->tarjeta)) {
              $tarjeta = new Tarjeta();
              $tarjeta->identificador= substr_replace($request->numero, '************', 0, -4);
              $tarjeta->num= $request->numero;
              $tarjeta->nombre = $request->nombre;
              $tarjeta->mes = $request->mes;
              $tarjeta->año = $request->año;
              $tarjeta->user_id = Auth::user()->id;
              $tarjeta->save();
            }


          $folio=Folio::first();

            $guardar = new Orden();
            $guardar->order_id=$order->id;
            $guardar->folio="W".$folio->folio;
            $guardar->user_id=Auth::user()->id;
            $guardar->status='Pagado';
            $guardar->save();

             $operacion = new Operacion();
             $operacion->user_id=Auth::user()->id;
             $operacion->orden_id = $guardar->id;
             $operacion->rt = $rt;
             $operacion->pesos = Cart::total(2,'.',',')-$rt;
             $operacion->tipo ="Compra";
             $operacion->fecha = date_create(date("Y-m-d H:i:s"));
             $operacion->save();

             

          foreach ($productos as $producto) {
            $product = Producto::find($producto['metadata']['id']);
            $boletos = $product->boletos;
            $digitos = strlen(intval($boletos));

            
            $vendidos = $product->vendidos;
            $tickets = array();

            for ($i=$product->vendidos+1; $i <= $product->vendidos+$producto['quantity']; $i++) { 
              $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
              $tickets[]="t".$numero."t";
            }

            $product->vendidos=$vendidos+$producto['quantity'];
            $product->save();
            
            $item = new Item();
            $item->orden_id = $guardar->id;
            $item->producto = $producto['name'];
            $item->producto_id = $producto['metadata']['id'];
            $item->boletos = implode(",", $tickets);
            $item->cantidad = $producto['quantity'];
            $item->precio = $producto['unit_price']/100;
            $item->fecha = date_create($product->fecha_limite);
            $item->save();
          }
    


          $folio->folio++;
          $folio->save();

          $usuario->rt = 0;
          $usuario->save();

          Cart::destroy();
          //$this->sendinvoice($order->id);
          //$this->sendclassrequest($order->id);
          Session::flash('total', $order->amount);
       
          return view('receipt', ['orden'=>$guardar]);

        } catch (\Conekta\ProccessingError $error){
          Session::flash('mensaje', $error->getMessage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'))->withInput();
        } catch (\Conekta\ParameterValidationError $error){

          Session::flash('mensaje', $error->getMessage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'))->withInput();

        } catch (\Conekta\Handler $error){
          Session::flash('mensaje', $error->getMessage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'))->withInput();
        }


      }



      }
}
