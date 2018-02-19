@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Escritorio</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="card blue-grey darken-1">
		            <div class="card-content white-text">
		              <span class="card-title">Ventas totales</span>

		              <h5 style="font-weight: 700">${{$ventas}}MXN</h5>
		            </div>
		            
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card blue-grey darken-1">
		            <div class="card-content white-text">
		              <span class="card-title">RifaTokens Gastados</span>

		              <h5 style="font-weight: 700"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>{{$rt}}</h5>
		            </div>
		            
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card blue-grey darken-1">
		            <div class="card-content white-text">
		              <span class="card-title">Boletos vendidos</span>

		              <h5 style="font-weight: 700">{{$boletos}} Boletos</h5>
		            </div>
		            
		        </div>
			</div>
		</div>

	</div>
</div>
@endsection