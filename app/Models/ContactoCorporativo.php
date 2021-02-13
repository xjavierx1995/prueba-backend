<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoCorporativo extends Model
{
    protected $table = 'contactos_corporativos';
    public $timestamps = false;
    public $fillable = [
        'S_Nombre',
        'S_Puesto',
        'S_Comentarios',
        'N_TelefonoFijo',
        'N_TelefonoMovil',
        'S_Email',
        'corporativos_id',
    ];
}
