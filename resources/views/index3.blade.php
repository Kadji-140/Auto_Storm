<!DOCTYPE html>
<html>
<head>
    <title>Liste des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .product { border: 1px solid #ddd; padding: 20px; margin: 10px 0; }
        .product h3 { color: #333; }
        .price { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Liste des Produits</h1>
    
    {{-- Ceci est un commentaire Blade --}}
    
    @foreach($products as $product)
        <div class="product">
            <h3>{{ $product['name'] }}</h3>
            <p class="price">Prix: {{ $product['price'] }}€</p>
            <a href="/products/{{ $product['id'] }}">Voir détails</a>
        </div>
    @endforeach
    
    @if(count($products) == 0)
        <p>Aucun produit disponible.</p>
    @endif
</body>
</html>
