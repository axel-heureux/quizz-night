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

// Vérifier si un quiz est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        // Ajout du quiz
        $title = $_POST['title'];
        $description = $_POST['description'];

        try {
            $stmt = $pdo->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
            $stmt->execute([$title, $description]);

            $quizId = $pdo->lastInsertId();
            $message = "Quiz ajouté avec succès ! Ajoutez maintenant des questions.";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout du quiz.";
        }
    }

    if (isset($_POST['quiz_id']) && isset($_POST['question'])) {
        // Ajout de la question
        $quizId = $_POST['quiz_id'];
        $question = $_POST['question'];

        try {
            $stmt = $pdo->prepare("INSERT INTO question (quiz_id, content) VALUES (?, ?)");
            $stmt->execute([$quizId, $question]);

            $questionId = $pdo->lastInsertId();
            $message = "Question ajoutée avec succès ! Ajoutez maintenant des réponses.";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout de la question.";
        }
    }

    if (isset($_POST['question_id']) && isset($_POST['answers']) && isset($_POST['correct_answer'])) {
        // Ajout des réponses
        $questionId = $_POST['question_id'];
        $answers = $_POST['answers'];
        $correctAnswer = $_POST['correct_answer'];

        try {
            $stmt = $pdo->prepare("INSERT INTO reponse (question_id, content, is_correct) VALUES (?, ?, ?)");

            foreach ($answers as $index => $answer) {
                $isCorrect = ($index == $correctAnswer) ? 1 : 0;
                if (!empty($answer)) {
                    $stmt->execute([$questionId, $answer, $isCorrect]);
                }
            }

            $message = "Réponses ajoutées avec succès !";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout des réponses.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Quiz</title>
    <link rel="stylesheet" href="stylesheet">
</head>
<body>

<div class="container">
    <h2>Créer un Quiz</h2>
    <?php if ($message) : ?>
        <p class="message"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulaire pour ajouter un Quiz -->
    <form method="POST">
        <label for="title">Titre du Quiz :</label>
        <input type="text" name="title" required>

        <label for="description">Description :</label>
        <textarea name="description" required></textarea>

        <button type="submit">Créer le Quiz</button>
    </form>

    <!-- Formulaire pour ajouter une Question -->
    <h3>Ajouter une Question</h3>
    <form method="POST">
        <label for="quiz_id">Sélectionner un Quiz :</label>
        <select name="quiz_id">
            <?php
            $result = $pdo->query("SELECT id, title FROM quizzes");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['title']}</option>";
            }
            ?>
        </select>

        <label for="question">Question :</label>
        <input type="text" name="question" required>

        <button type="submit">Ajouter la Question</button>
    </form>

    <!-- Formulaire pour ajouter des Réponses -->
    <h3>Ajouter des Réponses</h3>
    <form method="POST">
        <label for="question_id">Sélectionner une Question :</label>
        <select name="question_id">
            <?php
            $result = $pdo->query("SELECT id, content FROM question");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['content']}</option>";
            }
            ?>
        </select>

        <label>Réponses :</label>
        <input type="text" name="answers[]" placeholder="Réponse 1" required>
        <input type="text" name="answers[]" placeholder="Réponse 2" required>
        <input type="text" name="answers[]" placeholder="Réponse 3" required>
        <input type="text" name="answers[]" placeholder="Réponse 4" required>

        <label for="correct_answer">Indice de la bonne réponse (0-3) :</label>
        <input type="number" name="correct_answer" min="0" max="3" required>

        <button type="submit">Ajouter les Réponses</button>
    </form>
</div>

</body>
</html>
