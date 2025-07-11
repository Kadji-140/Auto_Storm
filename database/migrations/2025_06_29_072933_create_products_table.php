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
        Schema::create('products', function (Blueprint $table) {
            $table->id();                           // Colonne ID (clé primaire)
            $table->string('name');                 // Nom du produit (VARCHAR)
            $table->text('description');            // Description (TEXT)
            $table->decimal('price', 8, 2);         // Prix (8 chiffres, 2 décimales)
            $table->integer('stock')->default(0);   // Stock avec valeur par défaut
            $table->boolean('is_active')->default(true); // Produit actif ou non
            // $table->text('commentaire');
            // $table->string('prenom',200);
            // $table->enum('role',['admin','user']);
            $table->timestamps();                   // created_at, updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
