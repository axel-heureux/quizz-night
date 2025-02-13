<?php
require 'config.php';

$score = 0;
$total = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        if (strpos($key, "question_") === 0) {
            $total++;
            $reponse_id = intval($value);

            $stmt = $conn->prepare("SELECT is_correct FROM reponse WHERE id = ?");
            $stmt->bind_param("i", $reponse_id);
            $stmt->execute();
            $stmt->bind_result($correct);
            $stmt->fetch();

            if ($correct) {
                $score++;
            }

            $stmt->close();
        }
    }

    echo "<div class='card text-center shadow-lg p-4'>
            <h2 class='text-success'>Résultat du Quiz</h2>
            <h3 class='mt-3'>Score : <strong>$score</strong> / $total</h3>
          </div>";
}

$conn->close();
?>
