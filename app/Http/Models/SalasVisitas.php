<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SalasVisitas extends Model
{
    protected $table = 'salas_visitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_user',
        'id_sala'
    ];
    protected $dates = ['created_at', 'updated_at'];
    
    public $incrementing = false;
}
