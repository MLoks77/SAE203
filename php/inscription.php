<?php session_start(); 
include "../configdb/connexion.php"
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Université Gustave Eiffel - Créer votre compte</title>
  <link rel="stylesheet" href="../css/inscription.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
  <div class="page-inscription">
    <header>
      <div class="logo">
        <div class="icone-universite">
          <img src="../image/images.png" alt="Logo Université Gustave Eiffel" width="200">
        </div>
      </div>
      <h1>Créer votre compte</h1>
    </header>
    <main>
      <div class="bloc-inscription">
        <div class="image-campus">
          <img src="../image/27_mo-panoramique-2010-500px.jpg" alt="batiment">
        </div>

        <form class="formulaire">
          <div class="grille">
            <div class="prenom">
              <label for="firstname">Prénom</label>
              <input type="text" id="firstname" required>
            </div>

            <div class="role">
              <label for="role">Rôle</label>
              <input type="text" id="role" required>
            </div>

            <div class="nom">
              <label for="lastname">Nom</label>
              <input type="text" id="lastname" required>
            </div>

            <div class="identifiant">
              <label for="identifier">Identifiant</label>
              <input type="text" id="identifier" required>
            </div>

            <div class="email">
              <label for="email">Email</label>
              <input type="email" id="email" required>
            </div>

            <div class="mot-de-passe" style="position: relative;">
              <label for="password">Mot de passe</label>
              <input type="password" id="password" required>
              <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 38px; cursor: pointer;"></i>
            </div>


            <div class="date-naissance">
              <label for="birthdate">Date de naissance</label>
              <input type="date" id="date-naissance" name="date-naissance" required>
              <div class="date">
              </div>
            </div>

            <div class="confirmation" style="position: relative;">
              <label for="confirm-password">Confirmez votre mot de passe</label>
              <input type="password" id="confirm-password" required>
              <i class="fa-solid fa-eye" id="toggleConfirm" style="position: absolute; right: 10px; top: 38px; cursor: pointer;"></i>
            </div>
          </div>

          <div class="actions">
            <a href="../index.php" class="lien-connexion">S'identifier ?</a>
            <button type="submit" class="bouton-creer">Créer</button>
          </div>
        </form>
      </div>
    </main>
  </div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <?php include "../include/footer.php" ?>

<script>
  // Pour le mot de passe principal
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
  });

  // Pour la confirmation
  const toggleConfirm = document.getElementById('toggleConfirm');
  const confirmInput = document.getElementById('confirm-password');

  toggleConfirm.addEventListener('click', () => {
    const type = confirmInput.type === 'password' ? 'text' : 'password';
    confirmInput.type = type;
    toggleConfirm.classList.toggle('fa-eye');
    toggleConfirm.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>