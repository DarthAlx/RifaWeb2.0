<!DOCTYPE html>
<html>
    <head>
        <title>Rifa Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('css/materialize.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}" media="screen" />
        @yield('header')
        <link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}?v={{rand()}}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('js/bxslider/css/jquery.bxslider.css') }}" />

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ url('js/countdown.js') }}"></script>
    </head>
    <body>
        <nav>
            <ul id="slide-out" class="side-nav fixed">
                
                    <a href="{{url('/admin')}}"><img src="{{url('img/Rifaweb2.png')}}" class="responsive-img" alt=""></a>
                
                  <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="{{url('/admin')}}" class="waves-effect"><i class="fa fa-bar-chart" aria-hidden="true"></i> Escritorio</a></li>
                      <li>
                        <a class="collapsible-header" class="waves-effect"><i class="fa fa-shopping-basket" aria-hidden="true"></i> E-commerce</a>
                        <div class="collapsible-body">
                          <ul>
                            <li><a href="{{url('/productos')}}">Productos</a></li>
                            <li><a href="{{url('/ordenes')}}">Ordenes</a></li>
                            <li><a href="{{url('/ganadores')}}">Ganadores</a></li>
                            <li><a href="{{url('/canceladas')}}">Rifas canceladas</a></li>
                            <li><a href="{{url('/catalogos')}}">Catálogos</a></li>
                          </ul>
                        </div>
                      </li>
                    </ul>
                  </li>
                <li><a href="{{url('/codigos')}}" class="waves-effect"><i class="fa fa-qrcode" aria-hidden="true"></i> Códigos</a></li>
                <li><a href="{{url('/rifatokens')}}" class="waves-effect"><i class="fa fa-circle-o-notch"></i> RifaTokens</a></li>
                <li><a href="{{url('/trivias')}}" class="waves-effect"><i class="fa fa-question" aria-hidden="true"></i> Trivias</a></li>
                <li><a href="{{url('/mensajes')}}" class="waves-effect"><i class="fa fa-envelope" aria-hidden="true"></i> Mensajes</a></li>
                <li><a href="{{url('/slider')}}" class="waves-effect"><i class="fa fa-film" aria-hidden="true"></i> Slider</a></li>
                <li><a href="{{url('/regalo-update')}}" class="waves-effect"><i class="fa fa-gift" aria-hidden="true"></i> Regalo</a></li>
                <li><a href="{{url('/crm')}}" class="waves-effect"><i class="fa fa-user" aria-hidden="true"></i> CRM</a></li>
            </ul>
        </nav>

        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" data-activates="slide-out" class="button-collapse d-block d-md-none left"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        <div class="text-right">
                          <button class='dropdown-button btn' href='#' data-activates='dropdown1'>
                            Admin
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            
                          </div>
                        </div>

                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a class="dropdown-item" href="{{url('/salir')}}">Cerrar sesión</a></li>
                            
                          </ul>
                    </div>
                </div>
            </div>
          
        </header>
        
    
    
        @yield('pagecontent')
        <!--script type="text/javascript" src="{{ url('js/popper.js') }}"></script-->
        <script type="text/javascript" src="{{ url('js/materialize.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/Chart.js') }}"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>



        
        <script type="text/javascript" src="{{ url('js/script.js') }}"></script>
        <script>
          $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();     
            $('.collapsible').collapsible();
            $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
            $('.collapsible').collapsible();
            $('#loteria').material_select();
            $('.modal').modal();
            $('.select').material_select();
            


         


          });
        </script>
        
        @yield('scripts')

        <?php //App\Http\Controllers\OrdenController::cancelacion(); ?>
    </body>
</html>