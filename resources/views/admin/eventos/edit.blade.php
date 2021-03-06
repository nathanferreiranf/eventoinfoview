@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Editar evento</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="d-block">Banner principal:</label>
                        
                        @if($evento->lk_banner == null)
                            <img src="https://dummyimage.com/1200x550/fff/aaa" class="img-fluid shadow-sm border rounded-lg mb-2" />
                        @else
                            <img src="{{ asset($evento->lk_banner) }}" class="img-fluid shadow-sm border rounded-lg mb-2" />
                        @endif

                        <small class="text-info d-block">Tamanho ideal de 1200 x 550px</small>
                        <input type="file" class="d-block @error('lk_banner') is-invalid @enderror" name="lk_banner" value="{{ old('lk_banner') }}" />
                        @error('lk_banner')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="d-block">Banner para telas de autenticação:</label>
                        
                        @if($evento->lk_banner_auth == null)
                            <img src="https://dummyimage.com/1280x1080/fff/aaa" class="img-fluid shadow-sm border rounded-lg mb-2" />
                        @else
                            <img src="{{ asset($evento->lk_banner_auth) }}" class="img-fluid shadow-sm border rounded-lg mb-2" />
                        @endif
                        
                        <small class="text-info d-block">Tamanho ideal de 1280 x 1080px</small>
                        <input type="file" class="d-block @error('lk_banner_auth') is-invalid @enderror" name="lk_banner_auth" value="{{ old('lk_banner_auth') }}" />
                        @error('lk_banner_auth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <hr />
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control @error('nm_evento') is-invalid @enderror" name="nm_evento" value="{{ $evento->nm_evento }}" required />
                        @error('nm_evento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label>Data Inicio:</label>
                        <calendar-component name="dt_inicio" value="{{ $evento->dt_inicio }}" />
                        @error('dt_inicio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{ $evento->hora_inicio }}" placeholder="00:00" v-mask="'##:##'" />
                        @error('hora_inicio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label>Data Fim:</label>
                        <calendar-component name="dt_fim" value="{{ $evento->dt_fim }}" />
                        @error('dt_fim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora_fim') is-invalid @enderror" name="hora_fim" value="{{ $evento->hora_fim }}" placeholder="00:00" v-mask="'##:##'" />
                        @error('hora_fim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Descrição:</label>
                        <editor-component value="{{ $evento->descricao }}" />
                    </div>
                </div>
                <div class="col-12">
                    @error('descricao')
                        <span class="invalid-feedback d-table" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <hr />
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <campos-credenciamento-component :value="{{ $evento->campos }}" />
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
@endsection
