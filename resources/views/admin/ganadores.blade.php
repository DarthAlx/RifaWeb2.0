@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Ganadores</h3>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>

		@if($ganadores)
		<div class="row">
			<div class="col-md-12">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
			      	<th class="sorting">Rifa</th>
					<th class="sorting_desc">Usuario</th>
			      	<th>Boleto</th>
			      	<th>Fecha de rifa</th>


			  	</tr>
			  </thead>
			  <tbody>
			  	@if($ganadores)
			  		@foreach($ganadores as $ganador)

						<tr style="cursor: pointer;" class="modal-trigger " href="#ganador{{$ganador->id}}">
							<td>{{$ganador->producto}}</td>
							<td>{{$ganador->user->name}}</td>
							<td>{{$ganador->boleto}}</td>
							<td>{{$ganador->fecha}}</td>
						</tr>
					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
						<td></td>
						<td></td>
						<td></td>					
					</tr>

				@endif
				



			  </tbody>
			  <tfoot>
			  	<tr>
			      	<th class="sorting">Rifa</th>
					<th class="sorting_desc">Usuario</th>
			      	<th>Boleto</th>
			      	<th>Fecha de rifa</th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
				
		</div>

		@endif
		
		
		
	</div>
</div>





@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.table tr th:first-child').removeClass('sorting_desc');
		$('.table tr th:first-child').addClass('sorting');
		$('.table tr th:nth-child(2)').addClass('sorting_asc');
	});
	
</script>
@endsection