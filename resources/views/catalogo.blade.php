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
                  <a href="{{url('/rifas')}}/{{strtolower($catalogo)}}" class="btn btn-default"><div>{{ucfirst($catalogo)}}</div></a>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="input-group mb-3 browser-default">
                  <input type="text" class="form-control browser-default" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append browser-default">
                    <button class="btn btn-outline-secondary browser-default" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </div>

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
                    <div class="p1 col m4 valign-wrapper" >
                      <div class="img-container">
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
                        <br><br>
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
