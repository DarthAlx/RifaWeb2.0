@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />

@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Código</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a  href="{{url('/agregar-codigo')}}" class="btn btn-primary right waves-effect waves-light btn-large">Añadir nuevo</a>
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
					<th class="sorting_desc">Código</th>
					<th>RifaTokens</th>
					<th>Usuario</th>
					
					<th>Inicio</th>
					<th>Fin</th>
					<th>Usos</th>
					<th>Aplicaciones</th>
			      	<th></th>
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($codigos)
			  		@foreach($codigos as $codigo)

						<tr style="cursor: pointer;">
							<td>{{$codigo->codigo}}</td>
							<td>{{$codigo->rt}}</td>
							<td>
								@if($codigo->users)
								<?php $usuarios1=explode(",",$codigo->users); ?>
								@foreach($usuarios1 as $usuario1)
									<?php $user1=App\User::find($usuario1); ?>
									{{$user1->email}}, 
									@endforeach
								@else
									Todos
								@endif
							</td>
							<td>{{$codigo->inicio}}</td>
							<td>{{$codigo->fin}}</td>
							<td>{{$codigo->usos}}</td>
							<td>{{$codigo->aplicaciones->count()}}</td>
							<td align="right" style="text-align: right;">
								<a class="waves-effect waves-light btn" href="{{url('/actualizar-codigo')}}/{{$codigo->id}}"><i class="fa fa-pencil"></i></a>
								<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$codigo->id}}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>					
					</tr>

				@endif
				



			  </tbody>
			  <tfoot>
			  	<tr>
					<th class="sorting_desc">Código</th>
					<th>RifaTokens</th>
					<th>Usuario</th>
					
					<th>Inicio</th>
					<th>Fin</th>
					<th>Usos</th>
					<th>Aplicaciones</th>
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
  	<form action="{{ url('/agregar-codigo') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Añadir nuevo</h4>
			{!! csrf_field() !!}
			<div class="input-field col m6">
	          <input id="codigo" name="codigo" type="text" class="validate" value="{{old('codigo')}}" required>
	          <label for="codigo">Código</label>
	        </div>
	        <div class="input-field col m6">
	          <input id="rt" name="rt" type="number" class="validate" value="{{old('rt')}}" required>
	          <label for="rt">RifaTokens</label>
	        </div>

	        <div class="input-field col m6">
	          <input id="inicio" name="inicio" type="text" class="validate datepicker" value="{{old('inicio')}}" required>
	          <label for="inicio">Inicio</label>
	        </div>
	        <div class="input-field col m6">
	          <input id="fin" name="fin" type="text" class="validate datepicker" value="{{old('fin')}}" required>
	          <label for="fin">Fin</label>
	        </div>


	        <!--div class="input-field col m12">
	        	<input type="hidden" name="user_id" id="multipleuser" value="">
	          <input type="text" id="user_id" class="autocomplete" value="" placeholder="Buscar por email"  autocomplete="off">
	          
	          <label for="user_id">Usuario</label>
	          <p id="usercontainer"></p>
	        </div-->

	        <div class="col m12">
	          
	          
	          <label for="user_id">Usuarios</label>

	          <div class="todosusers" style="max-height: 800px; overflow: scroll;">


	          	<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
					<th class="sorting_desc">Usuario</th>
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($usuarios)
			  		@foreach($usuarios as $user)

						<tr style="cursor: pointer;">
							<td>
								<p>
		                          <input type="checkbox" name="users[]" id="users" required/>
		                          <label for="users">{{$user->email}} - {{$user->name}}</label>
	                        	</p>
	                        </td>
						</tr>
					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
									
					</tr>
				@endif
			  </tbody>
			  <tfoot>
			  	<tr>
					<th class="sorting_desc">Usuario</th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
	          	
	          </div>


	        </div>

	        <div class="input-field col m12">
	          <input id="usos" name="usos" type="number" class="validate" min="1" value="{{old('usos')}}" required>
	          <label for="usos">Usos maximos</label>
	        </div>
	        <div class="col m4">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>






@if($codigos)
@foreach($codigos as $codigo)
<!-- Modal Structure -->
  <div id="delete{{$codigo->id}}" class="modal">
    <div class="modal-content">
      <h4>Eliminar código ({{$codigo->codigo}})</h4>
      <p>¿Está seguro que desea eliminar este código?</p>
    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cancelar</a> &nbsp; 
		<form action="{{ url('/eliminar-codigo') }}" method="post" enctype="multipart/form-data">
			{{ method_field('DELETE') }}
			{!! csrf_field() !!}
			<input type="hidden" name="eliminar" value="{{$codigo->id}}">
			<input type="submit" class="modal-action modal-close waves-effect waves-green red btn" value="Eliminar">
		</form>
    	
    </div>
  </div>



  <!-- Modal Structure -->
  <div id="update{{$codigo->id}}" class="modal">
  	<form action="{{ url('/actualizar-codigo') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Editar ({{$codigo->codigo}})</h4>
			{!! csrf_field() !!}
			<input type="hidden" value="{{$codigo->id}}" name="id">
			<div class="input-field col m6">
	          <input id="codigo" name="codigo" type="text" class="validate" value="{{$codigo->codigo or old('codigo')}}" required>
	          <label for="codigo">Código</label>
	        </div>
	        <div class="input-field col m6">
	          <input id="rt" name="rt" type="number" class="validate" value="{{$codigo->rt or old('rt')}}" required>
	          <label for="rt">RifaTokens</label>
	        </div>

	        <div class="input-field col m6">
	          <input id="inicio" name="inicio" type="text" class="validate datepicker" value="{{$codigo->inicio or old('inicio')}}" required>
	          <label for="inicio">Inicio</label>
	        </div>
	        <div class="input-field col m6">
	          <input id="fin" name="fin" type="text" class="validate datepicker" value="{{$codigo->fin or old('fin')}}" required>
	          <label for="fin">Fin</label>
	        </div>


	        <div class="input-field col m12">
	          <input type="text" name="user_id" id="user_id" class="autocomplete" value="{{$codigo->user->email or old('user_id')}}" placeholder="Buscar por email"  autocomplete="off">
	          
	          <label for="user_id">Usuario</label>


	        </div>



	        <div class="input-field col m12">
	          <input id="usos" name="usos" type="number" class="validate" min="1" value="{{$codigo->usos or old('usos')}}" required>
	          <label for="usos">Usos maximos</label>
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