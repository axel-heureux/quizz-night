<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "quiz_night";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données.");
}

// Récupérer les données du formulaire
$quizId = isset($_POST['quiz_id']) ? $_POST['quiz_id'] : null;
$title = isset($_POST['title']) ? $_POST['title'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;

if ($quizId === null || $title === null || $description === null) {
    die("Tous les champs sont requis.");
}

try {
    // Mettre à jour les informations du quiz dans la base de données
    $stmt = $pdo->prepare("UPDATE quizzes SET title = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $description, $quizId]);

    // Rediriger vers la page d'administration ou tableau de bord
    header("Location: admin_edit_question.php?success=Quiz mis à jour avec succès.");
    exit();
} catch (PDOException $e) {
    die("Erreur lors de la mise à jour du quiz : " . $e->getMessage());
}
?>
