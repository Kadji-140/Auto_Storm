<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

// Pour l'instant, on simule des données
    // public static function getAllProducts()
    // {
    //     return [
    //         ['id' => 1, 'name' => 'Laptop', 'price' => 1000, 'description' => 'Ordinateur portable puissant'],
    //         ['id' => 2, 'name' => 'Smartphone', 'price' => 500, 'description' => 'Téléphone dernière génération'],
    //         ['id' => 3, 'name' => 'Tablet', 'price' => 300, 'description' => 'Tablette tactile légère'],
    //     ];
    // }

    // public static function findProduct($id)
    // {
    //     $products = self::getAllProducts();

    //     foreach ($products as $product) {
    //         if ($product['id'] == $id) {
    //             return $product;
    //         }
    //     }

    //     return nulla; // Produit non trouvé
// }
    // $fillable est un tableau qui contient les noms des colonnes de la table qui peuvent être remplies en masse.
    // il permet de n'autriser des donnee que ceux de la table
    // protéger contre l'injection SQL
        // il y'au aussi d'autre methode laravel pour proteger contre l'injection SQL tel que guarded (pour les données non autorisées)

    protected $fillable= [
        'name',
        'price',
        'description',
        'stock',
        'is_active',
        'category_id'
    ];

    protected $casts=[
        'price'=>'decimal:2',
        'is_active'=>'boolean'
    ];
    // Relation: un ptoduit appartient a une seul categorie
    public function category(){
        $this-> belongsTo(Category::class);
    }

    // Scope: Poduits actifs seulement
    public function scopeActive($query){
        return $query->where('is_active',true);
    }
    // Scope: Produit en stock
    public function ScopeInStock($query){
        return $query->where('stock','>',0);
    }

}
