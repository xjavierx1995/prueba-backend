<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporativo extends Model
{
    use SoftDeletes;
    protected $table = 'corporativos';
    public $timestamps = true;
    public $fillable = [
        'S_NombreCorto',
        'S_NombreCompleto',
        'S_LogoURL',
        'S_DBName',
        'S_DBUsuario',
        'S_DBPassword',
        'S_SystemUrl',
        'S_Activo',
        'D_FechaIncorporacion',
    ];
}
