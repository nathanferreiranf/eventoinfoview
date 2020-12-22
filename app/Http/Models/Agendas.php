<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendas extends Model
{
    use SoftDeletes;

    protected $table = 'agendas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_agenda',
        'slug_agenda',
        'descricao',
        'fl_visivel',
        'dt_inicio'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
}
