@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Slider</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a  href="#nuevo" class="btn btn-primary right waves-effect waves-light btn-large modal-trigger">Añadir nuevo</a>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('snip.notificaciones')
			</div>
		</div>
		<p>&nbsp;</p>


		<div class="row">
			<div class="col-md-12">
				<ul class="collapsible  popout" data-collapsible="accordion">
			  	@if($slides)
			  		@foreach($slides as $slide)
				  		@if($slide->tipo=="Imagen")
					  		<li>
						      <div class="collapsible-header">
						      	<i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp; {{$slide->imagen}}
						      </div>
						      <div class="collapsible-body">
						      	<div>
					              <img src="{{url('/uploads/slider')}}/{{$slide->imagen}}" style="width: 100%; max-height: 470px" alt="">
					            </div>
								<div class="text-right">
									<p>&nbsp;</p>
									<a class="waves-effect waves-light btn  modal-trigger " href="#update{{$slide->id}}"><i class="fa fa-pencil"></i></a>
								<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$slide->id}}"><i class="fa fa-trash"></i></a>
								</div>

						      </div>
						    </li>
					    @endif
					    @if($slide->tipo=="Texto")
					  		<li>
						      <div class="collapsible-header">
						      	<i class="fa fa-align-center" aria-hidden="true"></i> &nbsp; {{$slide->titulo}}
						      </div>
						      <div class="collapsible-body">
									<div class="slider-item" style="background: url('{{url('/img/bg')}}/{{rand(1, 30)}}.jpg'); background-size: cover;">
						              <div class="container"  style="position: relative !important;">
						                <div class="row" style="max-height: 350px;">


						                
						                <div class="col-sm-12">
						                  <div style="min-height: 350px;">
						                    <h2 style="text-align: center">{{$slide->titulo}}</h2>
						                    <p style="text-align: center; color:#fff">{{$slide->subtitulo}}</p>
						                    <p>&nbsp;</p>
						                    <div class="text-center">
						                      <a href="{{$slide->enlace}}" class="btn btn-primary">{{$slide->accion}}</a>
						                    </div>
						                    
						                  </div>
						                  
						                </div>
						                



						              </div>
						              </div>
						              
						            </div>
						            <div class="text-right">
										<p>&nbsp;</p>
										<a class="waves-effect waves-light btn  modal-trigger " href="#update{{$slide->id}}"><i class="fa fa-pencil"></i></a>
									<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$slide->id}}"><i class="fa fa-trash"></i></a>
									</div>
						      </div>
						    </li>
					    @endif
					    @if($slide->tipo=="Producto")
					  		<li>
						      <div class="collapsible-header">
						      	<i class="fa fa-shopping-basket" aria-hidden="true"></i> &nbsp; {{$slide->producto->nombre}} 
						      </div>
						      <div class="collapsible-body">

						      	<div class="slider">
						            
						            <div class="slider-item" style="background: url('{{url('/img/bg')}}/{{rand(1, 30)}}.jpg'); background-size: cover;">
						              <div class="container"  style="position: relative !important;">
						                <div class="row">
						                <div class="col-md-6 col-sm-12">
						                  <div class="slider-img" style="margin: 0 auto;">
						                    <img class="img-responsive" src="{{url('uploads/productos')}}/{{$slide->producto->imagen}}" >
						                  </div>
						                </div>
						                <div class="col-md-6  text-right">
						                  <h2>Sorteo de {{$slide->producto->nombre}}</h2>

						                  <h5>¡Quedan pocos boletos!</h5>
						                  <h5>1 Boleto = ${{$slide->producto->precio}}</h5>
						                  <div id="contador{{$slide->producto->id}}" style="float: right;">
						                            <?php $fecha = explode('-', $slide->producto->fecha_limite); ?>
						                            <script>
						                              var Countdown{{$slide->producto->id}} = new Countdown({
						                              year: {{$fecha[0]}},
						                              month : {{$fecha[1]}}, 
						                              day   : {{$fecha[2]}},
						                              width : 200, 
						                              height  : 50,
						                              rangeHi:"day"
						                              });

						                            </script>
						                          </div>
						                          <p>&nbsp;</p><p>&nbsp;</p>
						                          <a href="" class="btn btn-primary waves-effect waves-light">¡Quiero un {{$slide->producto->nombre}}!</a>
						                </div>
						              </div>
						              </div>
						              
						            </div>
						            
						          </div>
						          <div class="text-right">
									<p>&nbsp;</p>
										<a class="waves-effect waves-light btn  modal-trigger " href="#update{{$slide->id}}"><i class="fa fa-pencil"></i></a>
									<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$slide->id}}"><i class="fa fa-trash"></i></a>
									</div>
									
						      </div>
						    </li>
					    @endif

					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
						<td></td>					
					</tr>

				@endif
				</ul>
			

			  </div>
			</div>
				
		</div>
		
		
		
	</div>
