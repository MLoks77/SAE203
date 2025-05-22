<head>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
      <div class="container-fluid">

        <a class="navbar-brand" href="../php/accueil.php">
          <img src="../image/gustavedetouré.png" alt="Logo" style="max-height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" x>
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">

            <li class="nav-item px-3">
              <a class="nav-link" href="../php/accueil.php">Accueil</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link" href="../php/planning.php">Planning</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link" href="../php/Reserver.php" id="reservation" role="button">
                Réservation
              </a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link" href="../php/contact.php">Contact</a>
            </li>
            <li class="nav-item dropdown px-3">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../image/pp.jpg" alt="photo de profil" style="max-height: 40px; border-radius: 50%;">
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../php/compte.php">Paramètres</a></li>
                <li><a class="dropdown-item" href="../configdb/logout.php">Se déconnecter</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>