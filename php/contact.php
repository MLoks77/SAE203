<?php 
session_start();

include "../include/navbar.php";
/**include "../include/navbaradmin.php"; mettre le code pour choisir suivant l'ID de l'utilisateur connecté **/

include "../include/ContactHero.php";
include "../configdb/connexion.php"
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="bg-fond">
<div class="container-fluid py-4 px-6">
<h2 class="col-6 m-auto fw-bold text-light police-perso" style="text-align: center; "> Nous contacter</h2>
        <div class="row text-center m-5 ">
            <div class="col-3 bg-light py-4 rounded">
                <h5 class="fw-bold">Nous contacter <i class="fa-solid fa-phone"></i></h5>
                <p class="mb-1  mt-5">
                Vous pouvez nous contacter<br>
                au <strong>01 60 95 72 54</strong><br>
                du lundi au vendredi de 9h à 17h ou par courriel
                <div class="mt-4">
                    <a href="https://www.instagram.com/universitegustaveeiffel/" target="_blank" class="btn btn-outline-dark me-2">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://www.linkedin.com/school/universit%C3%A9-gustave-eiffel/posts/?feedView=all" target="_blank" class="btn btn-outline-dark me-2">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </a><br><br>
                    <a href="https://www.facebook.com/UniversiteGustaveEiffel/?locale=fr_FR" target="_blank" class="btn btn-outline-dark me-2">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                    <a href="https://www.youtube.com/c/universitegustaveeiffel" target="_blank" class="btn btn-outline-dark me-2">
                        <i class="fab fa-youtube"></i> YouTube
                    </a>
                    <a href="https://bsky.app/profile/univeiffel.bsky.social" target="_blank" class="btn btn-outline-dark">
                    <i class="fa-brands fa-twitter"></i> Bluesky
                    </a>
                </div>
            </div>
            
            <div class="col-1 py-4"></div> 

            <div class="col-8 bg-light py-4 rounded">
    <h5 class="fw-bold">Formulaire de contact</h5>
    <form action="contact.php" method="post">
        <div class="mb-3 d-flex align-items-center">
            <label for="identifiant" class="form-label me-3" style="width: 150px;">Identifiant</label>
            <input type="text" class="form-control" id="identifiant" name="identifiant" required>
        </div>
        <div class="mb-3 d-flex align-items-center">
            <label for="email" class="form-label me-3" style="width: 150px;">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3 d-flex align-items-center">
            <label for="message" class="form-label me-3" style="width: 150px;">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<!-- L'ENVOIE NE FONCTIONNE PAS, IL FAUT REGLER LE FORMULAIRE SUIVANT NOTRE BASE DE DONNEE-->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        // Récupération et validation des données
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars($_POST['message']);

        // Vérification de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='text-danger'>Adresse email invalide.</p>";
        } else {
            $to = "maximederenes@gmail.com";
            $subject = "Prise de contact par $identifiant";
            $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

            $body = "Identifiant: $identifiant\nEmail: $email\n\nMessage:\n$message";

            // Envoi de l'email
            if (mail($to, $subject, $body, $headers)) {
                echo "<p class='text-success'>Votre message a été envoyé avec succès.</p>";
            } else {
                echo "<p class='text-danger'>Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard.</p>";
            }
        }
    }
    ?>
</div>
        </div>
</div>
    <?php include "../include/footer.php" ?>
</body>
</html>