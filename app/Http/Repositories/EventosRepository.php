<?php namespace App\Http\Repositories;

use App\Http\Models\Eventos;
use Illuminate\Support\Str;
use Cache;

class EventosRepository {
    public function find($dados = null){
        $expiration = 60; //minutos
        $key = 'eventos_';

        $filtros = [];
        
        if(isset($dados['nm_evento'])) array_push($filtros, ['eventos.nm_evento', '=', $dados['nm_evento']]);
        
        return Cache::remember($key, $expiration, function() use ($filtros){
            return Eventos::select(
                'eventos.*'
            )->selectRaw('date_format(eventos.dt_inicio, "%d/%m/%Y %H:%i") as dt_inicio_format')
            ->selectRaw('date_format(eventos.dt_fim, "%d/%m/%Y %H:%i") as dt_fim_format')
            ->selectRaw('date_format(eventos.dt_inicio, "%H:%i") as hora_inicio')
            ->selectRaw('date_format(eventos.dt_fim, "%H:%i") as hora_fim')
            ->where($filtros)->paginate();
        });
    }

    public function show($id)
    {
        return Eventos::select(
            'eventos.*'
        )->selectRaw('date_format(eventos.dt_inicio, "%H:%i") as hora_inicio')
        ->selectRaw('date_format(eventos.dt_fim, "%H:%i") as hora_fim')
        ->where('eventos.id', $id)->first();
    }

    public function create($dados)
    {   
        $dados['id'] = Str::uuid();
        
        if(isset($dados['nm_evento'])) $dados['slug_evento'] = Str::slug($dados['nm_evento'], '-');

        $evento = New Eventos($dados);
        $data = Array(
            'success' => $evento->save(),
            'data' => $evento
        );
        return $data;
    }

    public function update($id, $dados)
    {   
        if(isset($dados['nm_evento'])) $dados['slug_evento'] = Str::slug($dados['nm_evento'], '-');
        
        $evento = Eventos::where('id', $id)->first();
        $data = Array(
            'success' => $evento->update($dados),
            'data' => $evento
        );
        return $data;
    }

    public function delete($id)
    {
        $evento = Eventos::where('id', $id)->first();

        if($evento != null){
            return $evento->delete();
        }

        return false;
    }

}