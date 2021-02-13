<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoCorporativo extends Model
{
    use SoftDeletes;
    protected $table = 'documentos_corporativos';
    public $timestamps = true;
    public $fillable = [
        'corporativos_id',
        'documentos_id',
        'S_ArchivoUel',
    ];
}
