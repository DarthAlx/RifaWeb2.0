@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Productos</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a href="{{url('/productos/nuevo')}}" class="btn btn-primary right waves-effect waves-light btn-large">Añadir nuevo</a>
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
			      	<th class="sorting"><i class="fa fa-picture-o"></i></th>
					<th class="sorting_desc">Nombre</th>
			      	<th>SKU</th>
			      	<th>Lotería</th>
			      	<th>Inventario</th>
					<th>Precio</th>
			      	<th>Categorías</th>
			      	<th><i class="fa fa-star"></i></th>
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($productos)
			  		@foreach($productos as $producto)

						<tr style="cursor: pointer;" onclick="location = '<?= url('/producto')?>/<?= $producto->id ?>'">
							<td><img src="{{url('/uploads/productos')}}/{{$producto->imagen}}" alt="" style="max-width: 50px;"></td>
							<td>{{$producto->nombre}}</td>
							<td>{{$producto->sku}}</td>
							<td>{{$producto->loteria}}</td>
							<td>@if($producto->vendidos){{$producto->boletos-$producto->vendidos}}@else{{$producto->boletos}}@endif</td>
							<td>${{$producto->precio}}</td>
							<td><?php $categorias=explode(',', $producto->categoria) ?> @foreach($categorias as $categoria) <?php $cate=App\Categoria::find($categoria); ?>{{$cate->nombre}}&nbsp;&nbsp;@endforeach</td>
							<td>@if($producto->destacado)<i class="fa fa-star"></i>@else<i class="fa fa-star-o"></i>@endif</td>	
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
			      	<th class="sorting"><i class="fa fa-picture-o"></i></th>
					<th class="sorting_desc">Nombre</th>
			      	<th>SKU</th>
			      	<th>Lotería</th>
			      	<th>Inventario</th>
					<th>Precio</th>
			      	<th>Categorías</th>
			      	<th><i class="fa fa-star"></i></th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
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
<script>
	$(document).ready(function() {
		$('.table tr th:first-child').removeClass('sorting_desc');
		$('.table tr th:first-child').addClass('sorting');
		$('.table tr th:nth-child(2)').addClass('sorting_asc');
	});
	
</script>
@endsection