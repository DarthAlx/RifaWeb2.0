@extends('templates.default')

@section('pagecontent')
<?php
                        $usuario=App\User::find(Auth::user()->id);
?>
<section class="perfil">
	<div class="perfilheader z-depth-3" style="background: url('{{url('/img/bg')}}/{{rand(1, 30)}}.jpg'); background-size: cover;">
		<div class="container">
			<div class="row">
				
					
            <div class="col-md-1 offset-md-3 col-12 text-center">
  						<div class="perfilimg left">
  							<img class="circle" src="{{Auth::user()->avatar}}" alt="">
  						</div>
            </div>
            <div class="col-md-8 col-12 text-center">
  						<div class="perfiltext left">
  							<h2>
  								{{Auth::user()->name}}
  							</h2>
  							<div class="chip amber accent-3">
  								 <i class="fa fa-circle-o-notch" aria-hidden="true"></i> {{$usuario->rt}} <span class="hiddenmov">rifatokens</span>
  							</div>
  							<!--div class="chip light-blue lighten-3">
  								<i class="fa fa-flag" aria-hidden="true"></i> {{$usuario->ordenes->count()}} <span class="hiddenmov">participaciones</span>
  							</div-->
  							<div class="chip light-green lighten-3">
  								<i class="fa fa-trophy" aria-hidden="true"></i> {{$usuario->ganadas->count()}} <span class="hiddenmov">ganadas</span>
  							</div>
  						</div>
            </div>
						
					
					
				
			</div>
		</div>
		
	</div>
	<p>&nbsp;</p>
	<div class="container">
    <div class="row">
      <div class="col-md-12">
        @include('snip.notificaciones')
      </div>
    </div>
		<div class="row">
        <div class="col-md-4">
          <div class="card z-depth-3">
            <div class="card-content">
            	<h3 class="card-title">Tus rifas <i class="fa fa-ticket" aria-hidden="true"></i></h3>
            	<p class="flow-text">
            		Aquí puedes encontrar las rifas en las que estás participando actualmente
            	</p>
            </div>

            <ul class="collapsible" data-collapsible="accordion" style="margin-bottom: 0;">
              <?php $ordenes= App\Orden::where('user_id',$usuario->id)->where('status', '<>','Terminada')->orderBy('created_at','desc')->paginate(10); $li=0;?>
              @foreach($ordenes as $orden)
                @foreach($orden->items as $item)

                
                  <li>
                    <div class="collapsible-header @if($li==0) active <?php $li++;?>@endif"><div class="left">{{$item->producto}} </div><div class="right">Ver <i class="fa fa-ticket" aria-hidden="true"></i></div></div>
                    <?php $boletos=explode(',',str_replace("t", "", $item->boletos)); $contador=0;?>
                    <div class="collapsible-body">
                          



                      @foreach($boletos as $boleto) @if($contador==0)<span class="ticket"><span class="circle"></span><span class="no">{{$boleto}}</span></span> <?php $contador++;?> @else <span class="ticket"><span class="circle"></span><span class="no">{{$boleto}}</span></span> @endif @endforeach

                      @if(strtotime($item->fecha) >= strtotime(date("Y-m-d H:i:s")))

                    <div id="contador{{$item->id}}" >
                            

                            <?php 
                            $datetime = explode(' ', $item->fecha); 
                            $fecha = explode('-', $datetime[0]); 

                            $hora = explode(':', $datetime[1]); 


                            ?>
                            <script>
                              var Countdown{{$item->id}} = new Countdown({
                              year: {{$fecha[0]}},
                              month : {{$fecha[1]}}, 
                              day   : {{$fecha[2]}},
                              hour   : {{$hora[0]}},
                              minutes   : {{$hora[1]}},
                              width : 200, 
                              height  : 50,
                              rangeHi:"day"
                              });

                            </script>
                          </div>
                          @endif

                        </div>
                  </li>
                @endforeach
              @endforeach
            </ul>  
            {{ $ordenes->links() }}          
          </div>
        </div>
        <div class="col-md-8">
        	<div class="card z-depth-3 amber accent-2">
            <div class="card-content">
            	<h3 class="card-title">Rifas ganadas <i class="fa fa-trophy" aria-hidden="true"></i></h3>

              <?php
                       
                       
                        if ($usuario->ganadas) {
                          $nuevas=App\Ganador::where('user_id',$usuario->id)->count();
                          $ganadas=App\Ganador::where('user_id',$usuario->id)->orderBy('created_at','desc')->paginate(10);
                        }
                      ?>

                @if($nuevas>0)
              <div class="collection">
                @foreach($ganadas as $ganada)
                    <a href="#ganada{{$ganada->id}}" class="collection-item modal-trigger"><b>¡{{$ganada->producto}}!</b> <span  class="secondary-content">
                      <i class="fa fa-search-plus" aria-hidden="true"></i></span>

                    </a>
                @endforeach

                {{ $ganadas->links() }}
              </div>
              @else


              <p class="flow-text">
                Aun no has ganado ninguna rifa <i class="fa fa-frown-o" aria-hidden="true"></i>. ¡Sigue participando!
              </p>
              @endif


            	
            </div>
          </div>

          <div class="card z-depth-3  blue-grey darken-1">

            <div class="card-content white-text">
            	<h3 class="card-title white-text">Tus mensajes <i class="fa fa-envelope" aria-hidden="true"></i></h3>
              <?php
                       
                       
                        if ($usuario->mensajes) {
                          $nuevos=App\Mensaje::where('user_id',$usuario->id)->count();
                          $mensajes=App\Mensaje::where('user_id',$usuario->id)->orderBy('created_at','desc')->paginate(10);
                        }
                      ?>

                @if($nuevos>0)
              <div class="collection">
                @foreach($mensajes as $mensaje)
                    <a href="#leer{{$mensaje->id}}" onclick="leer('{{$mensaje->id}}')" class="collection-item modal-trigger">{!!str_limit($mensaje->asunto, $limit = 50, $end = '...')!!} <span  class="secondary-content">
                      @if($mensaje->leido)<i id="msj{{$mensaje->id}}" class="fa fa-envelope-open"></i>@else<i id="msj{{$mensaje->id}}" class="fa fa-envelope"></i>@endif</span>

                    </a>
                @endforeach

                {{ $mensajes->links() }}
              </div>
              @else


            	<p class="flow-text">
            		No tienes ningún mensaje nuevo.
            	</p>
              @endif
            </div>
          </div>
        </div>
      </div>
	</div>

