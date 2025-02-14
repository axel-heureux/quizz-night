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

// Récupérer l'ID du quiz et de la question depuis l'URL
$quizId = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;
$questionId = isset($_GET['question_id']) ? $_GET['question_id'] : null;

if ($quizId === null || $questionId === null) {
    die("Quiz ID et Question ID sont requis.");
}

// Récupérer les informations de la question pour affichage
$stmt = $pdo->prepare("SELECT content FROM question WHERE id = ? AND quiz_id = ?");
$stmt->execute([$questionId, $quizId]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$question) {
    die("Question non trouvée.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_creation.css">
    <title>Ajouter des réponses</title>
</head>
<body>
    <!-- Header du site -->
    <header class="header">
        <a href="index_logged.php" class="logo"><span>Quizz</span>Night</a>
        <a href="logout.php" class="contact">Logout</a>
    </header>

    <!-- Section d'accueil -->
    <section class="home">
        <div class="home-content">
            <h2>🚀 Gérez et créez vos <span>Quiz</span> en toute simplicité ! 🎯</h2>
            <p>Bienvenue sur votre espace administrateur. Créez, modifiez et suivez vos quiz pour offrir la meilleure expérience aux joueurs !</p>
        </div>

        <div class="create-quiz">
            <h2>Ajouter des réponses pour la question : <?= htmlspecialchars($question['content']); ?></h2>

            <form action="create_answer.php" method="POST">
                <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quizId); ?>">
                <input type="hidden" name="question_id" value="<?= htmlspecialchars($questionId); ?>">

                <div class="form-group">
                    <label for="answer_1">Réponse 1 :</label>
                    <input type="text" name="answers[]" required>
                </div>

                <div class="form-group">
                    <label for="answer_2">Réponse 2 :</label>
                    <input type="text" name="answers[]">
                </div>

                <div class="form-group">
                    <label for="answer_3">Réponse 3 :</label>
                    <input type="text" name="answers[]">
                </div>

                <div class="form-group">
                    <label for="answer_4">Réponse 4 :</label>
                    <input type="text" name="answers[]">
                </div>

                <button type="submit" class="submit-btn">Ajouter les réponses</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <ul class="list">
            <h2>Quizz<span>Night</span></h2>
            <li><a href="#">Politique de confidentialité</a></li>
        </ul>
        <p class="copyright">© 2025 | Tous droits réservés</p>
    </footer>
</body>
</html>
