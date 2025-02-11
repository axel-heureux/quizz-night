<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_creation.css">
    <title>Création du quiz</title>
</head>
<body>
    <!-- Header du site -->
    <header class="header">
        <!-- Logo -->
        <a href="index.php" class="logo"><span>Quizz</span>Night</a>

        <!-- Bouton de contact -->
        <a href="logout.php" class="contact">Logout</a>
    </header>

    <!-- Section d'accueil -->
    <section class="home">
        <div class="home-content">
            <h2>🚀 Gérez et créez vos <span>Quiz</span> en toute simplicité ! 🎯</h2>
            <p>Bienvenue sur votre espace administrateur. Créez, modifiez et suivez vos quiz pour offrir la meilleure expérience aux joueurs !</p>
        </div>

        <div class="create-quiz">
        <h2>Créer un nouveau Quiz</h2>
        <form action="create_quiz.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="quiz_title">Titre du Quiz :</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="quiz_description">Description du Quiz :</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Créer le Quiz</button>
        </div>
        </form>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <ul class="list">
            <h2>Quizz<span>Night</span></h2>
            <li><a href="#">Politique de confidentialité</a></li>
        </ul>
        <p class="copyright">© 2025 | Tous droits réservés</p>
    </footer>

</body>
</html>
