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

// Récupérer l'ID du quiz à modifier
$quizId = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;
if ($quizId === null) {
    die("Quiz ID est requis.");
}

// Récupérer les informations du quiz à partir de l'ID
$stmt = $pdo->prepare("SELECT * FROM quiz WHERE id = ?");
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
    <title>Modifier le Quiz</title>
</head>
<body>
    <!-- Header du site -->
    <header class="header">
        <!-- Logo -->
        <a href="index_logged.php" class="logo"><span>Quizz</span>Night</a>

        <!-- Bouton de contact -->
        <a href="logout.php" class="contact">Logout</a>
    </header>

    <!-- Section d'accueil -->
    <section class="home">
        <div class="home-content">
            <h2>🎯 Modifiez facilement votre Quiz actuel ! 🚀</h2>
            <p>Accédez à vos quiz existants et mettez à jour leurs informations pour offrir la meilleure expérience aux joueurs !</p>
        </div>

        <div class="create-quiz">
            <h2>Modifier le Quiz : <?= htmlspecialchars($quiz['title']); ?></h2>
            <form action="edit_quiz.php" method="POST">
                <!-- Champ caché pour l'ID du quiz -->
                <input type="hidden" name="quiz_id" value="<?= $quiz['id']; ?>">

                <div class="form-group">
                    <label for="quiz_title">Titre du Quiz :</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($quiz['title']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="quiz_description">Description du Quiz :</label>
                    <textarea id="description" name="description" required><?= htmlspecialchars($quiz['description']); ?></textarea>
                </div>

                <button type="submit" class="submit-btn">Mettre à jour le Quiz</button>
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
