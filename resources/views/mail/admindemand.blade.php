<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d'inscription</title>
</head>
<body>
    <h1>Bienvenue {{ $userName }}!</h1>
    <p>Merci pour votre inscription sur notre site. Votre compte a été créé avec succès.</p>
    <p>Veuillez cliquer sur le lien suivant pour mettre à jour votre profil : <a href="http://127.0.0.1:8000/users/update/{{$userId}}">Mettre à jour votre profil</a></p>
</body>
</html>
