@extends('templates.default')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
@endsection


@section('pagecontent')

<section class="productsmain">
          <div class="container">
            <div class="row">
              <div class="row">
      <div class="col-md-12">
        @include('snip.notificaciones')
      </div>
    </div>
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





              <ul class="collapsible visiblemov" data-collapsible="accordion" style="border: none; box-shadow: none;">
                <li>
                  <div class="collapsible-header dropdown-toggle" style="background: transparent; box-shadow: none; border: 0;">Filtro</div>
                  <div class="collapsible-body">
                    <div class="col-md-3">
                      <form action="{{url()->current()}}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3 browser-default">
                        <input type="text" class="form-control browser-default" name="busqueda" placeholder="Buscar" aria-describedby="basic-addon2">
                        <div class="input-group-append browser-default">
                          <button class="btn btn-outline-secondary browser-default" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                      </form>
                      
                       <form action="{{url()->current()}}" method="post" id="ordenform">
                          {!! csrf_field() !!}

                      <div class="row">
                        <p class="titleshop col-sm-12">Ordenar publicaciones</p>
                      <div class="input-field col s8" style="margin: 0;">
                            <select id="orden" name="orden" class="select" required>
                              <option value="A - Z">A - Z</option>
                              <option value="Z - A">Z - A</option>
                              <option value="Menor precio">Menor precio</option>
                              <option value="Mayor precio">Mayor precio</option>
                            </select>
                            
                      </div>
                      <div class="sorting col s4 valign-wrapper">
                        <a onclick="list();" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lista"><i class="fa fa-list fa-2x"></i></a> &nbsp;
                        <a onclick="grid();" class="tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Grilla"><i class="fa fa-th-large fa-2x"></i></a>
                      </div>
                      </div>
                      </form>
                        <script>
                          $('#orden').change(function(){
                            $('#ordenform').submit();

                          });
                        </script>

                        <hr>
                      <p class="titleshop">Precio</p>

                      <form action="{{url()->current()}}" method="post" id="precioform">
                          {!! csrf_field() !!}


                        <div class="input-group-append browser-default">
                          <div class="row">
                            <div class="col-4" style="padding-right: 0">
                              <input type="text" class="form-control browser-default" name="minimo" placeholder="Minimo" aria-describedby="basic-addon2">
                            </div>
                            <div class="col-1 text-center valign-wrapper" style="max-width: inherit">
                              <span class="guion"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </div>
                            <div class="col-4" style="padding-left: 0">
                              <input type="text" class="form-control browser-default" name="maximo" placeholder="Maximo" aria-describedby="basic-addon2">
                            </div>
                            <div class="col-xs-3 valign-wrapper">
                              <a href="#" id="searchprice"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                              
                            </div>
                          </div>
                          
                        </div>

                        </form>
                        <script>
                          $('#searchprice').click(function(){
                            $('#precioform').submit();

                          });
                        </script>



                      @if($categorias)
                      <hr>
                      <p class="titleshop">Categorías</p>
                      <ul class="listacategorias">
                        @foreach($categorias as $categoria)
                        <li><a href="{{url('/rifas')}}/{{$categoria->slug}}">{{$categoria->nombre}}</a></li>
                        @endforeach
                      </ul>

                      @endif

                      @if($fuentes)
                      <hr>
                      <p class="titleshop">Fuentes</p>
                      <ul class="listacategorias">
                        @foreach($fuentes as $fuente)
                        <li><a href="{{url('/rifas')}}/{{$fuente->slug}}">{{$fuente->nombre}}</a></li>
                        @endforeach
                      </ul>
                      @endif
                      
                    </div>

                  </div>
                </li>
              </ul>



              































              <div class="col-md-3 hiddenmov">
                <form action="{{url()->current()}}" method="post">
                  {{ csrf_field() }}
                  <div class="input-group mb-3 browser-default">
                  <input type="text" class="form-control browser-default" name="busqueda" placeholder="Buscar" aria-describedby="basic-addon2">
                  <div class="input-group-append browser-default">
                    <button class="btn btn-outline-secondary browser-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                </form>
                
