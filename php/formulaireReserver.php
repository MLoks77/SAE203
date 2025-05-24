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
    include "../include/navbar.php"; // Si tu as une navbar spécifique agent
} else {
    include "../include/navbar.php"; //  si rôle inconnu
}
include "../include/ReserverHero.php";
include "../configdb/connexion.php";


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Ton CSS personnalisé -->
    <link rel="stylesheet" href="../css/Reserver.css">
</head>

<body class="custom">



    <h2 class="fw-bold display-5 text-center text-light mt-4">
        Veuillez remplir le <span class="fst-italic">formulaire</span>
    </h2>
    <div class="container text-end mt-3">
        <button class="btn btn-outline-light position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPanier" aria-controls="offcanvasPanier">

            <i class="bi bi-cart3"></i> Ma réservation
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                <?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?>
                <!--dynamiquement avec PHP -->
            </span>
            </a>
    </div>


    <div class="container-fluid d-flex justify-content-center align-items-center mt-5 ">
        <div class="col-lg-8 col-md-10 col-sm-12 p-4 custom ">
            <form action="traitementformulairereserver.php" method="POST">
                <table class="table text-light ">
                    <tr>
                        <td class="rounded-top p-3"><label for="name" class="form-label">Identifiant :</label>
                            <input type="text" id="name" name="identifiant" class="form-control input-custom" value="<?= htmlspecialchars($_SESSION['identifiant']) ?>" placeholder="Entrez votre nom" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="email" class="form-label">Email :</label>
                            <input type="email" id="email" name="email" class="form-control input-custom">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="numero_etudiant" class="form-label">Numéro étudiant :</label>
                            <input type="text" id="numero_etudiant" name="numero_etudiant" class="form-control input-custom" placeholder="Entrez votre numéro étudiant">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date_acces" class="form-label">Date d’accès souhaitée :</label>
                            <input type="date" id="date_acces" name="date_acces" class="form-control input-custom" max="<?= date('Y') ?>-12-31">

                        </td>
                    </tr>
                    <tr>
                        <td><label for="heure_acces" class="form-label">Heure d’accès (à partir de 8h30) :</label>
                            <input type="time" id="heure_acces" name="heure_acces" class="form-control input-custom" min="08:30">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="heure_remisee" class="form-label">Heure de remise des clés (jusqu’à 18h max) :</label>
                            <input type="time" id="heure_remisee" name="heure_remisee" class="form-control input-custom" max="18:00">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="annee_etude" class="form-label">Année MMI :</label>
                            <select id="annee_etude" name="annee_etude" class="form-control input-custom">
                                <option value="">Sélectionnez une année</option>
                                <option value="1">MMI1</option>
                                <option value="2">MMI2</option>
                                <option value="3">MMI3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="etudiant_concerne" class="form-label">Étudiants concernés / personnel :</label>
                            <input type="text" id="etudiant_concerne" name="etudiant_concerne" class="form-control input-custom" placeholder="Entrez les personnes concernées">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="projet" class="form-label">Projet :</label>
                            <input type="text" id="projet" name="projet" class="form-control input-custom" placeholder="Entrez votre projet">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center pt-4 rounded-bottom">
                            <button type="submit" class="btn btn-success px-5 py-2 rounded-pill">Soumettre</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- Offcanvas Panier -->
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasPanier" aria-labelledby="offcanvasPanierLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasPanierLabel">Votre réservation</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
        <div class="offcanvas-body">
            <?php if (!empty($_SESSION['panier'])): ?>
                <ul class="list-group text-dark" id="panier-list">
                    <?php foreach ($_SESSION['panier'] as $index => $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-index="<?= $index ?>">
                            <?= htmlspecialchars($item['nom']) ?> - <?= htmlspecialchars($item['quantite']) ?> x
                            <button type="button" class="btn btn-danger btn-sm ms-2 retirer-btn" data-index="<?= $index ?>">Retirer</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <hr class="bg-light">
                <a href="#" id="valider-panier" class="btn btn-success w-100 mt-3" data-bs-dismiss="offcanvas">Valider la réservation</a>
            <?php else: ?>
                <p>Aucun article dans le panier.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include "../include/footer.php"; ?>
    <script>
        document.getElementById('panier-list').addEventListener('click', function(e) {
            if (e.target.classList.contains('retirer-btn')) {
                e.preventDefault();
                const index = e.target.getAttribute('data-index');
                fetch('retirer_panier.php', { // <-- chemin corrigé
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'index=' + encodeURIComponent(index)
                    })
                    .then(response => response.text())
                    .then(result => {
                        if (result.trim() === 'success') {
                            e.target.closest('li').remove();
                        }
                    });
            }
        });

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
                    setTimeout(() => {
                        msg.style.display = 'none';
                    }, 2000);

                    // Optionnel : incrémente le badge du panier
                    let badge = document.querySelector('.badge.bg-success');
                    badge.textContent = parseInt(badge.textContent) + 1;
                });
            return false; // Empêche la soumission classique
        }
    </script>

    <!-- Message de confirmation -->
    <div id="ajout-message" class="alert alert-success text-center" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); z-index:2000;">
        Article ajouté à la réservation !
    </div>
</body>

</html>