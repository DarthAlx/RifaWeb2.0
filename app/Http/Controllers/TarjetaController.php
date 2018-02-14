<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarjeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TarjetaController extends Controller
{
        public function destroy(Request $request)
        {
          $tarjeta = Tarjeta::find($request->eliminar);
          $tarjeta->delete();
          Session::flash('mensaje', 'Tarjeta eliminada con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url()->previous());
        }
}
