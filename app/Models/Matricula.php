<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Matricula extends Pivot
{
    protected $table = 'matriculas';

    protected $casts = [
        'fecha' => 'date',
        'nota_final' => 'decimal:2',
    ];
}
