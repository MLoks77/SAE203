<?php

session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_POST['id'], $_POST['nom'], $_POST['quantite'], $_POST['type'])) {
    $item = [
        'id' => $_POST['id'],
        'nom' => $_POST['nom'],
        'quantite' => $_POST['quantite'],
        'type' => $_POST['type'] // 'salle' ou 'materiel'
    ];
    $_SESSION['panier'][] = $item;
}

header('Location: formulaireReserver.php');
exit();
?>
