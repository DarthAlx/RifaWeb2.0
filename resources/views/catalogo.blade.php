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
                  <a href="" data-toggle="tooltip" data-placement="top" title="Lista"><i class="fa fa-list"></i></a>
                  <a href="" data-toggle="tooltip" data-placement="top" title="Grilla"><i class="fa fa-th-large"></i></a>
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
                <div class="row">
                  @foreach($productos as $producto)

                  <div class="product col-md-12" style="padding: 0;">
                    <div class="img-container col-md-4 valign-wrapper" >
                      <img src="{{url('uploads/productos')}}/{{$producto->imagen}}" class="responsive-img">
                    </div>
                    <div class="product-info col-md-8">
                      <div class="product-content">
                        <h1>{{$producto->nombre}}</h1>
                        <p>{{$producto->descripcion}}</p>
                        <ul>
                          <li>Lorem ipsum dolor sit ametconsectetu.</li>
                          <li>adipisicing elit dlanditiis quis ip.</li>
                          <li>lorem sde glanditiis dars fao.</li>
                        </ul>
                        <br><br>
                        <div class="buttons">
                          <span class="button" id="price">1 Boleto = ${{$producto->precio}}mxn</span>
                          <a class="button buy" href="#">Ver rifa</a>

                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--div class="col-md-3">
                  <div class="product small hoverable" style="background: #fff;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('uploads/productos')}}/{{$producto->imagen}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>{{$producto->nombre}}</span>
                          </h3>
                          <h5>1 Boleto = ${{$producto->precio}}mxn</h5>
                          <div class="row cbox">
                            <div class="col l3">
                              <div class="countbox">
                                <div class="countnumber">
                                  <div class="number">
                                    <h2>1</h2>
                                  </div>
                                  <div class="text">
                                    <p>días</p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            <div class="col l3">
                              <div class="countbox">
                                <div class="countnumber">
                                  <div class="number">
                                    <h2>3</h2>
                                  </div>
                                  <div class="text">
                                    <p>horas</p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            <div class="col l3">
                              <div class="countbox">
                                <div class="countnumber">
                                  <div class="number">
                                    <h2>36</h2>
                                  </div>
                                  <div class="text">
                                    <p>minutos</p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            <div class="col l3">
                              <div class="countbox">
                                <div class="countnumber">
                                  <div class="number">
                                    <h2>19</h2>
                                  </div>
                                  <div class="text">
                                    <p>segundos</p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <div class="button text-center">
                            <button class="btn btn-success success">
                            Ir a sorteo
                          </button>
                          </div>
                          
                        </div>
                      </div>
                      </div>
                      <div class="visiblemov"><br></div>
                      
                    </div-->
                    @endforeach
                </div>
              </div>
                  

            </div>
          </div>
        </section>
        @endsection
