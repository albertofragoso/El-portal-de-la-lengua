<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','El portal de la lengua')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="http://innovacion.iems.edu.mx/ingles/img/iems.png" alt="" />
                <span class="gray hidden-sm-up"> IEMS</span>
                <span class="gray hidden-sm-down"> INSTITUTO DE EDUCACIÓN MEDIA SUPERIOR</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <ul class="nav navbar-nav ml-auto">
                    @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link btn btn-grad btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">Entrar</a>
                        </li>
                        &nbsp;&nbsp;
                        <li class="nav-item">
                            <a class="nav-link btn btn-grad btn-grad btn-outline-success my-2 my-sm-0" href="{{ route('register') }}">Registrate</a>
                        </li>
                    @else
                        <li class="nav-item dropdown mr-2">
                          <a data-toggle="modal" data-target="#myModal" class="btn btn-grad btn-outline-success my-2 my-sm-0" role="button">
                            ¿Dudas?
                          </a>
                        </li>
                        <li class="nav-item dropdown mr-2">
                          <a href="#" class="dropdown-toggle btn btn-grad btn-outline-success my-2 my-sm-0" data-toggle="dropdown" role="button" aria-expanded="false">
                            Notificaciones <span class="caret"></span>
                          </a>
                          <notifications :user="{{ Auth::user()->id }}"></notifications>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle btn btn-grad btn-outline-success my-2 my-sm-0" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" role="menu">
                              @if (Auth::user()->roll)
                                <a class="dropdown-item" href="/articulos/nuevo">
                                        Nuevo articulo
                                </a>
                                <hr>
                                <a class="dropdown-item" href="/articulos/actualizar">
                                        Modificar articulos
                                </a>
                                <hr>
                              @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
       <div class="row row-offcanvas row-offcanvas-right">
          <div class="offset-lg-3 col-lg-6 col-md-12 col-sm-12 mt-4 mb-5">
            @yield('content')
          </div>
        </div><!--/span-->
      <hr>
      <footer class="text-center">
        <p>&copy; Instituto de Educacion Media Superior {{ date('Y') }}</p>
      </footer>
    </div>
    <!--Modal dudas-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Escribe tu duda y con gusto la debatimos.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/conversaciones/create" method="post">
            <div class="modal-body">
              {{ csrf_field() }}
              <div class="form-group {{ $errors->has('conversacion') ? ' has-danger' : '' }}">
                <label for="recipient-name" class="form-control-label">Título</label>
                <input type="text" class="form-control" id="conversacion" name="conversacion" required>
                @if ($errors->has('conversacion'))
                  <div class="form-control-feedback">
                      <strong>{{ $errors->first('conversacion') }}</strong>
                  </div>
                @endif
              </div>
              <div class="form-group {{ $errors->has('mensaje') ? ' has-danger' : '' }}">
                <label for="message-text" class="form-control-label">Duda</label>
                <input type="text" class="form-control" id="mensaje" name="mensaje" required>
                @if ($errors->has('mensaje'))
                  <div class="form-control-feedback">
                      <strong>{{ $errors->first('mensaje') }}</strong>
                  </div>
                @endif
              </div>
              <small class="text-muted">Este proceso puede tardar un poco en lo que notificamos a los administradores.</small>
            </div>
            <div class="modal-footer">
              <a class="btn btn-grad" href="/conversaciones">Ver todas las dudas</a>
              <button type="submit" class="btn btn-grad">¡Listo!</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
  </div>
</body>
</html>
