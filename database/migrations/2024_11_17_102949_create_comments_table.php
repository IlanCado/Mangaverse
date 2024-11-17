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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('manga_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table mangas
            $table->string('content', 300); 
            $table->integer('likes')->default(0); // Nombre de likes, initialisé à 0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
