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
					          <p>
							      <input type="checkbox" name="habilitado" id="habilitado" checked="checked"/>
							      <label for="habilitado">Habilitado</label>
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
			</div>

			<div class="col-md-4">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Categorías</h5>
				    <div class="card-text">
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" name="categoria[]" value="1" id="cat1"/>
							      <label for="cat1">Viajes</label>
						      </p>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" name="categoria[]" value="2" id="cat2"/>
							      <label for="cat2">Celulares</label>
						      </p>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" name="categoria[]" value="3" id="cat3"/>
							      <label for="cat3">Videojuegos</label>
						      </p>
					        </div>
					      </div>
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
			</div>
		</div>
		
	</div>
	</form>
</div>
@endsection

