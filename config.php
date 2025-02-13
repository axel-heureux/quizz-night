<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");  // Mets ton utilisateur MySQL
define("DB_PASS", "");  // Mets ton mot de passe MySQL si nécessaire
define("DB_NAME", "quiz_night");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>
