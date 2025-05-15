<?php
include "../include/navbar.php";
include "../include/ReserverHero.php";
include "../configdb/connexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/Reserver.css">
    <style>
.input-custom {
    border-radius: 8px;  /* Coins arrondis */
    background-color: #f0f0f0;  /* Fond gris */
    padding: 10px;  /* Espacement intérieur */
    width: 100%;  /* Remplir l'espace disponible */
}
td{
    border-radius: 5px;
    background-color: 16425B;  /* Fond gris */
}
.table, .table td, .table tr {
    border: none !important;
    border-radius: 8px 0px 0px 0px; /* Coins arrondis */
}
.table tr:first-child td,
.table tr:last-child td{
    border-radius: 8px 8px 0 0; /* Arrondi en haut à gauche et à droite */
}


</style>

</head>
<body class="custom">
<h2 class="fw-bold display-5 text-center text-light">
    Veuillez remplir le  <span class="fst-italic">formulaire</span>
</h2>

    <div class="col-8 container d-flex justify-content-center align-items-center mt-5 rounded custom ">
    <table class="table col-6">
        <tr>
            <td>
                <label for="name" class="form-label">Nom :</label>
                <input type="text" id="name" class="form-control input-custom" placeholder="Entrez votre nom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" id="prenom" class="form-control input-custom" placeholder="Entrez votre prénom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="email" class="form-label">Email :</label>
                <input type="email" id="email" class="form-control input-custom" placeholder="Entrez votre email">
            </td>
        </tr>
        <tr>
            <td>
                <label for="numero_etudiant" class="form-label">Numéro étudiant :</label>
                <input type="text" id="numero_etudiant" class="form-control input-custom" placeholder="Entrez votre numéro étudiant">
            </td>
        </tr>
        <tr>
            <td>
                <label for="date_acces" class="form-label">Date d’accès souhaitée : </label>
                <input type="text" id="date_acces" class="form-control input-custom" placeholder="Entrez la date d'accès souhaitée">
            </td>
        </tr>
        <tr>
            <td>
                <label for="heure_acces" class="form-label">Heure d’accès*: (à partir de 8h30)</label>
                <input type="text" id="heure_acces" class="form-control input-custom" placeholder="Entrez l'heure d'accès souhaitée">
            </td>
        </tr>
        <tr>
            <td>
                <label for="heure_remisee" class="form-label">Heure de remise des clés*: ( jusqu’a 18h max)</label>
                <input type="text" id="heure_remisee" class="form-control input-custom" placeholder="Entrez l'heure de remise des clés">
            </td>
        </tr>
        <tr>
            <td>
                <label for="annee_etude" class="form-label">Année MMI / Autre</label>
                <input type="text" id="annee_etude" class="form-control input-custom" placeholder="Entrez votre année d'étude">
            </td>
        </tr>
        <tr>
            <td>
                <label for="etudiant_concernant" class="form-label">Nom des étudiants concernés / personnel</label>
                <input type="text" id="etudiant_concerne" class="form-control input-custom" placeholder="Entrez les étudiants concernés">
            </td>
        </tr>
        <tr>
            <td>
                <label for="projet" class="form-label">Projet :</label>
                <input type="text" id="projet" class="form-control input-custom" placeholder="Entrez votre projet">
            </td>
        </tr>
    </table>

    </div>
    
</body>
</html>