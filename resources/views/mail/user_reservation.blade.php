<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
</head>
<body>
    <p>Bonjour {{ $userName }},</p>

    <p>Votre réservation pour le carrousel "{{ $carouselName }}" a été enregistrée avec succès.</p>

    <p>Début de la réservation : {{ $debut_date }}</p>
    <p>Fin de la réservation : {{ $fin_date }}</p>

    <p>Merci de votre confiance.</p>
    <p>Vous serez prochainement contacté par notre équipe pour la validation de votre réservation</p>
    <p>Cordialement,</p>
    <p>Votre équipe de réservation</p>
</body>
</html>
