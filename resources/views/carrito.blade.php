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
	<h1 class="title">Tu carrito de compras.</h1>
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
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="{{url('uploads/productos')}}/{{ $product->options->imagen }}" class="responsive-img"/></div>
									<div class="col-sm-10">
										<a href="{{url('/rifa')}}/{{$product->options->slug}}" style="color: inherit; text-decoration: none;">
										<h4 class="nomargin">{{ $product->name }}</h4>
										<p>Fuente: {{$product->options->loteria}}</p>

										<p>{{str_limit($product->options->descripcion, $limit = 50, $end = '...')}}</p>
										</a>
									</div>
								</div>
							</td>
							<td data-th="Price">${{ $product->price }}</td>
							<form action="{{url('updatecart')}}" method="post">
								{!! csrf_field() !!}
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" name="qty" value="{{$product->qty}}">
								<input type="hidden" name="rowId" value="{{$product->rowId}}">
							</td>
							<td data-th="Subtotal" class="text-center">${{ $product->price*$product->qty }}</td>
							<td class="actions" data-th="">
								<button type="submit" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-refresh"></i></button>
								<a href="{{url('removefromcart')}}/{{$product->rowId}}" class="btn btn-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Remover"><i class="fa fa-trash-o"></i></a>								
							</td>
							</form>
						</tr>
						@endif
						@endforeach
					</tbody>
					<tfoot>

						<tr>	
							<td colspan="4" class="d-none d-sm-block" style="display: table-cell !important;"></td>
							<td class="d-none d-sm-block text-center"><strong style="font-weight: 700">Subtotal</strong> ${{Cart::subtotal(2,'.',',')}}</td>
						</tr>

						<tr>	
							<td colspan="4" class="d-none d-sm-block" style="display: table-cell !important;"></td>
							<td class="d-none d-sm-block text-center"><strong style="font-weight: 700">Tus RT</strong> <i class="fa fa-circle-o-notch"></i>{{$usuario->rt}}</td>
						</tr>

						<tr>	
							<td colspan="4" class="d-none d-sm-block" style="display: table-cell !important;"></td>
							<td class="d-none d-sm-block text-center"><strong style="font-weight: 700">Total</strong>@if($usuario->rt>=Cart::total(2,'.',',')) <i class="fa fa-circle-o-notch"></i>{{round(Cart::total(2,'.',','), 0, PHP_ROUND_HALF_UP)}} @else ${{Cart::total(2,'.',',')-$usuario->rt}} @endif</td>
						</tr>
						<tr>
							<td><a href="{{url('/rifas')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar comprando</a></td>
							<td colspan="3" class="d-none d-sm-block" style="display: table-cell !important;"></td>
							
							<td><a href="{{url('/checkout')}}" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
				@endif

@endif
</div>

@endsection


@section('scripts')


@endsection