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

				 <section class="pb-3 text-center">
				        
				    <p>&nbsp;</p>
				    <h3 class="section-title section-title-center">
	                  <b></b>
	                  <span class="secition-title-main">Ganadores</span>
	                  <b></b>
	                </h3>

				    <p class="grey-text pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi,
				        veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam.</p>
				    
				    <div class="row">
						@if($ganadores)
				    	@foreach($ganadores as $ganador)
				        <div class="col-lg-4 col-md-12 mb-4">
				    
				            <div class="card testimonial-card">
				    
				                <div class="card-up info-color"></div>
				    

				                <div class="avatar mx-auto white">
				                    <img src="{{$ganador->user->avatar}}" class="rounded-circle img-fluid">
				                </div>
				    
				                <div class="card-body">

				                    <h4 class="mt-1">
				                    	<?php
				                    		$usuario=explode(' ', $ganador->user->name);
				                    	 ?>
				                        <strong><?php for($i=0;$i<2;$i++){
				                        	if ($usuario[$i]!="") {
				                        		echo $usuario[$i]." ";
				                        	}
				                        } ?></strong>
				                    </h4>
				                    <hr>

				                    <p class="dark-grey-text">Ganador de {{$ganador->producto}}</p>
				                </div>
				    
				            </div>
				    
				        </div>
				        @endforeach
				        @endif

				    
				    </div>
				    
				</section>
				
			
		</div>
	

</div>

@endsection


@section('scripts')


@endsection