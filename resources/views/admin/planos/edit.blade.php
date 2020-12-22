@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('planos.update', $plano->id) }}" method="POST" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Editar plano</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome plano:</label>
                        <input type="text" class="form-control @error('nm_plano') is-invalid @enderror" name="nm_plano" value="{{ $plano->nm_plano }}" required />
                        @error('nm_plano')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Valor do plano:</label>
                        <input-money-component :value="{{ $plano->vl_plano }}" />
                        @error('vl_plano')
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
                        <label>Validade:</label>
                        <calendar-component name="dt_validade" value="{{ $plano->dt_validade }}" />
                        @error('dt_validade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" class="form-control @error('hora_validade') is-invalid @enderror" name="hora_validade" value="{{ $plano->hora_validade }}" placeholder="00:00" v-mask="'##:##'" />
                        @error('hora_validade')
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
                        <label>Layout</label>
                        <select class="custom-select" name="layout">
                            <option value="button" @if($plano->layout == 'button') selected @endif>Botão</option>
                            <option value="card" @if($plano->layout == 'card') selected @endif>Card</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Salas:</label>
                        <ul class="list-group">
                            @foreach ($salas as $sala)    
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="acesso_salas[]" value="{{ $sala->id }}" @if(in_array($sala->id, explode(",", $plano->acesso_salas))) checked @endif id="customCheck{{ $sala->id }}" />
                                        <label class="custom-control-label" for="customCheck{{ $sala->id }}"><span class="ml-2">{{ $sala->nm_sala }}</span></label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('planos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
@endsection
