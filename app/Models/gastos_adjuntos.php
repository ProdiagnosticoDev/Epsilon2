<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gastos_adjuntos extends Model
{
    protected $table = 'rg_adjuntos';

     public $incrementing = false; //No tenga auto_increment

    protected $fillable = [
        'id',
        'adjunto',
        'fecha',
        'currentuser'
    ];
}