<form action="{{url()->current()}}" method="post" id="ordenform">
                    {!! csrf_field() !!}

                <div class="row">
                  <p class="titleshop col-sm-12">Ordenar publicaciones</p>
                <div class="input-field col s8" style="margin: 0;">
                      <select id="orden" name="orden" class="select" required>
                        <option value="A - Z">A - Z</option>
                        <option value="Z - A">Z - A</option>
                        <option value="Menor precio">Menor precio</option>
                        <option value="Mayor precio">Mayor precio</option>
                      </select>
                      
                </div>
                <div class="sorting col s4 valign-wrapper">
                  <a onclick="list();" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lista"><i class="fa fa-list fa-2x"></i></a> &nbsp;
                  <a onclick="grid();" class="tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Grilla"><i class="fa fa-th-large fa-2x"></i></a>
                </div>
                </div>
                </form>
                  <script>
                    $('#orden').change(function(){
                      $('#ordenform').submit();

                    });
                  </script>

                  <hr>
                <p class="titleshop">Precio</p>

                <form action="{{url()->current()}}" method="post" id="precioform">
                    {!! csrf_field() !!}


                  <div class="input-group-append browser-default">
                    <div class="row">
                      <div class="col-4" style="padding-right: 0">
                        <input type="text" class="form-control browser-default" name="minimo" placeholder="Minimo" aria-describedby="basic-addon2">
                      </div>
                      <div class="col-1 text-center valign-wrapper" style="max-width: inherit">
                        <span class="guion"><i class="fa fa-minus" aria-hidden="true"></i></span>
                      </div>
                      <div class="col-4" style="padding-left: 0">
                        <input type="text" class="form-control browser-default" name="maximo" placeholder="Maximo" aria-describedby="basic-addon2">
                      </div>
                      <div class="col-xs-3 valign-wrapper">
                        <a href="#" id="searchprice"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                        
                      </div>
                    </div>
                    
                  </div>

                  </form>
                  <script>
                    $('#searchprice').click(function(){
                      $('#precioform').submit();

                    });
                  </script>



                @if($categorias)
                <hr>
                <p class="titleshop">Categorías</p>
                <ul class="listacategorias">
                  @foreach($categorias as $categoria)
                  <li><a href="{{url('/rifas')}}/{{$categoria->slug}}">{{$categoria->nombre}}</a></li>
                  @endforeach
                </ul>

                @endif

                @if($fuentes)
                <hr>
                <p class="titleshop">Fuentes</p>
                <ul class="listacategorias">
                  @foreach($fuentes as $fuente)
                  <li><a href="{{url('/rifas')}}/{{$fuente->slug}}">{{$fuente->nombre}}</a></li>
                  @endforeach
                </ul>
                @endif


                
                
                
                


                
              </div>
              
              <div class="col-md-9">
                <div class="row row-eq-height">
                  @foreach($productos as $producto)
                  @if(strtotime($producto->fecha_limite) >= strtotime(date("Y-m-d H:i:s")))
                  
                  <div class="product-type list col-md-12" style="padding: 0;">
                    <form action="{{url('carrito')}}" method="post">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="productoid" id="productoid{{$producto->id}}" value="{{$producto->id}}">
                    <div class="product-inner">
                    <div class="p1 col m4" >
                      <div class="img-container valign-wrapper">
                        <a href="{{url('/rifa')}}/{{$producto->slug}}">
                        @if($producto->fundacion&&$producto->fundacion!="")
                        <span class="fundacion">En beneficio de: {{$producto->fundacion}}</span>
                        @endif
                        <img src="{{url('uploads/productos')}}/{{$producto->imagen}}" class="responsive-img">
                        <span class="product-price">${{$producto->precio}}</span>
                        </a>
                      </div>
                      
                    </div>
                    <div class="p2 product-info col m8">
                      <div class="product-content">
                        <a href="{{url('/rifa')}}/{{$producto->slug}}" style="color: inherit; text-decoration: none;">
                        <h1>{{$producto->nombre}}</h1>
                        <p>Fuente: {{$producto->loteria}}</p>
                        <ul>
                          <li class="descorta" style="display: none;">{{str_limit($producto->descripcion, $limit = 30, $end = '...')}}</li>
                          <li class="desclarga">{{str_limit($producto->descripcion, $limit = 100, $end = '...')}}</li>
                        </ul>
                        </a>
                          
                          <div id="contador{{$producto->id}}">
                            <?php 
                            $datetime = explode(' ', $producto->fecha_limite); 
                            $fecha = explode('-', $datetime[0]); 

                            $hora = explode(':', $datetime[1]); 


                            ?>
                            <script>
                              var Countdown{{$producto->id}} = new Countdown({
                              year: {{$fecha[0]}},
                              month : {{$fecha[1]}}, 
                              day   : {{$fecha[2]}},
                              hour   : {{$hora[0]}},
                              minutes   : {{$hora[1]}},
                              width : 200, 
                              height  : 50,
                              rangeHi:"day"
                              });

                            </script>
                          </div>
                          
                          <p style="margin:0;">Progreso de rifa:</p>
                          <div class="progress tooltipped" data-position="top" data-delay="50" data-tooltip="{{$producto->vendidos}}/{{$producto->boletos}}">
                            <?php if((($producto->vendidos*100)/$producto->boletos)<=33){?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: red;"></div>
                              <?php } else if(($producto->vendidos*100)/$producto->boletos <= 66) {?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: yellow;"></div>
                              <?php }else{ ?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: green;"></div>
                              <?php } ?>
                          </div>
                        
                        
                        
                        
                        <div class="buttons">
                          <div class="row" style="width: 100%; margin: 0;">
                            <div class="botonprecio col-md-12" style="padding: 0">
                              <span class="btn" id="precio{{$producto->id}}" style="padding: 0 1rem;width: 100%;"><span id="precio{{$producto->id}}">1 <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = ${{$producto->precio}}</span>mxn</span>
                            </div>
                            
                            <div class="botoncantidad col-md-12" style="padding: 0">
                              <div class="input-group">
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="cantidad{{$producto->id}}"  style="width: 35px; padding: 0">
                                      <i class="fa fa-minus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              
                              <input type="text" name="cantidad" id="cantidad{{$producto->id}}" class="form-control input-number browser-default" value="0" min="0" max="{{$producto->boletos-$producto->vendidos}}" style="height: 36px;">
                              <?php if (Cart::content()->count()>0){
                                 foreach(Cart::content() as $row) {
                                      if($row->id==$producto->id){ ?>
                                      <script>
                                        $('#cantidad{{$producto->id}}').val({{$row->qty}})
                                      </script>
                                        
                                      <?php }
                                    } } ?>
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cantidad{{$producto->id}}" style="width: 35px; padding: 0">
                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              </div>

                              <script>

                                    <?php if (Cart::content()->count()>0){  
                                      foreach(Cart::content() as $row) {
                                      if($row->id==$producto->id){
                                        $agregado=1;
                                        break;
                                      }
                                      else{
                                        $agregado=0;
                                      }
                                    }  }
                                    else{
                                        $agregado=0;
                                    }?>
                                var agregado{{$producto->id}}= {{$agregado}};
                                minValue =  parseInt($('#cantidad{{$producto->id}}').attr('min'));
                                maxValue =  parseInt($('#cantidad{{$producto->id}}').attr('max'));

                                if(parseInt($('#cantidad{{$producto->id}}').val()) >= minValue) {
                                        $(".btn-number[data-type='minus'][data-field='cantidad{{$producto->id}}']").removeAttr('disabled');
                                    }
                                if(parseInt($('#cantidad{{$producto->id}}').val()) <= maxValue) {
                                        $(".btn-number[data-type='plus'][data-field='cantidad{{$producto->id}}']").removeAttr('disabled');
                                    }
                                $('#cantidad{{$producto->id}}').change(function(){

                                  auto=true;
                                  if (agregado{{$producto->id}}==0&&$('#cantidad{{$producto->id}}').val()==1) {
                                    

                                    productoid = '{{$producto->id}}';
                                    cantidad=$('#cantidad{{$producto->id}}').val();
                                    _token = $('#token').val();
                                
                                    
                                    $.post("{{url('/carritopost')}}", {
                                        productoid : productoid,
                                        cantidad : cantidad,
                                        _token : _token
                                        }, function(data) {
                                          $("#actualizarcarro").append(data);
                                        });


                                  }
                                  else if($('#cantidad{{$producto->id}}').val()==0&&agregado{{$producto->id}}==1){
                                    
                                    <?php if (Cart::content()->count()>0){
                                     foreach(Cart::content() as $row) {
                                      if($row->id==$producto->id){
                                        $rowId=$row->rowId;
                                        break;
                                      }
                                      else{
                                        $rowId=0;
                                      }
                                    } ?>
                                    rowId = '{{$rowId}}';
                                    _token = $('#token').val();
                                    $.post("{{url('/removefromcartpost')}}", {
                                        rowId : rowId,
                                        _token : _token
                                        }, function(data) {
                                          $("#actualizarcarro").html("");
                                          $("#actualizarcarro").append(data);
                                        });
                                    <?php } ?>
                                  }
                                  else{
                                    
                                    <?php if (Cart::content()->count()>0){  
                                      foreach(Cart::content() as $row) {
                                      if($row->id==$producto->id){
                                        $rowId=$row->rowId;
                                        break;
                                      }

                                      else{
                                        $rowId=0;
                                      }

                                    } ?>
                                    qty=$('#cantidad{{$producto->id}}').val();
                                    rowId = '{{$rowId}}';
                                    _token = $('#token').val();
                                    $.post("{{url('/updatecartpost')}}", {
                                        qty : qty,
                                        rowId : rowId,
                                        _token : _token
                                        }, function(data) {
                                          $("#actualizarcarro").html("");
                                          $("#actualizarcarro").append(data);
                                        });
                                    <?php } ?>
                                  }
                                  probabilidad=($('#cantidad{{$producto->id}}').val()*100)/{{$producto->boletos}};
                                  Materialize.Toast.removeAll();

                                  var url="{{url('/carrito')}}"
                                  var $toastContent = $('<span>'+probabilidad.toFixed(2)+'% chance de ganar</span>').add($('<a href="'+url+'" class="btn-flat toast-action">Ir a carrito</a>'));
                                  Materialize.toast($toastContent, 4000);


    
                                
                                  costo=$('#cantidad{{$producto->id}}').val()*{{$producto->precio}};

                                  $('#precio{{$producto->id}}').html($('#cantidad{{$producto->id}}').val()+' <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = $'+costo.toFixed(0)+'MXN');
                                  




                                });
                              </script>
                            </div>
                            
                          </div>
                          

                          <div class="pbut hidden">
                            <br>
                          </div>

                          
                          

                          
                        </div>
                      </div>
                    </div>
                    </div>
                    </form>
                  </div>
                @endif
                  
                    @endforeach
                    <p>&nbsp;</p>
                    {{ $productos->links() }}
                </div>
              </div>
                  

            </div>
          </div>
        </section>


        <script>
          function list(){
            $('.product-type').addClass('col-md-12');
            $('.product-type').removeClass('col m4');

            $('.p1').addClass('m4');
            $('.p1').removeClass('m12');
            $('.p2').addClass('m8');
            $('.p2').removeClass('m12');

            $('.product-type').addClass('list');
            $('.product-type').removeClass('grid');

            $('.pbut').addClass('hidden');
            $('.pbut').removeClass('visible');

            $('.botonprecio').removeClass('col-md-12');
            $('.botonprecio').addClass('col-md-12');

            $('.botoncomprar').removeClass('col-md-6');
            $('.botoncomprar').addClass('col-md-6');
            $('.botoncantidad').removeClass('col-md-6');
            $('.botoncantidad').addClass('col-md-6');


          }
          function grid(){
            $('.product-type').removeClass('col-md-12');
            $('.product-type').addClass('col m4');

            $('.p1').removeClass('m4');
            $('.p1').addClass('m12');
            $('.p2').removeClass('m8');
            $('.p2').addClass('m12');

            $('.product-type').removeClass('list');
            $('.product-type').addClass('grid');

            $('.pbut').removeClass('hidden');
            $('.pbut').addClass('visible');

            $('.botonprecio').removeClass('col-md-12');
            $('.botonprecio').addClass('col-md-12');

            $('.botoncomprar').removeClass('col-md-6');
            $('.botoncomprar').addClass('col-md-6');

            $('.botoncantidad').removeClass('col-md-6');
            $('.botoncantidad').addClass('col-md-6');

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
    var input = $("input[id='"+fieldName+"']");
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
    
    name = $(this).attr('id');
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


      <div id="actualizarcarro"></div>


        @endsection
