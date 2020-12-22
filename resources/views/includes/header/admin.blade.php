<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/iview-logo-bottom.png') }}" class="img-fluid" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout.admin') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-menu navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item @if(Route::currentRouteName() == 'dashboard') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('dashboard') }}">
                        <span class="material-icons mr-2">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'eventos.idnex') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('eventos.index') }}">
                        <span class="material-icons mr-2">event</span>
                        <span>Evento</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'patrocinadores.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('patrocinadores.index') }}">
                        <span class="material-icons mr-2">star</span>
                        <span>Patrocinadores</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'salas.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('salas.index') }}">
                        <span class="material-icons mr-2">cast_for_education</span>
                        <span>Salas</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'agendas.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('agendas.index') }}">
                        <span class="material-icons mr-2">schedule</span>
                        <span>Agendas</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'palestrantes.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('palestrantes.index') }}">
                        <span class="material-icons mr-2">school</span>
                        <span>Palestrantes</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'planos.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('planos.index') }}">
                        <span class="material-icons mr-2">bookmarks</span>
                        <span>Planos</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'inscritos.index') active @endif">
                    <a class="nav-link d-flex justify-content-center align-items-center" href="{{ route('inscritos.index') }}">
                        <span class="material-icons mr-2">person</span>
                        <span>Inscritos</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>