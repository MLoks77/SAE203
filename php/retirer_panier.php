<?php

session_start();

if (isset($_POST['index']) && isset($_SESSION['panier'][$_POST['index']])) {
    unset($_SESSION['panier'][$_POST['index']]);
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    echo 'success';
} else {
    echo 'error';
}