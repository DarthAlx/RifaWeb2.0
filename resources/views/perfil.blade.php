@extends('templates.default')

@section('pagecontent')
<section class="perfil">
    <div >        
        <div class="social-login">
            <div class="">
                <h4 style="margin-bottom: 0;">MI CUENTA</h4>
            </div>
        </div>
    </div>
	<p>&nbsp;</p>
    <div class="container">
	    <div class="row">
	        <div class="col-md-3 sidenav">
	            <div class="panel panel-default perfilside">
	            	<img class="circle" src="{{url('/img/dummy.png')}}" alt="">
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
@endsection