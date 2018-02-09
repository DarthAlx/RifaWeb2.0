@extends('templates.default')
@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
@endsection
@section('pagecontent')
<section class="productsmain" style="background:#fff;">
  <div class="container">
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
                @if($producto->poplets->count()>0)
                  @foreach($producto->poplets as $poplet)
                  <img src="{{url('/uploads/productos/poplets')}}/{{$producto->id}}/{{$poplet->imagen}}" alt="" class="responsive-img materialboxed">
                  @endforeach
                @endif
                
              </div>
              <div class="col-md-9">
                <div class="img-containerlarge">
                  <img src="{{url('/uploads/productos')}}/{{$producto->imagen}}" alt="" class="responsive-img materialboxed">
                </div>
              </div>
            </div>
          
        </div>
        
      </div>
      <div class="col-md-6">
         <form action="{{url('carrito')}}" method="post">
          <input type="hidden" name="productoid" value="{{$producto->id}}">
                  {!! csrf_field() !!}
        <h4>{{$producto->nombre}}</h4>
        <p>Fuente: {{$producto->loteria}}</p>
                        <ul>
                          <li>{{$producto->descripcion}}</li>
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
                          <p>&nbsp;</p>
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
                              <span class="btn" id="price" style="color: #5e5e5e; background: rgba(137, 137, 137, 0.04);padding: 0 1rem;width: 100%;"><span id="precio{{$producto->id}}">1 <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = ${{$producto->precio}}mxn - <i class="fa fa-circle-o-notch" style="font-size: inherit;"></i>{{$producto->precio*10}}</span></span>
                            </div>
                            <div class="botoncantidad col-md-6" style="padding: 0">
                              <div class="input-group">
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="cantidad{{$producto->id}}"  style="width: 35px; padding: 0">
                                      <i class="fa fa-minus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              <input type="text" name="cantidad" id="cantidad{{$producto->id}}" class="form-control input-number browser-default" value="1" min="1" max="{{$producto->boletos-$producto->vendidos}}" style="height: 36px;">
                              <span class="input-group-btn" style="width: 35px;">
                                  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cantidad{{$producto->id}}" style="width: 35px; padding: 0">
                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                  </button>
                              </span>
                              </div>

                              <script>
                                $('#cantidad{{$producto->id}}').change(function(){
                                  probabilidad=($('#cantidad{{$producto->id}}').val()*100)/{{$producto->boletos}};
                                  Materialize.Toast.removeAll();
                                  Materialize.toast(probabilidad.toFixed(2)+"% chance de ganar", 4000);
                                  costo=$('#cantidad{{$producto->id}}').val()*{{$producto->precio}};
                                  costort=$('#cantidad{{$producto->id}}').val()*{{$producto->precio*10}};
                                  $('#precio{{$producto->id}}').html($('#cantidad{{$producto->id}}').val()+' <i class="fa fa-ticket" aria-hidden="true" style="font-size: 1rem;"></i> = $'+costo.toFixed(0)+'mxn - <i class="fa fa-circle-o-notch" style="font-size: inherit;"></i>'+costort.toFixed(0));


                                });
                              </script>
                            </div>
                            <div class="botoncomprar col-md-6 " style="padding: 0">
                              <button type="submit" class="btn" style="padding: 0 15px; width: 100%; color:#fff;"><i class="fa fa-shopping-cart"></i></button>
                            </div>
                          </div>
                          

                          <div class="pbut hidden">
                            <br>
                          </div>
      </div>
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
@endsection