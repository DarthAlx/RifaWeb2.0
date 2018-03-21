@extends('templates.default')
@section('header')


  <meta property="og:url"           content="{{url()->current()}}" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="{{$producto->nombre}}" />
  <meta property="og:description"   content="{{$producto->descripcion}}" />
  <meta property="og:image"         content="{{url('/uploads/productos')}}/{{$producto->imagen}}" />

<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />


@endsection
@section('pagecontent')



<section class="productsmain" style="background:#fff;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @include('snip.notificaciones')
      </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <div id="bc1" class="btn-group btn-breadcrumb">
              <a href="{{url('/')}}" class="btn btn-default"><i class="fa fa-home"></i></a>
              <a href="{{url('/rifas')}}" class="btn btn-default"><div>Rifas</div></a>  
              <a href="{{url('/rifa')}}/{{$producto->slug}}" class="btn btn-default"><div>{{$producto->nombre}}</div></a>
            </div>
          </div>
        </div>
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          
            <div class="row">
              <div class="col-md-3">
                <div class="row">
                  @if($producto->video)
                  <div class="col-3 col-md-12">
                    <a  class="modal-trigger" href="#video"><img src="{{url('/img/play.png')}}" class="responsive-img"></a>

                    <div id="video" class="modal">
                      <div class="modal-content" style="height: 60vh;">
                        <iframe id="product-video" width="100%" style="height: 50vh;" src="https://www.youtube-nocookie.com/embed/{{$producto->video->video}}?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="materialboxed"></iframe>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                      </div>
                      
                    </div>
                  </div>

                  @endif

                  @if($producto->poplets->count()>0)
                    @foreach($producto->poplets as $poplet)
                    <div class="col-3 col-md-12">
                    <img src="{{url('/uploads/productos/poplets')}}/{{$producto->id}}/{{$poplet->imagen}}" alt="" class="responsive-img materialboxed">
                    </div>
                    @endforeach
                  @endif
                </div>
              </div>
              <div class="col-md-9">
                <div class="img-containerlarge">
                      @if($producto->fundacion&&$producto->fundacion!="")
                        <span class="fundacion">En beneficio de: {{$producto->fundacion}}</span>
                      @endif

                  <img src="{{url('/uploads/productos')}}/{{$producto->imagen}}" alt="" class="responsive-img materialboxed">              
                  <span class="product-price">1 <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = ${{$producto->precio}}</span>
                </div>
              </div>
            </div>
          
        </div>
        
      </div>
      <div class="col-md-6">
         <form action="{{url('carrito')}}" method="post">
          <input type="hidden" name="productoid" id="productoid{{$producto->id}}" value="{{$producto->id}}">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            
        <h4>{{$producto->nombre}}</h4>
        <ul>
                          <li>{{$producto->descripcion}}</li>
                        </ul>
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
                              width : 300, 
                              height  : 80,
                              rangeHi:"day"
                              });

                            </script>
                          </div>


        <p>Fuente: {{$producto->loteria}}</p>
                        
                        
                          
                          
                          <p>&nbsp;</p>
                          <p style="margin:0;">Progreso de rifa:</p>
                          <div class="progress tooltipped" data-position="top" data-delay="50" data-tooltip="{{$producto->vendidos}}/{{$producto->boletos}}">
                            <?php if($producto->vendidos >= $producto->minimo){?>
                              <div class="determinate" style="width: {{($producto->vendidos*100)/$producto->boletos}}%; background: green;"></div>
                              <?php } else if((($producto->vendidos*100)/$producto->boletos)<=33) {?>
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
                            
                            <div class="botoncantidad col-md-6" style="padding: 0">
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
                            <div class="col-md-6 botoncantidad" style="padding: 0;">
                              <a href="{{url('/carrito')}}" class="btn" style="width: 100%">Ir al carrito</a>
                            </div>
                            
                          </div>
                          

                          <div class="pbut hidden">
                            <br>
                          </div>
                          <p>&nbsp;</p>

                          <div id="shareBtn" class="btn btn-success clearfix" style="background-color: #3B5999;"><i class="fa fa-facebook" aria-hidden="true"></i> Compartir</div>
                          
                       

                          <!--iframe src="https://www.facebook.com/plugins/share_button.php?href={{url()->current()}}&layout=button&size=large&mobile_iframe=true&appId=1516214558672727&width=99&height=28" width="99" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe-->
      </div>
      @endif


    </form>
    </div>
    
  </div>
</section>


        


@endsection





@section('scripts')
<script>
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

<script>
                          document.getElementById('shareBtn').onclick = function() {
                            FB.ui({
                              method: 'share',
                              display: 'popup',
                              href: '{{url()->current()}}',
                            }, function(response){
                              if (response.post_id!="") {
                                _token = $('#token').val();
                                $.post("{{url('/regalo')}}", {
                                    _token : _token
                                    }, function(data) {
                                      $("#regalo").append(data);
                                    });
                              }
                            });
                          }
                        </script>

@endsection

