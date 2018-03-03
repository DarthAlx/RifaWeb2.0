@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Ordenes</h3>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>

		@if($ordenes)
		<div class="row">
			<div class="col-md-12">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
			      	<th class="sorting">ID</th>
					<th class="sorting_desc">Usuario</th>
			      	<th>Folio</th>
			      	<th>Estatus</th>
			      	<th>RifaTokens</th>
					<th>Pesos</th>
			      	<th>Fecha</th>

			  	</tr>
			  </thead>
			  <tbody>
			  	@if($ordenes)
			  		@foreach($ordenes as $orden)
			  		@if($orden->operacion->tipo=="Compra")

						<tr style="cursor: pointer;" class="modal-trigger " href="#orden{{$orden->id}}">
							<td>{{$orden->order_id}}</td>
							<td>{{$orden->user->name}}</td>
							<td>{{$orden->folio}}</td>
							<td>{{$orden->status}}</td>
							<td>{{$orden->operacion->rt}}</td>
							<td>{{$orden->operacion->pesos}}</td>
							<td>{{$orden->operacion->fecha}}</td>
						</tr>
					@endif
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
					</tr>

				@endif
				



			  </tbody>
			  <tfoot>
			  	<tr>
			      	<th class="sorting">ID</th>
					<th class="sorting_desc">Usuario</th>
			      	<th>Folio</th>
			      	<th>Estatus</th>
			      	<th>RifaTokens</th>
					<th>Pesos</th>
			      	<th>Fecha</th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
				
		</div>

		@endif
		
		
		
	</div>
</div>



@if($ordenes)
@foreach($ordenes as $orden)
<!-- Modal Structure -->
  <div id="orden{{$orden->id}}" class="modal">
    <div class="modal-content">
      <h4>Orden ({{$orden->order_id}})</h4>
      <h5>Rifas</h5>
  
      <ul class="collapsible" data-collapsible="accordion" style="margin-bottom: 0;">
			@foreach($orden->items as $item)
              <li>
                <div class="collapsible-header"><div class="left">{{$item->producto}} </div><div class="right"><i class="fa fa-ticket" aria-hidden="true"></i>{{$item->cantidad}}</div></div>
                <div class="collapsible-body"><span># {{str_replace("t", "", $item->boletos)}}</span></div>
              </li>
            @endforeach
 
            </ul>  

    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cerrar</a> &nbsp; 
    </div>
  </div>

  @endforeach
@endif



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