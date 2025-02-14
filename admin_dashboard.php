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
                echo "<div id='quiz-item-{$row['id']}' class='quiz-item p-3 mb-3 border rounded shadow-sm'>";
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

    <div id="quiz-container" class="mt-4"></div>
    <div id="result-container" class="mt-4"></div>

<script>
    function loadQuiz() {
        let quizId = document.getElementById("quiz").value;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_quiz.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("quiz-container").innerHTML = xhr.responseText;
                document.getElementById("result-container").innerHTML = "";
            }
        };

        xhr.send("quiz_id=" + quizId);
    }

    function submitQuiz(event) {
        event.preventDefault();

        let formData = new FormData(document.getElementById("quiz-form"));
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "check_quiz.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("result-container").innerHTML = xhr.responseText;
            }
        };

        xhr.send(formData);
    }

    function editQuiz(quizId) {
        window.location.href = "admin_edit_quiz.php?quiz_id=" + quizId;
    }

    function deleteQuiz(quizId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce quiz ?")) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_quiz.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    // Dynamically remove the quiz item from the list without reloading the page
                    let quizItem = document.getElementById("quiz-item-" + quizId);
                    if (quizItem) {
                        quizItem.remove();
                    }
                }
            };

            xhr.send("quiz_id=" + quizId);
        }
    }
</script>

</body>
</html>
