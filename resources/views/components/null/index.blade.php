{{-- <!DOCTYPE html>
<html>
<head>
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            background-color: #f9f9f9;
        }
        .product-name {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product-price {
            color: #27ae60;
            font-size: 20px;
            font-weight: bold;
        }
        .product-link {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
        .product-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>🛍️ Notre Catalogue</h1>
    
    @foreach($products as $product)
        <div class="product-card">
            <h2 class="product-name">{{ $product->name}}</h2>
            <p>{{ $product->description }}</p>
            <p class="product-price">{{ $product->price}}€</p>
            <p class="product-stock">{{ $product->stock}}</p>
            <a href="/products/{{ $product->id }}" class="product-link">
                Voir les détails →
            </a>
        </div>
    @endforeach
    
    @if(count($products) == 0)
        <p>Aucun produit disponible pour le moment.</p>
    @endif
</body>
</html> --}}


<!DOCTYPE html>
<html>
<head>
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-success {
            background-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #229954;
        }
        .btn-warning {
            background-color: #f39c12;
        }
        .btn-warning:hover {
            background-color: #e67e22;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            background-color: #f9f9f9;
        }
        .product-actions {
            margin-top: 15px;
        }
        .product-actions a, .product-actions button {
            margin-right: 10px;
            margin-bottom: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .delete-form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🛍️ Gestion des Produits</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">➕ Ajouter un produit</a>
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($products->count() > 0)
        @foreach($products as $product)
            <div class="product-card">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p><strong>Prix:</strong> {{ $product->price }}€</p>
                <p><strong>Stock:</strong> {{ $product->stock }} unités</p>
                <p><strong>Statut:</strong> 
                    @if($product->is_active)
                        <span style="color: green;">✅ Actif</span>
                    @else
                        <span style="color: red;">❌ Inactif</span>
                    @endif
                </p>
                <p><strong>Créé le:</strong> {{ $product->created_at->format('d/m/Y à H:i') }}</p>
                
                <div class="product-actions">
                    <a href="{{ route('products.show', $product) }}" class="btn">👁️ Voir</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">✏️ Modifier</a>
                    
                    <form method="POST" action="{{ route('products.destroy', $product) }}" class="delete-form" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="product-card">
            <p>Aucun produit disponible pour le moment.</p>
            <a href="{{ route('products.create') }}" class="btn btn-success">Créer le premier produit</a>
        </div>
    @endif
</body>
</html>
