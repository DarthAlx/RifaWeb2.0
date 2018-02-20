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
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>


		<div class="row">
			<div class="col-md-12">
				<form action="{{ url('/agregar-codigo') }}" method="post" enctype="multipart/form-data" class="card">
				    <div class="card-content">
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

					          <div class="todosusers">


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
						                          <input type="checkbox" name="users[]" id="users" value="{{$user->id}}" required/>
						                          <label for="users">{{$user->emial}} - {{$user->name}}</label>
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
					        <div class="col m12">
					        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
					        </div>
					        <p>&nbsp;</p><p>&nbsp;</p>
				    </div>

				    </form>
			</div>
				
		</div>
		
		
		
	</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>

@endsection