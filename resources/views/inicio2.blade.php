@extends('templates.default')
@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
@endsection
@section('pagecontent')

@if($slides->count()>0)

<section class="">
          <div class="slider">
            @foreach($slides as $slide)


            @if($slide->tipo=="Producto")


            <div class="slider-item" style="background: url('{{url('/img/bgslide')}}/{{rand(1, 7)}}.jpg'); background-size: cover;">
              <div class="container"  style="position: relative !important;">
                <div class="row">


               
                <div class="col-md-6 col-sm-12">
                  <div class="slider-img" style="margin: 0 auto;">
                    <img class="img-responsive" src="{{url('uploads/productos')}}/{{$slide->producto->imagen}}" >
                  </div>
                </div>
                <div class="col-md-6  text-right">
                  <h2>Sorteo de {{$slide->producto->nombre}}</h2>

                  <h5>{{$slide->subtitulo}}</h5>
                  <h5>1 Boleto = ${{$slide->producto->precio}}</h5>
                  <div class="contadorslider">
                    <div id="contador{{$slide->producto->id}}" style="float: right;">
                            

                            <?php 
                            $datetime = explode(' ', $slide->producto->fecha_limite); 
                            $fecha = explode('-', $datetime[0]); 

                            $hora = explode(':', $datetime[1]); 


                            ?>
                            <script>
                              var Countdown{{$slide->producto->id}} = new Countdown({
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
                  </div>
                  
                          <p>&nbsp;</p><p>&nbsp;</p>
                          <div class="botonslide">
                            <a href="" class="btn btn-primary waves-effect waves-light">{{$slide->accion}}</a>
                          </div>
                          
                </div>
                



              </div>
              </div>
              
            </div>
            @endif

            @if($slide->tipo=="Imagen")
            <div>
              <a href="{{$slide->enlace}}"><img src="{{url('/uploads/slider')}}/{{$slide->imagen}}" style="width: 100%; max-height: 470px" alt=""></a>
            </div>

            @endif

            @if($slide->tipo=="Texto")

            <div class="slider-item" style="background: url('{{url('/img/bgslide')}}/{{rand(1, 6)}}.jpg'); background-size: cover;">
                          <div class="container"  style="position: relative !important;">
                            <div class="row" style="max-height: 350px;">


                            
                            <div class="col-sm-12">
                              <div style="min-height: 350px;">
                                <h2 style="text-align: center">{!!$slide->titulo!!}</h2>
                                <p style="text-align: center; color:#fff">{!!$slide->subtitulo!!}</p>
                                <p>&nbsp;</p>
                                <div class="text-center">
                                  <a href="{{$slide->enlace}}" class="btn btn-primary">{{$slide->accion}}</a>
                                </div>
                                
                              </div>
                              
                            </div>
                            



                          </div>
                          </div>
                          
                        </div>

            @endif



            @endforeach

          </div>

        </section>
        @endif

        <section class="steps">
          <div class="container">
            <div class="row">
              <div class="col l12">
                <h3 class="section-title section-title-center">
                  <b></b>
                  <span class="secition-title-main">¿CÓMO FUNCIONA?</span>
                  <b></b>
                </h3>
              </div>
            </div>
            <div class="row">
              <div class="col l4 m4">
                <div class="icon-box-img">
                  <img src="{{url('img/form.png')}}" alt="">
                </div>
                <div class="icon-box-text text-center">
                  <h5><strong>#1 – Registrate</strong></h5>
                  <p>Crea tu cuenta, y te regalamos 100 RifaTokens.</p>
                </div>
              </div>
              <div class="col l4 m4">
                <div class="icon-box-img">
                  <img src="{{url('img/gift.png')}}" alt="">
                </div>
                <div class="icon-box-text text-center">
                  <h5><strong>#2 – Escoge Un Sorteo</strong></h5>
                  <p>Escoge la rifa a la que te gustaría entrar.</p>
                </div>
              </div>
              <div class="col l4 m4">
                <div class="icon-box-img">
                  <img src="{{url('img/trophy.png')}}" alt="">
                </div>
                <div class="icon-box-text text-center">
                  <h5><strong>#3 – Gana</strong></h5>
                  <p>¡Espera a que ganes!</p>
                </div>
              </div>
            </div>
          </div>
        </section>



<section class="productsmain">
          <div class="container">
            <div class="row">
      <div class="col-md-12">
        @include('snip.notificaciones')
      </div>
    </div>
            <h3 class="section-title section-title-center">
                  <b></b>
                  <span class="secition-title-main">Destacados</span>
                  <b></b>
                </h3>
                <p>&nbsp;</p>
            <div class="col-md-12">
                <div class="row row-eq-height">
                  @foreach($productos as $producto)
                  @if(strtotime($producto->fecha_limite) >= strtotime(date("Y-m-d H:i:s")))
                  
                  <div class="product-type grid col-md-12" style="padding: 0;">
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
                          <li>{{str_limit($producto->descripcion, $limit = 30, $end = '...')}}</li>
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
                            <?php if($producto->vendidos >= $producto->minimo){?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: green;"></div>
                              <?php } else if((($producto->vendidos*100)/$producto->boletos)<=33){?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: red;"></div>
                              <?php }else{ ?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: yellow;"></div>
                              <?php } ?>
                          </div>
                        
                        
                        
                        @if($producto->gratuito)
                        <div class="buttons">
                          <div class="row" style="width: 100%; margin: 0;">
                            <div class="botonprecio col-md-12" style="padding: 0">
                              <span class="btn" id="precio{{$producto->id}}" style="padding: 0 1rem;width: 100%;"><span id="precio{{$producto->id}}">1 <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = Gratis
                            </div>
                            <div class="botoncantidad col-md-12" style="padding: 0">
                              <a href="{{url('/regalar')}}/{{$producto->id}}" class="btn" id="btnregalo{{$producto->id}}" style="width:100%; color: #fff;">Participar gratis</a>
                            </div>

                          </div>
                          @if (Auth::guest())

                          @else
                          <?php
                            $operacion=App\Operacion::where('user_id',Auth::user()->id)->where('tipo','Boleto gratis')->orderBy('created_at', 'desc')->first();
                            if ($operacion) {
                              $orden=$operacion->orden;
                              foreach ($orden->items as $item) {
                                  if ($item->producto==$producto->nombre&&$item->fecha==$producto->fecha_limite) {
                                      $yaregalado=true;
                                      break;
                                  }
                                  else{
                                      $yaregalado=false;
                                  }
                              }

                              if ($yaregalado) {
                                ?>
                                <script>
                                  $('#btnregalo{{$producto->id}}').addClass('disabled');
                                </script>
                                <?php

                              }
                          }
                          ?>
                          @endif
                        
                        </div>
                        @else
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
                                  var $toastContent = $('<span style="display:block">'+probabilidad.toFixed(2)+'% probabilidad de ganar</span><br>');
                                  Materialize.toast($toastContent, 4000);
                                  Materialize.toast('<a href="'+url+'" class="btn-flat toast-action"  style="text-align: center">Ir a carrito</a>', 4000);
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
                        @endif
                      </div>
                    </div>
                    </div>
                    </form>
                  </div>
                
                  @endif
                    @endforeach
                    
                </div>
              </div>
                  

            </div>
            





            







            </div>            
        </section>
        @endsection





        @section('scripts')
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

          grid();


          
        </script>


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