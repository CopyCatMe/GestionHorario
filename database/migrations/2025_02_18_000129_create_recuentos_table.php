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
        Schema::create('recuentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guardia')->nullable()->constrained('guardias')->cascadeOnDelete();
            $table->foreignId('id_user')->nullable()->constrained('users')->cascadeOnDelete();
            $table->integer('guardias_cubiertas')->default(0);
            $table->integer('ingresos_convivencia')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recuentos');
    }
};
