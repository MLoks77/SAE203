<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
if ($_SESSION['role'] == 'admin') {
    include "../include/navbaradmin.php";
} elseif ($_SESSION['role'] == 'etudiant' || $_SESSION['role'] == 'enseignant') {
    include "../include/navbar.php";
} elseif ($_SESSION['role'] == 'agent') {
    include "../include/navbar.php"; 
} else {
    include "../include/navbar.php"; 
}

include "../include/AdminHero.php";
include "../configdb/connexion.php";

// Suppression matériel
if (isset($_POST['supprimer_materiel']) && isset($_POST['id_materiel'])) {
    $id = intval($_POST['id_materiel']);
    for ($i = 1; $i <= 3; $i++) {
        $image_path = "../image/" . $id . "_" . $i . ".jpg";
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    $sql = "DELETE FROM materiel WHERE ID_materiel = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}
// Suppression salle
if (isset($_POST['supprimer_salle']) && isset($_POST['id_salle'])) {
    $id = intval($_POST['id_salle']);
    $image_path = "../image/Salle" . $id . ".jpg";
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    $sql = "DELETE FROM salle WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}
// Ajout matériel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajout_materiel'])) {
    $reference = trim($_POST['reference']);
    $type = $_POST['type'];
    $date_achat = $_POST['date_achat'];
    $etat = $_POST['etat'];
    $descriptif = trim($_POST['descriptif']);
    $sql = "INSERT INTO materiel (Reference, Type, Date_achat, Etat_global, Descriptif) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reference, $type, $date_achat, $etat, $descriptif]);
    $id_materiel = $pdo->lastInsertId();
    if (isset($_FILES['images'])) {
        $upload_dir = "../image/";
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $filename = $id_materiel . "_" . ($key + 1) . ".jpg";
                move_uploaded_file($tmp_name, $upload_dir . $filename);
            }
        }
    }
}
// Ajout salle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajout_salle'])) {
    $descriptif = trim($_POST['descriptif_salle']);
    $etat = $_POST['etat_salle'];
    $sql = "INSERT INTO salle (Descriptif, Etat) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$descriptif, $etat]);
    $id_salle = $pdo->lastInsertId();
    if (isset($_FILES['image_salle'])) {
        $upload_dir = "../image/";
        $filename = "Salle" . $id_salle . ".jpg";
        move_uploaded_file($_FILES['image_salle']['tmp_name'], $upload_dir . $filename);
    }
}

// PAGINATION
$max_per_page = 5;
// Pagination matériel
$page_materiel = isset($_GET['page_materiel']) ? max(1, intval($_GET['page_materiel'])) : 1;
$total_materiel = $pdo->query("SELECT COUNT(*) FROM materiel")->fetchColumn();
$total_pages_materiel = ceil($total_materiel / $max_per_page);
$offset_materiel = ($page_materiel - 1) * $max_per_page;
$materiels = $pdo->query("SELECT * FROM materiel ORDER BY ID_materiel DESC LIMIT $max_per_page OFFSET $offset_materiel")->fetchAll();
// Pagination salle
$page_salle = isset($_GET['page_salle']) ? max(1, intval($_GET['page_salle'])) : 1;
$total_salle = $pdo->query("SELECT COUNT(*) FROM salle")->fetchColumn();
$total_pages_salle = ceil($total_salle / $max_per_page);
$offset_salle = ($page_salle - 1) * $max_per_page;
$salles = $pdo->query("SELECT * FROM salle ORDER BY ID DESC LIMIT $max_per_page OFFSET $offset_salle")->fetchAll();
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Admin</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-bleu">
<div class="container mt-4 bg-bleu">
        <ul class="nav nav-pills mb-3 justify-content-center" id="admin-nav">
            <li class="nav-item" role="presentation">
                <a href="admin.php" class="nav-link">Planning</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="admin_demandes.php" class="nav-link">Demandes</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="admin_ajouter.php" class="nav-link active">Ajouter du matériel</a>
            </li>
        </ul>
