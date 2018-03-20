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
use App\Cancelada;
use App\Paquete;
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
    public function addtocartpost(Request $request)
    {
      $producto=Producto::find($request->productoid);
        Cart::add($producto->id,$producto->nombre,$request->cantidad,$producto->precio, ['imagen'=>$producto->imagen, 'loteria'=>$producto->loteria, 'descripcion' => $producto->descripcion, 'slug' => $producto->slug]);


      echo "<script type='text/javascript'>$('#minicart').html('$".Cart::subtotal()."');     location.reload();</script>";
    }

    public function updatecart(Request $request)
    {

      Cart::update($request->rowId, $request->qty);
      return redirect()->intended(url('/carrito'));
    }
    public function updatecartpost(Request $request)
    {

      Cart::update($request->rowId, $request->qty);

      echo "<script type='text/javascript'>$('#minicart').html('$".Cart::subtotal()."');</script>";
    }
    public function destroy($rowId)
    {
      Cart::remove($rowId);
      Session::flash('mensaje', 'El producto se eliminó del carrito.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/carrito'));
    }

    public function destroypost(Request $request)
    {
      Cart::remove($request->rowId);
      echo "<script type='text/javascript'>$('#minicart').html('$".Cart::subtotal()."');    location.reload();</script>";

    }



    public function sendinvoice($id)
    {
      $orden=Orden::find($id);
      $user=$orden->user;
        Mail::send('emails.receiptmail', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->name)->subject('¡Tu compra!');
        });
    }
    public function sendinvoicert($id)
    {
      $orden=Orden::find($id);
      $user=$orden->user;
        Mail::send('emails.receiptmailrt', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->name)->subject('¡Tu compra!');
        });
    }

    public function sendficha($id)
    {
      $orden=Orden::find($id);
      $user=$orden->user;
        Mail::send('emails.ficha', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->name)->subject('¡Tu ficha de pago!');
        });
    }















    public function cargo(Request $request)
    {
      \Conekta\Conekta::setApiKey("key_ty3oYz86wwJVi8yCdqMwtw");
      $items=Cart::content();
      $usuario=User::find(Auth::user()->id);
      $rt=$usuario->rt/10;
      $subtotal=floatval(str_replace(",","",Cart::subtotal(2,'.',',')));
      $impuesto=$subtotal*0.029;
      $iva=floatval(str_replace(",","",Cart::tax()));
      $impuestomasiva=floatval($impuesto)+(floatval($impuesto)*0.16);
      $impuestomasiva=round(str_replace(",","",$impuestomasiva), 2, PHP_ROUND_HALF_UP);

      $total=floatval($subtotal)+floatval($iva)+floatval($impuestomasiva);
     
      

      if ($rt>=$total) {

        foreach ($items as $product) {
          $hayproduct = Producto::find($product->id);
          $hayboletos=(intval($hayproduct->vendidos)+intval($product->qty))<=intval($hayproduct->boletos);
          if (!$hayboletos) {
            Session::flash('mensaje', 'Lo sentimos, los boletos para '.$product->name.' se han terminado.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/carrito'))->withInput();

          }//hayboletos

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
            $guardar->status='Pagada';
            $guardar->save();

             $operacion = new Operacion();
             $operacion->user_id=Auth::user()->id;
             $operacion->orden_id = $guardar->id;
             $operacion->rt = round($total, 0, PHP_ROUND_HALF_UP)*10;
             $operacion->pesos = 0;
             $operacion->iva = $iva;
             $operacion->impuesto = $impuestomasiva;
             $operacion->tipo ="Compra";
             $operacion->metodo ="RifaTokens";
             $operacion->fecha = date_create(date("Y-m-d H:i:s"));
             $operacion->save();

             

          foreach ($productos as $producto) {
            $product = Producto::find($producto['metadata']['id']);
            $boletos = $product->boletos;
            $digitos = strlen(intval($boletos));

            
            $vendidos = $product->vendidos;
            $tickets = array();
           

            for ($i=$product->vendidos; $i <= ($product->vendidos+($producto['quantity']*$product->multiplicador))-1; $i++) { 
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

          $usuario->rt = $usuario->rt-(round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP)*10);
          $usuario->save();
          Cart::destroy();
          $this->sendinvoice($guardar->id);
          //$this->sendclassrequest($order->id);
          Session::flash('total', $operacion->rt);
       
          return view('receipt', ['orden'=>$guardar]);

      }//proceso solo rt
      else{

        if ($request->metodo=="Normal") {
        
        foreach ($items as $product) {
          $hayproduct = Producto::find($product->id);
          $hayboletos=(intval($hayproduct->vendidos)+intval($product->qty))<=intval($hayproduct->boletos);
          if (!$hayboletos) {
            Session::flash('mensaje', 'Lo sentimos, los boletos para '.$product->name.' se han terminado.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/carrito'))->withInput();

          }//hayboletos

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
            'amount' => $rt*100,
            'type'   => 'sign'
          );
      
        

        $impuestocent=($impuestomasiva*100);
        $ivacent=($iva*100);
        try{

            $order=\Conekta\Order::create(array(
              'currency' => 'MXN',
              "customer_info" => array(
                "name" => ''.Auth::user()->name,
                "email" => ''.Auth::user()->email,
                "phone" => "+521".Auth::user()->tel
              ), //customer_info
              'line_items' => $productos,
              
              'tax_lines'=> array(
                array(
                  'description' => 'IVA',
                  'amount'      => intval($ivacent)
                ),
                array(
                  'description' => 'Impuestos',
                  'amount'      => intval($impuestocent)
                )
              ),

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
            $guardar->status='Pagada';
            $guardar->save();

             $operacion = new Operacion();
             $operacion->user_id=Auth::user()->id;
             $operacion->orden_id = $guardar->id;
             $operacion->rt = $rt*10;
             $operacion->pesos = $subtotal-$rt;
             $operacion->iva = $iva;
             $operacion->impuesto = $impuestomasiva;
             $operacion->tipo ="Compra";
             $operacion->metodo ="Tarjeta";
             $operacion->fecha = date_create(date("Y-m-d H:i:s"));
             $operacion->save();

             

          foreach ($productos as $producto) {
            $product = Producto::find($producto['metadata']['id']);
            $boletos = $product->boletos;
            $digitos = strlen(intval($boletos));

            
            $vendidos = $product->vendidos;
            $tickets = array();

            for ($i=$product->vendidos; $i <= ($product->vendidos+($producto['quantity']*$product->multiplicador))-1; $i++) { 
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
          $this->sendinvoice($guardar->id);
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

        }//metodo normal




        elseif ($request->metodo=="Tienda") {
          foreach ($items as $product) {
              $hayproduct = Producto::find($product->id);
              $hayboletos=(intval($hayproduct->vendidos)+intval($product->qty))<=intval($hayproduct->boletos);
              if (!$hayboletos) {
                Session::flash('mensaje', 'Lo sentimos, los boletos para '.$product->name.' se han terminado.');
                Session::flash('class', 'danger');
                return redirect()->intended(url('/carrito'))->withInput();

              }//hayboletos

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
                'amount' => $rt*100,
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
                        "type" => "oxxo_cash",
                        "status" => "Pendiente",
                        "expires_at" => strtotime("+5 day")
                      )
                    )
                  )
                ));



              $folio=Folio::first();

                $guardar = new Orden();
                $guardar->order_id=$order->id;
                $guardar->folio="W".$folio->folio;
                $guardar->user_id=Auth::user()->id;
                $guardar->status='Pendiente';
                $guardar->referencia=$order->charges[0]->payment_method->reference;
                $guardar->save();

                 $operacion = new Operacion();
                 $operacion->user_id=Auth::user()->id;
                 $operacion->orden_id = $guardar->id;
                 $operacion->rt = $rt*10;
                 $operacion->pesos = Cart::total(2,'.',',')-$rt;
                 $operacion->tipo ="Pendiente";
                 $operacion->metodo ="Oxxo";
                 $operacion->fecha = date_create(date("Y-m-d H:i:s"));
                 $operacion->save();

                 

              foreach ($productos as $producto) {
                $product = Producto::find($producto['metadata']['id']);
                /*$boletos = $product->boletos;
                $digitos = strlen(intval($boletos));

                
                $vendidos = $product->vendidos;
                $tickets = array();

                for ($i=$product->vendidos+1; $i <= ($product->vendidos+$producto['quantity'])*$product->multiplicador; $i++) { 
                  $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
                  $tickets[]="t".$numero."t";
                }

                $product->vendidos=$vendidos+$producto['quantity'];
                $product->save();
                */
                $item = new Item();
                $item->orden_id = $guardar->id;
                $item->producto = $producto['name'];
                $item->producto_id = $producto['metadata']['id'];
                $item->boletos = 'pendiente';
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
              $this->sendficha($guardar->id);
              //$this->sendclassrequest($order->id);
              Session::flash('total', $order->amount);
           
              return view('ficha', ['orden'=>$guardar]);

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
        }//tienda

      }//no rt completo
      }


      public static function cancelacion(){
        $productos=Producto::where('habilitado',1)->orderBy('nombre','asc')->get();
        foreach($productos as $producto){
          if(strtotime($producto->fecha_limite) <= strtotime(date("Y-m-d H:i:s"))){
            if ($producto->vendidos<$producto->minimo) {

              $items=Item::where('producto',$producto->nombre)->where('fecha', $producto->fecha_limite)->get();

              foreach ($items as $item) {
                $totaldev=$item->cantidad*$item->precio;
                $devolucion= new Operacion();
                $devolucion->user_id=$item->orden->user_id;
                $devolucion->orden_id=$item->orden->id;
                $devolucion->rt=$totaldev*10;
                $devolucion->pesos=0;
                $devolucion->tipo="Cancelación";
                $devolucion->fecha=date_create(date("Y-m-d H:i:s"));
                $devolucion->save();
                $orden=$item->orden;
                $user=$orden->user;
                $user->rt=$user->rt+$devolucion->rt+10;
                $user->save();

                $cancelacion= new Cancelada();
                $cancelacion->producto=$producto->nombre;
                $cancelacion->fecha=$producto->fecha_limite;
                $cancelacion->rt=$devolucion->rt;
                $cancelacion->minimo=$producto->minimo;
                $cancelacion->vendidos=$producto->vendidos;
                $cancelacion->user_id=$devolucion->user_id;
                $cancelacion->orden_id=$devolucion->orden_id;
                $cancelacion->save();
                Mail::send('emails.cancelacion', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
                    $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $m->to($user->email, $user->name)->subject('Lo sentimos');
                });

                $orden->status="Cancelada";
                $orden->save();
              }

              $producto->habilitado=0;
              $producto->ganador=0;
              $producto->vendidos=0;
              $producto->save();
            }
          }
        }
                  
      }






public static function pendientes(){
        \Conekta\Conekta::setApiKey("key_ty3oYz86wwJVi8yCdqMwtw");
        $ordenes=Orden::where('status','Pendiente')->get();
 
        foreach($ordenes as $orden){
          $order = \Conekta\Order::find($orden->order_id);

          $user=$orden->user;
            if ($order->charges[0]->status=="paid") {
              $orden->status="Pagada";
              $orden->save();
              $operacion=$orden->operacion;
              $operacion->tipo="Compra RT";
              $operacion->save();

              $user->rt=$user->rt+$operacion->paquete->rt;
              $user->save();
              

              Mail::send('emails.aprobado', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
                    $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $m->to($user->email, $user->name)->subject('¡Pago acreditado!');
                });

             
              
              
            }//paid
            else{
              if ($order->charges[0]->payment_method->expires_at <= strtotime(date("Y-m-d H:i:s"))) {
                $orden->status="Expirada";
                $orden->save();
                $operacion=$orden->operacion;
                $operacion->tipo="Expirada";
                $operacion->save();       
              }
            }
        }
                  
      }











    public function paquetes(Request $request)
    {
      \Conekta\Conekta::setApiKey("key_ty3oYz86wwJVi8yCdqMwtw");

      $usuario=User::find(Auth::user()->id);
      $paquete=Paquete::find($request->paquete);

      $precio=intval($paquete->precio);
        $cantidad=intval($paquete->rt);
      if ($request->metodo=="Normal") {
        $impuesto= floatval($paquete->impuesto);
      }
      else{
        $impuesto= floatval($paquete->impuestot);
      }
        

        /*$impuestomasiva=floatval($impuesto)+(floatval($impuesto)*0.16);
        $impuestomasiva=round(str_replace(",","",$impuestomasiva), 2, PHP_ROUND_HALF_UP);*/
        $iva=floatval($paquete->iva);
        $total=floatval($precio)+floatval($iva)+floatval($impuesto);
        $total=round(str_replace(",","",$total), 2, PHP_ROUND_HALF_UP);
        

        $impuestocent=($impuesto*100);
        $ivacent=($iva*100);

        if ($request->metodo=="Normal") {
        
          $precio = $precio*100;
          $productos[]=array(
            'name' => 'RifaTokens',
            'unit_price' => $precio,
            'quantity' => 1,
            'metadata' => array(      
              'id' => $paquete->id
            )
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
              'tax_lines'=> array(
                array(
                  'description' => 'IVA',
                  'amount'      => intval($ivacent)
                ),
                array(
                  'description' => 'Impuestos',
                  'amount'      => intval($impuestocent)
                )
              ),

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
            $guardar->status='Pagada';
            $guardar->save();

             $operacion = new Operacion();
             $operacion->user_id=Auth::user()->id;
             $operacion->orden_id = $guardar->id;
             $operacion->rt = 0;
             $operacion->pesos = $paquete->precio;
             $operacion->iva = $iva;
             $operacion->impuesto = $impuesto;
             $operacion->paquete_id = $paquete->id;

             $operacion->tipo ="Compra RT";
             $operacion->metodo ="Tarjeta";
             $operacion->fecha = date_create(date("Y-m-d H:i:s"));
             $operacion->save();

            
    


          $folio->folio++;
          $folio->save();

          $usuario->rt = $usuario->rt+$paquete->rt;
          $usuario->save();

          $this->sendinvoicert($guardar->id);
          //$this->sendclassrequest($order->id);
          Session::flash('total', $order->amount);
       
          return view('receiptrt', ['orden'=>$guardar]);

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

        }//metodo normal




        elseif ($request->metodo=="Tienda") {
          $precio = $precio*100;
          $productos[]=array(
            'name' => 'RifaTokens',
            'unit_price' => $precio,
            'quantity' => 1,
            'metadata' => array(      
              'id' => $paquete->id
            )
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
                  

                  'tax_lines'=> array(
                    array(
                      'description' => 'IVA',
                      'amount'      => intval($ivacent)
                    ),
                    array(
                      'description' => 'Impuestos',
                      'amount'      => intval($impuestocent)
                    )
                  ),
                  'charges' => array(
                    array(
                      'payment_method' => array(
                        "type" => "oxxo_cash",
                        "status" => "Pendiente",
                        "expires_at" => strtotime("+5 day")
                      )
                    )
                  )
                ));



              $folio=Folio::first();

                $guardar = new Orden();
                $guardar->order_id=$order->id;
                $guardar->folio="W".$folio->folio;
                $guardar->user_id=Auth::user()->id;
                $guardar->status='Pagada';
                $guardar->referencia=$order->charges[0]->payment_method->reference;
                $guardar->save();

                 $operacion = new Operacion();
                 $operacion->user_id=Auth::user()->id;
                 $operacion->orden_id = $guardar->id;
                 $operacion->rt = 0;
                 $operacion->pesos = $paquete->precio;
                 $operacion->iva = $iva;
                  $operacion->impuesto = $impuesto;
                  $operacion->paquete_id = $paquete->id;
                 $operacion->tipo ="Compra RT";
                 $operacion->metodo ="Oxxo";
                 $operacion->fecha = date_create(date("Y-m-d H:i:s"));
                 $operacion->save();
        


              $folio->folio++;
              $folio->save();
         

              $this->sendficha($guardar->id);

              Session::flash('total', $order->amount);
           
              return view('ficha', ['orden'=>$guardar]);

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
        }//tienda


      }













      
}
