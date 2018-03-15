@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
@endsection


@section('pagecontent')

<div class="container carrito">
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

	<h3 class="section-title section-title-center">
                  <b></b>
                  <span class="secition-title-main">Comprar boletos</span>
                  <b></b>
                </h3>

                @php
							    $impuesto=floatval(str_replace(',','',Cart::subtotal(2,'.',',')))*0.029;
								$impuestomasiva=floatval($impuesto)+(floatval($impuesto)*0.16);
								$impuestomasiva=round(str_replace(",","",$impuestomasiva), 2, PHP_ROUND_HALF_UP);
							@endphp
@php
							    $total=floatval(str_replace(',','',Cart::subtotal(2,'.',',')))+floatval(Cart::tax())+floatval($impuestomasiva);
							@endphp


	<div class="row">
		<div class="col-md-6">


			<ul class="collapsible" data-collapsible="accordion">
			    @if(($usuario->rt/10)>=$total)

			    <li>
			      <div class="collapsible-header active"><i class="fa fa-circle-o-notch" style="line-height: 1.5;"></i> <span> &nbsp; RifaTokens</span> </div>
			      <div class="collapsible-body">
			      	<form action="{{url('checkout')}}" method="POST">
			      		{!! csrf_field() !!}
				    
				    <div class="row">
				        <div class="col s12">
				          <h3><i class="fa fa-circle-o-notch"></i>{{round(str_replace(",","",$total), 0, PHP_ROUND_HALF_UP)*10}}</h3>
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
			    
				@else
			    <li>
			      <div class="collapsible-header active" id="normalheader" onclick="document.getElementById('normal').click();">
			      	<input name="metodo" type="radio" value="Normal" id="normal" checked="checked" onclick="normal();" />
				      	<label for="normal"></label>
			      	<i class="fa fa-credit-card-alt" style="line-height: 1.5;"></i> <span> &nbsp; Tarjeta</span> 
			      </div>
			      <div class="collapsible-body">
			      	<form action="{{url('checkout')}}" method="POST" id="card-form">
			      		<input type="hidden" id="metodo" name="metodo" value="Normal">
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
			    
			    @endif
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
			@if (Cart::content()->count()>0)
			
			<ul class="collection with-header">
		        <li class="collection-header"><h4>Tus boletos</h4></li>
		        @foreach ($items as $product)
		        <li class="collection-item"><div>{{ $product->name }} <i class="fa fa-ticket" aria-hidden="true"></i> {{ $product->qty }}  <a class="secondary-content">${{ number_format($product->price*$product->qty,2) }}</a></div></li>
		        @endforeach
		        <li class="collection-item"><div><strong style="font-weight: 700">Subtotal</strong><a class="secondary-content">${{Cart::subtotal(2,'.',',')}}</a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">IVA</strong><a class="secondary-content">${{Cart::tax()}}</a></div></li>

		        
		        <li class="collection-item"><div><strong style="font-weight: 700">Impuesto</strong><a class="secondary-content">${{$impuestomasiva}}</a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Tus RifaTokens</strong><a class="secondary-content"><i class="fa fa-circle-o-notch"></i>{{$usuario->rt}}</a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Total</strong><a class="secondary-content">@if(($usuario->rt)/10>=$total) <i class="fa fa-circle-o-notch"></i>{{round(str_replace(",","",$total), 0, PHP_ROUND_HALF_UP)*10}} @else ${{$total-($usuario->rt/10)}} @endif</a></div></li>
		        
		      </ul>

			
			
			
			@endif
		</div>
	</div>


@endif
</div>



 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">



<div id="llenar"></div>








@endsection


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