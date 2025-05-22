<?php
require_once '../configdb/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
    // Sécurisation des entrées
    $nom = htmlspecialchars($_POST['Nom']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $identifiant = htmlspecialchars($_POST['Identifiant']);
    $mail = htmlspecialchars($_POST['Mail']);
    $mot_de_passe = htmlspecialchars($_POST['Mot_de_passee']);
    $confirm = htmlspecialchars($_POST['confirm_password']);
    $date_naissance = $_POST['Date-naissance'];
    $role = htmlspecialchars($_POST['Role']);

   

    // Vérification mot de passe
    if ($mot_de_passe !== $confirm) {
        echo "<script>alert('Les mots de passe ne correspondent pas.'); window.history.back();</script>";
        exit;
    }

    // Hachage du mot de passe
    $mot_de_passe_hashed = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO Utilisateur (Nom, Prenom, Identifiant, Mail, Mot_de_passe, Role, Date_naissance)
        VALUES (:Nom, :Prenom, :Identifiant, :Mail, :Mot_de_passee, :Role, :Date_naissance)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Nom' => $nom,
            ':Prenom' => $prenom,
            ':Identifiant' => $identifiant,
            ':Mail' => $mail,
            ':Mot_de_passee' => $mot_de_passe_hashed,
            ':Role' => $role,
            ':Date_naissance' => $date_naissance
        ]);

        header("Location: ../index.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
