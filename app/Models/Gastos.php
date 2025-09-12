<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = 'registro_gastos';

     

    protected $fillable = [
        'documento',
        'fecha',
        'tipo_gasto',
        'importe',
        'tipo_moneda',
        'descripcion',
        'currentuser'
    ];


    
}
