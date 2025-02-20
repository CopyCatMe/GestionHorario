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
        Schema::create('horario__guardias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_horario')->constrained('horarios')->onDelete('cascade');
            $table->foreignId('id_guardia')->constrained('guardias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario__guardias');
    }
};
