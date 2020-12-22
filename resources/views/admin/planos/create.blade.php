@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    @if(Request::session()->get('evento') == null)
        <div class="jumbotron text-center bg-transparent">
            <div class="container">
                <h1 class="display-4">Nenhum evento cadastrado.</h1>
                <p class="lead">Para adicionar um plano primeiramente crie um evento.</p>
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
        <form action="{{ route('planos.store') }}" method="POST" class="card shadow-sm">
            {{ csrf_field() }}
            <input type="hidden" name="id_evento" value="{{ Request::session()->get('evento.id') }}" />
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">Novo plano</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nome plano:</label>
                            <input type="text" class="form-control @error('nm_plano') is-invalid @enderror" name="nm_plano" value="{{ old('nm_plano') }}" required />
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
                            <input-money-component />
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
                            <calendar-component name="dt_validade" />
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
                            <input type="text" class="form-control @error('hora_validade') is-invalid @enderror" name="hora_validade" value="{{ old('hora_validade') }}" placeholder="00:00" v-mask="'##:##'" />
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
                                <option value="button">Botão</option>
                                <option value="card" selected>Card</option>
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
                                            <input type="checkbox" class="custom-control-input" name="acesso_salas[]" value="{{ $sala->id }}" id="customCheck{{ $sala->id }}">
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
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    @endif
</div>
@endsection
