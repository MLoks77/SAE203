<?php include "../include/navbar.php";
include "../include/ReserverHero.php" ;
include "../configdb/connexion.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/Reserver.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="custom text-white">

    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-white d-flex align-items-center justify-content-center flex-column" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Audiovisuelle</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Casque</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
        </li>
    </ul>

    <div class="tab-content " id="pills-tabContent">
        <div class="tab-pane fade show active contenu-tab " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container text-center py-2">
                <h2 class="fw-bold display-5">
                    Votre meilleure salle informatique à votre <span class="fst-italic">disposition</span>
                </h2>
                <p class="lead mb-5">Besoin d’une salle pour avancer sur vos projets ou jouer ?</p>
                <img src="../image/Salle138.JPG" class="img-fluid" alt="Salle informatique">
            </div>
            <p class="mt-4 fs-4 fst-italic ms-5 fw-semibold">La salle 138</p>
            <P class="col-lg-4 ms-5">Idéale si vous êtes seul (e) ou en petit groupe de 2 à 3 personnes , cette salle regroupe 3 ordinateurs équipés de double écran ainsi qu’un bureau à 90 degrés pour accueillir tout vos cahiers</P>

            <div class="row align-items-center">
                <div class="col-lg-4">
                    <p class="fw-semibold ms-5 mb-0">État : Super</p>
                </div>
                <div class="col-lg-4 offset-lg-4 text-end">
                    <button type="button" class="btn btn-light me-5 shadow-lg">Réserver la salle 138</button>
                </div>
            </div>
        </div>




        
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../image/P1018541.JPG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../image/P1018538.JPG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
