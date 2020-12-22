<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planos extends Model
{
    use SoftDeletes;

    protected $table = 'planos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_plano',
        'slug_plano',
        'layout',
        'acesso_salas',
        'vl_plano',
        'fl_visivel',
        'dt_validade'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
}
