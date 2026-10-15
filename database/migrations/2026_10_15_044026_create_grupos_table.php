<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $t) {
            $t->id();
            $t->foreignId('curso_id')->constrained()->cascadeOnDelete(); // composición
            $t->foreignId('docente_id')->constrained();
            $t->unsignedSmallInteger('numero');
            $t->string('semestre');
            $t->unsignedSmallInteger('cupo');
            $t->timestamps();
            $t->unique(['curso_id', 'numero', 'semestre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
