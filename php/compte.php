<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SESSION['role'] == 'admin') {
    include "../include/navbaradmin.php";
} else {
    include "../include/navbar.php";
}

include "../include/CompteHero.php";
include "../configdb/connexion.php";

$id = $_SESSION['utilisateur_id'];
$sql = "SELECT * FROM utilisateur WHERE ID_utilisateur = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupération des réservations validées
$sqlreservations = "SELECT r.Date, CONCAT(u.Nom, ' ', u.Prenom) AS student, r.Motif AS motif, r.salle, r.H_debut, r.H_fin, m.Reference AS nom_materiel, m.Type AS type_materiel, m.Etat_global AS etat_materiel
                    FROM reservation r
                    LEFT JOIN utilisateur u ON r.ID_utilisateur = u.ID_utilisateur
                    LEFT JOIN materiel m ON r.materiel = m.ID_materiel
                    WHERE r.ID_utilisateur = ?
                    ORDER BY r.Date, r.H_debut";
$stmtreservations = $pdo->prepare($sqlreservations);
$stmtreservations->execute([$id]);
$reservations = [];
while ($row = $stmtreservations->fetch(PDO::FETCH_ASSOC)) {
    $reservations[] = [
        'date' => $row['Date'],
        'student' => $row['student'],
        'motif' => $row['motif'],
        'salle' => $row['salle'],
        'materiel' => $row['nom_materiel'],
        'type' => $row['type_materiel'],
        'etat' => $row['etat_materiel'],
        'heure_debut' => $row['H_debut'],
        'heure_fin' => $row['H_fin'],
        'status' => 'validée'
    ];
}
// Récupération des réservations en attente
$sqlattente = "SELECT d.date_demande AS Date, d.Motif_demande AS motif, d.salle_d AS salle, d.H_acces AS H_debut, d.H_arrive AS H_fin, d.materiel_d AS materiel
               FROM reservation_demande d WHERE d.identifiant_demande = ? ORDER BY d.date_demande, d.H_acces";
$stmtattente = $pdo->prepare($sqlattente);
$stmtattente->execute([$user['Identifiant']]);
while ($row = $stmtattente->fetch(PDO::FETCH_ASSOC)) {
    $reservations[] = [
        'date' => $row['Date'],
        'student' => $user['Nom'] . ' ' . $user['Prenom'],
        'motif' => $row['motif'],
        'salle' => $row['salle'],
        'materiel' => $row['materiel'],
        'type' => '',
        'etat' => '',
        'heure_debut' => $row['H_debut'],
        'heure_fin' => $row['H_fin'],
        'status' => 'en attente'
    ];
}
// Récupération des réservations refusées
$sqlrefus = "SELECT d.date_demande AS Date, d.Motif_demande AS motif, d.salle_d AS salle, d.H_acces AS H_debut, d.H_arrive AS H_fin, d.materiel_d AS materiel
               FROM reservation_refus d WHERE d.identifiant_demande = ? ORDER BY d.date_demande, d.H_acces";
