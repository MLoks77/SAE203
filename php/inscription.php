
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

        <form class="formulaire" method="POST" action="../php/traitement_inscription.php">
          <div class="grille">
            <div class="prenom">
              <label for="firstname">Prénom</label>
              <input type="text" id="prenom" name="Prenom" required>
            </div>

            <div class="role">
              <label for="role">Rôle</label>
                <select id="role" name="rôle" required>
                <option value="" disabled selected>Choisissez votre rôle</option>
                <option value="etudiant">Étudiant</option>
                <option value="enseignant">Enseignant</option>
                <option value="agent">Agent</option>
                <option value="admin">Admin</option>
                </select>
            </div>

            <div class="nom">
              <label for="lastname">Nom</label>
              <input type="text" id="lastname" name="Nom" required>
            </div>

            <div class="identifiant">
              <label for="identifier">Identifiant</label>
              <input type="text" id="identifier" name="Identifiant" required>
            </div>

            <div class="email">
              <label for="email">Email</label>
              <input type="email" id="email" name="Mail" required>
            </div>

            <div class="mot-de-passe" style="position: relative;">
              <label for="password">Mot de passe</label>
              <input type="password" id="password" name="Mot_de_passee" required>
              <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 38px; cursor: pointer;"></i>
            </div>


            <div class="date-naissance">
              <label for="birthdate">Date de naissance</label>
              <input type="date" id="date-naissance" name="Date-naissance" required>
              <div class="date">
              </div>
            </div>

            <div class="confirmation" style="position: relative;">
              <label for="confirm-password">Confirmez votre mot de passe</label>
              <input type="password" id="confirm-password" name="confirm_password" required>

              <i class="fa-solid fa-eye" id="toggleConfirm" style="position: absolute; right: 10px; top: 38px; cursor: pointer;"></i>
            </div>
          </div>

          <div class="actions">
            <a href="../index.php" class="lien-connexion">S'identifier ?</a>
            <button type="submit" class="bouton-creer" name="envoyer">Créer</button>
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

<<<<<<< HEAD
=======
<?php
if ($_SERVER['REQUEST_METHOD'] == " post"){
  $Nom = htmlspecialchars($_POST['Nom']);
  $Prenom = htmlspecialchars($_POST['Prenom']);
  $Identifiant = htmlspecialchars($_POST['Identifiant']);
  $Mail = htmlspecialchars($_POST['Mail']);
  $Mot_de_passee = htmlspecialchars($_POST['Mot_de_passee']);
  $Date_naissance = htmlspecialchars($_POST['Date-naissance']);
  $Role = htmlspecialchars($_POST['Role']);
  $Mot_de_passee = password_hash($Mot_de_passee, PASSWORD_DEFAULT);
  if(!empty($Nom) && !empty($Prenom) && !empty($Identifiant) && !empty($Mail) && !empty($Mot_de_passee) && !empty($Date_naissance) && !empty($Role)){
    try{
      $sql = "INSERT INTO inscription (Nom, Prenom, Identifiant, Mail, Mot_de_passee, Date_naissance, Role) VALUES (:Nom, :Prenom, :Identifiant, :Mail, :Mot_de_passee, :Date_naissance, :Role)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':Nom', $Nom);
      $stmt->bindParam(':Prenom', $Prenom);
      $stmt->bindParam(':Identifiant', $Identifiant);
      $stmt->bindParam(':Mail', $Mail);
      $stmt->bindParam(':Mot_de_passee', $Mot_de_passee);
      $stmt->bindParam(':Date_naissance', $Date_naissance);
      $stmt->bindParam(':Role', $Role);

      if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie !');</script>";
        header('Location: ../index.php');
        exit();
      } else {
        echo "<script>alert('Erreur lors de l\'inscription.');</script>";
      }
    } catch (PDOException $e) {
      echo "<script>alert('Erreur de connexion à la base de données.');</script>";
    }
  }
}
>>>>>>> 40276da94d01c5e367290f7e68728cd6093e86c6
