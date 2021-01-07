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
		<title>Service</title>
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

                            <?php
                            // Toujours mettre le tableau vide même pour un select * sans paramètres
                            if ($_SESSION['lang']=="fr"){
                                $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_fr", []);
                            }else if ($_SESSION['lang']=="en"){
                                $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_en", []);
                            } else if (!isset($_SESSION['lang'])){
                                $_SESSION['lang'] = "fr";
                                $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_fr", []);
                            }

                            foreach ($info as $key) {
                                //echo $key['name'];
                                ?>
                                    <li><a href="<?php echo "" ?>services.php"><?php echo utf8_encode($key['name']);?></a></li>
                                <?php
                            }

                            ?>
                            <li><a href="deconnect.php">Deconnexion</a></li>

						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<h1><?php echo $lang['service_title']?></h1>

                            <section>
                                <a href="services_crea.php"><h2><?php echo $lang['service_btn_create_serv']?></h2></a>

                                <h2><?php echo $lang['service_choice']?></h2>
                                <form method="post" action="#">
                                    <div class="row gtr-uniform">
                                        <div class="col-6 col-12-xsmall">
                                            <input type="text" name="" id="" value="" placeholder="<?php echo $lang['service_search']?>" />
                                        </div>
                                        <div class="col-6 col-12-xsmall">
                                            <input type="text" name="" id="" value="" placeholder="<?php echo $lang['service_city']?>" />
                                        </div>
                                        <div class="col-12">
                                            <select name="type" id="demo-category">
                                                <option value="3"><?php echo $lang['cars_sharing']?></option>
                                                <option value="4"><?php echo $lang['service_exchange']?></option>
                                                <option value="5"><?php echo $lang['repair_service']?></option>
                                                <option value="6"><?php echo $lang['caretaking']?></option>
                                            </select>
                                        </div>
                                        <div class="align-center col-6" style="text-align: center">
                                            <input type="submit" value="<?php echo $lang['research']; ?>" />
                                        </div>
                                        <div class="align-center col-6" style="text-align: center">
                                            <input type="reset" value="<?php echo $lang['reset']; ?>" />
                                        </div>
                                    </div>
                                </form>
                            </section>



                            <?php

                            if (!isset($_GET['type'])){
                                $serv = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services", []);
                            }else if ($_GET['type']=="cars"){
                                $serv = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services WHERE type=3", []);
                            }else if ($_GET['type']=="exchange"){
                                $serv = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services WHERE type=4", []);
                            }else if ($_GET['type']=="repair"){
                                $serv = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services WHERE type=5", []);
                            }else if ($_GET['type']=="caretaking"){
                                $serv = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services WHERE type=6", []);
                            }

                            ?>


							<!-- Text -->
								<section>
                                    <h2>Résultats</h2>
                                    <div id="display">
                                        <table id="table">

                                        </table>
                                    </div>
                                    <div class="row">
                                    <?php
                                    foreach ($serv as $key) {
                                        echo "  
                                                <div class='col-12 row' onclick='window.location=\"services_prof.php?id=". $key['id'] ."\";' >
                                                            <div class='col-3'><img src='../images/services/".$key['image']."' style=\"width: 130px; \" ></div>
                                                            <div class='col-3'>".$key['city']."</div>
                                                            <div class='col-3'>".$key['name']."</div>
                                                            <div class='col-3'>".$key['phone']."</div>
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
                            <div style="text-align: center">
                            <a href="services.php?lang=fr">Français</a> | <a href="services.php?lang=en">English</a> | <a href="services.php?lang=pt">Português</a> | <a href="services.php?lang=it">Italiano</a> | <a href="services.php?lang=ir">Gaeilge</a>
                            </div>
                            <ul class="copyright">
								<li>&copy; Stop Waste 2019</li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->

			<script src="../js/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">

            $(document).ready(function(){
                var arrayData = <?php echo json_encode($serv); ?>;
                var arraytmp = Array();
                var arraycity = Array() ;

                arrayData.forEach(function(element){
                    arraycity.push(element["city"]);
                    arraycity.push(element["name"]);
                    arraycity.push(element["phone"]);
                    arraytmp.push(arraycity);
                    arraycity = [];
                });

                console.log(arraytmp);
;

//data demande un tableau de tableau [ [some data], [some data], etc.. ]
                $('#table').DataTable(
                    {
                        data: arraytmp
                    ,
                        "columns": [
                            {
                                "title" : "city",
                            },
                            {
                                "title" : "name",
                            },
                            {
                                "title" : "phone",
                            }
                        ],
                    }
                );

            })
        </script>
			<script src="../js/browser.min.js"></script>
			<script src="../js/breakpoints.min.js"></script>
			<script src="../js/util.js"></script>
			<script src="../js/main.js"></script>

	</body>
</html>