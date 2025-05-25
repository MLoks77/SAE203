<?php
session_start();
include "../configdb/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identifiant = $_POST['identifiant'] ?? null;
    $mail = $_POST['email'] ?? null;
    $num_etudiant = $_POST['numero_etudiant'] ?? null;
    $date_acces = $_POST['date_acces'] ?? null;
    $heure_acces = $_POST['heure_acces'] ?? null;
    $heure_remisee = $_POST['heure_remisee'] ?? null;
    $annee_etude = $_POST['annee_etude'] ?? null;
    $motif_demande = $_POST['projet'] ?? null; 
    $date_demande = date('Y-m-d'); 
    $etudiants_concerne = $_POST['etudiant_concerne'] ?? null;

    // Récupération des informations du panier
    $salle = null;
    $materiel = null;
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $item) {
            if (isset($item['type']) && $item['type'] === 'salle') {
                $salle = $item['id'];
            } elseif (isset($item['type']) && $item['type'] === 'materiel') {
                $materiel = $item['id'];
            }
        }
    }

    $num_annee = $_POST['annee_etude'];

    $sql = "INSERT INTO reservation_demande 
        (date_demande, Mail_demande, Date_acces, H_acces, H_arrive, Motif_demande, Num_etudiant, Num_annee, identifiant_demande, salle_d, materiel_d, e_concerne_d) 
        VALUES 
        (:date_demande, :mail, :date_acces, :h_acces, :h_arrive, :motif, :num_etudiant, :num_annee, :identifiant, :salle, :materiel, :etudiants_concerne)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':date_demande' => $date_demande,
        ':mail' => $mail,
        ':date_acces' => $date_acces,
        ':h_acces' => $heure_acces,
        ':h_arrive' => $heure_remisee,
        ':motif' => $motif_demande,
        ':num_etudiant' => $num_etudiant,
        ':num_annee' => $num_annee,
        ':identifiant' => $identifiant,
        ':salle' => $salle,
        ':materiel' => $materiel,
        ':etudiants_concerne' => $etudiants_concerne
    ]);

    // Vider le panier après la réservation
    unset($_SESSION['panier']);

    header("location:compte.php");
}
