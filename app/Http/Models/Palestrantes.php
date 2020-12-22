<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Palestrantes extends Model
{
    use SoftDeletes;

    protected $table = 'palestrantes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_palestrante',
        'slug_palestrante',
        'ocupacao',
        'descricao',
        'lk_thumb',
        'fl_visivel',
        'fl_principal',
        'posicao'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
}
