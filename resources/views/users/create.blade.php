<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h1>Formulaire de creation d'un utilisateur !</h1>

    <div class="container">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="group-box">
                <label for="name">Nom</label>
                <input type="text" name="name" required>
            </div><div class="group-box">
                <label for="prenom">prenom</label>
                <input type="text" name="prenom" required>
            </div><div class="group-box">
                <label for="email">email</label>
                <input type="text" name="email" required>
            </div><div class="group-box">
                <label for="mot_de_passe">mot_de_passe</label>
                <input type="text" name="password" required>
            </div>

            <input type="submit" value="Enregistrer">

        </form>
    </div>
</body>
</html>
