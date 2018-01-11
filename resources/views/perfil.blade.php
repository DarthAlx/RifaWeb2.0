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
								Jesus {{Auth::user()->name}} Arguello
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
    <div >        
        <div class="social-login">
            <div class="">
                <h4 style="margin-bottom: 0;">MI CUENTA</h4>
            </div>
        </div>
    </div>
	
	
    <div class="container">
	    <div class="row">
	        <div class="col-md-3 sidenav">
	            <div class="panel panel-default perfilside">
	            	<img class="circle" src="{{Auth::user()->avatar}}" alt="">
	            	<h6 class="grey-text"><strong>{{Auth::user()->name}}</strong></h6>
	                <ul class="list-group">
	                    <a href="#" class="list-group-item grey-text">ESCRITORIO</a>
	                    <a href="#" class="list-group-item grey-text">PEDIDOS</a>
	                    <a href="#" class="list-group-item grey-text">DIRECCIONES</a>
	                    <a href="#" class="list-group-item grey-text">CUENTA</a>
	                    <a href="#" class="list-group-item grey-text">LISTA DE DESEOS</a>
	                </ul>
	            </div>
	        </div>
	        <div class="col-md-9">
	        	<?php $nombre=explode(" ",Auth::user()->name);
		        if ( ! isset($nombre[1])) {
		            $nombre[1] = null;
		        }?>
	        	<p>Hola {{ucfirst($nombre[0])}} (¿no eres {{ucfirst($nombre[0])}}? <a href="{{url('/salir')}}">Cerrar sesión</a>)<br>

Desde el panel de control de tu cuenta puedes ver tus pedidos recientes, gestionar tus direcciones de envío y facturación y editar tu contraseña y los detalles de tu cuenta.</p>
	        </div>
		</div>
	</div>
</section>

<div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large red" data-toggle="tooltip" data-placement="top" title="Gestión de cuenta">
      <i class="fa fa-user fa2x"></i>
    </a>
    <ul>
      <li><a class="btn-floating yellow darken-1" data-toggle="tooltip" data-placement="top" title="Editar perfil"><i class="fa fa-pencil"></i></a></li>
      <li><a class="btn-floating green" data-toggle="tooltip" data-placement="top" title="Editar perfil"><i class="fa fa-pencil"></i></a></li>
      <li><a class="btn-floating blue" data-toggle="tooltip" data-placement="top" title="Editar perfil"><i class="fa fa-pencil"></i></a></li>
      <li><a class="btn-floating red" data-toggle="tooltip" data-placement="top" title="Editar perfil"><i class="fa fa-pencil"></i></a></li>
    </ul>
  </div>
@endsection