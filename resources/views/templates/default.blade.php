<!DOCTYPE html>
<html>
    <head>
        <title>Rifa Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('css/materialize.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}?v={{rand()}}" media="screen" />

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      </head>
    <body>
        <section class="navigation">
            <div class="container">
              <div class="col l12 text-center visiblemov">
                        <a class="navbar-brand auto " href="{{url('/')}}"><img src="{{url('img/Rifaweb2.png')}}" alt="" class="responsive-img"></a>
                    </div>
                <nav class="navbar navbar-expand-lg navbar-light">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="text-left">Menú</span>
                  </button>

                  <div class="collapse navbar-collapse row" id="navbarSupportedContent">

                    <ul class="navbar-nav col l4">
                      
                    </ul>
                    <div class="col l4 text-center">
                        <a class="navbar-brand auto hiddenmov" href="{{url('/')}}"><img src="{{url('img/Rifaweb2.png')}}" alt=""></a>
                    </div>
                    
                    <ul class="navbar-nav justify-content-end col l4">
                      @if (Auth::guest())
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('/entrar')}}">ENTRAR</a>
                        </li>
                      @else
                        
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="{{url('/perfil')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MI CUENTA
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/perfil')}}">Perfil</a>
                            <a class="dropdown-item" href="#">Mensajes <span class="new badge" data-badge-caption="nuevos">4</span></a>
                            <a class="dropdown-item" href="#">Mis Rifas</a>
                            <a class="dropdown-item" href="#">Direcciones</a>
                          </div>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('/salir')}}">SALIR</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">CARRITO</a>
                        </li>
                      @endif
                      
                    </ul>
                    
                    
                  </div>
                </nav>
            </div>
        </section>
        <section class="buttonsbar">
          <div class="container">
            <div class="row" style="margin-bottom:0;">
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#dd4b39;"><i class="fa fa-ticket fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Rifas</span> </div>
                    <a href="#123" style="text-decoration:none; color:#dd4b39;">
                      <div class="txt_google"><span class="hiddenmov">Todas las rifas</span><span class="visiblemov">Rifas</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#25B6D2;"><i class="fa fa-user fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Perfil</span> </div>
                    <a href="#123" style="text-decoration:none; color:#25B6D2;">
                      <div class="txt_google"><span class="hiddenmov">Tus rifas, mensajes y premios</span><span class="visiblemov">Perfil</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#FFCD50;"><i class="fa fa-trophy fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Rifas ganadas</span> </div>
                    <a href="#123" style="text-decoration:none; color:#FFCD50;">
                      <div class="txt_google"><span class="hiddenmov">Ganadores de las rifas anteriores</span><span class="visiblemov">Ganadores</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#2072A0;"><i class="fa fa-cogs fa-3x" aria-hidden="true"></i> <br> <span class="hiddenmov">¿Cómo Funciona?</span> </div>
                    <a href="#123" style="text-decoration:none; color:#2072A0;">
                      <div class="txt_google"><span class="hiddenmov">Ayuda sobre la plataforma</span><span class="visiblemov">Ayuda</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m4">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#C61867;"><i class="fa fa-book fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Permisos y Docs</span> </div>
                    <a href="#123" style="text-decoration:none; color:#C61867;">
                      <div class="txt_google"><span class="hiddenmov">Documentos legales</span><span class="visiblemov">Legales</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
            </div>
          </div>
        </section>
        




        @yield('pagecontent')

        
        
        <footer>
          <div class="container">
            <div class="col l12">
              <p>Creado por PYM Digital</p>

              <p>Copyright 2017 © RifaWeb</p>
            </div>
          </div>
          
        </footer>
        <a href="#" id="back-to-top" title="Regresar arriba">&uarr;</a>
        <script type="text/javascript" src="{{ url('js/materialize.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/popper.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ url('js/script.js') }}"></script>
        <script>
          $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();     
          });
        </script>
    </body>
</html>