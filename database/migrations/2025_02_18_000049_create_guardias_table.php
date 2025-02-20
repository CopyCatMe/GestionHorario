<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guardias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_horario')->constrained('horarios')->cascadeOnDelete();
            $table->foreignId('id_aula')->constrained('aulas')->cascadeOnDelete();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardias');
    }
};
