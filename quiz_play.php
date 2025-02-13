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

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center">Choisissez un quiz</h2>

        <div class="mb-3">
            <select id="quiz" class="form-select">
                <?php
                $result = $conn->query("SELECT id, title FROM quizzes");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                }
                ?>
            </select>
        </div>

        <button onclick="loadQuiz()" class="btn btn-primary w-100">Lancer le quiz</button>
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
</script>

</body>
</html>
