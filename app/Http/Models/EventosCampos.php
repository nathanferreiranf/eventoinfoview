<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventosCampos extends Model
{
    use SoftDeletes;

    protected $table = 'eventos_campos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_campo',
        'slug_campo',
        'fl_obrigatorio'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public $incrementing = false;
}