$stmtrefus = $pdo->prepare($sqlrefus);
$stmtrefus->execute([$user['Identifiant']]);
while ($row = $stmtrefus->fetch(PDO::FETCH_ASSOC)) {
    $reservations[] = [
        'date' => $row['Date'],
        'student' => $user['Nom'] . ' ' . $user['Prenom'],
        'motif' => $row['motif'],
        'salle' => $row['salle'],
        'materiel' => $row['materiel'],
        'type' => '',
        'etat' => '',
        'heure_debut' => $row['H_debut'],
        'heure_fin' => $row['H_fin'],
        'status' => 'refusée'
    ];
}
// Tri par date décroissante
usort($reservations, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $prenom = htmlspecialchars($_POST['Prenom']);
    $nom = htmlspecialchars($_POST['Nom']);
    $mail = htmlspecialchars($_POST['Mail']);
    $date_naissance = $_POST['Date_naissance'];
    $adresse = htmlspecialchars($_POST['Adresse']);
    $n_etudiant = !empty($_POST['n_etudiant']) ? htmlspecialchars($_POST['n_etudiant']) : null;
    $mot_de_passe = !empty($_POST['Mot_de_passe']) ? password_hash($_POST['Mot_de_passe'], PASSWORD_DEFAULT) : $user['Mot_de_passe'];

    $sqlUpdate = "UPDATE utilisateur SET Prenom=?, Nom=?, Mail=?, Date_naissance=?, Adresse=?, n_etudiant=?, Mot_de_passe=? WHERE ID_utilisateur=?";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([$prenom, $nom, $mail, $date_naissance, $adresse, $n_etudiant, $mot_de_passe, $id]);
    // Mise à jour de la session avec les nouvelles valeurs
    $_SESSION['Prenom'] = $prenom;
    $_SESSION['Nom'] = $nom;
    $_SESSION['Mail'] = $mail;
    $_SESSION['n_etudiant'] = $n_etudiant;
    $_SESSION['Adresse'] = $adresse;
    header("Location: compte.php?success=1");
    exit;
}
// Traitement de l'ajout de commentaire
$commentaire_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajout_commentaire'])) {
    $message = trim($_POST['commentaire_message'] ?? '');
    if ($message !== '') {
        $sqlComment = "INSERT INTO commentaire (ID_utilisateur, Message) VALUES (?, ?)";
        $stmtComment = $pdo->prepare($sqlComment);
        $stmtComment->execute([$id, $message]);
        $commentaire_success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-fond">
<main>
    <section class="extra-space" aria-hidden="true"></section>
    <div class="container mt-5 mb-5">
        <ul class="nav nav-pills justify-content-center mb-4 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link active" id="tab-compte" onclick="showTab('compte'); return false;" role="tab" aria-selected="true">Mon compte</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link" id="tab-reservations" onclick="showTab('reservations'); return false;" role="tab" aria-selected="false">Mes réservations</a>
            </li>
        </ul>
        <div id="pane-compte">
            <h1 class="mb-4 text-light text-center">Mon Compte</h1>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">Modifications enregistrées !</div>
            <?php endif; ?>
            <form method="post" autocomplete="off" aria-label="Formulaire de gestion du compte">
                <fieldset class="card mb-4">
                    <legend class="card-header h5 mb-0">Informations générales</legend>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstName" name="Prenom" value="<?= htmlspecialchars($user['Prenom']) ?>" required autocomplete="given-name">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastName" name="Nom" value="<?= htmlspecialchars($user['Nom']) ?>" required autocomplete="family-name">
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="dob" name="Date_naissance" value="<?= htmlspecialchars($user['Date_naissance'] ?? '') ?>" required autocomplete="bday">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="Mail" value="<?= htmlspecialchars($user['Mail']) ?>" required autocomplete="email">
                        </div>
                        <div class="col-md-6">
                            <label for="n_etudiant" class="form-label">Numéro étudiant</label>
                            <input type="text" class="form-control" id="n_etudiant" name="n_etudiant" value="<?= htmlspecialchars($user['n_etudiant'] ?? '') ?>" aria-describedby="nEtudiantHelp">
                            <div id="nEtudiantHelp" class="form-text">Laisser vide si non concerné.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Adresse postale</label>
                            <input type="text" class="form-control" id="address" name="Adresse" value="<?= htmlspecialchars($user['Adresse'] ?? '') ?>" autocomplete="street-address">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="card mb-4">
                    <legend class="card-header h5 mb-0">Sécurité</legend>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Identifiant</label>
                            <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user['Identifiant']) ?>" readonly aria-readonly="true" tabindex="-1">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="role" value="<?= htmlspecialchars($user['role']) ?>" readonly aria-readonly="true" tabindex="-1">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="Mot_de_passe" placeholder="Laisser vide pour ne pas changer" aria-describedby="passwordHelp">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword" aria-label="Afficher ou masquer le mot de passe">Afficher</button>
                            </div>
                            <div id="passwordHelp" class="form-text">Laisser vide pour conserver le mot de passe actuel.</div>
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="compte.php" class="btn btn-danger" aria-label="Annuler les modifications">Annuler</a>
                    <button type="submit" name="update" class="btn btn-success" aria-label="Enregistrer les modifications">Enregistrer</button>
                </div>
            </form>
        </div>
        <div id="pane-reservations" style="display:none;">
            <h2 class="mb-4 text-light text-center">Mes réservations</h2>
            <div class="bg-light rounded-3 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label for="reservationFilter" class="form-label mb-0">Filtrer les réservations :</label>
                    <select id="reservationFilter" class="form-select w-auto">
                        <option value="all">Toutes les réservations</option>
                        <option value="validee">Validées</option>
                        <option value="attente">En attente</option>
                        <option value="refusee">Refusées</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="reservationTable">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Heure début</th>
                                <th scope="col">Heure fin</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Matériel</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Les lignes seront générées en JS -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container d-flex justify-content-between align-items-center mt-3">
                    <div class="pagination-info">
                        Affichage de <span id="startIndex">1</span> à <span id="endIndex">10</span> sur <span id="totalItems">0</span> réservations
                    </div>
                    <nav aria-label="Navigation des réservations">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <button class="page-link text-dark" id="prevPage" aria-label="Page précédente">&laquo;</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link text-dark" id="nextPage" aria-label="Page suivante">&raquo;</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Zone de commentaire -->
            <div class="bg-light rounded-3 p-4 mb-4">
                <h3 class="mb-3 text-dark">Laisser un commentaire</h3>
                <?php if ($commentaire_success): ?>
                    <div class="alert alert-success">Commentaire envoyé avec succès !</div>
                <?php endif; ?>
                <form method="post" id="formCommentaire" autocomplete="off">
                    <div class="mb-3">
                        <textarea class="form-control" name="commentaire_message" id="commentaire_message" rows="3" placeholder="Votre commentaire..." required></textarea>
                    </div>
                    <input type="hidden" name="ajout_commentaire" value="1">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success" id="btnConfirmerCommentaire">Confirmer</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
            <!-- Modal de confirmation commentaire -->
            <div class="modal fade" id="commentaireModal" tabindex="-1" aria-labelledby="commentaireModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentaireModalLabel">Confirmer l'envoi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            Voulez-vous vraiment envoyer ce commentaire ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-success" id="confirmerEnvoiCommentaire">Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="extra-space" aria-hidden="true"></section>
