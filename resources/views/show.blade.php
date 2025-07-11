<!DOCTYPE html>
<html>
<head>
    <title>{{ $product['name'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .product-detail { border: 2px solid #333; padding: 30px; }
        .price { color: green; font-size: 24px; font-weight: bold; }
        .back-link { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="product-detail">
        <h1>{{ $product['name'] }}</h1>
        <p class="price">Prix: {{ $product['price'] }}€</p>
        <p>ID du produit: {{ $product['id'] }}</p>
    </div>
    
    <div class="back-link">
        <a href="/products">← Retour à la liste</a>
    </div>
</body>
</html>
