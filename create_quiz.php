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

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insérer le quiz dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);

        // Récupérer l'ID du quiz inséré
        $quizId = $pdo->lastInsertId();

        // Rediriger vers la page d'ajout de questions en passant l'ID du quiz dans l'URL
        header("Location: admin_question.php?quiz_id=$quizId");
        exit();
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout du quiz.";
    }
}
?>
