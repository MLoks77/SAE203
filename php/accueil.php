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
    include "../include/navbar.php"; // Si navbar spécifique agent
} else {
    include "../include/navbar.php"; //  si rôle inconnu
}

include "../include/AccueilHero.php";

include "../configdb/connexion.php";

$sql = "SELECT c.ID_commentaire, c.ID_utilisateur, c.Message, u.Prenom, u.Nom
        FROM Commentaire c
        JOIN utilisateur u ON c.ID_utilisateur = u.ID_utilisateur
        ORDER BY RAND() LIMIT 3";
$stmt = $pdo->query($sql);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id = $_SESSION['ID_utilisateur'];

$sqlSelect = "SELECT Prenom, Nom FROM utilisateur WHERE ID_utilisateur=?";
$stmtSelect = $pdo->prepare($sqlSelect);
$stmtSelect->execute([$id]);
$utilisateur = $stmtSelect->fetch(PDO::FETCH_ASSOC);

if (
    $utilisateur) {
    $prenom = $utilisateur['Prenom'];
    $nom = $utilisateur['Nom'];
} else {
    $prenom = 'Prénom inconnu';
    $nom = 'Nom inconnu';
}

$commentaires_json = json_encode($commentaires);
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
            <a href="Reserver.php" class="btn btn-secondary btn-lg mx-5 boutoncustom">Réserver</a>
            <a href="contact.php" class="btn btn-secondary btn-lg mx-5 boutoncustom">Nous contacter</a>
        </div>
    </div>

    <div class="container-fluid container2 pb-4">
        <h2 class="col-6  m-auto p-5  fw-bold text-dark police-perso" style="text-align: center; "> Les avantages de notre service</h2>
        <div class="text-center p-5">
            <img src="../image/Salle138.JPG" class=" mx-3 custom-width" alt=" salle 138">
            <img src="../image/Salle212.jpg" class=" mx-3 custom-width" alt="salle212">
        <div class="text-center p-5">
            <a href="Reserver.php" class="btn btn-secondary btn-lg mx-5 boutoncustom">Réserver</a>
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
        <div id="commentairespawn" class="row justify-content-center"></div>
    </section>
    <?php include "../include/footer.php" ?>
    <script>
    const commentaires = <?php echo $commentaires_json; ?>;
    const prenom = <?php echo json_encode($prenom); ?>;
    const nom = <?php echo json_encode($nom); ?>;

    function afficherCommentaires() {
        const container = document.getElementById('commentairespawn');
        container.innerHTML = '';
        commentaires.forEach(commentaire => {
            const card = document.createElement('div');
            card.className = 'col-12 col-md-4 mb-4';
            card.innerHTML = `
                <div class="comment-card">
                    <div style="display: flex; align-items: flex-start;">
                        <img src="../image/pp.jpg" alt="img" style="width: 60px; height: 60px; border-radius: 15px; border: 2px solid #000; object-fit: cover; margin-right: 20px;">
                        <div>
                            <span style="font-weight: bold;">${commentaire.Prenom} ${commentaire.Nom}</span>
                        </div>
                    </div>
                    <div style="margin-top: 30px; margin-left: 10px;">
                        <span style="color: #333; font-size: 1.1em;">${commentaire.Message}</span>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }
    // Appel automatique au chargement de la page
    window.addEventListener('DOMContentLoaded', afficherCommentaires);
    </script>
</body>

</html>