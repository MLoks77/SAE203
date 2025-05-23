<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
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

include "../include/AdminHero.php";
include "../configdb/connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes de réservation</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="custom text-white">
    <main>
        <div class="container mt-4">
            <ul class="nav nav-pills mb-3 justify-content-center" id="admin-nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="admin.php" class="nav-link">Planning</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="admin_demandes.php" class="nav-link active" aria-current="page">Demandes</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="admin_ajouter.php" class="nav-link">Ajouter du matériel</a>
                </li>
            </ul>
            <h2 class="text-light mb-4">Demandes de réservation</h2>
            <div class="row g-4">
                <?php
                $sql_demandes = "SELECT d.*, u.ID_utilisateur 
                               FROM reservation_demande d 
                               LEFT JOIN utilisateur u ON d.identifiant_demande = u.identifiant";
                $stmt_demandes = $pdo->query($sql_demandes);
                $hasDemande = false;
                while ($demande = $stmt_demandes->fetch(PDO::FETCH_ASSOC)):
                    $hasDemande = true;
                    $identifiant = explode('.', $demande['identifiant_demande']);
                    $prenom = $identifiant[0];
                    $nom = $identifiant[1];
                ?>
                <div class="col-12">
                    <section class="demande-card text-dark bg-light rounded-3 p-3" aria-label="Demande de réservation">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0">Demande n°<?php echo htmlspecialchars($demande['ID_demande']); ?></h5>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <strong>Nom :</strong> <?php echo htmlspecialchars($nom); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Prénom :</strong> <?php echo htmlspecialchars($prenom); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Email :</strong> <?php echo htmlspecialchars($demande['Mail_demande']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Numéro d'étudiant :</strong> <?php echo htmlspecialchars($demande['Num_etudiant']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Date d'accès souhaitée :</strong> <?php echo htmlspecialchars($demande['date_demande']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Année MMI / autres :</strong> <?php echo htmlspecialchars($demande['Num_annee']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Heure d'accès :</strong> <?php echo htmlspecialchars($demande['H_acces']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Heure de fin :</strong> <?php echo htmlspecialchars($demande['H_arrive']); ?>
                            </div>
                            <div class="col-md-12">
                                <strong>Nom des étudiants concernés / Personnel :</strong> <?php echo htmlspecialchars($demande['e_concerne_d']); ?>
                            </div>
                            <div class="col-md-12">
                                <strong>Projet :</strong> <?php echo htmlspecialchars($demande['Motif_demande']); ?>
                            </div>
                            <div class="col-md-12">
                                <strong>Matériel / salle :</strong> 
                                <?php 
                                $details = [];
                                if ($demande['salle_d']) $details[] = 'Salle ' . $demande['salle_d'];
                                if ($demande['materiel_d']) $details[] = $demande['materiel_d'];
                                echo htmlspecialchars(implode(', ', $details));
                                ?>
                            </div>
                        </div>
                        <div class="demande-actions">
                            <button type="button" class="btn btn-success btn-lg" 
                                    onclick="ouvrirAcceptModal(<?php echo $demande['ID_demande']; ?>, <?php echo $demande['ID_utilisateur']; ?>)">
                                Accepter
                            </button>
                            <button type="button" class="btn btn-danger btn-lg" 
                                    onclick="ouvrirRefusModal(<?php echo $demande['ID_demande']; ?>)">
                                Refuser
                            </button>
                        </div>
                    </section>
                </div>
                <?php endwhile; ?>
                <?php if (!$hasDemande): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center fs-4 mt-5">Aucune demande de réservation en attente.</div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Modal de confirmation d'acceptation -->
        <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel">Confirmer l'acceptation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir accepter cette demande ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-success" id="confirmerAcceptBtn">Accepter</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de confirmation de refus -->
        <div class="modal fade" id="refusModal" tabindex="-1" aria-labelledby="refusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="refusModalLabel">Confirmer le refus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir refuser cette demande ? Cette action est irréversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" id="confirmerRefusBtn">Refuser</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de succès -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Succès</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body" id="successModalBody">
                        <!-- Message de succès injecté ici -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        let demandeARefuser = null;
        let demandeAAccepter = null;
        let utilisateurAAccepter = null;
        function ouvrirAcceptModal(idDemande, idUtilisateur) {
            demandeAAccepter = idDemande;
            utilisateurAAccepter = idUtilisateur;
            var acceptModal = new bootstrap.Modal(document.getElementById('acceptModal'));
            acceptModal.show();
        }
        document.getElementById('confirmerAcceptBtn').onclick = function() {
            if (demandeAAccepter && utilisateurAAccepter) {
                accepterDemande(demandeAAccepter, utilisateurAAccepter);
                demandeAAccepter = null;
                utilisateurAAccepter = null;
                var acceptModal = bootstrap.Modal.getInstance(document.getElementById('acceptModal'));
                acceptModal.hide();
            }
        };
        function ouvrirRefusModal(idDemande) {
            demandeARefuser = idDemande;
            var refusModal = new bootstrap.Modal(document.getElementById('refusModal'));
            refusModal.show();
        }
        document.getElementById('confirmerRefusBtn').onclick = function() {
            if (demandeARefuser) {
                refuserDemande(demandeARefuser);
                demandeARefuser = null;
                var refusModal = bootstrap.Modal.getInstance(document.getElementById('refusModal'));
                refusModal.hide();
            }
        };
        function showSuccessModal(message) {
            document.getElementById('successModalBody').textContent = message;
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            // Recharge la page après 2 secondes ou à la fermeture de la modale
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function reloadOnce() {
                location.reload();
                document.getElementById('successModal').removeEventListener('hidden.bs.modal', reloadOnce);
            });
            setTimeout(() => {
                successModal.hide();
            }, 2000);
        }
        function accepterDemande(idDemande, idUtilisateur) {
            fetch('traitement_demande.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=accepter&id_demande=${idDemande}&id_utilisateur=${idUtilisateur}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessModal('Demande acceptée avec succès !');
                } else {
                    alert('Erreur lors de l\'acceptation de la demande : ' + data.message);
                }
            });
        }
        function refuserDemande(idDemande) {
            fetch('traitement_demande.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=refuser&id_demande=${idDemande}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessModal('Demande refusée avec succès !');
                } else {
                    alert('Erreur lors du refus de la demande : ' + data.message);
                }
            });
        }
        </script>
        <section class="extra-space"></section>
    </main>
    <footer>
        <?php include "../include/footer.php"; ?>
    </footer>
</body>
</html>