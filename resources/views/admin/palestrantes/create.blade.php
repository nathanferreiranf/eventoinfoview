@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    @if(Request::session()->get('evento') == null)
        <div class="jumbotron text-center bg-transparent">
            <div class="container">
                <h1 class="display-4">Nenhum evento cadastrado.</h1>
                <p class="lead">Para adicionar um palestrante primeiramente crie um evento.</p>
                <hr class="my-4">
                <a href="{{ route('eventos.create') }}" class="btn btn-secondary mb-3">
                    <div class="d-flex align-items-center">
                        <span class="material-icons">add</span>
                        <span class="ml-2">Criar evento</span>
                    </div>
                </a>
            </div>
        </div>
    @else
        <form action="{{ route('palestrantes.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
            {{ csrf_field() }}
            <input type="hidden" name="id_evento" value="{{ Request::session()->get('evento.id') }}" />
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">Novo Palestrante</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Imagem:</label>
                            <img src="https://dummyimage.com/335x400/fff/aaa" class="img-fluid shadow-sm border rounded-lg mb-2" />
                            <small class="text-info d-block">Tamanho ideal de 335 x 400px</small>
                            <input type="file" class="@error('lk_thumb') is-invalid @enderror" name="lk_thumb" value="{{ old('lk_thumb') }}" />
                            @error('lk_thumb')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control @error('nm_palestrante') is-invalid @enderror" name="nm_palestrante" value="{{ old('nm_palestrante') }}" required />
                            @error('nm_palestrante')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Ocupação:</label>
                            <input type="text" class="form-control @error('ocupacao') is-invalid @enderror" name="ocupacao" value="{{ old('ocupacao') }}" required />
                            @error('ocupacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Posição:</label>
                            <input type="number" class="form-control @error('posicao') is-invalid @enderror" name="posicao" value="{{ old('posicao') }}" />
                            @error('posicao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Curriculo:</label>
                            <editor-component value="{{ old('descricao') }}" />
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="fl_visivel" value="1" @if(old('fl_visivel') == 1 || !old('fl_visivel')) checked @endif id="customCheckVisivel">
                            <label class="custom-control-label" for="customCheckVisivel">Palestrante visivel no site ?</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="fl_principal" value="1" @if(old('fl_principal') == 1) checked @endif id="customCheckPrincipal">
                            <label class="custom-control-label" for="customCheckPrincipal">Definir como principal ?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('palestrantes.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    @endif
</div>
@endsection
