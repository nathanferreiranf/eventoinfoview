@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row mb-3">
        <div class="col-12 col-md-4">
            <div class="card card-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="item">
                            <h5 class="card-title">Inscritos</h5>
                            <span class="card-value text-muted">{{ $inscritos->total() }}</span>
                        </div>
                        <div class="item"><span class="icon material-icons">person</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="item">
                            <h5 class="card-title">Inscritos hoje</h5>
                            <span class="card-value text-muted">{{ $qtde_inscritos_hoje }}</span>
                        </div>
                        <div class="item"><span class="icon material-icons">group_add</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de Inscritos</h5>
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
                            <th nowrap>Nome</th>
                            <th nowrap>E-mail</th>
                            @foreach ($campos as $campo)
                                <th nowrap>{{ $campo->nm_campo }}</th>
                            @endforeach
                            <th nowrap>Data inscrição</th>
                            <th nowrap></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inscritos as $inscrito)
                            <tr>
                                <td style="vertical-align: middle" nowrap>{{ $inscrito->name }}</td>
                                <td style="vertical-align: middle" nowrap>{{ $inscrito->email }}</td>
                                @foreach ($campos as $campo)
                                    <td style="vertical-align: middle" nowrap>{{ $inscrito[$campo->slug_campo] }}</td>
                                @endforeach
                                <td style="vertical-align: middle" nowrap>{{ $inscrito->dt_inscricao }}</td>
                                <td style="vertical-align: middle" nowrap>
                                    <a href="{{ route('inscritos.show', $inscrito->id) }}" class="btn btn-sm"><span class="material-icons">visibility</span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($inscritos->total() >= 15)    
                    <div class="d-flex justify-content-center mt-2">
                        {{ $inscritos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
