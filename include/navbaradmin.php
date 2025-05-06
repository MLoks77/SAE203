
<link rel="stylesheet" href="../css/accueiletudiant.css">

<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
     <a href=""><img src="../image/gustavedetouré.png" alt="Logo" style="max-height: 40px;"></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item px-5" style="border-right: 1px solid black;">
          <a class="nav-link" href="#">Admin</a>
        </li>
        <li class="nav-item px-5">
          <a class="nav-link active" aria-current="page" href="../php/accueil.php">Accueil</a>
        </li>
        <li class="nav-item px-5">
          <a class="nav-link" href="../php/planning.php">Planning</a>
        </li>
        <li class="nav-item dropdown px-5">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            Réservation
          </a>
          <ul class="dropdown-menu"> <!-- Le dropdown bug, apparament c'est à cause du javascript -->
            <li><a class="dropdown-item" href="#">Audiovisuel</a></li>
            <li><a class="dropdown-item" href="#">Média</a></li>
            <li><a class="dropdown-item" href="#">Casque</a></li>
            <li><a class="dropdown-item" href="#">Salle</a></li>
          </ul>
        </li>    
        <li class="nav-item px-5">
          <a href="../php/contact.php" class="nav-link" aria-disabled="true">Contact</a>
        </li>
      </ul>
      <a href="" role="button" data-bs-toggle="dropdown"><img src="../image/pp.jpg" style="max-height: 40px;" alt="photo de profil"></a>
      <ul class="dropdown-menu"> <!-- Le dropdown bug, apparament c'est à cause du javascript -->
            <li><a class="dropdown-item" href="#">Paramètres</a></li> <!-- Lien vers la page paramètre à mettre -->
            <li><a class="dropdown-item" href="../configdb/delete-session.php">Se déconnecter</a></li> <!-- mettre un clear session dans delete-session.php et faire en sorte qu'il renvoie vers connexion -->
          </ul>
    </div>
  </div>
</nav>
</header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldnv0O8r+Lk5C6mZ5p2eD5z4z5j5z5j5j5j5j5j5" crossorigin="anonymous"></script>