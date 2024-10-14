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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travailleur_id');
            $table->unsignedBigInteger('declaration_id'); // Nouvelle colonne pour lier à la déclaration
            $table->float('montant_cotiser');
            $table->float('montant_brut');
            $table->string('periode');
            $table->timestamps();

            // Définir les clés étrangères
            $table->foreign('travailleur_id')->references('id')->on('travailleurs')->onDelete('cascade');
            $table->foreign('declaration_id')->references('id')->on('declarations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
