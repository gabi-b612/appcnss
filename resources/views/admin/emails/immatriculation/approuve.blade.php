

<h1>Immatriculation acceptée</h1>
<p>Bonjour {{ $entreprise->denomination }},</p>
<p>L'immatriculation de votre travailleur {{ $travailleur->nom }} {{ $travailleur->postnom }} a été acceptée.</p>
<p>Voici les informations de connexion :</p>
<ul>
    <li><strong>Numéro matricule :</strong> {{ $numero_matricule }}</li>
    <li><strong>Mot de passe :</strong> {{ $mot_de_passe }}</li>
</ul>
<p>Veuillez vous connecter au portail pour plus d'informations.</p>

<p>Cordialement,</p>
<p>L'équipe CNSS</p>

