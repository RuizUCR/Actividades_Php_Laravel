<?php

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Estudiante;

it('crea un grupo con dos estudiantes matriculados', function () {
    $docente = Docente::create(['nombre' => 'Ana Mora']);
    $curso = Curso::create(['codigo' => 'IF-1000', 'nombre' => 'Programación I']);

    $grupo = $curso->grupos()->create([
        'docente_id' => $docente->id,
        'numero' => 1,
        'semestre' => '2026-II',
        'cupo' => 30,
    ]);

    $luis = Estudiante::create(['nombre' => 'Luis Pérez']);
    $maria = Estudiante::create(['nombre' => 'María Rojas']);

    $grupo->estudiantes()->attach([
        $luis->id => ['fecha' => '2026-08-03', 'nota_final' => 85.5],
        $maria->id => ['fecha' => '2026-08-04', 'nota_final' => null],
    ]);

    expect($grupo->estudiantes)->toHaveCount(2)
        ->and($grupo->curso->codigo)->toBe('IF-1000')
        ->and($grupo->docente->nombre)->toBe('Ana Mora')
        ->and($luis->grupos)->toHaveCount(1);

    $this->assertDatabaseCount('matriculas', 2);
});

it('elimina los grupos cuando se elimina el curso', function () {
    $docente = Docente::create(['nombre' => 'Ana Mora']);
    $curso = Curso::create(['codigo' => 'IF-1000', 'nombre' => 'Programación I']);
    $curso->grupos()->create([
        'docente_id' => $docente->id, 'numero' => 1, 'semestre' => '2026-II', 'cupo' => 30,
    ]);

    $curso->delete();

    $this->assertDatabaseCount('grupos', 0);
});
