<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
        <h1>Details sur Utilisateurs</h1>

        <ul>
            <li>Nom: {{ $user->name }}</li>
            <li>prenom: {{ $user->prenom }}</li>
            <li>email: {{ $user->email }}</li>
            <li>password: {{ $user->password }}</li>
            <a href="{{ route('users.index') }}">Index</a>
        </ul>
</body>
</html>
