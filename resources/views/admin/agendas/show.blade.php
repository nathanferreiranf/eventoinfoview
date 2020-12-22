@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <form action="{{ route('agendas.destroy', $agendamento->id) }}" method="POST" class="card shadow-sm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Deletar agendamento</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control @error('nm_agenda') is-invalid @enderror" name="nm_agenda" value="{{ $agendamento->nm_agenda }}" required />
                        @error('nm_agenda')
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
                        <calendar-component name="dt_inicio" value="{{ $agendamento->dt_inicio }}" />
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
                        <input type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{ $agendamento->hora_inicio }}" placeholder="00:00" v-mask="'##:##'" />
                        @error('hora_inicio')
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
                        <editor-component value="{{ $agendamento->descricao }}" />
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12">
                    @error('descricao')
                        <span class="invalid-feedback d-table" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('agendas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-danger">Deletar</button>
        </div>
    </form>
</div>
@endsection