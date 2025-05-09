<?php
session_start();
$valid_user = "admin";
$valid_pass = "1234";

if ($_POST['username'] === $valid_user && $_POST['password'] === $valid_pass) {
    $_SESSION['admin'] = true;
    header('Location: ../php/accueil.php');
} else {
    echo "<p>Identifiants incorrects.</p><a href='admin.php'>Retour</a>";
}
?>