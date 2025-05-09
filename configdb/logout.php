<?php
session_start();
session_destroy();

header("Location: ../index.php");
?>

/**
 * TODO: Ce code devra être refait pour une meilleure implémentation.
 * Actuellement, il permet de supprimer la session et de se déconnecter.
 * faire en sorte qu'il redirige vers connexion.php
 */

 