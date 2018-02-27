@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		
		
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Editar producto</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				
					
				

				<form action="{{ url('/producto') }}/{{$producto->id}}" method="post" enctype="multipart/form-data">
				 	{{ csrf_field() }}
					<div class="text-right" style="margin-left: auto;">
						<a class="waves-effect waves-light btn btn-large modal-trigger red" href="#delete{{$producto->id}}">Eliminar</a>

						@if((!$producto->ganador||$producto->ganador=="")&&strtotime($producto->fecha_limite) < strtotime(date("Y-m-d H:i:s")))<a class="waves-effect waves-light btn btn-large modal-trigger " href="#ganador" style="margin-left: 15px;">Ganador</a>@endif
						<input type="submit" value="Actualizar" class="btn btn-primary right waves-effect waves-light btn-large">
					</div>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
				@if(!$categorias)
				<div class="alert alert-warning alert-dismissable">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <ul>
				        <li>Aún no se han creado categorías, te recomendamos ir a la sección <a href="{{url('/categorias')}}">categorías</a> y crear las necesarias.</li>
				    </ul>
				  </div>
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Detalles</h5>
				    <div class="card-text">
				    	<div class="col s12">
					      <div class="row">
					        <div class="input-field col col-md-8">
							
								<input id="nombre" name="nombre" type="text" class="validate" value="{{$producto->nombre or old('nombre')}}" required>
					          
					          <label for="nombre">Nombre</label>
					        </div>
					        <div class="input-field col col-md-4">
					          <input id="sku" name="sku" type="text" class="validate" value="{{$producto->sku or old('sku')}}" required>
					          <label for="sku">SKU</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s12">
					          <textarea id="descripcion" name="descripcion" class="materialize-textarea" required>{{$producto->descripcion or old('descripcion')}}</textarea>
					          <label for="descripcion">Descripción</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					        	<div class="switch">
								    <label>
								      <input type="checkbox" name="habilitado" id="habilitado"/>
								      <span class="lever"></span>
								    </label>
								  </div>
					          <p>      
							      <label for="habilitado">Habilitado</label>
						      </p>
						      @if($producto->habilitado)
							      <script>
							      	$('#habilitado').prop('checked', true);
							      </script>
						      @endif
					        </div>

					        <div class="col s6">
					        	<div class="switch">
								    <label>
								      <input type="checkbox" name="destacado" id="destacado"/>
								      <span class="lever"></span>
								      
								    </label>
								  </div>
					          <p>      
							      <label for="destacado">Destacado</label>
						      </p>
						      @if($producto->destacado)
							      <script>
							      	$('#destacado').prop('checked', true);
							      </script>
						      @endif
					        </div>
					      </div>
					      
					    </div>
				    </div>

				  </div>
				</div>
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Boletos</h5>
				    <div class="card-text">
				    	<div class="col s12">
				    		<div class="row">
						        <div class="input-field col s12">
						        	<input type="hidden" name="loteria" id="loteriareal" value="{!! $producto->loteria !!}">
						        	<select id="loteria"  required>
								      <option value="" disabled selected>Elejir tipo</option>
								      	@if($loterias)
				    					@foreach($loterias as $loteria)
				    					<option value="{{$loteria->nombre}}">{{$loteria->nombre}}</option>
										@endforeach
										@endif
								    </select>
						          <label for="loteria">Tipo de lotería</label>
						          	<script type="text/javascript">
									 	if (document.getElementById('loteria') != null) document.getElementById('loteria').value = '{!! $producto->loteria !!}';
									 	$('#loteria').change(function(){
									 		document.getElementById('loteriareal').value = $('#loteria').val();
									 	});
								   	</script>
						        </div>
					      	</div>	
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="boletos" name="boletos" type="number" class="validate" value="{{$producto->boletos or old('boletos')}}" required>
					          <label for="boletos">Número de boletos</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="minimo" name="minimo" type="number" class="validate" value="{{$producto->minimo or old('minimo')}}" required>
					          <label for="minimo">Cantidad minima de boletos a vender</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s6">
					        	<?php 
									$datetime = explode(' ', $producto->fecha_limite);  
									$hora = explode(':', $datetime[1]);  
					        	?>
					        	
								<input id="fecha_limite" name="fecha_limite" type="text" class="datepicker" value="{{$datetime[0] or old('fecha_limite')}}" required>
					          
					          <label for="fecha_limite">Fecha limite</label>
					        </div>
					        <div class="input-field col s6">
								
								<input id="hora" name="hora" type="text" class="timepicker" value="{{$hora[0].':'.$hora[1]}}" required>
					          
					          <label for="hora">Hora</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="precio" name="precio" type="text" class="validate" value="{{$producto->precio or old('precio')}}" required>
					          <label for="precio">Precio normal</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="multiplicador" name="multiplicador" type="number" class="validate" value="{{$producto->multiplicador or old('multiplicador')}}" min="1" required>
					          <label for="multiplicador">Multiplicador</label>
					        </div>
					        <!--div class="input-field col col-md-6">
					          <input id="precio_especial" name="precio_especial" type="text" value="{{$producto->precio_especial or old('precio_especial')}}" class="validate">
					          <label for="precio_especial">Precio rebajado</label>
					        </div-->
					      </div>	
					      
					      				      
					    </div>
				    </div>

				  </div>
				</div>



				<!--div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Ganador</h5>
				    <div class="card-text">
				    	<div class="col s12">
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="ganador" name="ganador" type="text" class="validate" value="{{old('ganador')}}">
					          <label for="ganador">Número ganador</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="ganador_confirmation" namee="ganador_confirmation" type="text" value="{{old('ganador_confirmation')}}" class="validate">
					          <label for="ganador_confirmation">Confirmar número ganador</label>
					        </div>
					      </div>					      
					    </div>
				    </div>

				  </div>
				</div-->
			</div>

			<div class="col-md-4">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Categorías</h5>
				    <div class="card-text">
				    	@if($categorias)
				    	@foreach($categorias as $categoria)
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" name="categoria[]" value="{{$categoria->id}}" id="cat{{$categoria->id}}"/>
							      <label for="cat{{$categoria->id}}">{{$categoria->nombre}}</label>
						      </p>
					        </div>
					      </div>
					    @endforeach
					    @foreach(explode(',',$producto->categoria) as $pcategoria)
							<script>
							    $('#cat{{$pcategoria}}').prop('checked', true);
							</script>
					    @endforeach
					    @endif
				    </div>

				  </div>
				</div>


				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Imágen destacada</h5>
				    <div class="card-text">
				    	<div class="text-center">
				    		<div class="img-container">
				    			<img src="{{url('/uploads/productos')}}/{{$producto->imagen}}" alt="" class="responsive-img">
				    		</div>
				    	</div>
					      <div class="file-field input-field">
						      <div class="btn">
						        <span>Cambiar</span>
						        <input type="file" name="imagen">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				    </div>

				  </div>
				</div>


				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Galería</h5>
				    <input name="poplets" type="hidden" class="popletsnum">
				    <div class="card-text popletsinput">

				    	<div class="text-center">
				    		@foreach($producto->poplets as $poplet)
				    		<div class="img-container" style="max-width:100px; display: inline-block;">
				    			<img src="{{url('/uploads/productos/poplets')}}/{{$producto->id}}/{{$poplet->imagen}}" alt="" class="responsive-img">
				    		</div>
				    		@endforeach
				    	</div>
				      <div class="file-field input-field poplet1">
					      <div class="btn">
					        <span>Subir</span>
					        <input type="file" name="poplet1">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>

					    <div class="file-field input-field poplet2" style="display: none;">
					      <div class="btn">
					        <span>Subir</span>
					        <input type="file" name="poplet2">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>


					    <div class="file-field input-field poplet3" style="display: none;">
					      <div class="btn">
					        <span>Subir</span>
					        <input type="file" name="poplet3">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>

					    <div class="file-field input-field poplet4" style="display: none;">
					      <div class="btn">
					        <span>Subir</span>
					        <input type="file" name="poplet4">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>

				    </div>
				    <div class="text-right popletscontrols">
				    	<a class="minus" style="display: none;" onclick="popletremove();"><i class="fa fa-minus fa-2x" aria-hidden="true"></i></a>
				    <a class="plus" onclick="popletappend();"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
				    </div>
				    

				  </div>
				</div>

				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Video</h5>
				    <input name="poplets" type="hidden" class="popletsnum">
				    <div class="card-text popletsinput">
				      <div class="file-field input-field">
					      
					        <label>Código</label>
					        <input type="text" name="video" value="{{$producto->video->video or old('video')}}">      
					    </div>
				    </div>
				  </div>
				</div>
				<script>
					var poplet=1;
					function popletappend(){
						poplet++;
						$( ".poplet"+poplet ).fadeIn();
						
						$('.minus').fadeIn();
						$('.popletsnum').val(poplet);
						if(poplet>=4){
							$('.plus').fadeOut();
						}
					}
					function popletremove(){
						$( ".poplet"+poplet ).fadeOut();
						poplet--;
						if(poplet<2){
							$('.minus').fadeOut();
						}
						if(poplet<5){
							$('.plus').fadeIn();
						}
						$('.popletsnum').val(poplet);
					}
				</script>




			</div>
		</div>
		
	</div>
	</form>
