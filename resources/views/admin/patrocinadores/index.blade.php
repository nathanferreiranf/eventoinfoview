@extends('layouts.admin')

@section('content')
<div class="container py-2">
    @include('includes.breadcrumb')
    @include('includes.alerts')

    <div class="form-row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0">Lista de patrocinadores</h5>
                
                <a href="{{ route('patrocinadores.create') }}" class="btn btn-sm btn-secondary">
                    <div class="d-flex align-items-center">
                        <span class="material-icons">add</span>
                        <span class="ml-2">Novo patrocinador</span>
                    </div>
                </a>
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
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Visivel</th>
                            <th>Posição</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patrocinadores as $patrocinador)
                            <tr>
                                <td style="width: 120px; vertical-align: middle"><img src="{{ asset($patrocinador->lk_foto) }}" class="img-fluid" width="120" /></td>
                                <td style="vertical-align: middle">{{ $patrocinador->nm_patrocinador }}</td>
                                <td style="vertical-align: middle">
                                    @if($patrocinador->fl_visivel == 1)
                                        <span class="badge badge-success">Visivel</span>
                                    @endif
                                    @if($patrocinador->fl_visivel == 0)
                                        <span class="badge badge-secondary">Invisivel</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle">{{ $patrocinador->posicao.' ª' }}</td>
                                <td style="vertical-align: middle">
                                    <a href="{{ route('patrocinadores.edit', $patrocinador->id) }}" class="btn btn-outline-secondary d-flex justify-content-center"><span class="material-icons">edit</span></a>
                                </td>
                                <td style="vertical-align: middle">
                                    <a href="{{ route('patrocinadores.show', $patrocinador->id) }}" class="btn btn-outline-secondary d-flex justify-content-center"><span class="material-icons">delete</span></a></td>
                                </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Nenhum patrocinador encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($patrocinadores->total() > 15)
            <div class="card-footer d-flex justify-content-center align-items-center">
                {{ $patrocinadores->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
