@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
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

	<h1 class="title">Comprar boletos.</h1>
	<div class="row">
		<div class="col-md-6">


			<ul class="collapsible" data-collapsible="accordion">
			    @if($usuario->rt>=Cart::total(2,'.',','))

			    <li>
			      <div class="collapsible-header active"><i class="fa fa-circle-o-notch" style="line-height: 1.5;"></i> <span> &nbsp; RifaTokens</span> </div>
			      <div class="collapsible-body">
			      	<form action="{{url('checkout')}}" method="POST">
			      		{!! csrf_field() !!}
				    
				    <div class="row">
				        <div class="col s12">
				          <h3><i class="fa fa-circle-o-notch"></i>{{round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP)}}</h3>
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
			      <div class="collapsible-header active"><i class="fa fa-credit-card-alt" style="line-height: 1.5;"></i> <span> &nbsp; Tarjeta</span> </div>
			      <div class="collapsible-body">
			      	<form action="{{url('checkout')}}" method="POST" id="card-form">
			      		{!! csrf_field() !!}
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
				    <div class="row">
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


			
			
		</div>
		<div class="col-md-6">
			@if (Cart::content()->count()>0)
			
			<ul class="collection with-header">
		        <li class="collection-header"><h4>Tus boletos</h4></li>
		        @foreach ($items as $product)
		        <li class="collection-item"><div>{{ $product->name }} <i class="fa fa-ticket" aria-hidden="true"></i> {{ $product->qty }}  <a class="secondary-content">${{ $product->price*$product->qty }} - <i class="fa fa-circle-o-notch"></i>{{ $product->price*$product->qty }}</a></div></li>
		        @endforeach
		        <li class="collection-item"><div><strong style="font-weight: 700">Subtotal</strong><a class="secondary-content">${{Cart::subtotal(2,'.',',')}}</a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Tus RifaTokens</strong><a class="secondary-content"><i class="fa fa-circle-o-notch"></i>{{$usuario->rt}}</a></div></li>
		        <li class="collection-item"><div><strong style="font-weight: 700">Total</strong><a class="secondary-content">@if($usuario->rt>Cart::total(2,'.',',')) <i class="fa fa-circle-o-notch"></i>{{round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP)}} @else ${{Cart::total(2,'.',',')-$usuario->rt}} @endif</a></div></li>
		        
		      </ul>

			
			
			
			@endif
		</div>
	</div>


@endif
</div>
















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


@endsection