@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Añadir nuevo</h5>
				    <div class="card-text">
				    	<form class="col s12">
					      <div class="row">
					        <div class="input-field col col-md-8">
					          <input id="nombre" type="text" class="validate" required>
					          <label for="nombre">Nombre</label>
					        </div>
					        <div class="input-field col col-md-4">
					          <input id="sku" type="text" class="validate" required>
					          <label for="sku">SKU</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s12">
					          <textarea id="textarea1" class="materialize-textarea"></textarea>
					          <label for="textarea1">Descripción</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col col-md-6">
					          <input id="precio" type="text" class="validate" required>
					          <label for="precio">Precio normal</label>
					        </div>
					        <div class="input-field col col-md-6">
					          <input id="precio_especial" type="text" class="validate" required>
					          <label for="precio_especial">Precio rebajado</label>
					        </div>
					      </div>
					     
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" id="habilitado" checked="checked"/>
							      <label for="habilitado">Habilitado</label>
						      </p>
					        </div>
					      </div>
					      
					    </form>
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
							      <input type="checkbox" id="cat1"/>
							      <label for="cat1">Viajes</label>
						      </p>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" id="cat1"/>
							      <label for="cat1">Celulares</label>
						      </p>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col s6">
					          <p>
							      <input type="checkbox" id="cat1"/>
							      <label for="cat1">Videojuegos</label>
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
						        <input type="file">
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
</div>
@endsection

