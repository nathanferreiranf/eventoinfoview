@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de salas</h5>
                @if($salas->total() >= 1)
                    <a href="{{ route('salas.create') }}" class="btn btn-sm btn-secondary">
                        <div class="d-flex align-items-center">
                            <span class="material-icons">add</span>
                            <span class="ml-2">Nova sala</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <hr />

    <div class="form-row">
        @forelse ($salas as $sala)
            <div class="col-12 align-self-center">
                <div class="card card-sala border shadow-sm mb-2">
                    <div class="row no-gutters">
                        <div class="col-12 col-lg-5 col-xl-4">
                            <div class="card-img-inline" style="background-image: url({{ asset($sala->thumb_sala) }})">
                                <div class="badges">
                                    @if ($sala->fl_visivel == 1)
                                        <span class="badge badge-success">Visivel</span>
                                    @endif
                                    @if ($sala->fl_visivel == 0)
                                        <span class="badge badge-danger">Invisivel</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 col-xl-8">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h5 class="card-title m-0">{{ $sala->nm_sala }}</h5>
                                    <div class="d-flex">
                                        <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-sm d-flex justify-content-center text-reset"><span class="material-icons">edit</span></a>
                                        <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-sm d-flex justify-content-center text-reset"><span class="material-icons">delete</span></a>
                                    </div>
                                </div>
                                {!! $sala->descricao !!}
                                @if($sala->dt_inicio->lte(date('Y-m-d H:i:s')) && $sala->dt_fim->gte(date('Y-m-d H:i:s')))
                                    <div class="tarja">
                                        <div class="spinner-grow spinner-grow-sm dot" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <span>Ao vivo</span>
                                    </div>
                                    <small class="card-text text-muted">De <strong>{{ $sala->dt_inicio_format }}</strong> á <strong>{{ $sala->dt_fim_format }}</strong></small>
                                @else
                                    <small class="card-text text-muted">De <strong>{{ $sala->dt_inicio_format }}</strong> á <strong>{{ $sala->dt_fim_format }}</strong></small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="jumbotron text-center bg-transparent">
                    <div class="container">
                        <h1 class="display-4">Nenhuma sala encontrada</h1>
                        <p class="lead">Não foi encontrada nenhuma sala. Faça o cadastro ou redefina os critérios de busca</p>
                        <hr class="my-4">
                        <a href="{{ route('salas.create') }}" class="btn btn-secondary mb-3">
                            <div class="d-flex align-items-center">
                                <span class="material-icons">add</span>
                                <span class="ml-2">Nova sala</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
