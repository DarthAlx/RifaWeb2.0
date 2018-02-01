@extends('templates.admin')

@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		
		<form action="{{ url('/enviar-mensaje') }}" method="post" enctype="multipart/form-data">
			 {{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Nuevo mensaje</h3>
			</div>
	
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-8">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title"></h5>
				    <div class="card-text">
				    	<div class="col s12">
							<div class="row">
							        <div class="input-field col s12">
							          <input type="text" name="destinatario" id="autocomplete" class="autocomplete" value="">
							          
							          <label for="autocomplete-input">Destinatario</label>
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
					      
					    </div>
				    </div>

				  </div>
				</div>
			</div>
		</div>
		
	</div>
	</form>
</div>
</div>

@endsection


@section('scripts')
<script>
	$(document).ready(function(){
	$('input.autocomplete').autocomplete({
    data: {!!json_decode($usuarios)!!},
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      $('#autocomplete').val(val);
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
	});
</script>
@endsection