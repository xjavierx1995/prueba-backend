<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    public $timestamps = false;
    public $fillable = [
        'S_nombre',
        'N_obligatorio',
        'S_Descripcion'
    ];
}
