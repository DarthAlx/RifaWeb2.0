@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Rifas canceladas</h3>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>

		@if($canceladas)
		<div class="row">
			<div class="col-md-12">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
			      	<th>Rifa</th>
					<th>Minimo</th>
			      	<th>Vendidos</th>
			      	<th>Fecha limite</th>


			  	</tr>
			  </thead>
			  <tbody>
			  	@if($canceladas)
			  		@foreach($canceladas as $cancelada)

						<tr>
							<td>{{$cancelada->producto}}</td>
							<td>{{$cancelada->minimo}}</td>
							<td>{{$cancelada->vendidos}}</td>
							<td>{{$cancelada->fecha}}</td>
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
			      	<th>Rifa</th>
					<th>Minimo</th>
			      	<th>Vendidos</th>
			      	<th>Fecha limite</th>
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

@endsection