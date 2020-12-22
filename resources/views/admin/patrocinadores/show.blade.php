@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    @if(Request::session()->get('evento') == null)
        <div class="jumbotron text-center bg-transparent">
            <div class="container">
                <h1 class="display-4">Nenhum evento cadastrado.</h1>
                <p class="lead">Para adicionar um patrocinador primeiramente crie um evento.</p>
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
        <form action="{{ route('patrocinadores.destroy', $patrocinador->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="id_evento" value="{{ Request::session()->get('evento.id') }}" />
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">Deletar Patrocinador</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="d-block">Imagem:</label>
                            @if($patrocinador->lk_foto == null)
                                <img src="https://dummyimage.com/120x60/fff/aaa" class="img-fluid shadow-sm border rounded-lg mb-2" />
                            @else
                                <img src="{{ asset($patrocinador->lk_foto) }}" class="img-fluid shadow-sm border rounded-lg mb-2" />
                            @endif
                            <small class="text-info d-block">Tamanho ideal de 120 x 60px</small>
                            <input type="file" class="@error('lk_foto') is-invalid @enderror" name="lk_foto" value="{{ old('lk_foto') }}" readonly />
                            @error('lk_foto')
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
                            <input type="text" class="form-control @error('nm_patrocinador') is-invalid @enderror" name="nm_patrocinador" value="{{ $patrocinador->nm_patrocinador }}" readonly />
                            @error('nm_patrocinador')
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
                            <input type="checkbox" class="custom-control-input" name="fl_visivel" value="1" @if($patrocinador->fl_visivel == 1) checked @endif id="customCheckVisivel">
                            <label class="custom-control-label" for="customCheckVisivel">Patrocinador visivel no site ?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('patrocinadores.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-danger">Deletar</button>
            </div>
        </form>
    @endif
</div>
@endsection