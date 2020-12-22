<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SalasArquivos extends Model
{   
    protected $table = 'salas_arquivos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_sala',
        'lk_arquivo'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    public $incrementing = false;
}
