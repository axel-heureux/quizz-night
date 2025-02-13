<?php
require 'config.php';

if (isset($_POST['quiz_id'])) {
    $quiz_id = intval($_POST['quiz_id']);

    // Récupérer les questions
    $questionsQuery = $conn->prepare("SELECT id, content FROM question WHERE quiz_id = ?");
    $questionsQuery->bind_param("i", $quiz_id);
    $questionsQuery->execute();
    $questionsResult = $questionsQuery->get_result();

    if ($questionsResult->num_rows > 0) {
        echo '<form id="quiz-form" onsubmit="submitQuiz(event)">';
        while ($question = $questionsResult->fetch_assoc()) {
            echo "<div class='card p-3 mb-3 shadow-sm'>";
            echo "<h5>" . htmlspecialchars($question['content']) . "</h5>";

            // Récupérer les réponses
            $answersQuery = $conn->prepare("SELECT id, content FROM reponse WHERE question_id = ?");
            $answersQuery->bind_param("i", $question['id']);
            $answersQuery->execute();
            $answersResult = $answersQuery->get_result();

            if ($answersResult->num_rows > 0) {
                while ($answer = $answersResult->fetch_assoc()) {
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='question_{$question['id']}' value='{$answer['id']}' required>";
                    echo "<label class='form-check-label'>" . htmlspecialchars($answer['content']) . "</label>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-danger'>Aucune réponse trouvée.</p>";
            }
            echo "</div>";
        }
        echo '<button type="submit" class="btn btn-success w-100">Soumettre</button>';
        echo '</form>';
    } else {
        echo "<p class='text-danger'>Aucune question trouvée pour ce quiz.</p>";
    }
} else {
    echo "<p class='text-danger'>ID du quiz non reçu.</p>";
}
?>
