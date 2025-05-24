<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

include "../configdb/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id_demande = $_POST['id_demande'] ?? 0;

    if ($action === 'accepter') {
        try {
            // Récupérer les informations de la demande
            $sql_demande = "SELECT * FROM reservation_demande WHERE ID_demande = ?";
            $stmt_demande = $pdo->prepare($sql_demande);
            $stmt_demande->execute([$id_demande]);
            $demande = $stmt_demande->fetch(PDO::FETCH_ASSOC);

            if (!$demande) {
                throw new Exception('Demande non trouvée');
            }

            // Insérer dans la table reservation
            $sql_insert = "INSERT INTO reservation (Date, Motif, ID_utilisateur, salle, materiel, H_debut, H_fin, e_concerne) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->execute([
                $demande['date_demande'],
                $demande['Motif_demande'],
                $_POST['id_utilisateur'],
                $demande['salle_d'],
                $demande['materiel_d'],
                $demande['H_acces'],
                $demande['H_arrive'],
                $demande['e_concerne_d']
            ]);

            // Supprimer la demande
            $sql_delete = "DELETE FROM reservation_demande WHERE ID_demande = ?";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([$id_demande]);

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } elseif ($action === 'refuser') {
        try {
            // Récupérer les informations de la demande
            $sql_demande = "SELECT * FROM reservation_demande WHERE ID_demande = ?";
            $stmt_demande = $pdo->prepare($sql_demande);
            $stmt_demande->execute([$id_demande]);
            $demande = $stmt_demande->fetch(PDO::FETCH_ASSOC);

            if (!$demande) {
                throw new Exception('Demande non trouvée');
            }

            // Insérer dans la table reservation_refus
            $sql_insert = "INSERT INTO reservation_refus (date_demande, ID_demande, Mail_demande, Date_acces, H_acces, H_arrive, Motif_demande, Num_etudiant, Num_annee, identifiant_demande, salle_d, materiel_d, e_concerne_d) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->execute([
                $demande['date_demande'],
                $demande['ID_demande'],
                $demande['Mail_demande'],
                $demande['Date_acces'],
                $demande['H_acces'],
                $demande['H_arrive'],
                $demande['Motif_demande'],
                $demande['Num_etudiant'],
                $demande['Num_annee'],
                $demande['identifiant_demande'],
                $demande['salle_d'],
                $demande['materiel_d'],
                $demande['e_concerne_d']
            ]);

            // Supprimer la demande de la table reservation_demande
            $sql_delete = "DELETE FROM reservation_demande WHERE ID_demande = ?";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([$id_demande]);

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}