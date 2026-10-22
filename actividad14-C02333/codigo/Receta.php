<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Receta extends Model
{
    protected $fillable = ['titulo', 'porciones', 'instrucciones'];

    public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(Ingrediente::class, 'receta_ingrediente')
            ->using(RecetaIngrediente::class)
            ->withPivot('cantidad', 'unidad');
    }
}
