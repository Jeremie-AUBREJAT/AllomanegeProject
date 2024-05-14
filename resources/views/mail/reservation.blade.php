<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle réservation effectuée</title>
</head>
<body>
    <h2>Nouvelle réservation effectuée</h2>
    <p>Une nouvelle réservation a été effectuée :</p>
    <ul>
        <li><strong>Date de début :</strong> {{ $debut_date }}</li>
        <li><strong>Date de fin :</strong> {{ $fin_date }}</li>
        <li><strong>Nom du Manège :</strong> {{ $carouselName }}</li>
        <li><strong>Nom de l'utilisateur :</strong> {{ $userName }}</li>
    </ul>
    <p>Merci !</p>
</body>
</html>