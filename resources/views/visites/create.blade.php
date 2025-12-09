<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrer une visite</title>
</head>
<body>
    <h1>Formulaire de visite (placeholder)</h1>

    <form method="POST" action="{{ route('visites.store') }}">
        @csrf
        <p>
            <label>Nom visiteur :</label>
            <input type="text" name="nom_visiteur">
        </p>
        <button type="submit">Enregistrer (test)</button>
    </form>

    <p><a href="{{ route('visites.index') }}">Retour à la liste</a></p>
</body>
</html>
