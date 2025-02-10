<?php
// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'quiz_night';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les derniers quiz créés
$sql = "SELECT title, description, created_at FROM quizzes ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);

// Vérification si des quiz ont été trouvés
if ($result->num_rows > 0) {
    // Affichage des quiz sous forme de cards
    echo '<div class="quiz-cards-container">';

    // Boucle pour afficher chaque quiz sous forme de carte
    while ($row = $result->fetch_assoc()) {
        // Formater la date si nécessaire
        $formatted_date = date('d M Y, H:i', strtotime($row['created_at']));

        // Carte pour chaque quiz
        echo '<div class="quiz-card">';
        echo '<h3 class="quiz-title">' . htmlspecialchars($row['title']) . '</h3>';
        echo '<p class="quiz-description">' . htmlspecialchars($row['description']) . '</p>';
        echo '<small class="quiz-date">Créé le: ' . $formatted_date . '</small>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "<p>Aucun quiz disponible pour le moment.</p>";
}

$conn->close();
?>
