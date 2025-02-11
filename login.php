<?php
session_start();

// Classe pour la connexion à la base de données
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

// Classe pour gérer les utilisateurs
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database->conn;
    }

    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['pass'])) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                return "Nom d'utilisateur ou mot de passe incorrect !";
            }
        } catch (PDOException $e) {
            return "Erreur lors de la connexion : " . $e->getMessage();
        }
    }
}

// Initialisation des classes
$database = new Database();
$user = new User($database);

$error_msg = "";

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (!empty($username) && !empty($password)) {
        $error_msg = $user->login($username, $password);
    } else {
        $error_msg = "Veuillez remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="portail_connexion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Connexion</title>
</head>
<body>

<!-- Header du site -->
<header class="header">
    <a href="index.php" class="logo"><span>Quiz</span>Night</a>
    <a href="login.php" class="contact">Login</a>
</header>

<!-- Formulaire de connexion -->
<form method="POST" action="">
    <h3 class="titre_connexion">Page de connexion</h3>
    
    <label for="username"><b>Username</b></label>
    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
    
    <label for="password"><b>Password</b></label>
    <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de passe" required>
    
    <input type="submit" value="Se connecter" name="ok">
    <a href="inscription.php">Vous n’êtes pas encore inscrit ?</a>
    
    <?php if (!empty($error_msg)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_msg); ?></p>
    <?php endif; ?>
</form>

</body>
</html>
