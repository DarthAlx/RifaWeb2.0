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
                        <p>{{$producto->loteria}}</p>
                        <ul>
                          <li>{{str_limit($producto->descripcion, $limit = 50, $end = '...')}}</li>
                        </ul>
                        <div id="contador"></div>
                        <div class="buttons">
                          <span class="button" id="price">1 Boleto = ${{$producto->precio}}mxn</span>

                          <div class="pbut hidden">
                            <br>
                          </div>
                          <a class="button buy" href="#">Ver rifa</a>

                          
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
            var diferencia=(fecha.getTime()-hoy.getTime())/1000
            dias=Math.floor(diferencia/86400)
            diferencia=diferencia-(86400*dias)
            horas=Math.floor(diferencia/3600)
            diferencia=diferencia-(3600*horas)
            minutos=Math.floor(diferencia/60)
            diferencia=diferencia-(60*minutos)
            segundos=Math.floor(diferencia)
            
            $("#contador").html('<div class="row cbox"><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ dias +'</h2></div><div class="text"><p>días</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ horas +'</h2></div><div class="text"><p>horas</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ minutos +'</h2></div><div class="text"><p>minutos</p></div></div></div></div><div class="col l3"><div class="countbox"><div class="countnumber"><div class="number"><h2>'+ segundos +'</h2></div><div class="text"><p>segundos</p></div></div></div></div></div>');

            if (dias>0 || horas>0 || minutos>0 || segundos>0){
                    setTimeout("countdown('contador'"+","+ano+","+mes+","+dia+")",100)
            }
    }
    else{
            document.getElementById(id).innerHTML='<table><tr><td><span class="numerito" ' + dias + '</td><td> dÃ­as</td></tr><tr><td>, ' + horas + '</td><td>horas</td></tr><tr><td> ' + minutos + '</td><td>minutos</td></tr> </table>'
    }
}
        countdown('contador','2018','0','26');
        </script>


        @endsection
