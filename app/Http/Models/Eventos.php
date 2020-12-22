<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eventos extends Model
{
    use SoftDeletes;

    protected $table = 'eventos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nm_evento',
        'slug_evento',
        'lk_banner',
        'lk_banner_auth',
        'descricao',
        'dt_inicio',
        'dt_fim'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public $incrementing = false;
}
