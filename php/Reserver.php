<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../index.php');
    exit();
}
if ($_SESSION['role'] == 'admin') {
    include "../include/navbaradmin.php";
} elseif ($_SESSION['role'] == 'etudiant' || $_SESSION['role'] == 'enseignant') {
    include "../include/navbar.php";
} elseif ($_SESSION['role'] == 'agent') {
    include "../include/navbar.php"; 
} else {
    include "../include/navbar.php"; 
}

include "../include/ReserverHero.php";
include "../configdb/connexion.php";

$sql = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Casque'";
$stmt = $pdo->query($sql);
$materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlMultimedia = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Multimédia'";
$stmtMultimedia = $pdo->query($sqlMultimedia);
$materielsMultimedia = $stmtMultimedia->fetchAll(PDO::FETCH_ASSOC);

$sqlAudiovisuel = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Audiovisuelle'";
$stmtAudiovisuel = $pdo->query($sqlAudiovisuel);
$materielsAudiovisuel = $stmtAudiovisuel->fetchAll(PDO::FETCH_ASSOC);

$sqlSalle = "SELECT ID, Descriptif, Etat FROM Salle";
$stmtSalle = $pdo->query($sqlSalle);
$materielsSalle = $stmtSalle->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="stylesheet" href="../css/Reserver.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body class="custom text-white">
<div class="d-flex align-items-center mb-3 bg-fond" style="gap: 1rem;">
    <div class="flex-grow-1 d-flex justify-content-center">
        <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Salle</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Casque</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Multimédia</button>
            </li>
            <li class="nav-item " role="presentation">
                <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false">Audiovisuel</button>
            </li>
        </ul>
        <div class="nav nav-pills ms-5" id="pills-tab">
        <a href="formulaireReserver.php" class="nav-link boutonpanier">
        <i class="bi bi-basket "></i> Aller au panier
        </a>
    </div>


    </div>
    
    
