<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night - Dashboard</title>
    <link href="quiz_play.css" rel="stylesheet">
</head>
<body class="bg-light"> 


        <!-- Liste des quiz existants -->
        <div id="quiz-list">
            <?php
            $result = $conn->query("SELECT id, title FROM quizzes");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='quiz-item p-3 mb-3 border rounded shadow-sm'>";
                    echo "<h5>{$row['title']}</h5>";
                    echo "<button onclick='editQuiz({$row['id']})' class='btn btn-warning me-2'>Modifier</button>";
                    echo "<button onclick='deleteQuiz({$row['id']})' class='btn btn-danger'>Supprimer</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun quiz trouvé.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        function editQuiz(quizId) {
            window.location.href = "edit_quiz.php?id=" + quizId;
        }

        function deleteQuiz(quizId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce quiz ?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_quiz.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload(); // Recharge la page pour afficher les changements
                    }
                };

                xhr.send("quiz_id=" + quizId);
            }
        }
    </script>

</body>
</html>
