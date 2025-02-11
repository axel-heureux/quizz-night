<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'quiz_night';
    private $conn;

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Erreur de connexion : " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Quiz {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function getLatestQuizzes($limit = 5) {
        $sql = "SELECT title, description, created_at FROM quizzes ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Initialisation de la base de données
$db = new Database();

// Récupération des derniers quiz
$quizManager = new Quiz($db);
$quizzes = $quizManager->getLatestQuizzes();

// Fermeture de la connexion à la base de données
$db->closeConnection();
?>

<!-- Affichage des quiz en HTML -->
<div class="quiz-cards-container">
    <?php if (!empty($quizzes)) : ?>
        <?php foreach ($quizzes as $quiz) : ?>
            <div class="quiz-card">
                <h3 class="quiz-title"><?= htmlspecialchars($quiz['title']); ?></h3>
                <p class="quiz-description"><?= htmlspecialchars($quiz['description']); ?></p>
                <small class="quiz-date">Créé le: <?= date('d M Y, H:i', strtotime($quiz['created_at'])); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun quiz disponible pour le moment.</p>
    <?php endif; ?>
</div>
