@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('palestrantes.destroy', $palestrante->id) }}" method="POST" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Deletar palestrante</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Imagem:</label>
                        <img src="{{ asset($palestrante->lk_thumb) }}" class="img-fluid rounded-lg border shadow-sm mb-2" />
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control @error('nm_palestrante') is-invalid @enderror" name="nm_palestrante" value="{{ $palestrante->nm_palestrante }}" required />
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
                        <input type="text" class="form-control @error('ocupacao') is-invalid @enderror" name="ocupacao" value="{{ $palestrante->ocupacao }}" required />
                        @error('ocupacao')
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
                        <label>Curriculo:</label>
                        <editor-component value="{{ $palestrante->descricao }}" />
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
            <a href="{{ route('palestrantes.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-danger">Deletar</button>
        </div>
    </form>
</div>
@endsection