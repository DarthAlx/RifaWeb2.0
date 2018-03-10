@extends('templates.admin')
@section('header')

@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">RifaTokens</h3>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>

		
			<div class="row">
				<div class="col-md-12">
					<ul class="collapsible  popout" data-collapsible="accordion">
				  	@if($paquetes)
				  		@foreach($paquetes as $paquete)
					  		<li>
						      <div class="collapsible-header">
						      	Paquete {{$paquete->id}}
						      </div>
						      <div class="collapsible-body">
						      	<form action="{{ url('/rifatokens') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="paquete" value="{{$paquete->id}}">
						      	<div>
					              	<div class="row">
								        <div class="input-field col col-md-6">			
											<input id="rifatokens{{$paquete->id}}" name="rt" type="number" class="validate" value="{{$paquete->rt or old('rifatokens')}}" required>
								          	<label for="rifatokens{{$paquete->id}}">RifaTokens</label>
								        </div>
								        <div class="input-field col col-md-6">
								          <input id="precio{{$paquete->id}}" name="precio" type="number" class="validate" value="{{$paquete->precio or old('precio')}}" required>
								          <label for="precio{{$paquete->id}}">Precio</label>
								        </div>
								    </div>
								    <div class="row">
								        <div class="col s12">
								        	<div class="switch">
											    <label>
											      <input type="checkbox" name="habilitado" id="habilitado{{$paquete->id}}"/>
											      <span class="lever"></span>
											    </label>
											  </div>
								          <p>      
										      <label for="habilitado{{$paquete->id}}">Habilitado</label>
									      </p>
									      @if($paquete->habilitado)
										      <script>
										      	$('#habilitado{{$paquete->id}}').prop('checked', true);
										      </script>
									      @endif
								        </div>
								    </div>
					            </div>
								<div class="text-right">
									<input type="submit" value="Actualizar" class="btn btn-primary right waves-effect waves-light">
									<p>&nbsp;</p>
								</div>
								</form>
						      </div>
						      
						    </li>
						    
						@endforeach
					@endif
				</ul>
			  </div>
			</div>
		
				
		</div>
		
		
		
	</div>
</div>















@endsection

@section('scripts')

@endsection