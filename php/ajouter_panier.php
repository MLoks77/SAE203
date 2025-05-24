<?php

session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_POST['id'], $_POST['nom'], $_POST['quantite'])) {
    $item = [
        'id' => $_POST['id'],
        'nom' => $_POST['nom'],
        'quantite' => $_POST['quantite']
    ];
    $_SESSION['panier'][] = $item;
}

header('Location: formulaireReserver.php');
exit();
?>
