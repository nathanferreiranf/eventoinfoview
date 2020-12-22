@extends('layouts.site')

@section('content')
<div class="container py-4">
    <h6 class="font-b font-weight-bold mb-4">{{ $evento->nm_evento }}</h6>

    <section class="section mb-4">
        <div class="section-header d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('home') }}" class="btn-back d-flex align-items-center">
                <span class="material-icons mr-2">arrow_back</span>Agenda
            </a>
            <div class="dropdown dropdown-filtro">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownFiltros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ordenar por</a>
                <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="dropdownFiltros">
                    <a class="dropdown-item" href="#">Mais recentes</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <!--<strong>Das 17h às 17h30</strong>-->
            <div class="form-row mt-2">
                @foreach ($agendamentos as $agenda)    
                    <div class="col-12">
                        <div class="card card-evento shadow-sm mb-3">
                            <div class="card-body">
                                <h5>{{ $agenda->nm_agenda }}</h5>
                                <span class="text-muted">{!! $agenda->descricao !!}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
