<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz-play.css">
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
    
    	<!-- Section d'accueil -->
	<section class="home">
		<div class="home-content">
<!-- Contenu du Quiz Football -->
<section class="quiz-container">
        <h2>⚽ Quizz Football ⚽</h2>
        <img src="assets/images/Cristiano-Ronaldopng.parspng.com-10.png" alt="Football Logo">

        <p>Testez vos connaissances sur le monde du football !</p>

        <div id="quiz">
            <!-- Question 1 -->
            <div class="question">
                <h3>1. Quel est le joueur le plus complet depuis l'histoire du football ?</h3>
                <ul>
                    <li><input type="radio" name="q1" value="a"> Pelé </li>
                    <li><input type="radio" name="q1" value="b"> Cristiano Ronaldo 2008</li>
                    <li><input type="radio" name="q1" value="c"> Lionel Messi 2012</li>
                    <li><input type="radio" name="q1" value="d"> Maradona </li>
                </ul>
            </div>

            <!-- Question 2 -->
            <div class="question">
                <h3>2. Quel joueur a remporté le plus grand nombre de Ballons d'Or ?</h3>
                <ul>
                    <li><input type="radio" name="q2" value="a"> Lionel Messi</li>
                    <li><input type="radio" name="q2" value="b"> Cristiano Ronaldo</li>
                    <li><input type="radio" name="q2" value="c"> Michel Platini</li>
                    <li><input type="radio" name="q2" value="d"> Johan Cruyff</li>
                </ul>
            </div>

            <!-- Question 3 -->
            <div class="question">
                <h3>3. Quelle équipe a remporté la Ligue des Champions en 2020 ?</h3>
                <ul>
                    <li><input type="radio" name="q3" value="a"> Juventus</li>
                    <li><input type="radio" name="q3" value="b"> FC Barcelone</li>
                    <li><input type="radio" name="q3" value="c"> Bayern Munich</li>
                    <li><input type="radio" name="q3" value="d"> Manchester City</li>
                </ul>
            </div>

            <!-- Question 4 -->
            <div class="question">
                <h3>4. Quel pays a accueilli la Coupe du Monde 2022 ?</h3>
                <ul>
                    <li><input type="radio" name="q4" value="a"> Russie</li>
                    <li><input type="radio" name="q4" value="b"> Qatar</li>
                    <li><input type="radio" name="q4" value="c"> États-Unis</li>
                    <li><input type="radio" name="q4" value="d"> France</li>
                </ul>
            </div>

            <button onclick="checkAnswers()">Vérifier mes réponses</button>
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