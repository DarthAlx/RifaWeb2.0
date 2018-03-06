@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
<link href="{{ url('css/ficha.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
@endsection


@section('pagecontent')
@if (Auth::guest())
      <div class="col-sm-12">
          <h1 class="gotham2 text-center" style="padding: 15vh 0;">¡Inicia sesión o registrate con nosotros! <br><br><br> 
          	<a href="{{url('/entrar')}}" class="btn btn-success" style="width: 65%; margin: 0 auto;">Entrar</a></h1>
      </div>
    @else
    <?php $usuario = App\User::find(Auth::user()->id); ?>


	<div class="col-sm-12">
		@include('snip.notificaciones')
	</div>
<div class="container">
	<div class="row">
		@foreach($paquetes as $paquete)
		<div class="col l4 m3 s12">
			<div class="paquete">
				<div class="card blue-grey darken-1">
		            <div class="card-content white-text">
		              <span class="card-title text-center">{{$paquete->rt}} <span class="small">RifaTokens</span></span>
		              <p class="text-center">${{$paquete->precio}} <span class="small">MXN</span></p>
		            </div>
		            <div class="card-action text-center">

		            	<p style="margin: 0;">
					      <input name="paquete" type="radio" id="paquete{{$paquete->id}}" />
					      <label for="paquete{{$paquete->id}}"></label>
					    </p>
		              <a onclick="carrito('{{$paquete->id}}','{{$paquete->rt}}','{{$paquete->precio}}')" class="btn btn-default" style="padding: .375rem .75rem; line-height: 25px; color: #fff; cursor: pointer;">Seleccionar</a>

		            </div>
		          </div>
			</div>	
		</div>
		@endforeach
	</div>

	<div class="row">
		<div class="col-md-6">

			<ul class="collapsible" data-collapsible="accordion">
					<li>
								      <div class="collapsible-header active" id="normalheader" onclick="document.getElementById('normal').click();">
								      	<input name="metodo" type="radio" value="Normal" id="normal" checked="checked" onclick="normal();" />
									      	<label for="normal"></label>
								      	<i class="fa fa-credit-card-alt" style="line-height: 1.5;"></i> <span> &nbsp; Tarjeta</span> 
								      </div>
								      <div class="collapsible-body">
								      	<form action="{{url('paquetes')}}" method="POST" id="card-form">
								      		<input type="hidden" id="metodo" name="metodo" value="Normal">
								      		<input type="hidden" id="pagonormal" name="paquete" value="" required>
								      		{!! csrf_field() !!}
										@if(!$usuario->tarjetas->isEmpty())
								      	<div class="row">
											        <div class="input-field col s12">
											        	<select id="mitarjeta" name="mitarjeta" class="select" required>
													      <option value="" disabled selected>Seleccionar tarjeta</option>

													      	
									    					@foreach($usuario->tarjetas as $tarjeta)
									    					<option value="{{$tarjeta->id}}">{{$tarjeta->identificador}}</option>
															@endforeach
															<option value="">Nueva tarjeta</option>
															
													    </select>
											          <label for="mitarjeta">Tus tarjetas</label>
											        </div>
										      	</div>



										      	@endif
										      	<div class="pagotarjeta">
										      		<div class="row">
												        <div class="input-field col s6">
												          <input class="validate" id="numtarjeta"  name="numero" autocomplete="off"  data-conekta="card[number]" type="text" maxlength="16" minlength="16">
												          <label for="numtarjeta">Número de tarjeta <span><i class="fa fa-cc-visa" aria-hidden="true"></i> <i class="fa fa-cc-mastercard" aria-hidden="true"></i> <i class="fa fa-cc-amex" aria-hidden="true"></i></span></label>
												        </div>
												    </div>
												    <div class="row">
												        <div class="input-field col s6">
												          <input class="validate" id="nombretitular"  name="nombre" autocomplete="off"  data-conekta="card[name]" type="text" >
												          <label for="nombretitular">Nombre del titular</label>
												        </div>
												    </div>

												    <div class="row">
												        <div class="input-field col s4">
												          <input class="validate" id="mm" name="mes" data-conekta="card[exp_month]" type="text" type="text"  maxlength="2">
												          
												          <label for="nombretitular">Mes</label>
												        </div>
												        <div class="input-field col s4">
												          <input class="validate" id="aa" name="año"  data-conekta="card[exp_year]" type="text"  maxlength="2">
												          <label for="nombretitular">Año</label>
												        </div>
												        <div class="input-field col s4">

												          <input class="validate tooltipped" id="cvv" autocomplete="off"  data-conekta="card[cvc]" type="text" data-position="bottom" data-delay="50" data-tooltip="Código de seguridad de 3 dígitos ubicado normalmente en la parte trasera de su tarjeta. Las tarjetas American Express tienen un código de 4 dígitos ubicado en el frente."   maxlength="4">
												          <label for="nombretitular">CVV</label>
												        </div>
												        
												    </div>
										      	</div>
										

									    <div class="row" id="guardartarjeta">
									    	<div class="col s12">
									    		<div class="switch">
													    <label>
													      <input type="checkbox" name="tarjeta" id="tarjeta"/>
													      <span class="lever"></span>
													      Guardar para compras futuras
													    </label>
													  </div>
										               
											      
									    	</div>
									    </div>
									    <div class="row">
									    	<div class="col s12">
									        	<button type="submit" class="btn btn-primary right">Pagar</button>
									        </div>
									    </div>
										</form>
								      </div>
								    </li>
								    
								    <li>
								    	<div class="collapsible-header active" id="tiendaheader" onclick="document.getElementById('tienda').click();">
									      	<input name="metodo" type="radio" value="Tienda" id="tienda"  onclick="tienda()" />
									      	<label for="tienda"></label>
						    				<img src="{{ url('img/logo-oxxopay.png') }}" style="width: 93px; height: 20px;"> <span> &nbsp; </span> 
						    			</div>
						    			<div class="collapsible-body">
						    				<p>Oxxo cobrará una comisión extra por la transacción.</p>
									      	<form action="{{url('checkout')}}" method="POST">
									      		<input type="hidden" id="metodo" name="metodo" value="Tienda">
									      		<input type="hidden" id="pagotienda" name="paquete" value="" required>
									      		{!! csrf_field() !!}
									      		<div class="row">
											    	<div class="col s12">
											        	<button type="submit" class="btn btn-primary right">Pagar</button>
											        </div>
											    </div>
									      	</form>
								      	</div>
								    </li>
								    
					</ul>
					<script>

			  	function normal(){

			  		document.getElementById('normal').checked = true;
			  		document.getElementById('normalheader').click();
			  	}
			  	function tienda(){
			  		document.getElementById('tienda').checked = true;
			  		document.getElementById('tiendaheader').click();
			  	}
			  </script>
			
		</div>


		<div class="col-md-6">
			
			
			<ul class="collection with-header">
		        <li class="collection-header"><h4>RifaTokens</h4></li>
		        
		        <li class="collection-item"><div> <i class="fa fa-circle-o-notch" aria-hidden="true"></i> <span id="cantidad">0</span> RT  <a class="secondary-content">$ <span id="subtotal">0</span></a></div></li>
		        
		        <li class="collection-item"><div><strong style="font-weight: 700">IVA</strong><a class="secondary-content">$<span id="iva">0</span> </a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Impuestos</strong><a class="secondary-content">$<span id="impuestos">0</span></a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Total</strong><a class="secondary-content"> $<span id="total">0</span> </a></div></li>
		        
		      </ul>

			
			
			
			
		</div>


	</div>
	