</section>
<p>&nbsp;</p>
<div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large red pulse tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Gestión de cuenta">
      <i class="fa fa-user fa2x"></i>
    </a>
    <ul>
      <li><a class="btn-floating blue tooltipped modal-trigger " href="#tarjetas" data-position="bottom" data-delay="50" data-tooltip="Tarjetas"><i class="fa fa-credit-card-alt"></i></a></li>
      <li><a class="btn-floating green tooltipped modal-trigger " href="#passwordmodal" data-position="bottom" data-delay="50" data-tooltip="Cambiar contraseña"><i class="fa fa-lock"></i></a></li>
      <!--li><a class="btn-floating red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar perfil"><i class="fa fa-pencil"></i></a></li-->

    </ul>
  </div>


  @if($usuario->ganadas)
@foreach($usuario->ganadas as $ganada)
<!-- Modal Structure -->
  <div id="ganada{{$ganada->id}}" class="modal modal-fixed-footer" style="display: none;">
    <div class="modal-content" style="height: 100%;">
      <div class="row">
        <div class="col-md-12">
          <h2 style="text-align: center;">¡Muchísimas felicidades!</h2>
          <div style="text-align: center;">
            <img src="{{url('/uploads/productos')}}/{{$ganada->imagen}}" class="circle" style="margin: 0 auto; max-width: 250px;" alt="">
          </div>
      <p>Eres el ganador en la rifa <b>"{{$ganada->producto}}"</b> con el boleto número <b>"{{$ganada->boleto}}"</b>. El ganador se obtuvo de la rifa <b>"{{$ganada->lotería}}"</b> en la fecha <b>"{{$ganada->fecha}}"</b>.</p>

      <p>Haz click en el siguiente botón para ver cómo reclamar tu premio</p>
<div style="text-align: center;">
  <a href="#" class="btn waves-effect waves-green">RECLAMAR MI PRODUCTO</a>
</div>

      
        </div>
      </div>
       
    </div>
 <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp;
    </div>
  </div>
  @endforeach
@endif




  @if($usuario->mensajes)
@foreach($usuario->mensajes as $mensaje)
<!-- Modal Structure -->
  <div id="leer{{$mensaje->id}}" class="modal modal-fixed-footer" style="display: none;">
    <div class="modal-content" style="height: 100%;">
      <div class="row">
        <div class="col-md-12">
          <h2 style="text-align: center;">{{$mensaje->asunto}}</h2>
          <small style="text-align: right;">Mensaje enviado el {{$mensaje->fecha}}</small>
          
          @if($mensaje->imagen)
          <img src="{{url('/uploads/mensajes')}}/{{$mensaje->imagen}}" style="max-width: 100%;" alt="">
          @endif
          <p>&nbsp;</p>
      <p>{!!$mensaje->msg!!}</p>
      <div class="text-right">
        
      </div>
      
        </div>
      </div>
       
    </div>
 <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp;
    </div>
  </div>
  @endforeach
