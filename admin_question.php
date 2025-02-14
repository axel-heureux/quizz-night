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

// Récupérer l'ID du quiz depuis l'URL
$quizId = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;

if ($quizId === null) {
    die("Quiz ID est requis.");
}

// Récupérer les informations du quiz pour affichage
$stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->execute([$quizId]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quiz) {
    die("Quiz non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_creation.css">
    <title>Création de la question</title>
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
            <h2>Ajouter des questions pour le quiz : <?= htmlspecialchars($quiz['title']); ?></h2>

            <form action="create_question.php" method="POST">
                <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quizId); ?>">

                <div class="form-group">
                    <label for="question">Question :</label>
                    <input type="text" id="question" name="question" required>
                </div>

                <button type="submit" class="submit-btn">Ajouter la question</button>
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
