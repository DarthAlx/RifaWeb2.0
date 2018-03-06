@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
<link href="{{ url('css/ficha.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
@endsection


@section('pagecontent')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="opps">
				<div class="opps-header">
					<div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
					<div class="opps-info">
						<div class="opps-brand"><img src="{{ url('/img/oxxopay_brand.png') }}" alt="OXXOPay"></div>
						<div class="opps-ammount">
							<h3>Monto a pagar</h3>
							<h2>$ {{number_format(($orden->operacion->rt/10)+$orden->operacion->pesos)}} <sup>MXN</sup></h2>
							<p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
						</div>
					</div>
					<div class="opps-reference">
						<h3>Referencia</h3>
						<h1>{{$orden->referencia}}</h1>
					</div>
				</div>
				<div class="opps-instructions">
					<h3>Instrucciones</h3>
					<ol>
						<li>Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</li>
						<li>Indica en caja que quieres realizar un pago de <strong>OXXOPay</strong>.</li>
						<li>Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
						<li>Realiza el pago correspondiente con dinero en efectivo.</li>
						<li>Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
					</ol>
					<div class="opps-footnote">Al completar estos pasos y validar tu pago recibirás un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
				</div>
			</div>	
		</div>
	</div>
</div>

		
	

@endsection