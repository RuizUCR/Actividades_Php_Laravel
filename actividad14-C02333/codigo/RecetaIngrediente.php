<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecetaIngrediente extends Pivot
{
    protected $table = 'receta_ingrediente';

    protected $casts = [
        'cantidad' => 'decimal:2',
    ];
}
