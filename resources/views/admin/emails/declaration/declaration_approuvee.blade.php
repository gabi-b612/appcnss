<!DOCTYPE html>
<html>
<head>
    <title>Déclaration Approuvée</title>
</head>
<body>
<h1>Bonjour, {{ $declaration->entreprise->nom }}</h1>
<p>Nous vous informons que votre déclaration a été approuvée.</p>
<p>Détails de la déclaration :</p>
<ul>
    <li>Numéro : {{ $declaration->id }}</li>
    <li>Date : {{ $declaration->created_at }}</li>
</ul>
<p>Merci pour votre collaboration.</p>
<p>Equipe cnss</p>
</body>
</html>
