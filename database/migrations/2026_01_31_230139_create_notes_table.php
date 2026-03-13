<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade');
            $table->decimal('note', 5, 2);
            $table->string('session');
            $table->year('annee_academique');
            $table->timestamps();
            
            $table->unique(['etudiant_id', 'matiere_id', 'session', 'annee_academique']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
