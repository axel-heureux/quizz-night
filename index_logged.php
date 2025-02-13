<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Accueil</title>
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
			<h2>🎉 Bienvenue sur<span>Quizz</span>Night ! 🎉</h2>
            <br>
			<h3>Prêt à tester <span>vos connaissances</span> et relever des défis passionnants ? </h3>
			<p>🚀 Que vous soyez un expert en culture générale, un fan de cinéma, un amateur d’histoire ou un passionné de sport, nous avons des quiz pour tous les goûts !</p>
            <p>👉 Défiez vos amis, améliorez votre score et découvrez de nouvelles choses en vous amusant.</p>
			
			<!-- Boutons d'action -->
			<div class="btn-box">
				<button class="btn-1" onclick="window.location.href='quiz_play.php'">Nos quiz disponible</button>
				<button class="btn-2" onclick="window.location.href='admin_creation.php'">Crée votre propre quiz</button>
			</div>
		</div>
		<div class="img-box">
			<img src="assets/images/hero-image.webp">
		</div>
	</section>

    <section class="quiz">
		<div class="quiz-content">
        <h2>📝 Découvrez nos quiz disponibles</h2>
        <p>Testez vos connaisances sur les themes que l’on propose parmis les suivants...</p>
        </div>
		<div id="latest-quizzes" class="quiz-container">
            <?php include 'get_latest_quizzes.php'; ?>
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