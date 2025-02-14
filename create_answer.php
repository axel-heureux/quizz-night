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

// Récupérer les données depuis le formulaire
$quizId = isset($_POST['quiz_id']) ? $_POST['quiz_id'] : null;
$questionId = isset($_POST['question_id']) ? $_POST['question_id'] : null;
$answers = isset($_POST['answers']) ? $_POST['answers'] : [];

if ($quizId === null || $questionId === null || empty($answers)) {
    $message = "Le Quiz ID, la Question ID et les réponses sont requis.";
} else {
    try {
        // Insérer les réponses dans la base de données (table 'reponse')
        $stmt = $pdo->prepare("INSERT INTO reponse (question_id, content) VALUES (?, ?)");

        foreach ($answers as $answer) {
            if (!empty($answer)) {
                $stmt->execute([$questionId, $answer]);
            }
        }

        $message = "Les réponses ont été ajoutées avec succès.";
        // Redirection vers la page d'ajout de réponses
        header("Location: admin_question.php?quiz_id=$quizId&question_id=$questionId");
        exit();
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout des réponses.";
    }
}

// Affichage du message de succès ou d'erreur
if ($message) {
    echo "<div class='message'>" . htmlspecialchars($message) . "</div>";
}
?>
