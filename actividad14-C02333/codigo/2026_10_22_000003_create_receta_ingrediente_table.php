<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receta_ingrediente', function (Blueprint $t) {
            $t->foreignId('receta_id')->constrained('recetas')->cascadeOnDelete();
            $t->foreignId('ingrediente_id')->constrained('ingredientes')->cascadeOnDelete();
            $t->decimal('cantidad', 8, 2);
            $t->string('unidad');
            $t->primary(['receta_id', 'ingrediente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receta_ingrediente');
    }
};
