<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class NullController extends Controller
{
    public function index()
    {
        // Eloquent : récupère tous les produits de la base
        $products = Product::all();
        // la methode compact permet de passer des variables à la vue

        return view('nulla.index', [
            'products'=>$products
        ]);
    }

    //La methode pour afficher un formulaire de creation de produit
    public function create(){
        return view('nulla.create');
    }
    // $request est
    // La methode pour enregistrer le produit creer du formulaire
    // public function store(Request $request){
    //     // Validation des donnee du formulaire
    //     $request -> validate([
    //         'name'=>'required|string|max:255',
    //         'price'=>'required|numeric|min: 0',
    //         'description'=>'required|string',
    //         'stock'=>'required|numeric|min:0'
    //     ]);

    //     // creation du produit
    //     Product::create([
    //         'name'=> $request->name,
    //         'description'=>$request->description,
    //         'price'=>$request->price,
    //         'stock'=>$request->stock
    //     ]);
    //     // ici la methode redirecct permet de rediriger vers une autre page. et route permet de rediriger vers une route.
    //     // c'est pour eviter les probleme de securite et with sert a envoyer des messages de succes ou d'erreur

    //     return redirect()->route('products.index')
    //                         ->with('sucess','Produit enregistrer avec succes !');
    // }

    // La methode plus haut fonctionne correctement juste que j'ai
    // creer un fichier StoreProductRequest.php qui possede maintenant les regles de validation

    public function store(StoreProductRequest $request){
        Product::create($request->validated());
        return redirect()->route('nulla.index')
            ->with('sucess', 'Produit sauvegarder avec success');
    }

    public function show($id)
    {
        // Eloquent : trouve un produit par ID
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Produit non trouvé');
        }

        return view('nulla.show2', [
            'product' => $product
        ]);
    }
    // La methode pour afficher le formulaire de modificartion du produit
    // public function edit2($id){
    //     $product = Product::find($id);
    //     return view('products.edit', compact('product'));
    // }

    public function edit(Product $product){
        return view ('nulla.edit', compact('product'));
    }

    // La methode pour enregistrer la modifiction du produit
    // public function update(Request $request, Product $product){
    //     // Commençons par valider les donnees
    //     // $request->validate([
    //     //     'name'=> 'required|string|max:255',
    //     //     'description'=>'required|string',
    //     //     'price'=>'required|numeric|min:0',
    //     //     'stock'=>'required|numeric|min:0'
    //     // ]);
    //     // // j'effectue la modification
    //     // $product->update([
    //     //     'name'=>$request->name,
    //     //     'description'=>$request->description,
    //     //     'price'=>$request->price,
    //     //     'stock'=>$request->stock
    //     // ]);




    //     return redirect()->route('products.index')
    //                         ->with('success', 'Modification effectuer avec success !');

    // }

    // LA TECHNIQUE UTILISER PLUS HAUT EST VALIDE mais voici une technique plus propre
    // qui va rendre le controler encore plus propre
    // public function update(UpdateProductRequest $request, Product $product){
    //     $product->update($request->validate());

    //         return redirect()->route('product.index')
    //                             ->with('success', 'Modification effecter avec succes !');
    // }
    public function update(UpdateProductRequest $request, Product $product){
        $product->update($request->validated());
        return redirect()->route('nulla.index')
            ->with('success', 'Modification effectuer avec succes !');
    }


    // La methode permetant de suprimer un produit
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('nulla.index')
            ->with('success', 'Produit supprimer avec succes !');

    }

}
