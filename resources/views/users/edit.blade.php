<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>Page d'edition</h1>
    <div class="container">
        <form action="{{ route('users.update') }}" method="post">
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" required>
            </div>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="prenom">prenom</label>
                <input type="text" name="prenom" required>
            </div>
            @error('prenom')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="email">Nom</label>
                <input type="text" name="email" required>
            </div>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <input type="submit" value="Modifier">
        </form>
    </div>
</body>
</html>
