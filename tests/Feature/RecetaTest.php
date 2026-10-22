<?php

use App\Models\Ingrediente;
use App\Models\Receta;

it('instancia una receta con dos ingredientes, cantidad y unidad', function () {
    // Instanciación de la clase Receta
    $receta = new Receta([
        'titulo' => 'Panqueques',
        'porciones' => 4,
        'instrucciones' => 'Mezclar todo y cocinar en sartén.',
    ]);
    $receta->save();

    $harina = new Ingrediente(['nombre' => 'Harina']);
    $harina->save();
    $leche = new Ingrediente(['nombre' => 'Leche']);
    $leche->save();

    $receta->ingredientes()->attach([
        $harina->id => ['cantidad' => 200, 'unidad' => 'g'],
        $leche->id => ['cantidad' => 300, 'unidad' => 'ml'],
    ]);

    expect($receta->ingredientes)->toHaveCount(2)
        ->and($receta->titulo)->toBe('Panqueques')
        ->and($receta->ingredientes->firstWhere('id', $harina->id)->pivot->unidad)->toBe('g')
        ->and($harina->recetas)->toHaveCount(1);

    $this->assertDatabaseCount('receta_ingrediente', 2);
});
