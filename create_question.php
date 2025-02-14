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

$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID du quiz et la question depuis le formulaire
    $quizId = $_POST['quiz_id'] ?? null;
    $question = $_POST['question'] ?? null;

    // Vérifier si l'ID du quiz et la question sont valides
    if ($quizId === null || empty($question)) {
        $message = "Le Quiz ID et la Question sont requis.";
    } else {
        // Insérer la question dans la base de données
        try {
            $stmt = $pdo->prepare("INSERT INTO question (quiz_id, content) VALUES (?, ?)");
            $stmt->execute([$quizId, $question]);

            // Récupérer l'ID de la question ajoutée
            $questionId = $pdo->lastInsertId();

            // Message de succès
            $message = "La question a été ajoutée avec succès.";

            // Rediriger vers la page des réponses avec quiz_id et question_id dans l'URL
            header("Location: admin_answers.php?quiz_id=$quizId&question_id=$questionId");
            exit();
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout de la question.";
        }
    }
}
?>

<!-- Affichage des messages -->
<?php if ($message) : ?>
    <div class="message"><?= htmlspecialchars($message); ?></div>
<?php endif; ?>