</main>
<?php include "../include/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Gestion des tabs custom
    function showTab(tab) {
        document.getElementById('pane-compte').style.display = (tab === 'compte') ? '' : 'none';
        document.getElementById('pane-reservations').style.display = (tab === 'reservations') ? '' : 'none';
        document.getElementById('tab-compte').classList.toggle('active', tab === 'compte');
        document.getElementById('tab-reservations').classList.toggle('active', tab === 'reservations');
    }
    // Affichage initial
    showTab('compte');

    // Affichage des réservations avec pagination et filtre
    const allReservations = <?php echo json_encode($reservations); ?>;
    let filteredReservations = [...allReservations];
    const itemsPerPage = 10;
    let currentPage = 1;

    function renderReservations() {
        const filter = document.getElementById('reservationFilter').value;
        filteredReservations = allReservations.filter(res => {
            if (filter === 'all') return true;
            if (filter === 'validee') return res.status === 'validée';
            if (filter === 'attente') return res.status === 'en attente';
            if (filter === 'refusee') return res.status === 'refusée';
        });
        const tbody = document.querySelector('#reservationTable tbody');
        tbody.innerHTML = '';
        const start = (currentPage - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, filteredReservations.length);
        for (let i = start; i < end; i++) {
            const res = filteredReservations[i];
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${formatDateFr(res.date)}</td>
                <td>${res.heure_debut || '-'}</td>
                <td>${res.heure_fin || '-'}</td>
                <td>${res.salle ? 'Salle ' + res.salle : '-'}</td>
                <td>${res.materiel || '-'}</td>
                <td>${res.motif || '-'}</td>
                <td><span class="badge ${res.status === 'validée' ? 'bg-success' : res.status === 'en attente' ? 'bg-warning text-dark' : 'bg-danger'}">${res.status}</span></td>
            `;
            tbody.appendChild(tr);
        }
        // Pagination info
        document.getElementById('startIndex').textContent = filteredReservations.length > 0 ? start + 1 : 0;
        document.getElementById('endIndex').textContent = end;
        document.getElementById('totalItems').textContent = filteredReservations.length;
        // Désactiver les boutons si besoin
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = end >= filteredReservations.length;
    }
    function formatDateFr(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('fr-FR', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }
    document.getElementById('reservationFilter').addEventListener('change', function() {
        currentPage = 1;
        renderReservations();
    });
    document.getElementById('prevPage').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderReservations();
        }
    });
    document.getElementById('nextPage').addEventListener('click', function() {
        const maxPage = Math.ceil(filteredReservations.length / itemsPerPage);
        if (currentPage < maxPage) {
            currentPage++;
            renderReservations();
        }
    });
    // Initialisation
    renderReservations();

    // Gestion du commentaire
    document.getElementById('btnConfirmerCommentaire').addEventListener('click', function() {
        const message = document.getElementById('commentaire_message').value.trim();
        if (message === '') {
            alert('Le commentaire ne peut pas être vide.');
            return;
        }
        var commentaireModal = new bootstrap.Modal(document.getElementById('commentaireModal'));
        commentaireModal.show();
    });
    document.getElementById('confirmerEnvoiCommentaire').addEventListener('click', function() {
        document.getElementById('formCommentaire').submit();
    });
    // Accessibilité : gestion de l'affichage du mot de passe
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Afficher' : 'Masquer';
    });
</script>
</body>
</html>
