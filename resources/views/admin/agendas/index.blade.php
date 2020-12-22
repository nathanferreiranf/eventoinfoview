@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de agendas</h5>
                
                <a href="{{ route('agendas.create') }}" class="btn btn-sm btn-secondary">
                    <div class="d-flex align-items-center">
                        <span class="material-icons">add</span>
                        <span class="ml-2">Novo agendamento</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <hr />

    <div class="form-row">
        @forelse ($agendamentos as $agendamento)
            <div class="col-12">
                <div class="card card-evento rounded-lg shadow-sm mb-3">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-12 col-md-8">
                                <h5>{{ $agendamento->nm_agenda }}</h5>
                                <span class="d-block text-muted mb-2">{!! $agendamento->descricao !!}</span>
                                <small class="text-muted">{{ $agendamento->dt_inicio_format }}</small>
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-around align-self-center">
                                <a href="{{ route('agendas.edit', $agendamento->id) }}" class="btn btn-secondary btn-sm d-flex align-items-center"><span class="material-icons mr-2">edit</span>Editar</a>
                                <a href="{{ route('agendas.show', $agendamento->id) }}" class="btn btn-danger btn-sm d-flex align-items-center"><span class="material-icons mr-2">delete</span>Deletar</a>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="jumbotron text-center bg-transparent">
                    <div class="container">
                        <h1 class="display-4">Nenhum agendamento encontrado</h1>
                        <p class="lead">Não foi encontrada nenhum agendamento. Faça o cadastro ou redefina os critérios de busca</p>
                        <hr class="my-4">
                        <a href="{{ route('agendas.create') }}" class="btn btn-secondary mb-3">
                            <div class="d-flex align-items-center">
                                <span class="material-icons">add</span>
                                <span class="ml-2">Novo agendamento</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
