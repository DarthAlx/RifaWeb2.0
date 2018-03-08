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


	<div class="col-sm-12">
		@include('snip.notificaciones')
	</div>

	<h1 class="title">Tu recibo de compra.</h1>

    <div class="row invoice">
        <div class="col-12">
    		
    		<hr>
    		
    					<strong>Fecha:</strong>
    					{{date("Y-m-d",strtotime($orden->operacion->fecha))}}<br><br>
    				
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Resumen de la orden</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Rifa</strong></td>
        							<td class="text-center"><strong>Precio</strong></td>
        							<td class="text-center"><strong>Cantidad</strong></td>
        							<td class="text-right"><strong>Subtotal</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php $subtotal=0; ?>
    							@foreach($orden->items as $item)
    							<tr>
    								<td>{{$item->producto}}</td>
    								<td class="text-center">{{$item->precio}}</td>
    								<td class="text-center">{{$item->cantidad}}</td>
    								<td class="text-right">${{$item->precio*$item->cantidad}}</td>
    							</tr>
    							<?php $subtotal=$subtotal+($item->precio*$item->cantidad); ?>
                               @endforeach


    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-right"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">${{$subtotal}}</td>
    							</tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-right"><strong>IVA</strong></td>
                                    <td class="thick-line text-right">${{$orden->operacion->iva}}</td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-right"><strong>Impuesto</strong></td>
                                    <td class="thick-line text-right">${{$orden->operacion->impuesto}}</td>
                                </tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>RifaTokens usados</strong></td>
    								<td class="no-line text-right"><i class="fa fa-circle-o-notch"></i>{{$orden->operacion->rt}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>Total pagado</strong></td>
    								<td class="no-line text-right">
                                        @if($orden->operacion->metodo=="RifaTokens")
                                            ${{$orden->operacion->pesos}}
                                        @else
                                            ${{$orden->operacion->pesos+$orden->operacion->iva+$orden->operacion->impuesto}}
                                        @endif
                                    </td>
    							</tr>
    						</tbody>
    					</table>
    				</div>

                    <div class="text-right" style="margin-left: auto;">
                        <a class="waves-effect waves-light btn btn-large" href="{{url('/perfil')}}">Ver mis rifas</a>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>



@endif
</div>
















@endsection


@section('scripts')



@endsection