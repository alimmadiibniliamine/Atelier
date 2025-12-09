<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers clients
            $table->foreignId('client_id')
                ->constrained('clients')
                ->onDelete('cascade');

            // Infos de la visite
            $table->string('personne_rencontree');
            $table->string('motif');               // réunion, livraison, etc.
            $table->dateTime('arrivee_at');        // heure/date d'arrivée
            $table->dateTime('depart_at')->nullable(); // heure/date de départ

            // Statut : EN_COURS ou TERMINEE
            $table->enum('statut', ['EN_COURS', 'TERMINEE'])->default('EN_COURS');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