</div>






<!-- Modal Structure -->
  <div id="nuevo" class="modal">
  	<form action="{{ url('/agregar-slide') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Añadir nuevo</h4>
			{!! csrf_field() !!}
			<div class="row">
		        <div class="input-field col s12">
		        	<select id="tipo" name="tipo" class="select" required>
				      <option value="" disabled selected>Elejir tipo</option>

				      	
						<option value="Producto">Producto</option>
						<option value="Imagen">Imágen</option>
						<option value="Texto">Texto</option>
						
				    </select>
		          <label for="tipo">Tipo de slide</label>
		        </div>
	      	</div>


	      	<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="titulo" name="titulo" type="text" class="validate" value="{{old('titulo')}}" required>
		          <label for="titulo">Título</label>
		        </div>
			</div>	
			<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="subtitulo" name="subtitulo" type="text" class="validate" value="{{old('subtitulo')}}" required>
		          <label for="subtitulo">Subtítulo</label>
		        </div>
			</div>	
			<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="accion" name="accion" type="text" class="validate" value="{{old('accion')}}" required>
		          <label for="accion">Accion</label>
		        </div>
			</div>	
			<div class="row tipoenlace tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="enlace" name="enlace" type="text" class="validate" value="{{old('enlace')}}" required>
		          <label for="enlace">Enlace</label>
		        </div>
			</div>
			<div class="row tipoimagen tipoall" style="display: none">
				<div class="file-field input-field">
			      <div class="btn">
			        <span>Subir imágen</span>
			        <input type="file" name="imagen">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
			</div>

			<div class="row tipoproducto tipoall" style="display: none">
			        <div class="input-field col s12">
			          <input type="text" name="producto_id" id="producto_id" class="autocomplete" value="">
			          
			          <label for="producto_id">Producto</label>
			        </div>
			  </div>

			  <div class="row">
		        <div class="input-field col col-md-12">
		          <input id="orden" name="orden" type="number" class="validate" value="{{old('orden')}}" required>
		          <label for="orden">Orden</label>
		        </div>
			</div>
	        <div class="col m12">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>
<script>
  	$('#tipo').change(function(){
  		tipo = $('#tipo').val();
  		if (tipo=="Producto") {
  			$('.tipoall').fadeOut();
  			$(".tipoall input").attr("required", false);
  			$('.tipoproducto').fadeIn();
  			$(".tipoproducto input").attr("required", true);
  		}
  		if (tipo=="Texto") {
  			$('.tipoall').fadeOut();
  			$(".tipoall input").attr("required", false);
  			$('.tipotexto').fadeIn();
  			$('.tipoenlace').fadeIn();
  			$(".tipotexto input").attr("required", true);
  			$(".tipoenlace input").attr("required", true);
  		}
  		if (tipo=="Imagen") {
  			$('.tipoall').fadeOut();
  			$(".tipoall input").attr("required", false);
  			$('.tipoimagen').fadeIn();
  			$(".tipoimagen input").attr("required", true);
  			$('.tipoenlace').fadeIn();
			$(".tipoenlace input").attr("required", true);
  		}

  	});
</script>





