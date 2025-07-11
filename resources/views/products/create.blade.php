<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un produit</title>
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
        }
        .btn:hover {
            background-color: #2980b9;
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
    </style>
</head>
<body>
    <h1>🆕 Ajouter un nouveau produit</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Erreurs :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf {{-- Protection CSRF obligatoire --}}

        <div class="form-group">
            <label for="name">Nom du produit :</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Prix (FCFA) :</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stock :</label>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>
            @error('stock')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="checkbox-group">
                <input type="checkbox" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                <label for="is_active">Produit actif</label>
            </div>
        </div>

        <button type="submit" class="btn">Créer le produit</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
