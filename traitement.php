<?php

$servername = "localhost";
$username = "root";
$password ="";
$dbname ="quiz_night";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=quiz_night", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    echo "Erreur de connexion : " . $e->getMessage();
}



if (isset($_POST['ok'])){
    $username = $_POST ['username'];
    $password = $_POST ['pass'];

    $requete = $bdd->prepare("INSERT INTO users VALUES (0, :username, :pass)");
    $requete->execute(
        array(
            "username" => $username,
            "pass" => $password
        )
    );
    header("Location: login.php");
    exit();
}
?>