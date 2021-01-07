<?php
session_start();
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__. '/../languages/config.php');
require_once "../languages/" . $_SESSION['lang'] . ".php";

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Cours de cuisine</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../css/main.css" />
		<noscript><link rel="stylesheet" href="../css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

                <!-- Menu -->
                <nav id="menu">
                    <h2>Menu</h2>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="lessonIndex.php">Cours de cuisine</a></li>
                        <li><a href="smoothieIndex.php">Smoothies BIO</a></li>
                        <li><a href="../../index.php">A propos de nous</a></li>
                        <li><a href="deconnect.php">Deconnexion</a></li>
                    </ul>
                </nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<h1>Cours de cuisine</h1>


							<!-- Text -->
								<section>
                                    <h2>Résultats</h2>
                                    <div class="row">
                                    <?php

                                    $infoLesson = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lesson", []);
                                    foreach ($infoLesson as $key) {
                                        echo "
                                                <div class='col-12 row' onclick='window.location=\"lesson_profile.php?id=". $key['id'] ."\";' >
                                                    
                                                            <div class='col-3'><b>".$key['title']."</b></div>
                                                            <div class='col-3'>".$key['date']."</div>
                                                            <div class='col-3'>".$key['address']."</div>
                                                            <div class='col-3'><iframe src='".$key['maps']."' width='300' height='50' frameborder='0' style='border:0' allowfullscreen></iframe></div>
                                                            
                                                    
                                                </div>
                                            ";
                                    }
                                    ?>
                                    </div>

								</section>

						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
                            <ul class="copyright">
								<li>&copy; Stop Waste 2019</li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="../js/jquery.min.js"></script>
			<script src="../js/browser.min.js"></script>
			<script src="../js/breakpoints.min.js"></script>
			<script src="../js/util.js"></script>
			<script src="../js/main.js"></script>

	</body>
</html>