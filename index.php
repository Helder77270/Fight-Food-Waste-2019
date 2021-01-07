<?php

session_start();
error_reporting(0);
//Les deux link suivants permettent de s'adapter selon le chemin
require_once __DIR__.'/Web/languages/config.php';
require_once "Web/languages/" . $_SESSION['lang'] . ".php";
//echo $_SESSION['lang'];
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Stop Waste</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="Web/css/main1index.css" />
	</head>
	<body class="is-preload">
    <div style="color: green; text-align: end; margin-top: 20px;">
    <a href="index.php?lang=fr">Français</a> | <a href="index.php?lang=en">English</a> | <a href="index.php?lang=pt">Português</a> | <a href="index.php?lang=it">Italiano</a> | <a href="index.php?lang=ir">Gaeilge</a>
    </div>
		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1 style="color: #0f6674;">Stop Waste</h1>
                    <br>
                    <ul class="actions special">
                        <li><?php echo $lang['index_vousmembre']?>
                            <br><a href="Web/pages/login.php" class="button" style="color: #2c9faf !important;"><?php echo $lang['index_seconnecter']?></a></li>
                        <br>
                        <li><?php echo $lang['index_nousrejoindre']?>
                            <br><a href="Web/pages/register.php" class="button" style="color: #2c9faf !important;"><?php echo $lang['index_sen']?></a></li>
                    </ul>
				</header>
				<div class="container">
					<ul class="actions special">
						<li><a style="background-color: #0f6674 !important;" href="#one" class="button primary scrolly"><?php echo $lang['index_btn_begin']?></a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="images/pic01.jpg" alt="" /></span>
					<div class="content">
						<header class="major">
							<h2><?php echo $lang['quisommesnous']?></h2>
						</header>
						<p><?php echo $lang['index_info']?></p>
                        <a href="WebGL/Projet.html">Visite 3D</a>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<header class="major">
							<h2><?php echo $lang['index_aide'] ?></h2>
						</header>
						<p><?php echo $lang['index_descri']?></p>
						<ul class="icons-grid">

							<li>
								<span class="icon major fa-coffee"></span>
								<h3><?php echo $lang['index_axe1'] ?></h3>
							</li>

							<li>
								<span class="icon major fa-pencil"></span>
								<h3><?php echo $lang['index_axe2'] ?></h3>
							</li>

							<li>
								<span class="icon major fa-camera-retro"></span>
								<h3><?php echo $lang['index_axe3'] ?></h3>
							</li>

							<li>
								<span class="icon major fa-code"></span>
								<h3><?php echo $lang['index_axe4'] ?></h3>
							</li>

						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</div>
			</section>


		<!-- Footer -->
			<section id="footer">
                <div class="container">
                    <span class="image fit primary"><img src="images/pic03.jpg" alt="" /></span>
                    <div class="content">
                        <header class="major">
                            <h2><?php echo $lang['index_title_exemple']?></h2>
                        </header>
                        <p>
                            <?php echo $lang['index_ingredient_cake_1']?><br>
                            <?php echo $lang['index_ingredient_cake_2']?><br>
                            <?php echo $lang['index_ingredient_cake_3']?><br>
                            <?php echo $lang['index_ingredient_cake_4']?><br>
                            <?php echo $lang['index_ingredient_cake_5']?><br>
                            <?php echo $lang['index_ingredient_cake_6']?>
                        </p>
                    </div>
                </div>


				<footer>
					<ul class="icons">
						<li><a href="https://www.facebook.com/Stop-Waste-1282850768544178/" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="mailto:tomy@smtp.stopwaste.eu" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Stop Waste</li>
					</ul>
				</footer>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>