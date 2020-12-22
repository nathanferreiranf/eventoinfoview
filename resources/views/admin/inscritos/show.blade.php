@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Inscrito</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $inscrito->name }}" style="background-color: #fff" readonly />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $inscrito->email }}" style="background-color: #fff" readonly />
                    </div>
                </div>

                @foreach ($campos as $campo)
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{ $campo->nm_campo }}:</label>
                            <input type="text" class="form-control @error($campo->slug_campo) is-invalid @enderror" name="{{ $campo->slug_campo }}" value="{{ $inscrito[$campo->slug_campo] }}" style="background-color: #fff" readonly />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('inscritos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection