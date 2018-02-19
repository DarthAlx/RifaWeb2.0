@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Escritorio</h3>
			</div>
		</div>
<form action="{{url('admin')}}" method="post">
					{!! csrf_field() !!}
		<div class="row">
		

			<div class="col-sm-3 col-md-2 ">
							<input type="text" class="form-control datepicker browser-default" name="from" placeholder="Desde..." value="{{$from}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="text" class="form-control datepicker browser-default" name="to" placeholder="Hasta..." value="{{$to}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="submit" value="Ver periodo" class="btn btn-success">
					</div>

		
		</div>
		</form>
		<p>&nbsp;</p>

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
		<div class="row">
			<div class="col-md-4">
				<div class="card  darken-1">
		            <div class="card-content">
		              <span class="card-title">Usuarios</span>

		              <h5 style="font-weight: 700">{{$usuarios}} Usuarios registrados</h5>

		              <canvas id="usuariosbar" width="400" height="400"></canvas>


		            </div>
		            
		        </div>
			</div>
			<div class="col-md-8">
				<div class="card  darken-1">
		            <div class="card-content">
		              <span class="card-title">Productos</span>

		              <h5 style="font-weight: 700">Boletos por producto</h5>

		              <canvas id="productosbar" width="400" height="auto"></canvas>
		            </div>
		            
		        </div>
			</div>
			
		</div>

		


	</div>
</div>
@endsection

@section('scripts')
<script>
var ctx = document.getElementById("usuariosbar").getContext('2d');
var pdx = document.getElementById("productosbar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Hombres","Mujeres" ],
        datasets: [{
            label: '# Hombres',
            data: [{{$hombres}}],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
        {
            label: '# Mujeres',
            data: [{{$mujeres}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
        ]
    },
    options: {
    	legend: {
        display: false
    },
        scales: {
            yAxes: [{
            	barThickness : 30,
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



var products = new Chart(pdx, {
    type: 'horizontalBar',
    data: {
        labels: [{!!$labels!!}],
        datasets: [{
			label: '# Boletos',
            data: [@foreach($data as $dato){{$dato}},@endforeach],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
        ]
    },
    options: {
    	barThickness: 1,
    	legend: {
        display: false
    },
        scales: {
            yAxes: [{
            	barThickness : 30,
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endsection