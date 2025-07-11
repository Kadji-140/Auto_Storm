<!DOCTYPE html>
<html>
<head>
    <title>{{ $product['name'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-detail {
            border: 2px solid #3498db;
            border-radius: 15px;
            padding: 30px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .product-title {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 15px;
        }
        .product-price {
            color: #27ae60;
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
        }
        .product-description {
            font-size: 18px;
            line-height: 1.6;
            color: #34495e;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="product-detail">
        <h1 class="product-title">{{ $product->name}}</h1>
        <p class="product-description">{{ $product->description }}</p>
        <p class="product-price">Prix: {{ $product->price }}€</p>
        <p class="product-stock">Stock: {{ $product->stock }}</p>
        <p class="product-createAt">Creer le: {{ $product->created_at->format('d-m-Y') }}</p>
        <p class="product-update_at">Derniere modification: {{ $product->updated_at->format('d/m/Y') }}</p>
        <p><strong>ID:</strong> {{ $product->id }}</p>
    </div>
    
    <a href="/products" class="back-link">← Retour au catalogue</a>
</body>
</html>
