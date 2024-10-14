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
        Schema::create('immatriculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travailleur_id')->constrained('travailleurs')->onDelete('cascade');
            $table->enum('etat', ['accepter', 'rejeter', 'en attente'])->default('en attente');
            $table->string('numero_immatriculation')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immatriculations');
    }
};
