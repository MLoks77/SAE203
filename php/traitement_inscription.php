<?php
if(isset($_POST['envoyer'])){
   $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $identifiant = $_POST['Identifiant'];
    $email = $_POST['Mail'];
    $motdepasse = $_POST['Mot_de_passee'];
    $date_naissance = $_POST['Date-naissance'];
    $role = $_POST['Role'];
    $confirm_password = $_POST['confirm_password'];
    


    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Identifiant, Mail, Mot_de_passee, Date_naissance, rôle) VALUES (:Nom, :Prenom, :Identifiant, :Mail, :Mot_de_passee, :Date_naissance, :rôle)";
    $stmt = $pdo ->prepare($sql);
    $stmt -> execute([
        ':Nom' => $nom,
        ':Prenom' => $prenom,
        ':Identifiant' => $identifiant,
        ':Mail' => $email,
        ':Mot_de_passee' => $motdepasse,
        ':Date_naissance' => $date_naissance,
        ':rôle' => $role
    ]);
    echo" inscription réussie";


}
?>