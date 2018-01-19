@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		
		<form action="{{ url('/agregar-producto') }}" method="post" enctype="multipart/form-data">
			 {{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Añadir nuevo</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light btn-large">
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
					          <input id="nombre" name="nombre" type="text" class="validate" value="{{old('nombre')}}" required>
					          <label for="nombre">Nombre</label>
					        </div>
					        <div class="input-field col col-md-4">
					          <input id="sku" name="sku" type="text" class="validate" value="{{old('sku')}}" required>
					          <label for="sku">SKU</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s12">
					          <textarea id="descripcion" name="descripcion" class="materialize-textarea" required>{{old('descripcion')}}</textarea>
					          <label for="descripcion">Descripción</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					        	<div class="switch">
								    <label>
								      <input type="checkbox" name="habilitado" id="habilitado" checked="checked"/>
								      <span class="lever"></span>
								      
								    </label>
								  </div>
					          <p>      
							      <label for="habilitado">Habilitado</label>
						      </p>
					        </div>

					        <div class="col s6">
					        	<div class="switch">
								    <label>
								      <input type="checkbox" name="destacado" id="destacado"/>
								      <span class="lever"></span>
								      
								    </label>
								  </div>
					          <p>      
							      <label for="habilitado">Destacado</label>
						      </p>
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
					        <div class="input-field col col-md-6">
					          <input id="boletos" name="boletos" type="number" class="validate" value="{{old('boletos')}}" required>
					          <label for="boletos">Número de boletos</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="minimo" name="minimo" type="number" class="validate" value="{{old('minimo')}}" required>
					          <label for="minimo">Cantidad minima de boletos a vender</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="fecha_limite" name="fecha_limite" type="text" class="datepicker" value="{{old('fecha_limite')}}" required>
					          <label for="fecha_limite">Fecha limite</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="precio" name="precio" type="text" class="validate" value="{{old('precio')}}" required>
					          <label for="precio">Precio normal</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="precio_especial" namee="precio_especial" type="text" value="{{old('precio_especial')}}" class="validate">
					          <label for="precio_especial">Precio rebajado</label>
					        </div>
					      </div>					      
					    </div>
				    </div>

				  </div>
				</div>


				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Ganadores</h5>
				    <div class="card-text">
				    	<div class="col s12">
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="melate" name="melate" type="text" class="validate" value="{{old('melate')}}">
					          <label for="melate">Ganador Melate</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="melate_confirmation" name="melate_confirmation" type="number" class="validate" value="{{old('melate_confirmation')}}">
					          <label for="melate_confirmation">Confirmar ganador Melate</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="ganador" name="ganador" type="text" class="validate" value="{{old('ganador')}}">
					          <label for="ganador">Ganador RifaWeb</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="ganador_confirmation" namee="ganador_confirmation" type="text" value="{{old('ganador_confirmation')}}" class="validate">
					          <label for="ganador_confirmation">Confirmar ganador RifaWeb</label>
					        </div>
					      </div>					      
					    </div>
				    </div>

				  </div>
				</div>
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
					    @endif
				    </div>

				  </div>
				</div>


				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Imágen destacada</h5>
				    <div class="card-text">
					      <div class="file-field input-field">
						      <div class="btn">
						        <span>Subir</span>
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
				      <div class="file-field input-field">
					      <div class="btn">
					        <span>Subir</span>
					        <input type="file" name="poplet1">
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
				<script>
					var poplet=1;
					function popletappend(){
						poplet++;
						$( ".popletsinput" ).append("<div class='file-field input-field poplet"+poplet+"'><div class='btn'><span>Subir</span><input type='file' name='poplet"+poplet+"'></div><div class='file-path-wrapper'><input class='file-path validate' type='text'></div></div>");
						$('.minus').fadeIn();
						$('.popletsnum').val(poplet);
						if(poplet>=5){
							$('.plus').fadeOut();
						}
					}
					function popletremove(){
						$( ".poplet"+poplet ).remove();
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
@endsection