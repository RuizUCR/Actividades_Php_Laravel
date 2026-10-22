<?php

use App\Models\Ingrediente;
use App\Models\Receta;

it('instancia una receta con dos ingredientes, cantidad y unidad', function () {
    $receta = Receta::create([
        'titulo' => 'Panqueques',
        'porciones' => 4,
        'instrucciones' => 'Mezclar todo y cocinar en sartén.',
    ]);

    $harina = Ingrediente::create(['nombre' => 'Harina']);
    $leche = Ingrediente::create(['nombre' => 'Leche']);

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
