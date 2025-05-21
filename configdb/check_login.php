<?php
session_start();
include_once '../configdb/connexion.php';
if(isset($_POST['envoyer'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = $_POST['Identifiant'];
    $mot_de_passe = $_POST['Mot_de_passe'];

    // Requête pour trouver l'utilisateur
    $sql = "SELECT * FROM Utilisateur WHERE Identifiant = :Identifiant";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['Identifiant' => $identifiant]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['Mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['utilisateur_id'] = $utilisateur['ID_utilisateur'];
        $_SESSION['identifiant'] = $utilisateur['Identifiant'];
        $_SESSION['role'] = $utilisateur['role'];

        echo "Connexion réussie !";
        // Redirection vers une page protégée
        header("Location: ../php/accueil.php");
        exit;
    } else {
        header("Location: ../index.php?erreur=1");
        }
    }
}
?>