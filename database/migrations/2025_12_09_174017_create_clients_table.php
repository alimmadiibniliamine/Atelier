<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // id int auto-incrément
            $table->string('nom');        // nom varchar
            $table->string('prenom');     // prenom varchar
            $table->string('telephone');  // telephone varchar
            $table->string('email')->nullable();      // email optionnel
            $table->string('entreprise'); // société du client
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
