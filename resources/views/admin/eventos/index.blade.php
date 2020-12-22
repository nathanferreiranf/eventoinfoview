@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de eventos</h5>
                
                @if($eventos->total() < 1)
                    <a href="{{ route('eventos.create') }}" class="btn btn-sm btn-secondary">
                        <div class="d-flex align-items-center">
                            <span class="material-icons">add</span>
                            <span class="ml-2">Novo evento</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <hr />

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped m-0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data inicio</th>
                            <th>Data termino</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($eventos as $evento)
                            <tr>
                                <td style="vertical-align: middle" nowrap>{{ $evento->nm_evento }}</td>
                                <td style="vertical-align: middle" nowrap>{{ $evento->dt_inicio_format }}</td>
                                <td style="vertical-align: middle" nowrap>{{ $evento->dt_fim_format }}</td>
                                <td style="vertical-align: middle" nowrap>
                                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm"><span class="material-icons">edit</span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum evento encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($eventos->total() >= 15)    
                    <div class="d-flex justify-content-center mt-2">
                        {{ $eventos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
