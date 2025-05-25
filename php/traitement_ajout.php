<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

include "../configdb/connexion.php";

// Traitement de l'ajout de matériel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajout_materiel'])) {
    $reference = trim($_POST['reference']);
    $type = $_POST['type'];
    $date_achat = $_POST['date_achat'];
    $etat = $_POST['etat'];
    $descriptif = trim($_POST['descriptif']);

    try {
        $pdo->beginTransaction();

        // Insertion du matériel
        $sql = "INSERT INTO materiel (Reference, Type, Date_achat, Etat_global, Descriptif) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reference, $type, $date_achat, $etat, $descriptif]);
        $id_materiel = $pdo->lastInsertId();

        // Traitement des images
        if (isset($_FILES['images'])) {
            $upload_dir = "../image/";
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $filename = $id_materiel . "_" . ($key + 1) . ".jpg";
                    $filepath = $upload_dir . $filename;
                    
                    // Déplacer l'image
                    if (move_uploaded_file($tmp_name, $filepath)) {
                        // Insérer le chemin dans la base de données
                        $sql_image = "INSERT INTO images_materiel (ID_materiel, chemin_image, ordre) VALUES (?, ?, ?)";
                        $stmt_image = $pdo->prepare($sql_image);
                        $stmt_image->execute([$id_materiel, $filename, $key + 1]);
                    }
                }
            }
        }

        $pdo->commit();
        header("Location: admin_ajouter.php?success=1");
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: admin_ajouter.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}

// Traitement de l'ajout de salle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajout_salle'])) {
    $id_salle = intval($_POST['id_salle']);
    $descriptif = trim($_POST['descriptif_salle']);
    $etat = $_POST['etat_salle'];

    try {
        $pdo->beginTransaction();

        // Vérifier si l'ID de salle existe déjà
        $check = $pdo->prepare("SELECT COUNT(*) FROM salle WHERE ID = ?");
        $check->execute([$id_salle]);
        if ($check->fetchColumn() > 0) {
            throw new Exception("L'ID de salle existe déjà.");
        }

        // Insertion de la salle
        $sql = "INSERT INTO salle (ID, Descriptif, Etat) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_salle, $descriptif, $etat]);

        // Traitement de l'image
        if (isset($_FILES['image_salle']) && $_FILES['image_salle']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = "../image/";
            $filename = "Salle" . $id_salle . ".jpg";
            $filepath = $upload_dir . $filename;

            // Déplacer l'image
            if (move_uploaded_file($_FILES['image_salle']['tmp_name'], $filepath)) {
                // Insérer le chemin dans la base de données
                $sql_image = "INSERT INTO images_salle (ID_salle, chemin_image, ordre) VALUES (?, ?, ?)";
                $stmt_image = $pdo->prepare($sql_image);
                $stmt_image->execute([$id_salle, $filename, 1]);
            }
        }

        $pdo->commit();
        header("Location: admin_ajouter.php?success=1");
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: admin_ajouter.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}

// Redirection par défaut
header("Location: admin_ajouter.php");
exit;