</div>
    <div class="tab-content" id="pills-tabContent">
        <!-- Onglet Salle -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="text-center">
                <h2 class="fw-bold display-5">Votre meilleure salle informatique à votre <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d'une salle pour avancer sur vos projets ou jouer ?</p>
            </div>
            <?php foreach ($materielsSalle as $row): ?>
                <div class="container mb-5">
                    <!-- Images de la salle -->
                    <div class="text-start mb-4 ms-5">
                        <div class="salle-image-container">
                            <img src="../image/Salle<?= $row['ID'] ?>.jpg"
                                class="salle-image"
                                alt="Salle <?= $row['ID'] ?>">
                        </div>
                    </div>
                    <!-- Bloc texte avec même marge -->
                   <div class="ms-5">
                        <p class="fs-4 fst-italic fw-semibold">La salle <?= $row['ID'] ?></p>
                        <p class="col-lg-6"><?= nl2br(htmlspecialchars($row['Descriptif'])) ?></p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="fw-semibold mb-0">État : <?= htmlspecialchars($row['Etat']) ?></p>
                            </div>
                            <div class="col-lg-4 offset-lg-4 text-end">
                                <form action="ajouter_panier.php" method="post" class="d-inline" onsubmit="return ajouterAuPanier(this);">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['ID']) ?>">
                                    <input type="hidden" name="nom" value="<?= 'Salle '.htmlspecialchars($row['ID']) ?>">
                                    <input type="hidden" name="type" value="salle">
                                    <input type="hidden" name="quantite" value="1">
                                    <button type="submit" class="btn  text-dark me-5 shadow-lg mb-5 btn-reserver">
                                        Réserver <?= htmlspecialchars($row['ID']) ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Onglet Casque -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="text-center">
                <h2 class="fw-bold display-5">Nous mettons des casques à votre  <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d'un casque pour avancer sur vos projets ou jouer ?</p>
        </div>
            <div class="container mt-5">
                <?php foreach ($materiels as $row): ?>
                    <div class="mb-5">
                        <!-- Affichage des images en grille -->
                        <?php
                        $imageCount = 0;
                        for ($i = 1; $i <= 3; $i++) {
                            $imagePath = "../image/" . $row['ID_materiel'] . "_" . $i . ".jpg";
                            if (file_exists($imagePath)) {
                                $imageCount++;
                            }
                        }
                        ?>
                        <div class="materiel-grid" data-images="<?= $imageCount ?>">
                            <?php
                            for ($i = 1; $i <= 3; $i++) {
                                $imagePath = "../image/" . $row['ID_materiel'] . "_" . $i . ".jpg";
                                if (file_exists($imagePath)) {
                                    ?>
                                    <div class="materiel-image-container">
                                        <img src="<?= $imagePath ?>"
                                            class="materiel-image"
                                            alt="<?= htmlspecialchars($row['Reference']) ?> - Image <?= $i ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- Informations du matériel -->
                        <p class="fs-4 fst-italic fw-semibold"><?= htmlspecialchars($row['Reference']) ?></p>
                        <p class="col-lg-6"><?= nl2br(htmlspecialchars($row['Descriptif'])) ?></p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="fw-semibold mb-0">État : <?= htmlspecialchars($row['Etat_global']) ?></p>
                            </div>
                            <div class="col-lg-4 offset-lg-4 text-end">
                                <form action="ajouter_panier.php" method="post" class="d-inline" onsubmit="return ajouterAuPanier(this);">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['ID_materiel'] ?? $row['ID']) ?>">
                                    <input type="hidden" name="nom" value="<?= htmlspecialchars($row['Reference'] ?? ('Salle '.$row['ID'])) ?>">
                                    <input type="hidden" name="type" value="materiel">
                                    <input type="hidden" name="quantite" value="1">
                                    <button type="submit" class="btn  text-dark me-5 shadow-lg mb-5 btn-reserver">
                                        Réserver
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Onglet Multimédia -->
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="text-center">
                <h2 class="fw-bold display-5">Nous mettons divers matériels d'audiovisuelle à votre   <span class="fst-italic">disposition</span></h2>
                <p class="lead mb-5">Besoin d'une drone , tablettes graphique ou autres pour vous amuser ?</p>
            </div>
            <div class="container mt-5">
                <?php foreach ($materielsMultimedia as $row): ?>
                    <div class="mb-5">
                        <!-- Affichage des 3 images -->
                        <div class="materiel-grid" data-images="<?= $imageCount ?>">
                            <?php 
                            $imageCount = 0;
                            for ($i = 1; $i <= 3; $i++) {
                                $imagePath = "../image/" . $row['ID_materiel'] . "_" . $i . ".jpg";
                                if (file_exists($imagePath)) {
                                    $imageCount++;
                                    ?>
                                    <div class="materiel-image-container">
                                        <img src="<?= $imagePath ?>"
                                            class="materiel-image"
                                            alt="<?= htmlspecialchars($row['Reference']) ?> - Image <?= $i ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Informations du matériel -->
                        <p class="fs-4 fst-italic fw-semibold"><?= htmlspecialchars($row['Reference']) ?></p>
                        <p class="col-lg-6"><?= nl2br(htmlspecialchars($row['Descriptif'])) ?></p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="fw-semibold mb-0">État : <?= htmlspecialchars($row['Etat_global']) ?></p>
                            </div>
                            <div class="col-lg-4 offset-lg-4 text-end">
                                <form action="ajouter_panier.php" method="post" class="d-inline" onsubmit="return ajouterAuPanier(this);">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['ID_materiel'] ?? $row['ID']) ?>">
                                    <input type="hidden" name="nom" value="<?= htmlspecialchars($row['Reference'] ?? ('Salle '.$row['ID'])) ?>">
                                    <input type="hidden" name="type" value="materiel">
                                    <input type="hidden" name="quantite" value="1">
                                    <button type="submit" class="btn  text-dark me-5 shadow-lg mb-5 btn-reserver">
                                        Réserver
                                    </button>
                                </form>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Onglet Audiovisuel -->
        <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab">
        <div class="text-center">
        <h2 class="fw-bold display-5">Des équipements audiovisuels à votre <span class="fst-italic">disposition</span></h2>
        <p class="lead mb-5">Besoin d'équipements pour vos projets audiovisuels ?</p>
        </div>
            <div class="container mt-5">
                <?php foreach ($materielsAudiovisuel as $row): ?>
                    <div class="mb-5">
                        <!-- Affichage des 3 images -->
                        <div class="materiel-grid" data-images="<?= $imageCount ?>">
                            <?php 
                            $imageCount = 0;
                            for ($i = 1; $i <= 3; $i++) {
                                $imagePath = "../image/" . $row['ID_materiel'] . "_" . $i . ".jpg";
                                if (file_exists($imagePath)) {
                                    $imageCount++;
                                    ?>
                                    <div class="materiel-image-container">
                                        <img src="<?= $imagePath ?>"
                                            class="materiel-image"
                                            alt="<?= htmlspecialchars($row['Reference']) ?> - Image <?= $i ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- Informations du matériel -->
                        <p class="fs-4 fst-italic fw-semibold"><?= htmlspecialchars($row['Reference']) ?></p>
                        <p class="col-lg-6"><?= nl2br(htmlspecialchars($row['Descriptif'])) ?></p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="fw-semibold mb-0">État : <?= htmlspecialchars($row['Etat_global']) ?></p>
                            </div>
                            <div class="col-lg-4 offset-lg-4 text-end">
                                <form action="ajouter_panier.php" method="post" class="d-inline" onsubmit="return ajouterAuPanier(this);">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['ID_materiel'] ?? $row['ID']) ?>">
                                    <input type="hidden" name="nom" value="<?= htmlspecialchars($row['Reference'] ?? ('Salle '.$row['ID'])) ?>">
                                    <input type="hidden" name="type" value="materiel">
                                    <input type="hidden" name="quantite" value="1">
                                    <button type="submit" class="btn  text-dark me-5 shadow-lg mb-5 btn-reserver">
                                        Réserver <?= htmlspecialchars($row['Reference'] ?? $row['ID']) ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div id="ajout-message" class="alert alert-success text-center" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); z-index:2000;">
    Article ajouté à la réservation !
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script>
function ajouterAuPanier(form) {
    const formData = new FormData(form);
    fetch('ajouter_panier.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(() => {
        // Affiche le message
        const msg = document.getElementById('ajout-message');
        msg.style.display = 'block';
        setTimeout(() => { msg.style.display = 'none'; }, 2000);

        // Optionnel : incrémente le badge du panier si tu veux
        let badge = document.querySelector('.badge.bg-success');
        if (badge) badge.textContent = parseInt(badge.textContent) + 1;
    });
    return false; // Empêche la soumission classique
}
</script>
</body>
</html>
<?php include "../include/footer.php" ;


?>