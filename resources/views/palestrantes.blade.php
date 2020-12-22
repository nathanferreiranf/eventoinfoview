@extends('layouts.site')

@section('content')
<div class="container py-4">
    <h6 class="font-b font-weight-bold mb-4">{{ $evento->nm_evento }}</h6>

    <section class="section mb-4">
        <div class="section-header d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('home') }}" class="btn-back d-flex align-items-center">
                <span class="material-icons mr-2">arrow_back</span>Palestrantes
            </a>
        </div>
        <div class="section-body">
            <div class="form-row mt-2">
                @foreach ($palestrantes as $palestrante)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card card-palestrante shadow-sm mb-2">
                            <div class="card-image" style="background-image: url({{ asset($palestrante->lk_thumb) }})">
                                <div class="filtro">
                                    <div class="infos">
                                        <span>{{ $palestrante->nm_palestrante }}</span>
                                        <small>{{ $palestrante->ocupacao }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-reveal">
                                {!! $palestrante->descricao !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
