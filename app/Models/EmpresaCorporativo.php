<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaCorporativo extends Model
{
    use SoftDeletes;
    protected $table = 'empresas_corporativos';
    public $timestamps = true;
    public $fillable = [
        'S_RazonSocial',
        'S_RFC',
        'S_Pais',
        'S_Estado',
        'S_Municipio',
        'S_ColoniaLocalidad',
        'S_Domicilio',
        'S_CodigoPostal',
        'S_UsoCFDI',
        'S_UrlRFC',
        'S_UrlActaConstitutiva',
        'S_Activo',
        'S_Comentarios',
        'corporativos_id',
    ];
}
