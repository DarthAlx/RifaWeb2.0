@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Catálogos</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a  href="#nuevo" class="btn btn-primary right waves-effect waves-light btn-large modal-trigger">Añadir nuevo</a>
				</div>
				
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
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
					<th class="sorting_desc">Nombre</th>
			      	<th></th>
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($catalogos)
			  		@foreach($catalogos as $catalogo)

						<tr style="cursor: pointer;">
							<td>{{$catalogo->nombre}}</td>
							<td align="right" style="text-align: right;">
								<a class="waves-effect waves-light btn  modal-trigger " href="#update{{$catalogo->id}}"><i class="fa fa-pencil"></i></a>
								<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$catalogo->id}}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
						<td></td>					
					</tr>

				@endif
				



			  </tbody>
			  <tfoot>
			  	<tr>
					<th class="sorting_desc">Nombre</th>
			      	<th></th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
				
		</div>
		
		
		
	</div>
</div>






<!-- Modal Structure -->
  <div id="nuevo" class="modal">
  	<form action="{{ url('/agregar-catalogo') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Añadir nuevo</h4>
			{!! csrf_field() !!}
			<div class="input-field col m8">
	          <input id="nombre" name="nombre" type="text" class="validate" value="{{old('nombre')}}" required>
	          <label for="nombre">Nombre de catálogo</label>
	        </div>
	        <div class="col m4">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>






@if($catalogos)
@foreach($catalogos as $catalogo)
<!-- Modal Structure -->
  <div id="delete{{$catalogo->id}}" class="modal">
    <div class="modal-content">
      <h4>Eliminar catalogo ({{$catalogo->nombre}})</h4>
      <p>¿Está seguro que desea eliminar este catalogo?</p>
    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cancelar</a> &nbsp; 
		<form action="{{ url('/eliminar-catalogo') }}" method="post" enctype="multipart/form-data">
			{{ method_field('DELETE') }}
			{!! csrf_field() !!}
			<input type="hidden" name="eliminar" value="{{$catalogo->id}}">
			<input type="submit" class="modal-action modal-close waves-effect waves-green red btn" value="Eliminar">
		</form>
    	
    </div>
  </div>



  <!-- Modal Structure -->
  <div id="update{{$catalogo->id}}" class="modal">
  	<form action="{{ url('/actualizar-catalogo') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Editar ({{$catalogo->nombre}})</h4>
			{!! csrf_field() !!}
			<div class="input-field col m8">
				<input type="hidden" value="{{$catalogo->id}}" name="id">
	          <input id="nombre" name="nombre" type="text" class="validate" value="{{ $catalogo->nombre or old('nombre')}}" required>
	          <label for="nombre">Nombre de catálogo</label>
	        </div>
	        <div class="col m4">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>

  @endforeach
@endif







@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>

@endsection