@extends('layouts.site')

@section('content')

@if($evento != null)
    <section id="banner" style="background-image: url({{ asset($evento->lk_banner) }})"></section>

    <div class="container py-4">
        @auth
            <h1 class="font-b font-weight-bold mb-4">{{ $evento->nm_evento }}</h1>

            <section class="section border-bottom mb-4">
                <div class="section-header d-flex justify-content-between align-items-center mb-2">
                    <h6 class="font-weight-bold">Salas de palestras</h6>
                    <a href="{{ route('site.salas.index') }}">Ver todas</a>
                </div>
                <div class="section-body">
                    <div class="form-row">
                        @foreach ($salas as $sala)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card card-sala shadow-sm mb-3">
                                    <a href="{{ route('site.salas.show', $sala->slug_sala) }}" class="card-img-top" style="background-image: url({{ asset($sala->thumb_sala) }})"></a>
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">{{ $sala->nm_sala }}</h5>
                                        <duration-component class="mb-2" dt_inicio="{{ $sala->dt_inicio }}" dt_fim="{{ $sala->dt_fim }}"></duration-component>
                                        {!! $sala->descricao !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>    
        @endauth

        <div class="row">
            <div class="col-12 col-md-6">
                @if (!Auth::check())
                    <h1 class="font-weight-bold mb-5">{{ $evento->nm_evento }}</h1>
                @endif

                <section class="mb-5">
                    <h6 class="font-weight-bold">Descrição</h6>
                    {!! $evento->descricao !!}
                </section>
                

                <section class="mb-5">
                    <h6 class="font-weight-bold">Data e hora</h6>
                    <p>De <strong>{{ $evento->dt_inicio_format }}</strong> até <strong>{{ $evento->dt_fim_format }}</strong></p>
                </section>

                <section class="section mb-3">
                    <div class="section-header d-flex justify-content-between align-items-center mb-2">
                        <h6 class="font-weight-bold m-0">Palestrantes</h6>
                        <a href="{{ route('web.palestrantes.index') }}">Ver todos</a>
                    </div>
                    <div class="section-body">
                        <div class="form-row">
                            @foreach ($palestrantes as $palestrante)
                                <div class="col-6 col-sm-6 col-lg-4">
                                    <div class="card card-palestrante card-palestrante-mini shadow-sm mb-2">
                                        <div class="card-image" style="background-image: url({{ asset($palestrante->lk_thumb) }})">
                                            <div class="filtro">
                                                <div class="infos">
                                                    <span>{{ $palestrante->nm_palestrante }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6">
                @if(!Auth::check())
                    <section class="section mb-4">
                        <div class="section-body">
                            <div class="form-row">
                                @foreach ($planos as $plano)    
                                    <div class="col-12">
                                        @if($plano->layout == 'card')
                                            <div class="card card-plano shadow-sm mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="item">
                                                            <h5>{{ $plano->nm_plano }}</h5>
                                                            <small class="text-muted">Vagas até {{ $plano->dt_validade_format }}</small>
                                                        </div>
                                                        <div class="item">
                                                            <a href="{{ route('register') }}" class="btn btn-success btn-lg">Credenciamento</a>
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
                                                        <button class="btn btn-link btn-block py-0" type="button" data-toggle="collapse" data-target="#collapse-{{ $plano->id }}" aria-expanded="true" aria-controls="collapse-1">Saiba mais</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($plano->layout == 'button')
                                            <a href="{{ route('register') }}" class="btn btn-success btn-lg btn-block">{{ $plano->nm_plano }}</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                <section class="section mb-4">
                    <div class="section-header d-flex justify-content-between align-items-center mb-3">
                        <h6 class="font-weight-bold m-0">Agenda</h6>
                        @if($agendamentos->total() > 4)
                            <a href="{{ route('agenda.index') }}">Ver todos</a>
                        @endif
                    </div>
                    <div class="section-body">
                        <!--<strong>Das 17h às 17h30</strong>-->
                        <div class="form-row mt-2">
                            @foreach ($agendamentos as $agenda)    
                                <div class="col-12">
                                    <div class="card card-evento shadow-sm mb-3">
                                        <div class="card-body">
                                            <h5>{{ $agenda->nm_agenda }}</h5>
                                            <div class="text-muted mb-2">{!! $agenda->descricao !!}</div>
                                            <small class="text-muted">{{ $agenda->dt_inicio_format }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <hr />

        <section class="section">
            <!--<div class="section-header d-flex justify-content-between align-items-center mb-3">
                <h6 class="font-weight-bold m-0">Apoio</h6>
            </div>-->
            <div class="section-body">
                <div class="form-row justify-content-center align-items-center">
                    @foreach ($patrocinadores as $patrocinador)    
                        <div class="col-4 col-md-2 text-center">
                            <a href="{{ $patrocinador->lk_site }}" target="_blank">
                                <img src="{{ asset($patrocinador->lk_foto) }}" class="img-fluid w-75 mb-2" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endif

@endsection
