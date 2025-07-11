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
        if(!Schema::hasColumn('products', 'category_id')){
            Schema::table('products', function (Blueprint $table) {
                $table->foreignId('category_id')
                    ->nullable()
                    ->constrained('categories')// C'est possible de ne pas passer le nom de table mais j'ai juger utile de le mettre pour minimer les risque si d'autre table avait des noms similaire
                    ->onDelete('set null'); // Ici, si la categorie est supprimer le produit reste mais category_id = nulla


            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id'],);
            $table->dropColumn('category_id');
        });
    }
};
