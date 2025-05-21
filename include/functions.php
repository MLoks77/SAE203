<?php
function includeNavbarParRole($role) {
    switch ($role) {
        case 'admin':
            include "../include/navbaradmin.php";


            break;
        case 'etudiant':
        case 'enseignant':
            include "../include/navbar.php";
            break;
        case 'agent':
            include "../include/navbar.php"; // Si tu as une navbar spécifique agent
            break;
        default:
            include "../include/navbar.php"; //  si rôle inconnu
            break;
    }
}
?>
