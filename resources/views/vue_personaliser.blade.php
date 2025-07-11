<!DOCTYPE html>
<html>
<head>
    <title>Page de {{ $nom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Salut {{ $nom }} ! 👋</h1>
        <p>{{ $message }}</p>
        <p>Nous sommes en {{ $annee }}</p>
    </div>
</body>
</html>
