<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>Voici tout les utilisateurs ici present :</h1>

            <ul>

                @foreach($users as $user)
                    <li>Nom: {{ $user->name }}</li>
                    <li>Prenom: {{ $user-> prenom }}</li>
                    <li>Email: {{ $user->email }}</li>
                @endforeach


            </ul>
</body>
</html>
