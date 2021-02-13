<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoCorporativo extends Model
{
    protected $table = 'contratos_corporativos';
    public $timestamps = false;
    public $fillable = [
        'D_FechaInicio',
        'D_FechaFin',
        'S_URLContrato',
        'corporativos_id',
    ];
}
