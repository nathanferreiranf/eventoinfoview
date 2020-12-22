@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visitas nos stands</li>
        </ol>
    </nav>
    
    <h4 class="text-center m-0">Lista de visitas</h4>
    <hr />
    <div class="row">
        <div class="col-12">
            <form class="card mb-3" action="{{ route('relatorio.visitas') }}" method="GET">
                <div class="card-body p-3">
                    <div class="form-row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" name="search" value="{{ Request::input('search') }}" placeholder="Nome / E-mail" />
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Sala</label>
                                <select class="custom-select" name="id_sala">
                                    <option value="">Todos</option>
                                    @foreach ($salas as $sala)
                                        <option value="{{ $sala->id }}" @if(Request::input('id_sala') == $sala->id) selected @endif>{{ $sala->nm_sala }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end p-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped m-0">
                            <thead>
                                <tr>
                                    <th nowrap>Sala</th>
                                    <th nowrap>Visitante</th>
                                    <th nowrap>E-mail</th>
                                    <th nowrap>Qtde. Acessos</th>
                                    <th nowrap>Último acesso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($visitas as $visita)
                                    <tr>
                                        <td style="vertical-align: middle" nowrap>{{ $visita->nm_sala }}</td>
                                        <td style="vertical-align: middle" nowrap>{{ $visita->nm_visitante }}</td>
                                        <td style="vertical-align: middle" nowrap>{{ $visita->email }}</td>
                                        <td style="vertical-align: middle" nowrap>{{ $visita->qtde }}</td>
                                        <td style="vertical-align: middle" nowrap>{{ date_format(date_create($visita->ultimo_acesso), 'd/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhuma visita encontrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center mt-3">
                {{ $visitas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
