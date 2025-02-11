<?php

class Database {
    private $host = "localhost";
    private $dbname = "quiz_night";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}

class User {
    private $db;

    public function __construct($database) {
        $this->db = $database->conn;
    }

    public function register($username, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage sécurisé du mot de passe

            $sql = "INSERT INTO users (username, pass) VALUES (:username, :pass)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "username" => $username,
                "pass" => $hashedPassword
            ]);

            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }
}

// Initialisation de la base de données
$database = new Database();
$user = new User($database);

// Vérification si le formulaire est soumis
if (isset($_POST['ok'])) {
    $username = $_POST['username'];
    $password = $_POST['pass'];

    if (!empty($username) && !empty($password)) {
        $user->register($username, $password);
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

?>
