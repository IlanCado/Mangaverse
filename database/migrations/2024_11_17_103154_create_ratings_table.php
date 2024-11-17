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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id(); // ID unique auto-incrémenté pour chaque évaluation
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers users
            $table->foreignId('manga_id')->constrained()->onDelete('cascade'); // Clé étrangère vers mangas
            $table->float('rating_value', 2)->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
