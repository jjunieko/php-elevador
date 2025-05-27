<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentoElevador extends Model
{
    protected $fillable = ['acao', 'andar'];

    protected $table = 'movimentos_elevador';
}
