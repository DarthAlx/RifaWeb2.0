<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Operacion;
use App\Item;
use App\User;
use App\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function admin(Request $request)
    {
        
        $from_n = strtotime ( $request->from )  ;
      $to_n = strtotime ( $request->to )  ;
      $from = date ( 'Y-m-d' , $from_n );
      $to = date ( 'Y-m-d' , $to_n );
        $ventas=Operacion::whereBetween('fecha', array($from, $to))->sum('pesos');
        $rt=Operacion::whereBetween('fecha', array($from, $to))->sum('rt');
        $boletos=Item::whereBetween('created_at', array($from, $to))->sum('cantidad');
        $usuarios=User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->count();
        $mujeres=User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('genero','Femenino')->count();
        $hombres=User::whereBetween('created_at', array($from, $to))->where('is_admin',0)->where('genero','Masculino')->count();
        $productos=Producto::all();
        $boletos1=array();
        $labels="";
        $data=array();
        foreach ($productos as $producto) {
            $items=Item::whereBetween('created_at', array($from, $to))->where('producto_id',$producto->id)->sum('cantidad');
            $boletos1[]=array('nombre' => $producto->nombre, 'boletos' => $items);
            
        }
        foreach ($boletos1 as $boleto) {
            $labels.="'".$boleto['nombre']."',";
            $data[]=intval($boleto['boletos']);
        }

            
    
        return view('admin', ['ventas'=>$ventas,'boletos'=>$boletos,'rt'=>$rt,'usuarios'=>$usuarios,'mujeres'=>$mujeres,'hombres'=>$hombres,'labels'=>$labels,'data'=>$data,'from'=>$from,'to'=>$to]);
    }
}
