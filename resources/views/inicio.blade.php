@extends('templates.default')

@section('pagecontent')

<section class="">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{url('img/slide.png')}}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{url('img/slide.png')}}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{url('img/slide.png')}}" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </section>

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
                  <p>Crea tu cuenta, y recibe 100 tickets gratis.</p>
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
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="product big hoverable" style="background: url('{{url('img/bg-product2.jpg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/iphone-x-select-2017.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>SORTEO DE IPHONE X</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                  </div>
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                  <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                      
                    </div>
            
                <div class="col-md-6">
                  <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                <div class="col-md-6">
                  <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                </div>
                
              </div>
            </div>





            







            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                <div class="col-md-6">
                  <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                <div class="col-md-6">
                  <div class="product small hoverable" style="background: url('{{url('img/bg-product.jpeg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/Xbox-One-Console.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>Sorteo de Xbox One</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                </div>
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="product big hoverable" style="background: url('{{url('img/bg-product2.jpg')}}'); background-size: cover;">
                      <div class="product-container">
                        <p>&nbsp;</p>
                        <div class="product-image text-center">
                          <img src="{{url('img/iphone-x-select-2017.png')}}" alt="" class="responsive-img">
                        </div>
                        <div class="product-text uppercase">
                          <h3>
                            <span>SORTEO DE IPHONE X</span>
                          </h3>
                          <h5>1 Boleto = $30mxn</h5>
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
                  </div>
                </div>
                
              </div>
              
            </div>            
        </section>
        @endsection