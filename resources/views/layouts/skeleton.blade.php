<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}"/>
        <title>Sound Monitor</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link href="{{ elixir('vendor/vendor.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed"
                        data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img alt="logo" src="{{ asset('img/logo.png') }}" />
                        Sound Monitor
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::guest())							
						
						
						@else
							<li class="@isActive('/monitor')">
								<a href="{{ url('/monitor') }}">
										Monitores
								</a>
							</li>
							<!--
							<li class="@isActive('/phppgadmin')">
								<a href="{{ url('/phppgadmin') }}" target="_blank">
										Banco de Dados
								</a>
							</li>
							-->
						@endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="@isActive('/login')">
                                <a href="{{ url('/login') }}">Entrar</a>
                            </li>
							<!--
                            <li class="@isActive('/register')">
                                <a href="{{ url('/register') }}">Cadastrar</a>
                            </li>
							-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('container')

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Sound Monitor</h4>
                        <ul class="nav">
                            <li>
                                <a href="https://github.com/leocandido/sound-monitor"
                                    target="_blank">
                                    <i class="fa fa-github"></i>
                                    Código Fonte
                                </a>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JavaScripts -->
        <script src="{{ elixir('vendor/vendor.js') }}"></script>
        @stack('scripts')
    </body>
</html>
