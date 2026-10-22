<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recetas', function (Blueprint $t) {
            $t->id();
            $t->string('titulo');
            $t->unsignedSmallInteger('porciones');
            $t->text('instrucciones');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
