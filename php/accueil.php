<?php 
session_start();


include "../include/navbar.php";
/**include "../include/navbaradmin.php"; mettre le code pour choisir suivant l'ID de l'utilisateur connecté **/

include "../include/AccueilHero.php";
include "../configdb/connexion.php";
 ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid  en-tete text-center">
        <h1 class="col-6 col-lg-8 m-auto p-5 display-3 fw-bold text-light police-perso"> Le matériel qu'il vous faut quand il vous le faut</h1>
        <p class="text-center text-white fs-4 opacité">Gagnez du temps : tout le matériel de l'IUT accessible en ligne, en quelques clics.</p>
        <div class="text-center p-5">
        <a href="Reserver.php" class="btn btn-primary btn-lg mx-5">Réserver</a>
        <a href="contact.php" class="btn btn-secondary btn-lg mx-5 boutons">Nous contacter</a>
        </div>
    </div>

    <div class="container-fluid container2 pb-4">
        <h2 class="col-6  m-auto p-5  fw-bold text-dark police-perso" style="text-align: center; "> Les avantages de notre service</h2>
        <div class="text-center p-5">
            <img src="../image/Salle138.JPG" class=" mx-3 custom-width" alt=" salle 138">
            <img src="../image/Salle212.jpg" class=" mx-3 custom-width" alt="salle212">
            <button type="button" class="btn btn-primary btn-lg d-block mx-auto mt-5 text-light" > <a href="Reserver.php"> Réserver une salle</a></button>
        </div>
        <div class="row text-center m-5">
            <div class="col-4">
                <h5 class="fw-bold">Réserver le matériel en ligne</h5>
                <p class="text-muted">Le matériel est disponible ? Réservez en ligne pour gagner du temps.</p>
            </div>

            <div class="col-4">
                <h5 class="fw-bold">Obtenez la confirmation</h5>
                <p class="text-muted">À la suite de la réservation, vous recevez la confirmation par l'administrateur.</p>
            </div>


            <div class="col-4">
                <h5 class="fw-bold">Récupérer votre matériel</h5>
                <p class="text-muted">Récupérez votre matériel dans les salles indiquées.</p>
            </div>
        </div>
    </div>
    </div>

    <section class="container-fluid en-tete text-center py-5">
        <h2 class="col-12 col-lg-8 mx-auto display-5 fw-bold text-light police-perso">
            Ils nous font confiance
        </h2>
        <p class="text-center text-white fs-4 opacité">Découvrez ce que les clients disent de notre service.</p>
        <img src="../image/avis203.jpg" alt="avis client">
    </section>
    <?php include "../include/footer.php" ?>
</body>
</html>