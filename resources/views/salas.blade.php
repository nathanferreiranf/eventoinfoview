@extends('layouts.site')

@section('content')
<div class="container py-4">
    <h6 class="font-b font-weight-bold mb-4">{{ $evento->nm_evento }}</h6>

    <section class="section mb-4">
        <div class="section-header d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('home') }}" class="btn-back d-flex align-items-center">
                <span class="material-icons mr-2">arrow_back</span>Salas
            </a>
        </div>
        <div class="section-body">
            <!--<strong>Das 17h às 17h30</strong>-->
            <div class="form-row">
                @foreach ($salas as $sala)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card card-sala shadow-sm mb-2">
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
</div>
@endsection
