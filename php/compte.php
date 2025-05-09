<?php
session_start();

include "../include/navbar.php";
/**include "../include/navbaradmin.php"; mettre le code pour choisir suivant l'ID de l'utilisateur connecté **/
include "../include/CompteHero.php" ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body class="bg-fond">
<section class="extra-space"></section>
<div class="container mt-5">
    <h2 class="mb-4 text-light">Mon Compte</h2>
    <div class="card mb-4">
        <div class="card-header">
            Général
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="firstName" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstName" value="Jean">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="dob" value="1990-01-01">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastName" value="Dupont">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="jean.dupont@example.com">
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-danger">Annuler</button>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section Sécurité -->
    <div class="card mb-4">
        <div class="card-header">
            Sécurité
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="username" value="jdupont">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <input type="text" class="form-control" id="role" value="Utilisateur">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" value="motdepasse">
                        <button type="button" class="btn card" id="togglePassword">
                            Afficher
                        </button>
                    </div>
                </div>
                <script>
                    document.getElementById('togglePassword').addEventListener('click', function () {
                        const passwordField = document.getElementById('password');
                        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordField.setAttribute('type', type);
                        this.textContent = type === 'password' ? 'Afficher' : 'Masquer';
                    });
                </script>
                <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section Localisation -->
    <div class="card mb-4">
        <div class="card-header">
            Localisation
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse Postale</label>
                    <input type="text" class="form-control" id="address" value="123 Rue Exemple, Paris">
                </div>
                <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

</div>
<section class="extra-space"></section>
<section class="extra-space"></section>
<?php include "../include/footer.php"; ?>
</body>
</html>
