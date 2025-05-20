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
        <div class="formulaire">
            <h1>Connexion</h1>
            <form action="index.php" method="post">
                <label for="identifiant">Identifiant</label>
                <input type="text" id="identifiant" name="identifiant">

                <div style="position: relative;">
                  <label for="mdp">Mot de passe</label><br>
                  <input type="password" id="mdp" name="mdp" required>
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

                <button type="submit">Connexion</button>
            </form>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<?php include "include/footerindex.php" ?>

<script>
  const toggleConnexion = document.getElementById('toggleConnexion');
  const mdpInput = document.getElementById('mdp');

  toggleConnexion.addEventListener('click', () => {
    const type = mdpInput.type === 'password' ? 'text' : 'password';
    mdpInput.type = type;
    toggleConnexion.classList.toggle('fa-eye');
    toggleConnexion.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>
