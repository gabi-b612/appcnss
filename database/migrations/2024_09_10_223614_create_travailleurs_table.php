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
        Schema::create('travailleurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->string('matricule')->nullable()->unique();
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->enum('genre', ['M', 'F']);
            $table->string('lieu_naissance');
            $table->date('date_naissance');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->date('date_embauche');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travailleurs');
    }
};
