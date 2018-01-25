@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
@endsection


@section('pagecontent')

<section class="productsmain">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div id="bc1" class="btn-group btn-breadcrumb">
                  <a href="{{url('/')}}" class="btn btn-default"><i class="fa fa-home"></i></a>
                  <a href="{{url('/rifas')}}" class="btn btn-default"><div>Rifas</div></a>
                  @if($catalogo!="Todos"&&$catalogo!="Resultados")
                  <a href="{{url('/rifas')}}/{{strtolower($catalogo)}}" class="btn btn-default"><div>{{ucfirst($catalogo)}}</div></a>
                  @endif

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <form action="{{url('/rifas')}}" method="post">
                  {{ csrf_field() }}
                  <div class="input-group mb-3 browser-default">
                  <input type="text" class="form-control browser-default" name="busqueda" placeholder="Buscar" aria-describedby="basic-addon2">
                  <div class="input-group-append browser-default">
                    <button class="btn btn-outline-secondary browser-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                </form>
                

                <p class="titleshop">Ordenar publicaciones</p>
                <div class="sorting">
                  <a onclick="list();" data-toggle="tooltip" data-placement="top" title="Lista"><i class="fa fa-list"></i></a>
                  <a onclick="grid();"  data-toggle="tooltip" data-placement="top" title="Grilla"><i class="fa fa-th-large"></i></a>
                </div>
                

                @if($categorias)
                <hr>
                <p class="titleshop">Categorías</p>
                <ul class="listacategorias">
                  @foreach($categorias as $categoria)
                  <li><a href="{{url('/rifas')}}/{{strtolower($categoria->nombre)}}">{{$categoria->nombre}}</a></li>
                  @endforeach
                </ul>

                @endif


                
              </div>
              <div class="col-md-9">
                <div class="row row-eq-height">
                  @foreach($productos as $producto)
                  
                    
                  
                  <div class="product-type list col-md-12" style="padding: 0;">
                    <div class="product-inner">
                    <div class="p1 col m4" >
                      <div class="img-container valign-wrapper">
                        <img src="{{url('uploads/productos')}}/{{$producto->imagen}}" class="responsive-img">
                      </div>
                      
                    </div>
                    <div class="p2 product-info col m8">
                      <div class="product-content">
                        <h1>{{$producto->nombre}}</h1>
                        <p>Fuente: {{$producto->loteria}}</p>
                        <ul>
                          <li>{{str_limit($producto->descripcion, $limit = 50, $end = '...')}}</li>
                        </ul>
                        
                          
                          <div id="contador{{$producto->id}}">
                            <?php $fecha = explode('-', $producto->fecha_limite); ?>
                            <script>
                              var Countdown{{$producto->id}} = new Countdown({
                              year: {{$fecha[0]}},
                              month : {{$fecha[1]}}, 
                              day   : {{$fecha[2]}},
                              width : 200, 
                              height  : 50,
                              rangeHi:"day"
                              });

                            </script>
                          </div>
                          <p style="margin:0;">Progreso de rifa:</p>
                          <div class="progress">
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%"></div>
                          </div>
                        
                        
                        
                        
                        <div class="buttons">
                          <div class="row" style="width: 100%;">
                            <div class="botonprecio col-md-5">
                              <span class="btn" id="price" style="padding: 0 1rem;">1 Boleto = ${{$producto->precio}}mxn</span>
                            </div>
                            <div class="botonescomprar col-md-3">
                              <div class="input-group">
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="cantidad"  style="width: 35px; padding: 0">
                                      <i class="fa fa-minus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              <input type="text" name="cantidad" class="form-control input-number browser-default" value="1" min="1" max="{{$producto->boletos-$producto->vendidos}}" style="height: 36px;">
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cantidad" style="width: 35px; padding: 0">
                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              </div>
                            </div>
                            <div class="botonescomprar col-md-4">
                              <a class="btn" href="#">Comprar</a>
                            </div>
                          </div>
                          

                          <div class="pbut hidden">
                            <br>
                          </div>

                          
                          

                          
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  
                    @endforeach
                </div>
              </div>
                  

            </div>
          </div>
        </section>


        <script>
          function list(){
            $('.product-type').addClass('col-md-12');
            $('.product-type').removeClass('col-md-4');

            $('.p1').addClass('m4');
            $('.p1').removeClass('m12');
            $('.p2').addClass('m8');
            $('.p2').removeClass('m12');

            $('.product-type').addClass('list');
            $('.product-type').removeClass('grid');

            $('.pbut').addClass('hidden');
            $('.pbut').removeClass('visible');

          }
          function grid(){
            $('.product-type').removeClass('col-md-12');
            $('.product-type').addClass('col-md-4');

            $('.p1').removeClass('m4');
            $('.p1').addClass('m12');
            $('.p2').removeClass('m8');
            $('.p2').addClass('m12');

            $('.product-type').removeClass('list');
            $('.product-type').addClass('grid');

            $('.pbut').removeClass('hidden');
            $('.pbut').addClass('visible');

            $('.botonprecio').removeClass('col-md-5');
            $('.botonprecio').addClass('col-md-12');

            $('.botonescomprar').removeClass('col-md-3 col-md-4');
            $('.botonescomprar').addClass('col-md-6');

          }


          
        </script>
        @endsection


        @section('scripts')
        <script type="text/javascript">
          
          function countdown(id, ano, mes, dia){
  // los meses van del 0 al 11
    var fecha=new Date(ano,mes,dia,'9','00','00')
    var hoy=new Date()
    var dias=0
    var horas=0
    var minutos=0
    var segundos=0
    var nid=id;
    if (fecha>hoy){
            var diferencia=(fecha.getTime()-hoy.getTime())/1000;
            dias=Math.floor(diferencia/86400);
            diferencia=diferencia-(86400*dias);
            horas=Math.floor(diferencia/3600);
            diferencia=diferencia-(3600*horas);
            minutos=Math.floor(diferencia/60);
            diferencia=diferencia-(60*minutos);
            segundos=Math.floor(diferencia);
           
            $("#contador"+id).html('<div class="row cbox"><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ dias +'</h2></div><div class="text"><p>días</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ horas +'</h2></div><div class="text"><p>horas</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ minutos +'</h2></div><div class="text"><p>minutos</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ segundos +'</h2></div><div class="text"><p>segundos</p></div></div></div></div></div>');

            if (dias>0 || horas>0 || minutos>0 || segundos>0){
                    //setTimeout(countdown,100,id,ano,mes,dia);
            }
    }
    else{
            $("#contador"+id).html('<div class="row cbox"><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>0</h2></div><div class="text"><p>días</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>0</h2></div><div class="text"><p>horas</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>0</h2></div><div class="text"><p>minutos</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>0</h2></div><div class="text"><p>segundos</p></div></div></div></div></div>');
    }
}

          @foreach($productos as $producto)

          //countdown('{{$producto->id}}','2018','0','26');
          @endforeach

          
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


        </script>


        @endsection
