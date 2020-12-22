@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de palestrantes</h5>
                @if($palestrantes->total() >= 1)
                    <a href="{{ route('palestrantes.create') }}" class="btn btn-sm btn-secondary">
                        <div class="d-flex align-items-center">
                            <span class="material-icons">add</span>
                            <span class="ml-2">Novo palestrante</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <hr />

    <div class="form-row mt-2">
        @forelse ($palestrantes as $palestrante)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-palestrante shadow-sm mb-2">
                    <div class="card-image" style="background-image: url({{ asset($palestrante->lk_thumb) }})">
                        <div class="filtro">
                            <div class="infos">
                                <span>{{ $palestrante->nm_palestrante }}</span>
                                <small>{{ $palestrante->ocupacao }}</small>
                            </div>
                            <div class="badges">
                                <span class="badge badge-secondary">{{ $palestrante->posicao. ' ª' }}</span>
                                @if ($palestrante->fl_visivel == 1)
                                    <span class="badge badge-success">Visivel</span>
                                @endif
                                @if ($palestrante->fl_visivel == 0)
                                    <span class="badge badge-danger">Invisivel</span>
                                @endif
                                @if ($palestrante->fl_principal == 1)
                                    <span class="badge badge-warning">Principal</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex btns-action">
                        <a href="{{ route('palestrantes.edit', $palestrante->id) }}" class="btn btn-sm d-flex btn-outline-light"><span class="material-icons">edit</span></a>
                        <a href="{{ route('palestrantes.show', $palestrante->id) }}" class="btn btn-sm d-flex btn-outline-light ml-2"><span class="material-icons">delete</span></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="jumbotron text-center bg-transparent">
                    <div class="container">
                        <h1 class="display-4">Nenhum palestrante encontrado</h1>
                        <p class="lead">Não foi encontrada nenhum palestrante. Faça o cadastro ou redefina os critérios de busca</p>
                        <hr class="my-4">
                        <a href="{{ route('palestrantes.create') }}" class="btn btn-secondary mb-3">
                            <div class="d-flex align-items-center">
                                <span class="material-icons">add</span>
                                <span class="ml-2">Novo palestrante</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
