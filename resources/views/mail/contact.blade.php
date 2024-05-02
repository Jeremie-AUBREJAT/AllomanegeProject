<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Message du formulaire de contact</title>
</head>
<body>
    <h1>Vous avez reçu un nouveau message</h1>
    <p><strong>Nom :</strong> {{ $nom }}</p>
    <p><strong>Prénom :</strong> {{ $prenom }}</p>
    <p><strong>Email :</strong> {{ $email }}</p>
    <p><strong>Message :</strong> {{ $userMessage }}</p>
</body>
</html>
