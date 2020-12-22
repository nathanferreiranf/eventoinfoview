@if(Route::currentRouteName() == 'dashboard')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">dashboard</span>
                <span>Dashboard</span>
            </li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'salas.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">cast_for_education</span>
                <span>Salas</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'salas.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('salas.index') }}">
                    <span class="material-icons mr-2">cast_for_education</span>
                    <span>Salas</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'salas.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('salas.index') }}">
                    <span class="material-icons mr-2">cast_for_education</span>
                    <span>Salas</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sala->nm_sala }}</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'salas.show')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('salas.index') }}">
                    <span class="material-icons mr-2">cast_for_education</span>
                    <span>Salas</span>
                </a>
            </li>
            <li class="breadcrumb-item">Deletar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sala->nm_sala }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'agendas.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">schedule</span>
                <span>Agendas</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'agendas.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('agendas.index') }}">
                    <span class="material-icons mr-2">schedule</span>
                    <span>Agendas</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'agendas.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('agendas.index') }}">
                    <span class="material-icons mr-2">schedule</span>
                    <span>Agendas</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $agendamento->nm_agenda }}</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'agendas.show')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('agendas.index') }}">
                    <span class="material-icons mr-2">schedule</span>
                    <span>Agendas</span>
                </a>
            </li>
            <li class="breadcrumb-item">Deletar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $agendamento->nm_agenda }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'palestrantes.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">school</span>
                <span>Palestrantes</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'palestrantes.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('palestrantes.index') }}">
                    <span class="material-icons mr-2">school</span>
                    <span>Palestrantes</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'palestrantes.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('palestrantes.index') }}">
                    <span class="material-icons mr-2">school</span>
                    <span>Palestrantes</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $palestrante->nm_palestrante }}</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'palestrantes.show')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('palestrantes.index') }}">
                    <span class="material-icons mr-2">school</span>
                    <span>Palestrantes</span>
                </a>
            </li>
            <li class="breadcrumb-item">Deletar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $palestrante->nm_palestrante }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'planos.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">bookmarks</span>
                <span>Planos</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'planos.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('planos.index') }}">
                    <span class="material-icons mr-2">bookmarks</span>
                    <span>Planos</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'planos.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('planos.index') }}">
                    <span class="material-icons mr-2">bookmarks</span>
                    <span>Planos</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $plano->nm_plano }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'inscritos.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">person</span>
                <span>Inscritos</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'inscritos.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('inscritos.index') }}">
                    <span class="material-icons mr-2">person</span>
                    <span>Inscritos</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'inscritos.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('inscritos.index') }}">
                    <span class="material-icons mr-2">person</span>
                    <span>Inscritos</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $inscrito->name }}</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'inscritos.show')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('inscritos.index') }}">
                    <span class="material-icons mr-2">person</span>
                    <span>Inscritos</span>
                </a>
            </li>
            <li class="breadcrumb-item">Visualizar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $inscrito->name }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'eventos.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">event</span>
                <span>Evento</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'eventos.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('eventos.index') }}">
                    <span class="material-icons mr-2">event</span>
                    <span>Evento</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'eventos.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('eventos.index') }}">
                    <span class="material-icons mr-2">event</span>
                    <span>Evento</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $evento->nm_evento }}</li>
        </ol>
    </nav>
@endif

@if(Route::currentRouteName() == 'patrocinadores.index')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item active d-flex align-items-center">
                <span class="material-icons mr-2">star</span>
                <span>Patrocinadores</span>
            </li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'patrocinadores.create')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('patrocinadores.index') }}">
                    <span class="material-icons mr-2">star</span>
                    <span>Patrocinadores</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'patrocinadores.edit')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('patrocinadores.index') }}">
                    <span class="material-icons mr-2">star</span>
                    <span>Patrocinadores</span>
                </a>
            </li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $patrocinador->nm_patrocinador }}</li>
        </ol>
    </nav>
@endif
@if(Route::currentRouteName() == 'patrocinadores.show')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-0 bg-transparent">
            <li class="breadcrumb-item">
                <a class="d-flex align-items-center" href="{{ route('patrocinadores.index') }}">
                    <span class="material-icons mr-2">star</span>
                    <span>Patrocinadores</span>
                </a>
            </li>
            <li class="breadcrumb-item">Deletar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $patrocinador->nm_patrocinador }}</li>
        </ol>
    </nav>
@endif