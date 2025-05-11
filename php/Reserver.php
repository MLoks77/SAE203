<?php 
include "../include/navbar.php";
include "../include/ReserverHero.php";
include "../configdb/connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="stylesheet" href="../css/Reservercopie.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="custom text-white">
    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Salle</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Casque</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Multimédia</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" >Audiovisuel</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

        <!-- Onglet Salle -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="text-center">
                <h2 class="fw-bold display-5">Votre meilleure salle informatique à votre <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d’une salle pour avancer sur vos projets ou jouer ?</p>
            </div>

                <!-- Salle 212 -->
            <div class="salle212 mt-5">
                <div class="container text-center py-2">
                    <img src="../image/Salle212.jpg" class="img-fluid" alt="Salle informatique">
                </div>
                <p class="mt-4 fs-4 fst-italic ms-5 fw-semibold">La salle 212</p>
                <p class="col-lg-4 ms-5">Idéale si vous êtes seul(e) ou en groupe...</p>
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <p class="fw-semibold ms-5 mb-0">État : Super</p>
                    </div>
                    <div class="col-lg-4 offset-lg-4 text-end">
                        <button type="button" class="btn btn-light me-5 shadow-lg">Réserver la salle 212</button>
                    </div>
                </div>
            </div>

                <!-- Salle 138 -->
            <div class="container text-center py-2 salle212">
                <img src="../image/Salle138.JPG" class="img-fluid" alt="Salle informatique">
            </div>
            <p class="mt-4 fs-4 fst-italic ms-5 fw-semibold">La salle 138</p>
            <p class="col-lg-4 ms-5">Idéale si vous êtes seul(e) ou en petit groupe de 2 à 3 personnes, cette salle regroupe 3 ordinateurs équipés de double écran ainsi qu’un bureau à 90 degrés pour accueillir tous vos cahiers.</p>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <p class="fw-semibold ms-5 mb-0">État : Super</p>
                </div>
                <div class="col-lg-4 offset-lg-4 text-end">
                    <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver la salle 138</button>
                </div>
            </div>
        </div>

        <!-- Onglet Casque -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="text-center">
                <h2 class="fw-bold display-5">Nous mettons des casques VR à votre  <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d’une casque VR  pour avancer sur vos projets ou jouer ?</p>
            </div>
        <div class="container mt-5">
                <!-- HTC Vive Cosmos -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018538.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 1">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018541.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 2">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018538.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 3">
                    </div>
                </div>
                <p class="fs-4 fst-italic fw-semibold">Le HTC Vive Cosmos</p>
                <p class="col-lg-6">Le HTC Vive Cosmos est un casque de réalité virtuelle offrant un tracking inside-out, un confort optimisé et une visière relevable, idéal pour des expériences immersives interactives sur PC.</p>
                <div class="row">
                    <div class="col-lg-4">
                        <p class="fw-semibold mb-0">État : Super</p>
                    </div>
                    <div class="col-lg-4 offset-lg-4 text-end">
                        <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver le HTC Vive Cosmos</button>
                    </div>
                </div>

                <!-- Microsoft Hololens 2 -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018521.JPG" class="img-fluid rounded shadow" alt="Hololens 1">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018522.JPG" class="img-fluid rounded shadow" alt="Hololens 2">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img src="../image/P1018523.JPG" class="img-fluid rounded shadow" alt="Hololens 3">
                    </div>
                </div>
                <p class="fs-4 fst-italic fw-semibold">Le Microsoft HoloLens 2</p>
                <p class="col-lg-6">Le Microsoft HoloLens 2 est un casque de réalité mixte autonome, permettant d’interagir avec des hologrammes en 3D grâce à des capteurs, la reconnaissance gestuelle et une visière transparente.</p>
                <div class="row">
                    <div class="col-lg-4">
                        <p class="fw-semibold mb-0">État : Super</p>
                    </div>
                    <div class="col-lg-4 offset-lg-4 text-end">
                        <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver le HoloLens 2</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Multimédia -->
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="container mt-5">

            <!-- Manette -->
            <div class="text-center">
                <h2 class="fw-bold display-5">Nous mettons divers matériels d’audiovisuelle à votre   <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d’une drone , tablettes graphique ou autres pour vous amuser ?</p>
            </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018516.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018519.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image//P1018515.JPG" class="img-fluid rounded shadow" alt="HTC Vive Cosmos 3">
            </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">La manette MSI GC30</p>
        <p class="col-lg-6">La MSI GC30 est une manette sans fil polyvalente, compatible PC et Android, offrant une prise en main confortable et des commandes réactives pour une expérience de jeu fluide.</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Super</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver la MSI GC30</button>
                 </div>
        </div>

                <!-- Tablette -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018503.JPG" class="img-fluid rounded shadow" alt="Hololens 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018504.JPG" class="img-fluid rounded shadow" alt="Hololens 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018505.JPG" class="img-fluid rounded shadow" alt="Hololens 3">
            </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">La tablette WACOM</p>
        <p class="col-lg-6">La tablette Wacom est un outil de dessin numérique précis, utilisée avec un stylet sensible à la pression, idéale pour la création graphique et le travail artistique.</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Super</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver la WACOM</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018444.JPG" class="img-fluid rounded shadow" alt="Hololens 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018445.JPG" class="img-fluid rounded shadow" alt="Hololens 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/P1018446.JPG" class="img-fluid rounded shadow" alt="Hololens 3">
            </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">La drone DJI Tello</p>
        <p class="col-lg-6">Le DJI Tello est un mini-drone ludique et facile à piloter, idéal pour débuter. Il capture des vidéos HD, réalise des figures et se contrôle via smartphone.</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Super</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver le DJI Tello</button>
            </div>
        </div>
        </div>
      </div>
        <!-- Onglet Audiovisuel -->
        <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab">
        <div class="text-center">
        <h2 class="fw-bold display-5">Des équipements audiovisuels à votre <span class="fst-italic">disposition</span></h2>
        <p class="lead mb-5">Besoin d'équipements pour vos projets audiovisuels ?</p>
        </div>

        <div class="container mt-5">
            <!-- Trépied -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="../image/20230505_110216.jpg" class="img-fluid rounded shadow" alt="Projecteur 1">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="../image/20230505_110146.jpg" class="img-fluid rounded shadow" alt="Projecteur 2">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="../image/20230505_110146.jpg" class="img-fluid rounded shadow" alt="Projecteur 2">
                </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">Trépied</p>
        <p class="col-lg-6">Ce Trépied est idéal pour stabiliser votre caméra , en exterieur comme en intérieur.</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Excellent</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver le trépied</button>
            </div>
        </div>

        <!-- Caméra -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/20230505_105700.jpg" class="img-fluid rounded shadow" alt="Caméra 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/20230505_105927.jpg" class="img-fluid rounded shadow" alt="Caméra 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/20230505_105927.jpg" class="img-fluid rounded shadow" alt="Caméra 2">
            </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">GoPro</p>
        <p class="col-lg-6">La GoPro HERO est une caméra robuste idéale pour filmer en action. Parfaite pour le sport et les aventures extrêmes..</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Neuf</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver la Gopro</button>
            </div>
        </div>

        <!-- Microphone -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/20230505_100306.jpg" class="img-fluid rounded shadow" alt="Microphone 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/20230505_100614.jpg" class="img-fluid rounded shadow" alt="Microphone 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <img src="../image/IMG_00111.JPG" class="img-fluid rounded shadow" alt="Microphone 2">
            </div>
        </div>
        <p class="fs-4 fst-italic fw-semibold">Microphone Professionnel</p>
        <p class="col-lg-6">Ce microphone est conçu pour offrir une qualité sonore optimale, adapté aux enregistrements audio professionnels ou aux conférences.</p>
        <div class="row">
            <div class="col-lg-4">
                <p class="fw-semibold mb-0">État : Excellent</p>
            </div>
            <div class="col-lg-4 offset-lg-4 text-end">
                <button type="button" class="btn btn-light me-5 shadow-lg mb-5">Réserver le Microphone Professionnel</button>
            </div>
        </div>
    </div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
<?php
include "../include/footer.php"?>
