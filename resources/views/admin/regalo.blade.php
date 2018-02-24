@extends('templates.admin')
@section('header')

@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Regalo</h3>
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

				<form action="{{ url('/regalo-update') }}" method="post" enctype="multipart/form-data" class="card">
				    <div class="card-content">
				     
							{!! csrf_field() !!}
							<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
						        	<select id="tipo" name="tipo" class="select" required>
								      	<option value="" disabled selected>Elejir tipo</option>
				    					<option value="Share">RifaTokens</option>
				    					<option value="Regalo">Ticket</option>
								    </select>
						          <label for="tipo">Tipo de regalo</label>
						        </div>
							  </div>
							<div class="row regalo" style="display: none">
							        <div class="input-field col s12">
							          <input type="text" name="producto" id="autocomplete" class="autocomplete" value="">
							          
							          <label for="autocomplete">Producto</label>
							        </div>
							  </div>
							  <div class="row share">
						        	<div class="input-field col s12">
						          	<input id="rt" name="rt" type="number" class="validate" value="{{$regalo->rt or old('rt')}}" required>
						          	<label for="rt">RifaTokens</label>
					        </div>
					        </div>
					        <div class="row regalo" style="display: none">
						        	<div class="input-field col s12">
						          	<input id="boletos" name="boletos" type="number" class="validate" value="{{$regalo->boletos or old('boletos')}}" required>
						          	<label for="boletos">Boletos</label>
						          	</div>
					        </div>
					        <div class="row">
						        	<div class="input-field col s12">
						          	<input id="dias" name="dias" type="number" class="validate" value="{{$regalo->dias or old('dias')}}" required>
						          	<label for="dias">Días</label>
						          	</div>
					        </div>
						

						      <div class="row">
						      	<div class="text-center col s12" style="margin-left: auto;">
									<button type="submit" class="btn btn-primary right waves-effect waves-light">Guardar</button>
								</div>  
								</div>

						       
					      </div>
					        <p>&nbsp;</p><p>&nbsp;</p>

				    </div>

				    </form>
			</div>
				
		</div>
		
		
		
	</div>
</div>


<script>
@if ($regalo)
	tipo = '{{$regalo->tipo}}';
  		if (tipo=="Share") {
  			$('.share').fadeIn();
  			$("#rt").attr("required", true);
  			$('.regalo').fadeOut();
  			$("#autocomplete").attr("required", false);
  			$("#boletos").attr("required", false);
  		}
  		else{
  			$('.regalo').fadeIn();
  			$('.share').fadeOut();
  			$("#rt").attr("required", false);
  			$("#autocomplete").attr("required", true);
  			$("#boletos").attr("required", true);
  		}
 @endif


  	$('#tipo').change(function(){
  		tipo = $('#tipo').val();
  		if (tipo=="Share") {
  			$('.share').fadeIn();
  			$("#rt").attr("required", true);
  			$('.regalo').fadeOut();
  			$("#autocomplete").attr("required", false);
  			$("#boletos").attr("required", false);
  		}
  		else{
  			$('.regalo').fadeIn();
  			$('.share').fadeOut();
  			$("#rt").attr("required", false);
  			$("#autocomplete").attr("required", true);
  			$("#boletos").attr("required", true);
  		}
  	});
  </script>

@endsection

@section('scripts')


@if ($productos!= '')
<script>
	
	$(document).ready(function(){
	$('input.autocomplete').autocomplete({
    data: {!!json_decode($productos)!!},
    limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      $('#producto').val(val);
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
	});

</script>
@endif


@endsection