</div>
<div class="container mt-5 bg-light p-5 rounded-3">
    <!-- Formulaire d'ajout de matériel -->
    <form method="post" enctype="multipart/form-data" class="mb-5">
        <h2>Ajouter du matériel</h2>
        <div class="mb-3">
            <label>Référence</label>
            <input type="text" name="reference" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="Casque">Casque</option>
                <option value="Multimédia">Multimédia</option>
                <option value="Audiovisuelle">Audiovisuelle</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Date d'achat</label>
            <input type="date" name="date_achat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>État</label>
            <select name="etat" class="form-control" required>
                <option value="Neuf">Neuf</option>
                <option value="Excellent">Excellent</option>
                <option value="Super">Super</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Descriptif</label>
            <textarea name="descriptif" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Images (3 maximum)</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
        </div>
        <section class="extra-space"></section>
        <button type="submit" name="ajout_materiel" class="btn btn-success">Ajouter le matériel</button>
    </form>
    <hr>
    <!-- Formulaire d'ajout de salle -->
    <form method="post" enctype="multipart/form-data">
        <h2>Ajouter une salle</h2>
        <div class="mb-3">
            <label>Descriptif</label>
            <textarea name="descriptif_salle" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>État</label>
            <select name="etat_salle" class="form-control" required>
                <option value="Excellent">Excellent</option>
                <option value="Très bon état">Très bon état</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Image de la salle</label>
            <input type="file" name="image_salle" class="form-control" accept="image/*" required>
        </div>
        <section class="extra-space"></section>
        <button type="submit" name="ajout_salle" class="btn btn-success">Ajouter la salle</button>
    </form>
    <section class="extra-space"></section>
    <hr>
    <!-- Liste du matériel -->
    <h2>Liste du matériel existant</h2>
    <table class="table table-bordered table-striped align-middle shadow-sm rounded-3 overflow-hidden">
        <thead class="table-dark">
            <tr>
                <th>Référence</th>
                <th>Type</th>
                <th>Date d'achat</th>
                <th>État</th>
                <th>Descriptif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materiels as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['Reference']) ?></td>
                    <td><?= htmlspecialchars($m['Type']) ?></td>
                    <td><?= htmlspecialchars($m['Date_achat']) ?></td>
                    <td><?= htmlspecialchars($m['Etat_global']) ?></td>
                    <td><?= htmlspecialchars($m['Descriptif']) ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Supprimer ce matériel ?');" style="display:inline;">
                            <input type="hidden" name="id_materiel" value="<?= $m['ID_materiel'] ?>">
                            <button type="submit" name="supprimer_materiel" class="btn btn-danger text-light btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination-container d-flex justify-content-between align-items-center mt-4 mb-4 p-3 bg-light rounded-3 shadow-sm">
        <div class="pagination-info">
            <?php
            $startIndex = $total_materiel ? $offset_materiel + 1 : 0;
            $endIndex = min($offset_materiel + $max_per_page, $total_materiel);
            ?>
            Affichage de <?= $startIndex ?> à <?= $endIndex ?> sur <?= $total_materiel ?> matériels
        </div>
        <nav aria-label="Pagination matériel">
            <ul class="pagination mb-0">
                <li class="page-item<?= ($page_materiel == 1) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=1&page_salle=<?= $page_salle ?>#" aria-label="Première page">&laquo;</a>
                </li>
                <li class="page-item<?= ($page_materiel == 1) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= max(1, $page_materiel-1) ?>&page_salle=<?= $page_salle ?>#" aria-label="Page précédente">&lt;</a>
                </li>
                <li class="page-item disabled"><span class="page-link bg-light text-dark">Page <?= $page_materiel ?> / <?= $total_pages_materiel ?></span></li>
                <li class="page-item<?= ($page_materiel == $total_pages_materiel) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= min($total_pages_materiel, $page_materiel+1) ?>&page_salle=<?= $page_salle ?>#" aria-label="Page suivante">&gt;</a>
                </li>
                <li class="page-item<?= ($page_materiel == $total_pages_materiel) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= $total_pages_materiel ?>&page_salle=<?= $page_salle ?>#" aria-label="Dernière page">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
    <section class="extra-space"></section>
    <hr>
    <section class="extra-space"></section>
    <h2>Liste des salles existantes</h2>
    <table class="table table-bordered table-striped align-middle shadow-sm rounded-3 overflow-hidden">
        <thead class="table-dark text-light">
            <tr>
                <th>ID</th>
                <th>Descriptif</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salles as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['ID']) ?></td>
                    <td><?= htmlspecialchars($s['Descriptif']) ?></td>
                    <td><?= htmlspecialchars($s['Etat']) ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Supprimer cette salle ?');" style="display:inline;">
                            <input type="hidden" name="id_salle" value="<?= $s['ID'] ?>">
                            <button type="submit" name="supprimer_salle" class="btn btn-danger text-light btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Pagination salles -->
    <div class="pagination-container d-flex justify-content-between align-items-center mt-4 mb-4 p-3 bg-light rounded-3 shadow-sm">
    <div class="pagination-info">
            <?php
            $startIndexSalle = $total_salle ? $offset_salle + 1 : 0;
            $endIndexSalle = min($offset_salle + $max_per_page, $total_salle);
            ?>
            Affichage de <?= $startIndexSalle ?> à <?= $endIndexSalle ?> sur <?= $total_salle ?> salles
        </div>
        <nav aria-label="Pagination salles">
            <ul class="pagination mb-0">
                <li class="page-item<?= ($page_salle == 1) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= $page_materiel ?>&page_salle=1#" aria-label="Première page">&laquo;</a>
                </li>
                <li class="page-item<?= ($page_salle == 1) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= $page_materiel ?>&page_salle=<?= max(1, $page_salle-1) ?>#" aria-label="Page précédente">&lt;</a>
                </li>
                <li class="page-item disabled"><span class="page-link bg-light text-dark">Page <?= $page_salle ?> / <?= $total_pages_salle ?></span></li>
                <li class="page-item<?= ($page_salle == $total_pages_salle) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= $page_materiel ?>&page_salle=<?= min($total_pages_salle, $page_salle+1) ?>#" aria-label="Page suivante">&gt;</a>
                </li>
                <li class="page-item<?= ($page_salle == $total_pages_salle) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-light" href="?page_materiel=<?= $page_materiel ?>&page_salle=<?= $total_pages_salle ?>#" aria-label="Dernière page">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<section class="extra-space"></section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "../include/footer.php"; ?>
