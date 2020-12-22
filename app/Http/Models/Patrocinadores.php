<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrocinadores extends Model
{
    use SoftDeletes;

    protected $table = 'patrocinadores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_evento',
        'nm_patrocinador',
        'slug_patrocinador',
        'lk_foto',
        'lk_site',
        'fl_visivel',
        'posicao'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
}
