<?php
require 'config.php';

// Vérifier si l'ID du quiz est passé dans l'URL
if (isset($_GET['id'])) {
    $quizId = $_GET['id'];

    // Récupérer les informations actuelles du quiz
    $stmt = $conn->prepare("SELECT title, description FROM quizzes WHERE id = ?");
    $stmt->bind_param("i", $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $quiz = $result->fetch_assoc();
    } else {
        die("Quiz non trouvé.");
    }
} else {
    die("ID de quiz manquant.");
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = $_POST['title'];
    $newDescription = $_POST['description'];

    // Mettre à jour le quiz dans la base de données
    $stmt = $conn->prepare("UPDATE quizzes SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newTitle, $newDescription, $quizId);

    if ($stmt->execute()) {
        echo "<p>Quiz mis à jour avec succès !</p>";
    } else {
        echo "<p>Erreur lors de la mise à jour du quiz.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Quiz - Quiz Night</title>
    <link href="quiz_play.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h3>Modifier le Quiz</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Quiz</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($quiz['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du Quiz</label>
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($quiz['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Retour à la liste des quiz</a>
    </div>
</body>
</html>
