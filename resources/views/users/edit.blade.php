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

        </form>
    </div>
</body>
</html>
