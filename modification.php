<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modification.css">
    <title>Accueil</title>
</head>
<body>
    <!-- Header du site -->
	<header class="header">
		<!-- Logo -->
		<a href="index.php" class="logo"><span>Quizz</span>Night</a>

		<!-- Bouton de contact -->
		<a href="login.php" class="contact">Login</a>
	</header>

    <section class="quiz">
		<div class="quiz-content">
        <h2>📝 Quel quizz voulez-vous modifier ?</h2>
        </div>
		<div id="latest-quizzes" class="quiz-container">
            <?php include 'get_latest_quizzes.php'; ?>
		</div>
            
	</section>

    	<!-- Section d'accueil -->
	<section class="home">
		<div class="home-content">
			<h2>Ajouter des Questions</h2>
            <br>
			
			<!-- Boutons d'action -->
			<div class="btn-box">
				<button class="btn-1" onclick="window.location.href='#'">Questions</button>
				<button class="btn-2" onclick="window.location.href='#'">Reponses</button>
			</div>
		</div>
		<div class="img-box">
			<img src="assets/images/hero-image.webp">
		</div>
	</section>

    	<!-- Footer -->
	<footer class="footer">

		<!-- Liste de liens importants -->
		<ul class="list">
            <h2>Quizz<span>Night</span></h2>
			<li><a href="#">Politique de confidentialité</a></li>
		</ul>

		<!-- Copyright -->
		<p class="copyright">© 2025 | Tous droits réservés</p>
	</footer>

</body>
</html>