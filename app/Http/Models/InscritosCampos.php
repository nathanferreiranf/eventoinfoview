<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InscritosCampos extends Model
{
    use SoftDeletes;

    protected $table = 'inscritos_campos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_user',
        'campo',
        'conteudo'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public $incrementing = false;
}
