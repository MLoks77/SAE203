<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Serveur MySQL
$username = "root";        
$password = "";            
$database = "gustaveeiffel";     

try {
    // Connexion à MySQL avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
$sql = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Casque'";
$stmt = $pdo->query($sql);
$materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sqlMultimedia = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Multimédia'";
$stmtMultimedia = $pdo->query($sqlMultimedia);
$materielsMultimedia = $stmtMultimedia->fetchAll(PDO::FETCH_ASSOC);
$sqlAudiovisuel = "SELECT ID_materiel, Reference, Descriptif, Etat_global FROM Materiel WHERE Type = 'Audiovisuelle'";
$stmtAudiovisuel = $pdo->query($sqlAudiovisuel);
$materielsAudiovisuel = $stmtAudiovisuel->fetchAll(PDO::FETCH_ASSOC);
$sqlSalle = "SELECT ID, Descriptif, Etat FROM Salle";
$stmtSalle = $pdo->query($sqlSalle);
$materielsSalle = $stmtSalle->fetchAll(PDO::FETCH_ASSOC);






?>
    


