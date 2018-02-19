@extends('templates.default')

@section('header')

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
					<form role="form" action="{{ url('/canjear') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<h3 class="title">Canjear código.</h3>
					<div class="input-field">
			          <input id="codigo" name="codigo" type="text" class="validate" value="{{old('codigo')}}" required>
			          <label for="codigo">Código promocional</label>
	        		</div>

	        		<div>
                            <button class="btn btn-default waves-effect waves-light" style="width:100%">Canjear</button>
                        </div>
                    </form>
				</div>
				
			</div>
		</div>
	


	@endif
</div>

@endsection


@section('scripts')


@endsection