@if($slides)
@foreach($slides as $slide)
<!-- Modal Structure -->
  <div id="delete{{$slide->id}}" class="modal">
    <div class="modal-content">
      <h4>Eliminar slide ({{$slide->orden}})</h4>
      <p>¿Está seguro que desea eliminar este slide?</p>
    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cancelar</a> &nbsp; 
		<form action="{{ url('/eliminar-slide') }}" method="post" enctype="multipart/form-data">
			{{ method_field('DELETE') }}
			{!! csrf_field() !!}
			<input type="hidden" name="eliminar" value="{{$slide->id}}">
			<input type="submit" class="modal-action modal-close waves-effect waves-green red btn" value="Eliminar">
		</form>
    	
    </div>
  </div>



  <!-- Modal Structure -->
  <div id="update{{$slide->id}}" class="modal">
  	<form action="{{ url('/actualizar-slide') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Editar ({{$slide->orden}})</h4>
			{!! csrf_field() !!}
			


	        <div class="row">
		        <div class="input-field col s12">
		        	<select id="tipo{{$slide->id}}" name="tipo" class="select" required>
				      <option value="" disabled selected>Elejir tipo</option>

				      	
						<option value="Producto">Producto</option>
						<option value="Imagen">Imágen</option>
						<option value="Texto">Texto</option>
						
				    </select>
		          <label for="tipo">Tipo de slide</label>
		        </div>
		        <script>
		        	document.getElementById('tipo{{$slide->id}}').value="{!!$slide->tipo!!}"
		        </script>

	      	</div>


	      	<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="titulo{{$slide->id}}" name="titulo" type="text" class="validate" value="{{$slide->titulo or old('titulo')}}" required>
		          <label for="titulo">Título</label>
		        </div>
			</div>	
			<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="subtitulo{{$slide->id}}" name="subtitulo" type="text" class="validate" value="{{$slide->subtitulo or old('subtitulo')}}" required>
		          <label for="subtitulo">Subtítulo</label>
		        </div>
			</div>	
			<div class="row tipotexto tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="accion{{$slide->id}}" name="accion" type="text" class="validate" value="{{$slide->accion or old('accion')}}" required>
		          <label for="accion">Accion</label>
		        </div>
			</div>	
			<div class="row tipoenlace tipoall" style="display: none">
		        <div class="input-field col col-md-12">
		          <input id="enlace{{$slide->id}}" name="enlace" type="text" class="validate" value="{{$slide->enlace or old('enlace')}}" required>
		          <label for="enlace">Enlace</label>
		        </div>
			</div>
			<div class="row tipoimagen tipoall" style="display: none">
				<div class="file-field input-field">
			      <div class="btn">
			        <span>Subir imágen</span>
			        <input type="file" name="imagen">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
			</div>

			<div class="row tipoproducto tipoall" style="display: none">
			        <div class="input-field col s12">
			          <input type="text" name="producto_id" id="producto_id{{$slide->id}}" class="autocomplete" value="{{$slide->producto->nombre or old('producto_id')}}">
			          
			          <label for="producto_id">Producto</label>
			        </div>
			  </div>

			  <div class="row">
		        <div class="input-field col col-md-12">
		          <input id="orden{{$slide->id}}" name="orden" type="number" class="validate" value="{{$slide->orden or old('orden')}}" required>
		          <label for="orden">Orden</label>
		        </div>
			</div>
			<input type="hidden" name="id" value="{{$slide->id}}">
	        <div class="col m12">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>
  <script>
  	$(document).ready(function() {
  		tipo = $('#tipo{{$slide->id}}').val();
  		if (tipo=="Producto") {
  			$('#update{{$slide->id}} .tipoall').fadeOut();
  			$("#update{{$slide->id}} .tipoall input").attr("required", false);
  			$('#update{{$slide->id}} .tipoproducto').fadeIn();
  			$("#update{{$slide->id}} .tipoproducto input").attr("required", true);
  		}
  		if (tipo=="Texto") {
  			$('#update{{$slide->id}} .tipoall').fadeOut();
  			$("#update{{$slide->id}} .tipoall input").attr("required", false);
  			$('#update{{$slide->id}} .tipotexto').fadeIn();
  			$('#update{{$slide->id}} .tipoenlace').fadeIn();
  			$("#update{{$slide->id}} .tipotexto input").attr("required", true);
  			$("#update{{$slide->id}} .tipoenlace input").attr("required", true);
  		}
  		if (tipo=="Imagen") {
  			$('#update{{$slide->id}} .tipoall').fadeOut();
  			$("#update{{$slide->id}} .tipoall input").attr("required", false);
  			$('#update{{$slide->id}} .tipoimagen').fadeIn();
  			$("#update{{$slide->id}} .tipoimagen input").attr("required", true);
  			$('#update{{$slide->id}} .tipoenlace').fadeIn();
			$("#update{{$slide->id}} .tipoenlace input").attr("required", true);
  		}

  	});
</script>

  @endforeach
@endif







@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>


@if ($productos!= '')
<script>
	
	$(document).ready(function(){
	$('input.autocomplete').autocomplete({
    data: {!!json_decode($productos)!!},
    limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      $('#producto_id').val(val);
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
	});

</script>
@endif


<script>
          $(document).ready(function() {
            $('.slider').bxSlider({
              auto: true,

              stopAutoOnClick: true,
              adaptiveHeight: true,
              infiniteLoop: true,
              responsive: true,
              touchEnabled: true,
              mode: 'fade',

            });

         


          });
        </script>
@endsection