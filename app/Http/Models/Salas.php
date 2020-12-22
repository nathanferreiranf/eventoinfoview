<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salas extends Model
{
    use SoftDeletes;
    
    protected $table = 'salas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_sala',
        'slug_sala',
        'thumb_sala',
        'lk_sala',
        'lk_chat',
        'lk_perguntas',
        'descricao',
        'dt_inicio',
        'dt_fim',
        'fl_visivel',
        'fl_principal'
    ];
    
    protected $dates = ['dt_inicio', 'dt_fim', 'created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
}
