@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Mensajes</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a href="#nuevo" class="btn btn-primary right waves-effect waves-light btn-large modal-trigger">Enviar nuevo</a>
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

			      	<th>Destinatario</th>
			      	<th>Asunto</th>
			      	<th>Mensaje</th>
			      	<th>Fecha</th>
					<th>Lectura</th>
			      	
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($mensajes)
			  		@foreach($mensajes as $mensaje)

						<tr style="cursor: pointer;">
							<td>{{$mensaje->user->name}}</td>
							<td>{{$mensaje->asunto}}</td>
							<td>{{$mensaje->msg}}</td>
							<td>{{$mensaje->fecha}}</td>
							<td>@if($mensaje->leido)<i class="fa fa-check-circle" aria-hidden="true"></i>@else<i class="fa fa-check-circle-o" aria-hidden="true"></i>@endif</td>
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
			      	<th>Destinatario</th>
			      	<th>Asunto</th>
			      	<th>Mensaje</th>
			      	<th>Fecha</th>
					<th>Lectura</th>
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
	<form action="{{ url('/enviar-mensaje') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Enviar mensaje</h4>
			{!! csrf_field() !!}
			<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
						        	<select id="tipo" name="tipo" class="select" required>
								      	<option value="" disabled selected>Elejir tipo</option>
				    					<option value="Individual">Individual</option>
				    					<option value="Masivo">Masivo</option>
								    </select>
						          <label for="tipo">Tipo de mensaje</label>
						        </div>
							  </div>
							<div class="row" id="dest" style="display: none">
							        <div class="input-field col s12">
							          <input type="text" name="destinatario" id="autocomplete" class="autocomplete" value="">
							          
							          <label for="autocomplete-input">Destinatario</label>
							        </div>
							  </div>
							  <div class="row" style="display: none">
							        <div class="input-field col s12">
							          <input type="text" name="asunto" id="asunto">
							          
							          <label for="asunto">Asunto</label>
							        </div>
							  </div>
							  <div class="row">
						        <div class="input-field col s12">
						          <textarea id="msg" name="msg" class="materialize-textarea" required>{{old('msg')}}</textarea>
						          <label for="msg">Mensaje</label>
						        </div>
						      </div>

						      <div class="row">
						      	<div class="text-center col s12" style="margin-left: auto;">
									<button type="submit" class="btn btn-primary right waves-effect waves-light">Enviar <i class="fa fa-paper-plane"></i></button>
								</div>  
								</div>

						       
					      </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>

  <script>
  	$('#tipo').change(function(){
  		tipo = $('#tipo').val();
  		if (tipo=="Individual") {
  			$('#dest').fadeIn();
  			$("#autocomplete").attr("required", true);
  		}
  		else{
  			$('#dest').fadeOut();
  			$("#autocomplete").attr("required", false);
  		}
  	});
  </script>

@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>

@if ($usuarios!= '')
<script>
	
	$(document).ready(function(){
	$('input.autocomplete').autocomplete({
    data: {!!json_decode($usuarios)!!},
    limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      $('#autocomplete').val(val);
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
	});

</script>
@endif

@endsection