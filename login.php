<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="portail_connexion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">	
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='font'>
    <title>Connexion</title>
</head>
<body>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_night";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}


$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Requête sécurisée pour éviter les injections SQL
        $stmt = $bdd->prepare("SELECT * FROM users WHERE username = :username AND pass = :password");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $rep = $stmt->fetch();
        if ($rep) {
            $_SESSION['username'] = $username;
            header ("Location: index_logged.php");
            exit;

        } else {
            $error_msg = "Nom d'utilisateur ou mot de passe incorrect !";
        }
    } else {
        $error_msg = "Veuillez remplir tous les champs !";
    }
}
?>

<!-- Header du site -->
<header class="header">
		<!-- Logo -->
		<a href="index.php" class="logo"><span>Quizz</span>Night</a>

		<!-- Bouton de contact -->
		<a href="login.php" class="contact">Login</a>
	</header>


<form method="POST" action="">
    <h3 class="titre_connexion">Page de connexion</h3>
    <label for="username"><b>Username</b></label>
    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
    <br>
    <label for="password"><b>Password</b></label>
    <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de passe" required>
    <br>
    <input type="submit" value="Se connecter" name="ok">
    <a href="inscription.php">Vous n’êtes pas encore inscrit ?</a>
    <?php if (!empty($error_msg)) : ?>
    <p style="color: red;"><?php echo htmlspecialchars($error_msg); ?></p>
<?php endif; ?>
</form>
</body>
</html>
