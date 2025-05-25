


<!-- Il y a 2 index pour régler un bug concernant la vrai première page, celle ci n'est pas la vrai première page, la vrai est en dehors de ce dossier -->

<?php session_start()?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header>
        <img src="image/images.png" alt="Logo Université Gustave Eiffel" class="logo">
    </header>
    <div class="container">
        <div class="image">
            <img src="image/main_batimentensginterieurcagencepwp.jpeg" alt="Photo bâtiment">
        </div>
        <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1): ?>
            <script>alert("Identifiant ou mot de passe incorrect.");    </script>
        <?php endif; ?>
        <div class="formulaire">
            <h1>Connexion</h1>
            <form action="configdb/check_login.php" method="post">
                <label for="identifiant">Identifiant</label>
                <input type="text" id="identifiant" name="Identifiant" required>
                <div style="position: relative;">
                    <label for="mdp">Mot de passe</label><br>
                    <input type="password" id="mdp" name="Mot_de_passe" required>
                    <i class="fa-solid fa-eye" id="toggleConnexion" style="position: absolute; right: 10px; top: 38px; cursor: pointer;"></i>
                </div>
                <div class="options">
                    <input type="checkbox" id="souvenir">
                    <label for="souvenir">Se souvenir de moi</label>
                </div>
                <div class="liens">
                    <a href="php/inscription.php">Vous n'avez pas de compte ?</a>
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <button type="submit" name="envoyer">Connexion</button>
            </form>
        </div>
    </div>
    <?php include "include/footerindex.php" ?>
    <script src="./js/index.js"></script>
</body>

</html>