@endif

@if($usuario)

<!-- Modal Structure -->
  <div id="passwordmodal" class="modal modal-fixed-footer" style="display: none;">
    <div class="modal-content" style="height: 100%;">
      <div class="row">
        <div class="col-md-12">
          <h5>Contraseña</h5>

                  <form action="{{ url('/cambiar-contrasena-user') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="usuario_id" value="{{$usuario->id}}">
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="password" type="password" name="password" class="validate" required>
                      <label for="password">Nueva contraseña</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="password_confirmation" name="password_confirmation" type="password" class="validate" required>
                      <label for="password_confirmation">Confirmar nueva contraseña</label>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col s12">
                      <input type="submit" value="Cambiar" class="btn btn-primary right waves-effect waves-light">
                    </div>
                  </div>
                </form>
      
        </div>
      </div>
       
    </div>
 <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp;
    </div>
  </div>

@endif




@if($usuario->tarjetas)

<!-- Modal Structure -->
  <div id="tarjetas" class="modal">
    <div class="modal-content">
      <h4>Tarjetas</h4>
  @if(!$usuario->tarjetas->isEmpty())
      <ul class="collapsible" data-collapsible="accordion" style="margin-bottom: 0;">
      @foreach($usuario->tarjetas as $tarjeta)
              <li>
                <div class="collapsible-header"><div class="left">{{$tarjeta->identificador}} </div>
                  <div class="right">
                    <form action="{{url('/eliminar-tarjeta')}}" method="post" enctype="multipart/form-data">
                      {{ method_field('DELETE') }}
                      {!! csrf_field() !!}
                      <input type="hidden" name="eliminar" value="{{$tarjeta->id}}">
                      <button type="submit" class="modal-action modal-close waves-effect waves-green red btn"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
                    </form> &nbsp; &nbsp;
                  </div>
                </div>
               
              </li>
            @endforeach

 
            </ul>
            @else
            <p>Aún no hay tarjetas guardadas.</p>  
@endif
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp; 
    </div>
  </div>

@endif

<div id="cumpleanos" class="modal">
              <div class="modal-content">
                <h4>¡Feliz cumpleaños!</h4>

                <p>Te regalamos 100 RifaTokens.</p>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp; 
              </div>
            </div>


  

  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">




@endsection

@section("scripts")

<script>

  function leer(valor1){

    mensaje = valor1;
    _token = $('#token').val();
    $.post("{{url('/leermensaje')}}", {
        mensaje : mensaje,
        _token : _token
        }, function(data) {
          $("#msj"+valor1).removeClass('fa-envelope');
          $("#msj"+valor1).addClass('fa-envelope-open');
        });

  }
  
</script>


<?php 
  $hoy1= date("Y-m-d"); 
  $dob1=$usuario->dob;
  $hoy = explode('-', $hoy1);  
  $dob = explode('-', $dob1);  
  $creado=$usuario->created_at;
  $crea1=explode(' ', $creado);  
  $creacion=explode('-', $crea1[0]);  

  $dob[0]=$hoy[0];


  if (strtotime(date("Y-m-d")) >= strtotime(implode("-", $dob))) {
    $regalado=App\Operacion::where('user_id',$usuario->id)->where('tipo','Cumpleaños')->orderBy('fecha','desc')->first();
    if ($regalado) {
      $cumple=explode('-', $regalado->fecha);
      if ($hoy[0]>$cumple[0]) {
          $operacion = new App\Operacion();
          $operacion->user_id=Auth::user()->id;
          $operacion->rt=100;
          $operacion->pesos=0;
          $operacion->tipo="Cumpleaños";
          $operacion->fecha=date_create(date("Y-m-d H:i:s"));
          $operacion->save();
          $usuario->rt=$usuario->rt+100;
          $usuario->save();
          ?>
          
            <script type='text/javascript'>
              $('#cumpleanos').modal();
              $( document ).ready(function() {
              $('#cumpleanos').modal('open');
              });
              </script>
          <?php
      }


    }
    elseif($creacion[0]!=$hoy[0]){
        $operacion = new App\Operacion();
          $operacion->user_id=Auth::user()->id;
          $operacion->rt=100;
          $operacion->pesos=0;
          $operacion->tipo="Cumpleaños";
          $operacion->fecha=date_create(date("Y-m-d H:i:s"));
          $operacion->save();
          $usuario->rt=$usuario->rt+100;
          $usuario->save();
          ?>

            
            <script type='text/javascript'>
              $('#cumpleanos').modal();
              $( document ).ready(function() {
              $('#cumpleanos').modal('open');
              });
              </script>
          <?php
      }
    

  }

  

?>



@endsection