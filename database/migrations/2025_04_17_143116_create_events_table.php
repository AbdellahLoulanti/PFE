<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('title'); // Titre de l'événement
            $table->text('description')->nullable(); // Description détaillée
            $table->string('location')->nullable(); // Lieu de l'événement
            $table->dateTime('start_date'); // Date et heure de début
            $table->dateTime('end_date')->nullable(); // Date et heure de fin
            $table->enum('visibility', ['public', 'private'])->default('public'); // Visibilité de l'événement
            $table->string('cover_image')->nullable(); // Image de couverture
            $table->json('tags')->nullable(); // Tags associés à l'événement
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
