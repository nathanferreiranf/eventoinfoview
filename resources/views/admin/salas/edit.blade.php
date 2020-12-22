@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('salas.update', $sala->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Editar sala</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control @error('nm_sala') is-invalid @enderror" name="nm_sala" value="{{ $sala->nm_sala }}" disabled />
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
                        <input type="text" class="form-control @error('lk_sala') is-invalid @enderror" name="lk_sala" value="{{ $sala->lk_sala }}" />
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
                        <input type="text" class="form-control @error('lk_chat') is-invalid @enderror" name="lk_chat" value="{{ $sala->lk_chat }}" />
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
                        <input type="text" class="form-control @error('lk_perguntas') is-invalid @enderror" name="lk_perguntas" value="{{ $sala->lk_perguntas }}" />
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
                            value="{{ ($sala->dt_inicio) }}">
                        </calendar-component>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{ $sala->hora_inicio }}" placeholder="00:00" v-mask="'##:##'" />
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
                            value="{{ ($sala->dt_fim) }}">
                        </calendar-component>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora_fim') is-invalid @enderror" name="hora_fim" value="{{ $sala->hora_fim }}" placeholder="00:00" v-mask="'##:##'" />
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
                        <img src="{{ asset($sala->thumb_sala) }}" class="img-fluid rounded-lg border shadow-sm mb-2" />
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
                <div class="col-12">
                    <hr/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="d-block">Arquivos:</label>
                        <input type="file" class="@error('arquivos') is-invalid @enderror" name="arquivos[]" value="{{ old('arquivos') }}" multiple />
                        @error('arquivos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <files-component :arquivos="{{ collect($arquivos) }}" :sala="{{ collect($sala) }}" token={{ csrf_field() }} />
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <hr/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Descrição:</label>
                        <!--<textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" required>{{ old('descricao') }}</textarea>-->
                        <editor-component value="{{ $sala->descricao }}" />
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
                        <input type="checkbox" class="custom-control-input" name="fl_visivel" value="1" @if($sala->fl_visivel == 1) checked @endif id="customCheckVisivel">
                        <label class="custom-control-label" for="customCheckVisivel">Sala visivel no site ?</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="fl_principal" value="1" @if($sala->fl_principal == 1) checked @endif id="customCheckPrincipal">
                        <label class="custom-control-label" for="customCheckPrincipal">Definir como principal ?</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('salas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
@endsection
