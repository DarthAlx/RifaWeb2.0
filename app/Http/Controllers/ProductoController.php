<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Poplets;
use App\Fuente;
use App\Item;
use App\Ganador;
use App\Video;
use App\Folio;
use App\Orden;
use App\Operacion;
use App\User;

use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class ProductoController extends Controller
{


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ganador' => 'required|string|min:3|confirmed'
        ]);
    }
	public function store(Request $request)
    {
        

    	$producto = new Producto($request->all());
        $producto->nombre=$request->nombre;
        $producto->slug = str_slug($request->nombre, '-');
        $producto->sku=$request->sku;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        //$producto->precio_especial=$request->precio_especial;
        $producto->boletos=$request->boletos;
        $producto->minimo=$request->minimo;
        $producto->fundacion=$request->fundacion;
        $producto->fecha_limite=date_create($request->fecha_limite. " ". $request->hora);
        

        //categoria
        if (isset($request->categoria)) {
          $producto->categoria=implode(",", $request->categoria);
        }
        else{
            Session::flash('mensaje', 'Selecciona o crea por lo menos una categoría.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
        }

        //habilitado
		if (isset($request->habilitado)) {
			$producto->habilitado=1;
		}
		else{
			$producto->habilitado=0;
		}
        //destacado
        if (isset($request->destacado)) {
            $producto->destacado=1;
        }
        else{
            $producto->destacado=0;
        }
        //gratuito
        if (isset($request->gratuito)) {
            $producto->gratuito=1;
            $producto->precio=0;
        }
        else{
            $producto->gratuito=0;
        }

        //producto general
        if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = $request->sku . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/productos/');
            $file-> move($path, $name);
            $producto->imagen = $name;
            }


          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
          }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/productos/nuevo'))->withInput();
        }

        //guardar
        if ($producto->save()) {
            Session::flash('mensaje', 'Producto publicado con exito.');
            Session::flash('class', 'success');
            
        }
        else{
            Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/productos/nuevo'))->withInput();
        }

        //poplets
        if (!$request->poplets&&$request->hasFile('poplet1')) {
            $request->poplets=1;
        }
        if ($request->poplets) {
            for ($i=1; $i <= intval($request->poplets); $i++) { 
                $poplet = new Poplets();
               if ($request->hasFile('poplet'.$i)) {
                  $file = $request->file('poplet'.$i);

                  if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
                    $name = $request->sku . "-" . $i . "-" . time()."." . $file->getClientOriginalExtension();
                    $path = base_path('uploads/productos/poplets/'.$producto->id.'/');
                    $file->move($path, $name);
                    $poplet->imagen = $name;
                    $poplet->producto_id = $producto->id;
                    $poplet->save();
                    }


                  else{
                    Session::flash('mensaje', 'Hubo un error al guardar la galería.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/producto/'.$producto->id))->withInput();
                  }

                }
            }
            
        }

        //video
        if ($request->video) {
            $video = new Video();
            $video->producto_id = $producto->id;
            $video->video = $request->video;
            $video->save();
        }




        return redirect()->intended(url('/productos'))->withInput();
        



    }

    public function ganador(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()) {


            Session::flash('mensaje', 'Los números deben coincidir.');
              Session::flash('class', 'danger');
              return redirect()->intended(url()->previous());
        }
        else{
              $producto = Producto::find($request->producto);
              $producto->ganador=$request->ganador;
              $producto->habilitado=0;
              $producto->save();

              
              
              $itemganador= Item::where('producto_id',$producto->id)->where('fecha',date_create($producto->fecha_limite))->where('boletos', 'like', '%t' . $producto->ganador . 't%')->first();
              $comprados=Item::where('producto_id',$producto->id)->where('fecha',date_create($producto->fecha_limite))->get();

              if ($itemganador) {
                    $ordenganadora=$itemganador->orden;
                    $ganador=$ordenganadora->user;

                    //guardar ganador
                    $guardarganador= new Ganador();
                    $guardarganador->user_id=$ganador->id;
                    $guardarganador->producto=$producto->nombre;
                    $guardarganador->boleto=$producto->ganador;
                    
                    $guardarganador->loteria=$producto->loteria;
                    $guardarganador->imagen=$producto->imagen;
                    $guardarganador->fecha=date_create($producto->fecha_limite);
                    $guardarganador->save();


                  foreach ($comprados as $item) {
                    $orden=$item->orden;
                    $orden->status="Terminada";
                    $orden->save();
                  }

                  $this->sendwinner($guardarganador->id);
              }
              else{
                    $guardarganador= new Ganador();
                    $guardarganador->user_id=1;
                    $guardarganador->producto=$producto->nombre;
                    $guardarganador->boleto=$producto->ganador;
                    $guardarganador->loteria=$producto->loteria;
                    $guardarganador->imagen=$producto->imagen;
                    $guardarganador->fecha=date_create($producto->fecha_limite);
                    $guardarganador->save();


                  foreach ($comprados as $item) {
                    $orden=$item->orden;
                    $orden->status="Terminada";
                    $orden->save();
                  }

              }

              

              Session::flash('mensaje', 'Ganador asignado.');
              Session::flash('class', 'success');
              return redirect()->intended(url()->previous());
        }
    }

    public function sendwinner($id)
    {
      $ganador=Ganador::find($id);
      $user=$ganador->user;
      if ($user->id!=1) {
          Mail::send('emails.winner', ['ganador'=>$ganador,'user'=>$user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->name)->subject('¡Felicidades!');
        });
      }
        
    }

    public function regalarboleto($id){
        $usuario=User::find(Auth::user()->id);
        $product=Producto::find($id);
        $operacion=Operacion::where('user_id',Auth::user()->id)->where('tipo','Boleto gratis')->orderBy('created_at', 'desc')->first();

        $hayproduct = Producto::find($product->id);
          $hayboletos=(intval($hayproduct->vendidos)+(1*$hayproduct->multiplicador))<=intval($hayproduct->boletos);
          if (!$hayboletos) {
            Session::flash('mensaje', 'Lo sentimos, los boletos para '.$product->name.' se han terminado.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/carrito'))->withInput();

          }//hayboletos


        
        if ($operacion) {
            $orden=$operacion->orden;
            foreach ($orden->items as $item) {
                if ($item->producto==$product->nombre&&$item->fecha==$product->fecha_limite) {
                    $yaregalado=true;
                    break;
                }
                else{
                    $yaregalado=false;
                }
            }

            if (!$yaregalado) {
                $folio=Folio::first();

                $guardar = new Orden();
                $guardar->order_id="Regalo";
                $guardar->folio="W".$folio->folio;
                $guardar->user_id=Auth::user()->id;
                $guardar->status='Pagado';
                $guardar->save();

                 $operacion = new Operacion();
                 $operacion->user_id=Auth::user()->id;
                 $operacion->orden_id = $guardar->id;
                 $operacion->rt = 0;
                 $operacion->pesos = 0;
                 $operacion->tipo ="Boleto gratis";
                 $operacion->metodo ="Boleto gratis";
                 $operacion->fecha = date_create(date("Y-m-d H:i:s"));
                 $operacion->save();

                $boletos = $product->boletos;
                $digitos = strlen(intval($boletos));
                
                $vendidos = $product->vendidos;
                $tickets = array();

                for ($i=$product->vendidos; $i <= ($product->vendidos+(1*$product->multiplicador))-1; $i++) { 
                  $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
                  $tickets[]="t".$numero."t";
                }

                $product->vendidos=$vendidos+1;
                $product->save();
                
                $item = new Item();
                $item->orden_id = $guardar->id;
                $item->producto = $product->nombre;
                $item->producto_id = $product->id;
                $item->boletos = implode(",", $tickets);
                $item->cantidad = 1;
                $item->precio = $product->precio;
                $item->fecha = date_create($product->fecha_limite);
                $item->save();
              
        


              $folio->folio++;
              $folio->save();

              return view('receipt', ['orden'=>$guardar]);

              //$this->sendinvoice($guardar->id);
            }
            else{
                 Session::flash('mensaje', 'Ya estás participando en esta rifa.');
                    Session::flash('class', 'warning');
                    return redirect()->intended(url()->previous());
            }

        }
        else{
            $folio=Folio::first();

                $guardar = new Orden();
                $guardar->order_id="Regalo";
                $guardar->folio="W".$folio->folio;
                $guardar->user_id=Auth::user()->id;
                $guardar->status='Pagada';
                $guardar->save();

                 $operacion = new Operacion();
                 $operacion->user_id=Auth::user()->id;
                 $operacion->orden_id = $guardar->id;
                 $operacion->rt = 0;
                 $operacion->pesos = 0;
                 $operacion->tipo ="Boleto gratis";
                 $operacion->metodo ="Boleto gratis";
                 $operacion->fecha = date_create(date("Y-m-d H:i:s"));
                 $operacion->save();

                $boletos = $product->boletos;
                $digitos = strlen(intval($boletos));
                
                $vendidos = $product->vendidos;
                $tickets = array();

                for ($i=$product->vendidos; $i <= ($product->vendidos+(1*$product->multiplicador))-1; $i++) { 
                  $numero=str_pad((string)$i, $digitos, "0", STR_PAD_LEFT);
                  $tickets[]="t".$numero."t";
                }

                $product->vendidos=$vendidos+1;
                $product->save();
                
                $item = new Item();
                $item->orden_id = $guardar->id;
                $item->producto = $product->nombre;
                $item->producto_id = $product->id;
                $item->boletos = implode(",", $tickets);
                $item->cantidad = 1;
                $item->precio = $product->precio;
                $item->fecha = date_create($product->fecha_limite);
                $item->save();
              
        


              $folio->folio++;
              $folio->save();

              return view('receipt', ['orden'=>$guardar]);

              //$this->sendinvoice($guardar->id);
        }
    }



    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
            if ($producto->fecha_limite!=$request->fecha_limite. " ". $request->hora) {
                if ($producto->ganador!=null) {
                    $producto->vendidos=0;
                    $producto->ganador=null;
                }
                else{
                    $ventas=Item::where('producto',$producto->nombre)->where('fecha',$producto->fecha_limite)->count();
                    $venta=Item::where('producto',$producto->nombre)->where('fecha',$producto->fecha_limite)->first();
                    if ($venta) {
                        $orden= $venta->orden;
                        $status=$orden->status;
                    }
                    else{
                        $status="none";
                    }
                    if($ventas>0&&$status!="Terminada"){
                        $comprados=Item::where('producto_id',$producto->id)->where('fecha',date_create($producto->fecha_limite))->get();
                        foreach($comprados as $comprado){
                            $comprado->producto=$request->nombre;
                            $comprado->fecha=date_create($request->fecha_limite. " ". $request->hora);
                            $comprado->save();
                        }
                    }
                }
            }
        
        
        
        
        $producto->nombre=$request->nombre;
        $producto->slug = str_slug($request->nombre, '-');
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->loteria=$request->loteria;
        $producto->sku=$request->sku;
        //$producto->precio_especial=$request->precio_especial;
        $producto->boletos=$request->boletos;
        $producto->minimo=$request->minimo;
        $producto->fundacion=$request->fundacion;
        $producto->fecha_limite=date_create($request->fecha_limite. " ". $request->hora);
        
        
        //categoria
        if (isset($request->categoria)) {
          $producto->categoria=implode(",", $request->categoria);
        }
        else{
            Session::flash('mensaje', 'Selecciona o crea por lo menos una categoría.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/producto/'.$id))->withInput();
        }
        //habilitado
        if (isset($request->habilitado)) {
            $producto->habilitado=1;
        }
        else{
            $producto->habilitado=0;
        }
        //destacado
        if (isset($request->destacado)) {
            $producto->destacado=1;
        }
        else{
            $producto->destacado=0;
        }
        //gratuito
        if (isset($request->gratuito)) {
            $producto->gratuito=1;
            $producto->precio=0;
        }
        else{
            $producto->gratuito=0;
        }
        //producto general
        if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = $request->sku . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/productos/');
            File::delete($path . $producto->imagen);
            $file-> move($path, $name);
            $producto->imagen = $name;
            }
          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/producto/'.$id))->withInput();
          }
        }
        //guardar
        if ($producto->save()) {
            Session::flash('mensaje', 'Producto actualizado con exito.');
            Session::flash('class', 'success');
            
        }
        else{
            Session::flash('mensaje', 'Hubo un error, por favor, verifica la información.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/producto/'.$id))->withInput();
        }
        //poplets

        if (!$request->poplets&&$request->hasFile('poplet1')) {
            $request->poplets=1;
        }
        if ($request->poplets) {
            $path = base_path('uploads/productos/poplets/'.$producto->id.'/');
            $oldpoplets=Poplets::where('producto_id', $producto->id)->get();
            foreach ($oldpoplets as $oldpoplet) {
                File::delete($path . $oldpoplet->imagen);
                $oldpoplet->delete();
            }
            for ($i=1; $i <= intval($request->poplets); $i++) { 
                $poplet = new Poplets();
               if ($request->hasFile('poplet'.$i)) {
                  $file = $request->file('poplet'.$i);
                  if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
                    $name = $request->sku . "-" . $i . "-" . time()."." . $file->getClientOriginalExtension();           
                    $file->move($path, $name);
                    $poplet->imagen = $name;
                    $poplet->producto_id = $producto->id;
                    $poplet->save();
                    }
                  else{
                    Session::flash('mensaje', 'Hubo un error al guardar la galería.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/producto/'.$id))->withInput();
                  }
                }
            }
            
        }

        //video
        if ($request->video) {
            if ($producto->video) {
                if ($request->video!=$producto->video->video) {
                    $video = $producto->video;
                    $video->video = $request->video;
                    $video->save();
                }
            }
            else{
                $video = new Video();
                $video->producto_id = $producto->id;
                $video->video = $request->video;
                $video->save();
            }

            
        }
        

        return redirect()->intended(url('/producto/'.$id))->withInput();
        
    }
    




    public function search(Request $request){

    $catalogo="Resultados";
    $categorias=Categoria::orderBy('nombre','asc')->get();
    $fuentes=Fuente::orderBy('nombre','asc')->get();

    if ($request->busqueda) {
         $productos=Producto::where('nombre', 'like','%'.$request->busqueda.'%')->orWhere('sku', 'like','%'.$request->busqueda.'%')->orWhere('descripcion', 'like','%'.$request->busqueda.'%')->orWhere('loteria', 'like','%'.$request->busqueda.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
    }

    elseif ($request->orden) {
        if ($request->orden=="A - Z") {
            $productos=Producto::orderBy('nombre','asc')->paginate(20);
        }
        if ($request->orden=="Z - A") {
            $productos=Producto::orderBy('nombre','desc')->paginate(20);
        }
        if ($request->orden=="Menor precio") {
            $productos=Producto::orderBy('precio','asc')->paginate(20);
        }
        if ($request->orden=="Mayor precio") {
            $productos=Producto::orderBy('precio','desc')->paginate(20);
        }
        
    }


    elseif ($request->minimo||$request->maximo) {
        if ($request->minimo&&$request->maximo) {
            $productos=Producto::whereBetween('precio', [$request->minimo, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        if ($request->minimo&&!$request->maximo) {
            $productos=Producto::whereBetween('precio', [$request->minimo, 999999999999999])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        if (!$request->minimo&&$request->maximo) {
            $productos=Producto::whereBetween('precio', [999999999999999, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        
        
    }
    else{
        $productos=Producto::orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
    }

    return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
}

    public function searchcatalogo(Request $request, $catalogo){




    $categoria=Categoria::where('nombre',$catalogo)->first();
    $fuente=Fuente::where('nombre',$catalogo)->first();
    $categorias=Categoria::orderBy('nombre','asc')->get();
    $fuentes=Fuente::orderBy('nombre','asc')->get();
    if ($categoria) {

        if ($request->busqueda) {
         $productos=Producto::where('nombre', 'like','%'.$request->busqueda.'%')->orWhere('sku', 'like','%'.$request->busqueda.'%')->orWhere('descripcion', 'like','%'.$request->busqueda.'%')->orWhere('loteria', 'like','%'.$request->busqueda.'%')->where('categoria', 'like', '%'.$categoria->id.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
        }

        if ($request->orden) {
            if ($request->orden=="A - Z") {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Z - A") {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->orderBy('nombre','desc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Menor precio") {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Mayor precio") {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->orderBy('precio','desc')->where('habilitado',1)->paginate(20);
            }
            
        }


        if ($request->minimo||$request->maximo) {
            if ($request->minimo&&$request->maximo) {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->whereBetween('precio', [$request->minimo, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->minimo&&!$request->maximo) {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->whereBetween('precio', [$request->minimo, 999999999999999])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if (!$request->minimo&&$request->maximo) {
                $productos=Producto::where('categoria', 'like', '%'.$categoria->id.'%')->whereBetween('precio', [999999999999999, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            
            
        }

        return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
    }
    elseif ($fuente) {

        if ($request->busqueda) {
         $productos=Producto::where('nombre', 'like','%'.$request->busqueda.'%')->orWhere('sku', 'like','%'.$request->busqueda.'%')->orWhere('descripcion', 'like','%'.$request->busqueda.'%')->orWhere('loteria', 'like','%'.$request->busqueda.'%')->where('loteria', 'like', '%'.$fuente->nombre.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
        }

        if ($request->orden) {
            if ($request->orden=="A - Z") {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Z - A") {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->orderBy('nombre','desc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Menor precio") {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->orden=="Mayor precio") {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->orderBy('precio','desc')->where('habilitado',1)->paginate(20);
            }
            
        }


        if ($request->minimo||$request->maximo) {
            if ($request->minimo&&$request->maximo) {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->whereBetween('precio', [$request->minimo, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if ($request->minimo&&!$request->maximo) {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->whereBetween('precio', [$request->minimo, 999999999999999])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            if (!$request->minimo&&$request->maximo) {
                $productos=Producto::where('loteria', 'like', '%'.$fuente->nombre.'%')->whereBetween('precio', [999999999999999, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
            }
            
            
        }


        return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'fuentes'=>$fuentes,'catalogo'=>$catalogo]);
    }
    else{
        return redirect()->intended(url('/404'));
    }


    if ($request->busqueda) {
         $productos=Producto::where('nombre', 'like','%'.$request->busqueda.'%')->orWhere('sku', 'like','%'.$request->busqueda.'%')->orWhere('descripcion', 'like','%'.$request->busqueda.'%')->orWhere('loteria', 'like','%'.$request->busqueda.'%')->orderBy('nombre','asc')->where('habilitado',1)->paginate(20);
    }

    if ($request->orden) {
        if ($request->orden=="A - Z") {
            $productos=Producto::orderBy('nombre','asc')->paginate(20);
        }
        if ($request->orden=="Z - A") {
            $productos=Producto::orderBy('nombre','desc')->paginate(20);
        }
        if ($request->orden=="Menor precio") {
            $productos=Producto::orderBy('precio','asc')->paginate(20);
        }
        if ($request->orden=="Mayor precio") {
            $productos=Producto::orderBy('precio','desc')->paginate(20);
        }
        
    }


    if ($request->minimo||$request->maximo) {
        if ($request->minimo&&$request->maximo) {
            $productos=Producto::whereBetween('precio', [$request->minimo, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        if ($request->minimo&&!$request->maximo) {
            $productos=Producto::whereBetween('precio', [$request->minimo, 999999999999999])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        if (!$request->minimo&&$request->maximo) {
            $productos=Producto::whereBetween('precio', [999999999999999, $request->maximo])->orderBy('precio','asc')->where('habilitado',1)->paginate(20);
        }
        
        
    }


   
    return view('catalogo', ['productos'=>$productos,'categorias'=>$categorias,'catalogo'=>$catalogo,'fuentes'=>$fuentes])->withInput();

    }



    public function destroy(Request $request)
        {
          $producto = Producto::find($request->eliminar);
          $dir = base_path('uploads/productos/');
          $path = base_path('uploads/productos/poplets/'.$producto->id.'/');
          //File::delete($dir . $producto->imagen);
            $oldpoplets=Poplets::where('producto_id', $producto->id)->get();
            foreach ($oldpoplets as $oldpoplet) {
                File::delete($path . $oldpoplet->imagen);
                $oldpoplet->delete();
            }
          $producto->delete();
          Session::flash('mensaje', 'Producto eliminado con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/productos/'))->withInput();
        }





}
