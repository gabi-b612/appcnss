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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('denomination')->unique();
            $table->string('adresse');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('forme_juridique', ['S.A.R.L.', 'S.A.', 'A.S.B.L.', 'ETS.']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
