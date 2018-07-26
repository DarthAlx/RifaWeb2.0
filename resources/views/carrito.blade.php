@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<style>
	iframe:last-child {
    display: none;
}
</style>

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
      <div class="cart-header">
        @if (Cart::content()->count()>0)
          @foreach ($items as $product)
            @if ($product->id=="Desc")
              <?php $descuento=$product; $tienedescuento=true; break; ?>
            @else
              <?php $tienedescuento=false; ?>
            @endif
          @endforeach
        @else
          <h1 class="title">Tu carrito está vacio.</h1>
          <a href="{{url('/rifas')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar comprando</a>
        @endif

      </div>
	</div>

	@if (Cart::content()->count()>0)
	<h3 class="section-title section-title-center">
                  <b></b>
                  <span class="secition-title-main">Tu carrito de compras</span>
                  <b></b>
                </h3>
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Rifa</th>
							<th style="width:10%">Precio</th>
							<th style="width:8%">Boletos</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $product)
                		@if ($product->id!="Desc")

						<tr>
							<td data-th="Producto">
								<div class="row">
									<div class="col-sm-2 hidden-xs valign-wrapper"><img src="{{url('uploads/productos')}}/{{ $product->options->imagen }}" class="responsive-img"/></div>
									<div class="col-sm-10">
										<!--a href="{{url('/rifa')}}/{{$product->options->slug}}" style="color: inherit; text-decoration: none;"-->
										<h4 class="nomargin">{{ $product->name }}</h4>
										

										<p>{{str_limit($product->options->descripcion, $limit = 50, $end = '...')}}</p>
										<!--/a-->
									</div>
								</div>
							</td>
							<td data-th="Precio">${{ $product->price }}</td>
							<form action="{{url('updatecart')}}" method="post">
								{!! csrf_field() !!}
							<td data-th="Cantidad">
								<input type="number" class="form-control text-center" name="qty" value="{{$product->qty}}">
								<input type="hidden" name="rowId" value="{{$product->rowId}}">
							</td>
							<td data-th="Subtotal" class="text-center">${{ $product->price*$product->qty }}</td>
							<td class="actions" >
								<button type="submit" class="btn btn-primary btn-sm tooltipped left" data-position="bottom" data-delay="50" data-tooltip="Actualizar"><i class="fa fa-refresh"></i></button>
								<a href="{{url('removefromcart')}}/{{$product->rowId}}" class="btn btn-danger btn-sm tooltipped right" data-position="bottom" data-delay="50" data-tooltip="Remover"><i class="fa fa-trash-o"></i></a>								
							</td>
							</form>
						</tr>
						@endif
						@endforeach
					</tbody>
					<tfoot>

						<tr>	
							<td colspan="4" class="d-none d-sm-block totalcart"></td>
							<td class=" text-center"><strong style="font-weight: 700">Subtotal</strong> ${{Cart::subtotal(2,'.',',')}}</td>
						</tr>
						<!--tr>	
							<td colspan="4" class="d-none d-sm-block totalcart"></td>
							<td class=" text-center"><strong style="font-weight: 700">IVA</strong> ${{Cart::tax()}}</td>
						</tr>
						<tr>	
							@php
							    $impuesto=floatval(Cart::subtotal(2,'.',','))*0.029;
								$impuestomasiva=floatval($impuesto)+(floatval($impuesto)*0.16);
								$impuestomasiva=round(str_replace(",","",$impuestomasiva), 2, PHP_ROUND_HALF_UP);
							@endphp

							<td colspan="4" class="d-none d-sm-block totalcart"></td>
							<td class=" text-center"><strong style="font-weight: 700">Impuesto</strong> ${{$impuestomasiva}}</td>
						</tr>

						<tr>	
							<td colspan="4" class="d-none d-sm-block totalcart"></td>
							<td class=" text-center"><strong style="font-weight: 700">Tus RT</strong> <i class="fa fa-circle-o-notch"></i>{{$usuario->rt}}</td>
						</tr>

						<tr>	
							@php
							    $total=floatval(Cart::subtotal(2,'.',','))+floatval(Cart::tax())+floatval($impuestomasiva);
							@endphp
							<td colspan="4" class="d-none d-sm-block totalcart"></td>
							<td class=" text-center"><strong style="font-weight: 700">Total</strong>@if(($usuario->rt)/10>=$total) <i class="fa fa-circle-o-notch"></i>{{round(str_replace(",","",$total), 0, PHP_ROUND_HALF_UP)*10}} @else ${{$total-($usuario->rt/10)}} @endif</td>
						</tr-->
						<tr>
							<td data-th=""><a href="{{url('/rifas')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar comprando</a></td>
							<td colspan="3" class="d-none d-sm-block" style="display: table-cell !important;"></td>
							
							<td data-th=""  class="d-none d-sm-block"><a href="{{url('/checkout')}}" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a></td>
						</tr>

						<tr class="d-block d-sm-none">
							
							
							<td data-th=""><a href="{{url('/checkout')}}" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
				@endif

@endif
</div>

@endsection


@section('scripts')


@endsection