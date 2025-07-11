<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\ProductController;

use App\Http\Controllers\HelloController;
use App\Models\Category;
use App\Models\Product;

// Route pour afficher tous les produits
// Route::get('/products', [ProductController::class, 'index']);

// Route pour afficher un produit spécifique
// Route::get('/products/{id}', [ProductController::class, 'show']);

// Route::get('/about', [AboutController::class, 'index']);

Route::get('/hello/{nom}', function($nom){
    return "<h3>Bonjour $nom ! </h3>";
});

Route::get('/Hello-controller/{nom}',[HelloController::class, 'sayHello']);

//Route::get('/hello-view',[HelloController::class, 'showView']);
//Route::get('/hello-data',[HelloController::class, 'showViewWithData']);
//Route::get('/helloDataPersonaliser/{nom}',[HelloController::class, 'vuePersonaliser']);
// Route::get('/products',[ProductController::class, 'index']);
// Route::get('/products/{id}', [ProductController::class, 'show']);


// Route::get('/seed-products', function() {
//     // Je vérifie ici si des produits existent déjà
//     if (App\Models\Product::count() > 0) {
//         return "Des produits existent déjà !";
//     }

//     // je crée des produits de test
//     App\Models\Product::create([
//         'name' => 'MacBook Pro',
//         'description' => 'Ordinateur portable Apple haute performance',
//         'price' => 2499.99,
//         'stock' => 10,
//         'is_active' => true
//     ]);

//     App\Models\Product::create([
//         'name' => 'iPhone 15',
//         'description' => 'Smartphone Apple dernière génération',
//         'price' => 999.99,
//         'stock' => 25,
//         'is_active' => true
//     ]);

//     App\Models\Product::create([
//         'name' => 'iPad Air',
//         'description' => 'Tablette Apple légère et puissante',
//         'price' => 649.99,
//         'stock' => 15,
//         'is_active' => true
//     ]);

//     return "Produits créés avec succès !";
// });

// L'utilisation de ses routes si permet de creer toute les routes CRUD
    Route::resource('/products', ProductController::class);
    //Route::resource('/user', ProductController::class);
    Route::resource('/nulla', \App\Http\Controllers\NullController::class);
    Route::get('azerty', function(){
        return view('azerty');
    });
    // Route::get('/cree',[ProductController::class, 'azerty']);

    //Route::get('/azerty', [ProductController::class, 'azerty']);

    Route::resource('/users', UserController::class);



    // Route::get('/products/create',[ProductController::class, 'store2']);

    Route::get('/seed-categories', function(){
        if (App\Models\Category::count()>0){
            return 'Des categories existent deja';
        }

        $categories= [
            [
                'name'=>'Smartphone',
                'description'=>'Vente de smarthphone d\'origine Chinoine'
            ],
            [
                'name'=> 'Equipement electromenager',
                'description'=> 'Il s\'agit ici de  tout genre d\'equipement '
            ],
            [
            'name' => 'Accessoires',
            'description' => 'Accessoires et périphériques'
            ]
        ];

        foreach ($categories as $category){
            Category::create($category);
        }

        return 'Categories enregistrer avec succes !';
    });

    Route::get('/test-relations', function() {
    // Récupérer une catégorie
    $category=Category::first();


    // Assigner des produits à cette catégorie
    $products= Product::take(2)->get();

    foreach($products as $product){
        $product->update(['category_id'=>$category->id]);
    }

    // Tester les relations
    $html = "<h1>Test des Relations</h1>";

    // Produits d'une catégorie
    $html .= "<h2>Produits de la catégorie '{$category->name}':</h2>";
    foreach ($category->products as $product) {
        $html .= "<p>- {$product->name}</p>";
    }

    // Catégorie d'un produit
    $product = App\Models\Product::with('category')->first();
    $html .= "<h2>Catégorie du produit '{$product->name}':</h2>";
    $html .= "<p>Catégorie: " . ($product->category ? $product->category->name : 'Aucune') . "</p>";

    return $html;
});