</div>

		<script>
			$('#pagotienda').change(function() {
				$('#subtotal').html($('#pagotienda').val());
			});

			function carrito(id,cantidad,precio){
				precio=parseInt(precio);
				cantidad=parseInt(cantidad);
				impuesto= ((precio*0.029)+2.5);
				impuestomasiva=impuesto+(impuesto*0.16);
				iva=(precio*0.16);
				total=precio+iva+impuestomasiva;
				

				document.getElementById('paquete'+id).click(); 
				document.getElementById('pagonormal').value=id; 
				document.getElementById('pagotienda').value=id; 
					$('#subtotal').html(precio);  
					$('#cantidad').html(cantidad);

					$('#iva').html(iva);
					$('#impuestos').html(impuestomasiva);

					$('#total').html(parseFloat(total).toFixed(2));
			}
		</script>
	
@endif





<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@section('scripts')

<script type="text/javascript">

    Conekta.setPublishableKey('key_O2AUfqG6Rsv3ZgKVi38uSdA');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Inserta el token_id en la forma para que se envíe al servidor
    $form.append($('<input type="hidden" name="tokencard" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Hace submit
  };
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $("#cart-errors").show();
    $(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);
  };

  //jQuery para que genere el token después de dar click en submit
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Previene hacer submit más de una vez
      $form.find("button").prop("disabled", true);
      Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
</script>


<script>

  $('#mitarjeta').change(function(){
  	if ($('#mitarjeta').val()!="") {
  		$("#guardartarjeta").hide();
  	}
  	else{
  		$("#guardartarjeta").show();
  	}
  	
  	tarjeta = $('#mitarjeta').val();
    _token = $('#token').val();
    $.post("{{url('/traertarjeta')}}", {
        tarjeta : tarjeta,
        _token : _token
        }, function(data) {
          $("#llenar").append(data);
        });
  });

    

  
  
</script>


@endsection
@endsection


<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@section('scripts')

<script type="text/javascript">

    Conekta.setPublishableKey('key_O2AUfqG6Rsv3ZgKVi38uSdA');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Inserta el token_id en la forma para que se envíe al servidor
    $form.append($('<input type="hidden" name="tokencard" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Hace submit
  };
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $("#cart-errors").show();
    $(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);
  };

  //jQuery para que genere el token después de dar click en submit
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Previene hacer submit más de una vez
      $form.find("button").prop("disabled", true);
      Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
</script>


<script>

  $('#mitarjeta').change(function(){
  	if ($('#mitarjeta').val()!="") {
  		$("#guardartarjeta").hide();
  	}
  	else{
  		$("#guardartarjeta").show();
  	}
  	
  	tarjeta = $('#mitarjeta').val();
    _token = $('#token').val();
    $.post("{{url('/traertarjeta')}}", {
        tarjeta : tarjeta,
        _token : _token
        }, function(data) {
          $("#llenar").append(data);
        });
  });

    

  
  
</script>


@endsection