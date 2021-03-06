@extends('templates.default')

@section('header')
<script type="text/javascript" src="{{ url('js/llqrcode.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webqr.js') }}"></script>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<style>
	iframe:last-child {
    display: none;
}
</style>


@endsection


@section('pagecontent')

<div class="container">
	@if (Auth::guest())
      <div class="col-sm-12">
          <h1 class="gotham2 text-center" style="padding: 15vh 0;">¡Inicia sesión o registrate con nosotros! <br><br><br> 
          	<a href="{{url('/entrar')}}" class="btn btn-success" style="width: 65%; margin: 0 auto;">Entrar</a></h1>
      </div>
    @else
		<div class="col-sm-12">
			@include('snip.notificaciones')
		</div>


		

		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="canjear">
					<h3 class="title">Canjear código.</h3>
					<div class="titlescan d-blockd-sm-none"><h6>Escanea</h6></div>
					<div id="mainbody d-blockd-sm-none">
					<div id="outdiv"></div>
					<div id="result" style="display: none;"></div>
					</div>
					<canvas id="qr-canvas" width="800" height="600" style="display: none;"></canvas>
					<script type="text/javascript">
						//if( /iphone|ipod|ipad|android|blackberry|opera mini|opera mobi|skyfire|maemo|windows phone|palm|iemobile|symbian|symbianos|fennec/i.test(navigator.userAgent) ) {
						    load();
						//}
						
					</script>
					<div class="titlescan d-blockd-sm-none"><h6>ó escribe aquí el código</h6></div>
					<form role="form" action="{{ url('/canjear') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<div class="input-field">
			          <input id="codigo" name="codigo" type="text" class="validate" value="{{old('codigo')}}" style="text-transform: uppercase;" required>
			          <label for="codigo">Tu código promocional</label>
	        		</div>

	        		<div>
                            <button class="btn btn-default waves-effect waves-light" id="canjearbtn" style="width:100%">Canjear</button>
                        </div>
                    </form>
				</div>
				
			</div>
		</div>
	


	@endif
</div>

@endsection


@section('scripts')
@if($codigo!="")
	<script>
		$('#codigo').val("{{$codigo}}");
		$('#canjearbtn').click();
	</script>
@endif

@endsection