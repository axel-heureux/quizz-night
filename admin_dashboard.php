<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night</title>
    <link href="quiz_play.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div id="quiz-list" class="mt-4">
        <h3>Liste des quiz</h3>
        <?php
        $result = $conn->query("SELECT id, title FROM quizzes");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='quiz-item p-3 mb-3 border rounded shadow-sm'>";
            echo "<h5>{$row['title']}</h5>";
            echo "<button onclick='editQuiz({$row['id']})' class='btn btn-warning me-2'>Modifier</button>";
            echo "<button onclick='deleteQuiz({$row['id']})' class='btn btn-danger'>Supprimer</button>";
            echo "</div>";
        }
        ?>
    </div>

    <div id="quiz-container" class="mt-4"></div>
    <div id="result-container" class="mt-4"></div>
</div>

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
                    location.reload();
                }
            };

            xhr.send("quiz_id=" + quizId);
        }
    }
</script>

</body>
</html>
