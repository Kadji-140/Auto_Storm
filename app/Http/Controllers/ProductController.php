<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // public function index(){
    //     $products = [
    //         ['id' => 1, "nom" => "Laptop", "prix" => 3000],
    //         ['id' => 2, "nom" => "Modem", "prix" => 1000],
    //         ['id' => 3, "nom" => "WIFI", "prix" => 2000]
    //     ];

    //     return view('products.index',['products' =>$products]);
    // }

    // public function show($id){
    //     $products = [
    //         1 => ['id' => 1, "nom" => "Laptop", "prix" => 3000],
    //         2=> ['id' => 2, "nom" => "Modem", "prix" => 1000],
    //         3=> ['id' => 3, "nom" => "WIFI", "prix" => 2000]
    //     ];
    //     $product = $products[$id] ?? nulla;

    //     if (!$product) {
    //         abort(404); // Page non trouvée
    //     }

    //     return view('products.show', ['product' => $product]);
    // }

    // Il s'agit ici de tout les produit
    // Afficher tous les produits

    //Ici c'est la methode de lecture des données

    public function index()
    {
        // Eloquent : récupère tous les produits de la base
        $products = Product::all();
        // la methode compact permet de passer des variables à la vue

        return view('products.index', [
            'products'=>$products
        ]);
    }

    //La methode pour afficher un formulaire de creation de produit
    public function create(){
        return view('bienvenue');
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
        return redirect()->route('products.index')
                            ->with('sucess', 'Produit sauvegarder avec success');
    }

    public function show($id)
    {
        // Eloquent : trouve un produit par ID
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Produit non trouvé');
        }

        return view('products.show2', [
            'product' => $product
        ]);
    }
    // La methode pour afficher le formulaire de modificartion du produit
    // public function edit2($id){
    //     $product = Product::find($id);
    //     return view('products.edit', compact('product'));
    // }

    public function edit(Product $product){
        return view ('products.edit', compact('product'));
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
            return redirect()->route('products.index')
                                ->with('success', 'Modification effectuer avec succes !');
        }


    // La methode permetant de suprimer un produit
        public function destroy(Product $product){
            $product->delete();
            return redirect()->route('products.index')
                                ->with('success', 'Produit supprimer avec succes !');

        }

// -----------------------------------------------------------------------------

        public function index2(){
            $product2= Product::all();
            return view('products.index', compact('product2'));
           // return view('products.i', compact('product2'));
        }

        // formulaire de creation
        public function create2(){
            return view('products.create');
        }

        // logique de creation d'un produit
        public function store2(Request $request2){
            // Verifion la validation des donnee
            $request2->validate([
                'name'=>'required|string|max:255',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'stock'=>'required|numeric|min:0'
            ]);
            // enregistrement

            Product::create([
                'name'=> $request2->name,
                'description'=>$request2->description,
                'price'=>$request2->price,
                'stock'=>$request2->stock
            ]);

            return redirect()->route('products.create')
                                ->with('success','Produit enregistrer avec avec sucess !');
        }

        //voir les details d'un produit
        public function show2($id){
            $product2= Product::find($id);
            Product::create(['name'=>'Iphone']);
            return view('products.show', compact('product2'));
        }

        // update des produits
            // renvoie vers la vue du formulaire
        public function edit2($id){
            $product2= Product::find($id);
            return view('products.edit',compact('product2'));
        }
            // la logique de modification
        public function update2(Request $request2, Product $product2){
            // Verification prealable sur les donnee
            $request2->validate([
                'name'=>'required|string|max',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'stock'=>'required|numeric|min:0'
            ]);

            return redirect()->route('products.edit')
                                ->with('sucess','Modification effectuer avec success !');
        }

        //Supprimer un produit
        public function delete2($id){
            $product2= Product::find($id);
            $product2->delete();
            return redirect()->route('products')
                                ->with('success','Produit supprimer avec succes !');
        }


        public function azerty(){
            return view('products.cree');
        }



}
