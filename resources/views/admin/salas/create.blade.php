@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    @if(Request::session()->get('evento') == null)
        <div class="jumbotron text-center bg-transparent">
            <div class="container">
                <h1 class="display-4">Nenhum evento cadastrado.</h1>
                <p class="lead">Para adicionar uma sala primeiramente crie um evento.</p>
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
        <form action="{{ route('salas.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
            {{ csrf_field() }}
            <input type="hidden" name="id_evento" value="{{ Request::session()->get('evento.id') }}" />
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">Nova sala</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control @error('nm_sala') is-invalid @enderror" name="nm_sala" value="{{ old('nm_sala') }}" required />
                            @error('nm_sala')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Link do video:</label>
                            <input type="text" class="form-control @error('lk_sala') is-invalid @enderror" name="lk_sala" value="{{ old('lk_sala') }}" />
                            @error('lk_sala')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Link do chat:</label>
                            <input type="text" class="form-control @error('lk_chat') is-invalid @enderror" name="lk_chat" value="{{ old('lk_chat') }}" />
                            @error('lk_chat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Link de perguntas:</label>
                            <input type="text" class="form-control @error('lk_perguntas') is-invalid @enderror" name="lk_perguntas" value="{{ old('lk_perguntas') }}" />
                            @error('lk_perguntas')
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
                            <label>Data inicial:</label>
                            <calendar-component 
                                name="dt_inicio" 
                                class-name="form-control @error('dt_inicio') is-invalid @enderror"
                                error-message="@error('dt_inicio') {{ $message }} @enderror"
                                value="{{ (old('dt_inicio')) ? \Carbon\Carbon::createFromFormat('d/m/Y', old('dt_inicio'))->toDateString() : '' }}">
                            </calendar-component>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Hora:</label>
                            <input type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{ old('hora_inicio') }}" placeholder="00:00" v-mask="'##:##'" />
                            @error('dt_inicio')
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
                            <label>Data final:</label>
                            <calendar-component 
                                name="dt_fim" 
                                class-name="form-control @error('dt_fim') is-invalid @enderror"
                                error-message="@error('dt_fim') {{ $message }} @enderror"
                                value="{{ (old('dt_fim')) ? \Carbon\Carbon::createFromFormat('d/m/Y', old('dt_fim'))->toDateString() : '' }}">
                            </calendar-component>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Hora:</label>
                            <input type="text" class="form-control @error('hora_fim') is-invalid @enderror" name="hora_fim" value="{{ old('hora_fim') }}" placeholder="00:00" v-mask="'##:##'" />
                            @error('dt_fim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="d-block">Imagem:</label>
                            <img src="https://dummyimage.com/600x400/fff/aaa" class="img-fluid shadow-sm border rounded-lg mb-2" />
                            <small class="text-info">Tamanho ideal de 600 x 400px</small>
                            <input type="file" class="@error('thumb_sala') is-invalid @enderror" name="thumb_sala" value="{{ old('thumb_sala') }}" />
                            @error('thumb_sala')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="d-block">Arquivos:</label>
                            <input type="file" class="@error('arquivos') is-invalid @enderror" name="arquivos[]" value="{{ old('arquivos') }}" multiple />
                            @error('arquivos')
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
                            <editor-component value="{{ old('descricao') }}" class="@error('descricao') is-invalid @enderror"></editor-component>
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
                            <input type="checkbox" class="custom-control-input" name="fl_visivel" value="1" @if(!old('fl_visivel') || old('fl_visivel') == 1) checked @endif id="customCheckVisivel">
                            <label class="custom-control-label" for="customCheckVisivel">Sala visivel no site ?</label>
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
                <a href="{{ route('salas.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    @endif
</div>
@endsection
