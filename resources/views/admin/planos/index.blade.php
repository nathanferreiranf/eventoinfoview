@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de planos</h5>
                @if($planos->total() >= 1)
                    <a href="{{ route('planos.create') }}" class="btn btn-sm btn-secondary">
                        <div class="d-flex align-items-center">
                            <span class="material-icons">add</span>
                            <span class="ml-2">Novo plano</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <hr />

    <div class="form-row mt-2">
        @forelse ($planos as $plano)
            <div class="col-12">
                <div class="card card-plano shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="item">
                                <h5>{{ $plano->nm_plano }}</h5>
                                @if($plano->vl_plano >= 1)
                                    <strong class="d-block">R$ {{ $plano->vl_plano }}</strong>
                                @endif
                                <small class="text-muted">Vagas até {{ $plano->dt_validade_format }}</small>
                            </div>
                            <div class="item">
                                <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-success btn-lg">Editar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="accordion" id="plano-{{ $plano->id }}">
                            <div id="collapse-{{ $plano->id }}" class="collapse" aria-labelledby="heading-{{ $plano->id }}" data-parent="#plano-{{ $plano->id }}">
                                <div class="separator my-2"></div>
                                @foreach ($plano->salas as $sala)
                                    <p>Acesso a sala <strong>{{ $sala->nm_sala }}</strong></p>
                                @endforeach
                            </div>
                            <button class="btn btn-link btn-block py-0" type="button" data-toggle="collapse" data-target="#collapse-{{ $plano->id }}" aria-expanded="true" aria-controls="collapse-{{ $plano->id }}">Lista de acessos</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="jumbotron text-center bg-transparent">
                    <div class="container">
                        <h1 class="display-4">Nenhum plano encontrado</h1>
                        <p class="lead">Não foi encontrado nenhum plano. Faça o cadastro ou redefina os critérios de busca</p>
                        <hr class="my-4">
                        <a href="{{ route('planos.create') }}" class="btn btn-secondary mb-3">
                            <div class="d-flex align-items-center">
                                <span class="material-icons">add</span>
                                <span class="ml-2">Novo plano</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
