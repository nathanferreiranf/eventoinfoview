@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row mb-3">
        <div class="col-12 col-md-4">
            <div class="card card-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="item">
                            <h5 class="card-title">Inscritos</h5>
                            <span class="card-value text-muted">{{ $qtde_inscritos }}</span>
                        </div>
                        <div class="item"><span class="icon material-icons">person</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="item">
                            <h5 class="card-title">Inscritos hoje</h5>
                            <span class="card-value text-muted">{{ $qtde_inscritos_hoje }}</span>
                        </div>
                        <div class="item"><span class="icon material-icons">group_add</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="item">
                            <h5 class="card-title">Visitas</h5>
                            <span class="card-value text-muted">{{ $totalVisitasSalas }}</span>
                        </div>
                        <div class="item"><span class="icon material-icons">visibility</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <visitas-salas-component :periodo="{{ collect($periodo_evento) }}" :salas="{{ collect($salas) }}" />
                </div>
                <div class="card-footer">
                    <a href="{{ route('relatorio.visitas') }}" class="btn btn-block btn-sm">Ver relatório detalhado</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
