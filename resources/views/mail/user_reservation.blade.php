<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
</head>
<body>
    <div class="logo">
        <img src="cid:logo.jpg" alt="Logo du site" style="width: 10%; height: auto;">
        <h1 style="color: #353858; font-weight: bold;">Allomanège</h1>
    </div>
    <p style="color: #353858; font-weight: bold;">Bonjour {{ $userName }},</p>

    <p style="color: #353858; font-weight: bold;">Votre réservation pour le carrousel "{{ $carouselName }}" a été enregistrée avec succès.</p>

    <p style="color: #353858; font-weight: bold;">Début de la réservation : {{ $debut_date }}</p>
    <p style="color: #353858; font-weight: bold;">Fin de la réservation : {{ $fin_date }}</p>

    <p style="color: #353858; font-weight: bold;">Merci de votre confiance.</p>
    <p style="color: #353858; font-weight: bold;">Vous serez prochainement contacté par notre équipe pour la validation de votre réservation</p>
    <p style="color: #353858; font-weight: bold;">Cordialement,</p>
    <p style="color: #353858; font-weight: bold;">Votre équipe de réservation</p>
</body>
</html>
