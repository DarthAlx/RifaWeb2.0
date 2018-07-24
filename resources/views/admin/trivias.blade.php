@extends('templates.admin')
@section('header')
<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
@endsection
@section('pagecontent')
<div class=" main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3 class="">Trivias</h3>
			</div>
			<div class="col-md-6 text-right valign-wrapper" style="justify-content: space-between;">
				<div class="text-center" style="margin-left: auto;">
					<a  href="#nuevo" class="btn btn-primary right waves-effect waves-light btn-large modal-trigger">Añadir nueva</a>
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
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  	<tr>
					<th class="sorting_desc">Pregunta</th>
			      	<th></th>
			  	</tr>
			  </thead>
			  <tbody>
			  	@if($trivias)
			  		@foreach($trivias as $trivia)

						<tr style="cursor: pointer;">
							<td>{{$trivia->pregunta}}</td>
							<td align="right" style="text-align: right;">
								<a class="waves-effect waves-light btn  modal-trigger " href="#update{{$trivia->id}}"><i class="fa fa-pencil"></i></a>
								<a class="waves-effect waves-light btn  modal-trigger red" href="#delete{{$trivia->id}}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr style="cursor: pointer;">
						<td></td>
						<td></td>					
					</tr>

				@endif
				



			  </tbody>
			  <tfoot>
			  	<tr>
					<th class="sorting_desc">Pregunta</th>
			      	<th></th>
			  	</tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
				
		</div>
		
		
		
	</div>
</div>






<!-- Modal Structure -->
  <div id="nuevo" class="modal">
  	<form action="{{ url('/agregar-trivia') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Añadir nueva</h4>
			{!! csrf_field() !!}
			<div class="input-field col m12">
				<input id="pregunta" name="pregunta" type="text" class="validate" value="{{old('pregunta')}}" required>
				<label for="pregunta">Pregunta</label>
			</div>

			<div class="input-field col m12">
				<input id="a" name="a" type="text" class="validate" value="{{old('a')}}" required>
				<label for="a">A</label>
			</div>
			<div class="input-field col m12">
				<input id="b" name="b" type="text" class="validate" value="{{old('b')}}" required>
				<label for="b">B</label>
			</div>
			<div class="input-field col m12">
				<input id="c" name="c" type="text" class="validate" value="{{old('c')}}" required>
				<label for="c">C</label>
			</div>

			<p>
				<input name="respuesta" value="a" type="radio" id="ra" />
				<label for="ra">A</label>
			</p>
			<p>
				<input name="respuesta" value="b" type="radio" id="rb" />
				<label for="rb">B</label>
			</p>
			<p>
				<input name="respuesta" value="c" type="radio" id="rc"  />
				<label for="rc">C</label>
			</p>
			<div class="col m4">
				<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
			</div>
			<p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>






@if($trivias)
@foreach($trivias as $trivia)
<!-- Modal Structure -->
  <div id="delete{{$trivia->id}}" class="modal">
    <div class="modal-content">
      <h4>Eliminar trivia ({{$trivia->pregunta}})</h4>
      <p>¿Está seguro que desea eliminar esta trivia?</p>
    </div>
    <div class="modal-footer">
    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn">Cancelar</a> &nbsp; 
		<form action="{{ url('/eliminar-trivia') }}" method="post" enctype="multipart/form-data">
			{{ method_field('DELETE') }}
			{!! csrf_field() !!}
			<input type="hidden" name="eliminar" value="{{$trivia->id}}">
			<input type="submit" class="modal-action modal-close waves-effect waves-green red btn" value="Eliminar">
		</form>
    	
    </div>
  </div>



  <!-- Modal Structure -->
  <div id="update{{$trivia->id}}" class="modal">
  	<form action="{{ url('/actualizar-trivia') }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Editar ({{$trivia->pregunta}})</h4>
			{!! csrf_field() !!}

			<input type="hidden" value="{{$trivia->id}}" name="id">		
					<div class="input-field col m12">
						<input id="pregunta" name="pregunta" type="text" class="validate" value="{{$trivia->pregunta or old('pregunta')}}" required>
						<label for="pregunta">Pregunta</label>
					</div>
		
					<div class="input-field col m12">
						<input id="a" name="a" type="text" class="validate" value="{{$trivia->a or old('a')}}" required>
						<label for="a">A</label>
					</div>
					<div class="input-field col m12">
						<input id="b" name="b" type="text" class="validate" value="{{$trivia->b or old('b')}}" required>
						<label for="b">B</label>
					</div>
					<div class="input-field col m12">
						<input id="c" name="c" type="text" class="validate" value="{{$trivia->c or old('c')}}" required>
						<label for="c">C</label>
					</div>
		
					<p>
						<input name="respuesta" value="a" type="radio" id="ra2" />
						<label for="ra2">A</label>
					</p>
					<p>
						<input name="respuesta" value="b" type="radio" id="rb2" />
						<label for="rb2">B</label>
					</p>
					<p>
						<input name="respuesta" value="c" type="radio" id="rc2"  />
						<label for="rc2">C</label>
					</p>
					<script>
						$("input[name='respuesta'][value='{{$trivia->respuesta}}']").prop("checked",true);
					</script>
	        <div class="col m4">
	        	<input type="submit" value="Guardar" class="btn btn-primary right waves-effect waves-light">
	        </div>
	        <p>&nbsp;</p><p>&nbsp;</p>
    </div>

    </form>
  </div>

  @endforeach
@endif







@endsection

@section('scripts')
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>

@endsection