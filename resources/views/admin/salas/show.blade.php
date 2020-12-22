@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('salas.destroy', $sala->id) }}" method="POST" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Deletar sala</h5>
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
                        <label>Link:</label>
                        <input type="text" class="form-control @error('lk_sala') is-invalid @enderror" name="lk_sala" value="{{ $sala->lk_sala }}" disabled />
                        @error('lk_sala')
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
                        <label>Data:</label>
                        <calendar-component value="{{ $sala->dt_inicio }}" name="dt_inicio" :disabled="true" />
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora') is-invalid @enderror" name="hora" value="{{ $sala->hora }}" placeholder="00:00" v-mask="'##:##'" />
                        @error('dt_inicio')
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
                        <label>Imagem:</label>
                        <img src="{{ asset($sala->thumb_sala) }}" class="img-fluid rounded-lg border shadow-sm mb-2" />
                    </div>
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
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('salas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-danger">Deletar</button>
        </div>
    </form>
</div>
@endsection