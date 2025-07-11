<!DOCTYPE html>
<html>
<head>
    <title>Modifier {{ $product->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-warning {
            background-color: #f39c12;
        }
        .btn-warning:hover {
            background-color: #e67e22;
        }
        .btn-secondary {
            background-color: #95a5a6;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .product-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>✏️ Modifier le produit</h1>

    <div class="product-info">
        <p><strong>Produit:</strong> {{ $product->name }}</p>
        <p><strong>Créé le:</strong> {{ $product->created_at->format('d/m/Y à H:i') }}</p>
        <p><strong>Dernière modification:</strong> {{ $product->updated_at->format('d/m/Y à H:i') }}</p>
    </div>

    {{-- Affichage des erreurs de validation --}}
    {{-- @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Erreurs :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <x-form-errors :errors="$errors" />

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT') {{-- Important : spécifier la méthode PUT --}}
        
        <div class="form-group">
            <label for="name">Nom du produit :</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Prix (€) :</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stock :</label>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required>
            @error('stock')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="checkbox-group">
                <input type="checkbox" id="is_active" name="is_active" 
                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <label for="is_active">Produit actif</label>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">💾 Sauvegarder les modifications</button>
        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Annuler</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</body>
</html>
