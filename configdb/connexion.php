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






?>
    


