<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de demande Admin</title>
    <style>
        /* Styles pour le titre */
        .title {
            font-size: 1.5rem; /* Tailwind: text-2xl */
            font-weight: bold; /* Tailwind: font-bold */
            color: #00317f; /* Tailwind: text-blue-700 */
        }
        
        /* Styles pour le paragraphe */
        .paragraph {
            font-size: 1.25rem; /* Tailwind: text-xl */
            color: black.; /* Tailwind: text-gray-600 */
        }
        
        /* Styles pour le lien */
        .link {
            margin-top: 1rem; /* Tailwind: mt-4 */
        }
        .link a {
            font-size: 0.875rem; /* Tailwind: text-sm */
            font-weight: bold; /* Tailwind: font-semibold */
            color: #00317f; /* Tailwind: text-blue-500 */
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1 class="title">Nom: {{ $userName }}</h1>
    <p class="paragraph">Cet utilisateur souhaite passer à un compte "Admin".</p>
    <p class="link"><a href="http://127.0.0.1:8000/users/update/{{$userId}}">Mettre à jour le profil</a></p>
</body>
</html>