</div>



<!-- Modal Structure -->
  <div id="delete{{$producto->id}}" class="modal">
    <div class="modal-content">
      <h4>Eliminar producto</h4>
      <p>¿Está seguro que desea eliminar este producto?</p>
    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cancelar</a> &nbsp; 
		<form action="{{ url('/eliminar-producto') }}" method="post" enctype="multipart/form-data">
			{{ method_field('DELETE') }}
			{!! csrf_field() !!}
			<input type="hidden" name="eliminar" value="{{$producto->id}}">
			<input type="submit" class="modal-action modal-close waves-effect waves-green red btn" value="Eliminar">
		</form>
    	
    </div>
  </div>


  <!-- Modal Structure -->
  <?php 
	$boletos = $producto->boletos;
	$digitos = strlen(intval($boletos));
	?>
  <div id="ganador" class="modal">
  	<form action="{{ url('/asignar-ganador') }}" method="post" enctype="multipart/form-data">
  		{!! csrf_field() !!}
  		<input type="hidden" name="producto" value="{{$producto->id}}">
    <div class="modal-content">
      <h4>Asignar Ganador</h4>
      <p>Ingresa los ultimos {{$digitos}} digitos del boleto ganador</p>
	
	    	<div class="col s12">
		      <div class="row">
		        <div class="input-field col col-md-6">
		          <input id="ganador" name="ganador" type="text" class="validate" value="{{old('ganador')}}" maxlength="{{$digitos}}" minlength="{{$digitos}}">
		          <label for="ganador">Número ganador</label>
		        </div>
		        <div class="input-field col col-md-6">
		          <input id="ganador_confirmation" name="ganador_confirmation" type="text" value="{{old('ganador_confirmation')}}" class="validate" maxlength="{{$digitos}}" minlength="{{$digitos}}">
		          <label for="ganador_confirmation">Confirmar número ganador</label>
		        </div>
		      </div>					      
		    </div>

    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cancelar</a> &nbsp; 
		
			
			

			<input type="submit" class="modal-action waves-effect waves-green btn" value="Terminar">
		
    	
    </div>
    </form>
  </div>
@endsection