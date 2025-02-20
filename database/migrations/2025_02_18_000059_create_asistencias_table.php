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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->date('fecha');
            $table->integer('hora');
            $table->boolean('presente')->default(true);

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['id_user', 'fecha', 'hora']); // Permite múltiples registros por día, pero solo uno por hora
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
