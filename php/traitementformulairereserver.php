<?php
session_start();
include "../configdb/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération sécurisée des données
    $identifiant = $_POST['identifiant'] ?? null;
    $mail = $_POST['email'] ?? null;
    $num_etudiant = $_POST['numero_etudiant'] ?? null;
    $date_acces = $_POST['date_acces'] ?? null;
    $heure_acces = $_POST['heure_acces'] ?? null;
    $heure_remisee = $_POST['heure_remisee'] ?? null;
    $annee_etude = $_POST['annee_etude'] ?? null;
    $motif_demande = $_POST['projet'] ?? null; // tu peux adapter ce champ
    $date_demande = date('Y-m-d'); // date actuelle

    // Attention : Num_annee dans ta table est un int(1), alors on va extraire le numéro dans "MMI1" par exemple
    // Exemple : si $annee_etude = "MMI1", on récupère le dernier caractère
    $num_annee = $_POST['annee_etude'];

    // Prépare ta requête d'insertion
    $sql = "INSERT INTO reservation_demande 
        (date_demande, Mail_demande, Date_acces, H_acces, H_arrive, Motif_demande, Num_etudiant, Num_annee, identifiant_demande) 
        VALUES 
        (:date_demande, :mail, :date_acces, :h_acces, :h_arrive, :motif, :num_etudiant, :num_annee, :identifiant)";

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
    ]);

    header("location:compte.php"); // redirection au hazard pour l'instant
}
