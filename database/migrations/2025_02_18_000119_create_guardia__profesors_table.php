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
        Schema::create('guardia__profesors', function (Blueprint $table) {
            $table->foreignId('id_guardia')->constrained('guardias')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->boolean('cubrio_guardia')->default(false);
            $table->timestamps();
            $table->primary(['id_guardia', 'id_user']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardia__profesors');
    }
};
