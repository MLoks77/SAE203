<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SESSION['role'] == 'admin') {
    include "../include/navbaradmin.php";
} else {
    include "../include/navbar.php";
}

include "../include/CompteHero.php";
include "../configdb/connexion.php";

$id = $_SESSION['utilisateur_id'];
$sql = "SELECT * FROM utilisateur WHERE ID_utilisateur = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='alert alert-danger'>Utilisateur introuvable.</div>";
    exit;
}

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $prenom = htmlspecialchars($_POST['Prenom']);
    $nom = htmlspecialchars($_POST['Nom']);
    $mail = htmlspecialchars($_POST['Mail']);
    $date_naissance = $_POST['Date_naissance'];
    $adresse = htmlspecialchars($_POST['Adresse']);
    $n_etudiant = !empty($_POST['n_etudiant']) ? htmlspecialchars($_POST['n_etudiant']) : null;
    $mot_de_passe = !empty($_POST['Mot_de_passe']) ? password_hash($_POST['Mot_de_passe'], PASSWORD_DEFAULT) : $user['Mot_de_passe'];

    $sqlUpdate = "UPDATE utilisateur SET Prenom=?, Nom=?, Mail=?, Date_naissance=?, Adresse=?, n_etudiant=?, Mot_de_passe=? WHERE ID_utilisateur=?";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([$prenom, $nom, $mail, $date_naissance, $adresse, $n_etudiant, $mot_de_passe, $id]);
    // Mise à jour de la session avec les nouvelles valeurs
    $_SESSION['Prenom'] = $prenom;
    $_SESSION['Nom'] = $nom;
    $_SESSION['Mail'] = $mail;
    $_SESSION['n_etudiant'] = $n_etudiant;
    $_SESSION['Adresse'] = $adresse;
    header("Location: compte.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-fond">
<main>
    <section class="extra-space" aria-hidden="true"></section>
    <div class="container mt-5 mb-5">
        <h1 class="mb-4 text-light text-center">Mon Compte</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">Modifications enregistrées !</div>
        <?php endif; ?>
        <form method="post" autocomplete="off" aria-label="Formulaire de gestion du compte">
            <fieldset class="card mb-4">
                <legend class="card-header h5 mb-0">Informations générales</legend>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstName" name="Prenom" value="<?= htmlspecialchars($user['Prenom']) ?>" required autocomplete="given-name">
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="lastName" name="Nom" value="<?= htmlspecialchars($user['Nom']) ?>" required autocomplete="family-name">
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" id="dob" name="Date_naissance" value="<?= htmlspecialchars($user['Date_naissance'] ?? '') ?>" required autocomplete="bday">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="Mail" value="<?= htmlspecialchars($user['Mail']) ?>" required autocomplete="email">
                    </div>
                    <div class="col-md-6">
                        <label for="n_etudiant" class="form-label">Numéro étudiant</label>
                        <input type="text" class="form-control" id="n_etudiant" name="n_etudiant" value="<?= htmlspecialchars($user['n_etudiant'] ?? '') ?>" aria-describedby="nEtudiantHelp">
                        <div id="nEtudiantHelp" class="form-text">Laisser vide si non concerné.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Adresse postale</label>
                        <input type="text" class="form-control" id="address" name="Adresse" value="<?= htmlspecialchars($user['Adresse'] ?? '') ?>" autocomplete="street-address">
                    </div>
                </div>
            </fieldset>
            <fieldset class="card mb-4">
                <legend class="card-header h5 mb-0">Sécurité</legend>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user['Identifiant']) ?>" readonly aria-readonly="true" tabindex="-1">
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label">Rôle</label>
                        <input type="text" class="form-control" id="role" value="<?= htmlspecialchars($user['role']) ?>" readonly aria-readonly="true" tabindex="-1">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="Mot_de_passe" placeholder="Laisser vide pour ne pas changer" aria-describedby="passwordHelp">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword" aria-label="Afficher ou masquer le mot de passe">Afficher</button>
                        </div>
                        <div id="passwordHelp" class="form-text">Laisser vide pour conserver le mot de passe actuel.</div>
                    </div>
                </div>
            </fieldset>
            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="compte.php" class="btn btn-danger" aria-label="Annuler les modifications">Annuler</a>
                <button type="submit" name="update" class="btn btn-success" aria-label="Enregistrer les modifications">Enregistrer</button>
            </div>
        </form>
    </div>
    <section class="extra-space" aria-hidden="true"></section>
</main>
<?php include "../include/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Accessibilité : gestion de l'affichage du mot de passe
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Afficher' : 'Masquer';
    });
</script>
</body>
</html>
