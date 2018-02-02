@extends('templates.default')

@section('pagecontent')
<section class="perfil">
	<div class="perfilheader z-depth-3" style="background: url('{{url('/img/bg')}}/{{rand(1, 30)}}.jpg'); background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="profilecard">
						<div class="perfilimg left">
							<img class="circle" src="{{Auth::user()->avatar}}" alt="">
						</div>
						<div class="perfiltext right">
							<h2>
								{{Auth::user()->name}}
							</h2>
							<div class="chip amber accent-3">
								 <i class="fa fa-circle-o-notch" aria-hidden="true"></i> 100 <span class="hiddenmov">rifatokens</span>
							</div>
							<div class="chip light-blue lighten-3">
								<i class="fa fa-flag" aria-hidden="true"></i> 3 <span class="hiddenmov">participaciones</span>
							</div>
							<div class="chip light-green lighten-3">
								<i class="fa fa-trophy" aria-hidden="true"></i> 0 <span class="hiddenmov">ganadas</span>
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		
	</div>
	<p>&nbsp;</p>
	<div class="container">
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
              <li>
                <div class="collapsible-header"><div class="left">Xbox One </div><div class="right"><i class="fa fa-ticket" aria-hidden="true"></i>15</div></div>
                <div class="collapsible-body"><span># 1, 2, 3, 4, 5</span></div>
              </li>
              <li>
                <div class="collapsible-header"><div class="left">Iphone X </div><div class="right"><i class="fa fa-ticket" aria-hidden="true"></i>30</div></div>
                <div class="collapsible-body"><span># 1, 2, 3, 4, 5</span></div>
              </li>
              <li>
                <div class="collapsible-header"><div class="left">Xbox One </div><div class="right"><i class="fa fa-ticket" aria-hidden="true"></i>15</div></div>
                <div class="collapsible-body"><span># 1, 2, 3, 4, 5</span></div>
              </li>
              <li>
                <div class="collapsible-header"><div class="left">Iphone X </div><div class="right"><i class="fa fa-ticket" aria-hidden="true"></i>30</div></div>
                <div class="collapsible-body"><span># 1, 2, 3, 4, 5</span></div>
              </li>
            </ul>            
          </div>
        </div>
        <div class="col-md-8">
        	<div class="card z-depth-3 amber accent-2">
            <div class="card-content">
            	<h3 class="card-title">Rifas ganadas <i class="fa fa-trophy" aria-hidden="true"></i></h3>
            	<p class="flow-text">
            		Aun no has ganado ninguna rifa <i class="fa fa-frown-o" aria-hidden="true"></i>. ¡Sigue participando!
            	</p>
            </div>
          </div>

          <div class="card z-depth-3  blue-grey darken-1">

            <div class="card-content white-text">
            	<h3 class="card-title white-text">Tus mensajes <i class="fa fa-envelope" aria-hidden="true"></i></h3>
              <?php
                        $usuario=App\User::find(Auth::user()->id);
                       
                        if ($usuario->mensajes) {
                          $nuevos=App\Mensaje::where('user_id',$usuario->id)->count();
                          $mensajes=App\Mensaje::where('user_id',$usuario->id)->orderBy('created_at','desc')->paginate(10);
                        }
                      ?>

                @if($nuevos>0)
              <div class="collection">
                @foreach($mensajes as $mensaje)
                    <a href="#leer{{$mensaje->id}}" onclick="leer('{{$mensaje->id}}')" class="collection-item modal-trigger">{{str_limit($mensaje->msg, $limit = 20, $end = '...')}} <span  class="secondary-content">
                      @if($mensaje->leido)<i id="msj{{$mensaje->id}}" class="fa fa-envelope-open"></i>@else<i id="msj{{$mensaje->id}}" class="fa fa-envelope"></i>@endif

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
    <a class="btn-floating btn-large red pulse" data-toggle="tooltip" data-placement="top" title="Gestión de cuenta">
      <i class="fa fa-user fa2x"></i>
    </a>
    <ul>
      <li><a class="btn-floating blue" data-toggle="tooltip" data-placement="top" title="Direcciones"><i class="fa fa-map-marker"></i></a></li>
      <li><a class="btn-floating red" data-toggle="tooltip" data-placement="top" title="Editar perfil"><i class="fa fa-pencil"></i></a></li>
    </ul>
  </div>



  @if($usuario->mensajes)
@foreach($usuario->mensajes as $mensaje)
<!-- Modal Structure -->
  <div id="leer{{$mensaje->id}}" class="modal modal-fixed-footer" style="display: none;">
    <div class="modal-content" style="height: 100%;">
      <div class="row">
        <div class="col-md-12">
          <small>Mensaje enviado el {{$mensaje->fecha}}</small>
      <p>{{$mensaje->msg}}</p>
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
@endsection