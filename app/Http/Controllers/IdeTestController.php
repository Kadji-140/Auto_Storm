<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use View;

class IdeTestController extends Controller
{
    public function testAutocompletion()
    {
        // ==========================================
        // TEST 1 : FACADES LARAVEL
        // ==========================================

        // Tape "DB::" et regarde les suggestions
        DB::

        // Tape "Route::" et regarde les suggestions
        //Route::

        // Tape "Auth::" et regarde les suggestions
        //Auth::

        // ==========================================
        // TEST 2 : MODÈLES ELOQUENT
        // ==========================================

        // Tape "Product::" et regarde les suggestions
        //Product::

        // Crée une instance et teste
        $produ = new Product();
        //$product->  // ← Tape le point ici

        // Test des méthodes Eloquent
        //Product::where('name', 'test')->  // ← Suggestions après ->

        // ==========================================
        // TEST 3 : ROUTES (NOTRE NOUVEAU FEATURE)
        // ==========================================

        // Tape route(' et regarde les suggestions
        $url1 = route('products.create');

        // Test avec redirect
        return redirect()->route('products.');

        // ==========================================
        // TEST 4 : HELPERS LARAVEL
        // ==========================================

        // Tape config(' et regarde
        $config = view('hello');

        // Tape view(' et regarde
        $view = view('products.create');

        // ==========================================
        // TEST 5 : NAVIGATION (CTRL+CLIC)
        // ==========================================

        // Ctrl+Clic sur "Product" → doit aller au modèle
        $product =Product::find(4);

        // Ctrl+Clic sur "route" → doit aller à la définition
        return route('produ');

        // Ctrl+Clic sur "view" → doit aller à la vue
        return view('prod');
        return route('user');

            return view('');


    }

}
