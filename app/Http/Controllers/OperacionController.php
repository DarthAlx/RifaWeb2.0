<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Codigo;
use App\Operacion;
use App\User;

class OperacionController extends Controller
{
    public function canjear(Request $request)
    {
    	$codigo = Codigo::where('codigo', strtoupper($request->codigo))->first();
    	if ($codigo) {
            $inicio=strtotime($codigo->inicio);
            $fin=strtotime($codigo->fin);
            $ahora=strtotime(date("Y-m-d"));

            if($ahora>=$inicio&&$ahora<=$fin){
                $fechavalida=true;
            }
            else{
                $fechavalida=false;
            }

            if ($codigo->user_id!=null) {
                if (in_array(Auth::user()->id, explode(",",$codigo->users))) {
                    $uservalido=true;
                    $usos=Operacion::where('codigo_id',$codigo->id)->where('user_id',Auth::user()->id)->count();
                    if ($usos<=$codigo->usos) {
                        $usosvalido=true;
                    }
                    else{
                        $usosvalido=false;
                    }
                }
                else{
                    $uservalido=false;
                    $usosvalido=false;
                }
            }
            else{
                $uservalido=true;
                $usos=Operacion::where('codigo_id',$codigo->id)->count();
                if ($usos<$codigo->usos) {
                    $usosvalido=true;
                }
                else{
                    $usosvalido=false;
                }
            }



            if ($fechavalida&&$uservalido&&$usosvalido) {
                $operacion = new Operacion();
                $operacion->user_id=Auth::user()->id;
                $operacion->codigo_id=$codigo->id;
                $operacion->rt=$codigo->rt;
                $operacion->pesos=0;
                $operacion->tipo="Código";
                $operacion->fecha=date_create(date("Y-m-d H:i:s"));

                $usuario=User::find(Auth::user()->id);
                $usuario->rt=$usuario->rt+$codigo->rt;
                $usuario->save();
                
                //guardar
                if ($operacion->save()) {
                    Session::flash('mensaje', 'Obtuviste '.$codigo->rt.' RifaTokens.');
                    Session::flash('class', 'success');
                    return redirect()->intended(url('/perfil'))->withInput();
                    
                }
                else{
                    Session::flash('mensaje', 'Hubó un error, por favor, intenrtalo de nuevo.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/canjear'))->withInput();
                }
            }
            else{
                    Session::flash('mensaje', 'Código no aplicable.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/canjear'))->withInput();
                }



    	}
        else{
                    Session::flash('mensaje', 'Código no aplicable.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/canjear'))->withInput();
                }

    }
}
