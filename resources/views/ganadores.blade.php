@extends('templates.default')

@section('header')
<script type="text/javascript" src="{{ url('js/llqrcode.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webqr.js') }}"></script>

@endsection


@section('pagecontent')

<div class="container">

		<div class="col-sm-12">
			@include('snip.notificaciones')
		</div>


		

		<div class="row">

				 <section class="col s12 text-center">
				        
				    <p>&nbsp;</p>
				    <h3 class="section-title section-title-center">
	                  <b></b>
	                  <span class="secition-title-main">Ganadores</span>
	                  <b></b>
	                </h3>

				    <p class="grey-text pb-5"></p>
				    
				    <div class="row">
						@if($ganadores)
				    	@foreach($ganadores as $ganador)
				        <div class="col-lg-4 col-md-12 mb-4">
				    
				            <div class="card testimonial-card">
				    
				                <div class="card-up info-color"></div>
				    

				                <div class="avatar mx-auto white">
				                	
				                	
				                    <img src="{{url('/uploads/productos')}}/{{$ganador->imagen}}" class="rounded-circle img-fluid">
				                
				                </div>
				    
				                <div class="card-body">

				                    <h4 class="mt-1">
				                    	
				                        <strong>{{$ganador->producto}}</strong>
				                       
				                    </h4>
				                    <p class="text-center">{{$ganador->fecha}}</p>
				                    <hr>


				                    <p class="text-center">
					                   
					                    {{$ganador->loteria}}
					                  
				                	</p>
				                	<?php $usuario=explode(" ",$ganador->user->name); ?>

				                    <p class="dark-grey-text">El ganador de {{$ganador->producto}} es <b>{{$usuario[0]}}</b> con el número de boleto: <b>{{$ganador->boleto}}</b> </p>
				                </div>
				    
				            </div>
				    
				        </div>
				        @endforeach
				        @else
				        <p class="grey-text pb-5">Aún no hay ganadores.</p>
				        @endif

				    
				    </div>
				    
				</section>
				
			
		</div>
	

</div>

@endsection


@section('scripts')


@endsection