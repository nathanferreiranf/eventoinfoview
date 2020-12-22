@extends('layouts.site')

@section('content')
<div class="container-fluid p-0">
    <section id="section-video">
        <div id="video-sala">{!! $sala->lk_sala !!}</div>
        
        <div id="video-infos">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold m-0">{{ $sala->nm_sala }}</h5>
                <duration-component dt_inicio="{{ $sala->dt_inicio }}" dt_fim="{{ $sala->dt_fim }}" />
            </div>
        </div>

        <div id="video-description">
            {!! $sala->descricao !!}
        </div>
            
        <div id="video-tabs">
            <ul class="nav nav-tabs nav-tabs-sala justify-content-around border-0 mb-3" id="myTab" role="tablist">
                @if($sala->lk_chat != null && $sala->lk_chat != '')
                    <li class="nav-item">
                        <a class="nav-link" id="chat-tab" data-toggle="tab" href="#chat" role="tab" aria-controls="chat" aria-selected="true"><span class="material-icons">chat</span></a>
                    </li>
                @endif
                @if($sala->lk_perguntas != null && $sala->lk_perguntas != '')
                    <li class="nav-item">
                        <a class="nav-link" id="perguntas-tab" data-toggle="tab" href="#perguntas" role="tab" aria-controls="perguntas" aria-selected="false"><span class="material-icons">help</span></a>
                    </li>
                @endif
                @if(count($arquivos) >= 1)
                    <li class="nav-item">
                        <a class="nav-link" id="arquivos-tab" data-toggle="tab" href="#arquivos" role="tab" aria-controls="arquivos" aria-selected="false"><span class="material-icons">folder</span></a>
                    </li>
                @endif
            </ul>
            <div class="tab-content tab-content-sala" id="myTabContent">
                @if($sala->lk_chat != null && $sala->lk_chat != '')
                    <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="chat-tab">
                        {!! $sala->lk_chat !!}
                    </div>
                @endif
                @if($sala->lk_perguntas != null && $sala->lk_perguntas != '')
                    <div class="tab-pane fade" id="perguntas" role="tabpanel" aria-labelledby="perguntas-tab">
                        {!! $sala->lk_perguntas !!}
                    </div>
                @endif
                @if(count($arquivos) >= 1)
                    <div class="tab-pane fade" id="arquivos" role="tabpanel" aria-labelledby="arquivos-tab">
                        <div class="form-row">
                            @forelse ($arquivos as $arquivo)    
                                <div class="col-12">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons mr-3">insert_drive_file</span>
                                                <span>{{ explode('/',$arquivo->lk_arquivo)[1] }}</span>
                                            </div>
                                            <a href="{{ asset($arquivo->lk_arquivo) }}" class="btn d-flex btn-sm" download><span class="material-icons">get_app</span></a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window.onload = function(){
            var tabs = document.getElementById('myTab').children[0];
            tabs.getElementsByClassName('nav-link')[0].classList.add('active');

            var tabsContent = document.getElementById('myTabContent').children[0];
            tabsContent.classList.add('show', 'active');
        }
    </script>    
@endsection
