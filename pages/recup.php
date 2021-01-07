<?php
session_start();

require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__ .'/../languages/config.php');
require_once (__DIR__ .'/../services/google_maps_api/GoogleMapApi.php');
require_once (__DIR__ . '/../models/GoogleMapsAPIObject.php');

$obj = unserialize($_SESSION['user']);

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}



$coords = new GoogleMapsAPIObject("AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c"); // API key qui nous est personnelle -> Permettra de faire des requetes https juste pour nous
$res1 = $coords->getLatAndLng(17, "chemin du port", "Montévrain", "France"); // Fais la requête comme t'as fait pour le C St Phan
$res2 = $coords->getLatAndLng(134, "rue du chateau", "Boulogne-Billancourt", "France");
$res3 = $coords->getLatAndLng(90, "avenue Jean d'Estienne d'Orves", "Joinville Le Pont", "France");
$res4 = $coords->getLatAndLng(242, "Faubourg Saint-Antoine", "Paris", "France");
$res5 = $coords->getLatAndLng(17, "rue de la forge royale", "Paris", "France");
$hangar = $coords->getLatAndLng(20, "rue Meynadier", "Paris", "France");

$res = array($res1, $res2, $res3, $res4, $res5, $hangar);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Benevolat</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../css/main.css" />
		<noscript><link rel="stylesheet" href="../css/noscript.css" /></noscript>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map.
              Clé d'API : AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c
              */
            #map {
                height: 25%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
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
                            $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_fr", []);
                            foreach ($info as $key) {

                                ?>
                                    <li><a href=""><?php echo utf8_encode($key['name']);?></a></li>
                                <?php
                            }

                            ?>

						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<h1>Récolte des aliments</h1>

                            <section>
                                <form id="servicecreationform">
                                    <div class="row gtr-uniform">
                                        <div class="col-6 col-12-xsmall">
                                            <h2>Combien de km maximum voulez-vous parcourir ?</h2>
                                            <input type="number" name="km" id="" value="" placeholder="km" min="5" max="99"/>
                                        </div>
                                        <div class="col-6 col-12-xsmall">
                                            <h2>Vous partez de :</h2>
                                            <input type="text" name="address" id="" value="<?php echo $obj->gethousenumber()." ".$obj->getstreet(); ?>" placeholder="Où vous trouver ?" />
                                        </div>
                                        <div class="col-6 col-12-xsmall">
                                            <h2>Ville</h2>
                                            <input type="text" name="city" id="" value="<?php echo $obj->getcity(); ?>" placeholder="Où vous trouver ?" />
                                        </div>
                                        <div class="col-6 col-12-xsmall">
                                            <h2>Code postal</h2>
                                            <input type="text" name="postal_code" id="" value="<?php echo $obj->getpostalcode(); ?>" placeholder="Où vous trouver ?" />
                                        </div>
                                        <div class="align-center col-6 col-12-small" style="text-align: center">
                                            <input type="submit" id="validatebutton" value="Valider" />
                                        </div>
                                        <div class="align-center col-6 col-12-small" style="text-align: center">
                                            <input type="reset" value="Reset" />
                                        </div>
<!--                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3130.9633001285915!2d2.336661709483646!3d48.88286755508758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e44e2a227af%3A0x641930356f5c6782!2sLe+mur+des+je+t&#39;aime!5e0!3m2!1sfr!2sfr!4v1559221718343!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                                    </div>
                                </form>
                            </section>
                                         <div id="result"></div>
                                         <div id="map"></div>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>


			</div>

		<!-- Scripts -->
        <script>
            // Fonction callback appelée par l'API Google IL FAUT CODER TOUT GOOGLE MAPS DEDANS
            function mapRenderer() {

                // Activation du service Directions de Google
                var directionTracer = new google.maps.DirectionsService();

                // Affiche le tracé de la route
                var directionDisplay = new google.maps.DirectionsRenderer();

                // On récupère la latitude et la longitude des différentes adresses retournées
                var address1 = new google.maps.LatLng(<?php echo $res[0]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[0]['results'][0]['geometry']['location']['lng']; ?>);
                var address2 = new google.maps.LatLng(<?php echo $res[1]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[1]['results'][0]['geometry']['location']['lng']; ?>);
                var address3 = new google.maps.LatLng(<?php echo $res[2]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[2]['results'][0]['geometry']['location']['lng']; ?>);
                var address4 = new google.maps.LatLng(<?php echo $res[3]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[3]['results'][0]['geometry']['location']['lng']; ?>);
                var address5 = new google.maps.LatLng(<?php echo $res[4]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[4]['results'][0]['geometry']['location']['lng']; ?>);
                var hangar = new google.maps.LatLng(<?php echo $res[5]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[5]['results'][0]['geometry']['location']['lng']; ?>);

                // Tableau d'options d'initialisation de la map
                var options = {
                    zoom : 14, // Puissance du zoom
                    //center : address1
                    draggable:true // Empêche tout déplacement sur la carte
                };
                // Création d'une map Google avec les paramètres du dessus
                var map = new google.maps.Map(document.getElementById('map'), options);

                // On indique au traceur sur quel map il doit se placer
                directionDisplay.setMap(map);

                function calculateRoute() {

                    // Dans waypts on met tous les points
                    var waypts = [];
                    waypts.push({
                            location: address1, // Lat et Lng du point
                            stopover: true // Stopover indique le fait que ce soit un point d'arrêt sur la route
                        },{
                            location: address2, // Lat et Lng du point
                            stopover: true // Stopover indique le fait que ce soit un point d'arrêt sur la route
                        },
                        {
                            location: address3,
                            stopover: true
                        },
                        {
                            location: address4,
                            stopover: true
                        },
                        {
                            location:address5,
                            stopover: true
                        }
                    );
                    var timestamp = Date.now(); // Récupère la date du système
                    // Tableau d'option du tracé
                    var query = {
                        origin: hangar, // Adresse de départ
                        waypoints: waypts, // Tableau des adresses de la route
                        destination: hangar,// Adresse de d'arrivée
                        optimizeWaypoints: true, // Optimise parfois le chemin entre les points si nécéssaires
                        provideRouteAlternatives:true, // Peu proposer des routes alternatives
                        travelMode: 'DRIVING', // Type de déplacement 'DRIVING', 'BICYCLING' ,'TRANSIT', 'WALKING'
                        drivingOptions: {
                            departureTime: new Date(timestamp),
                            trafficModel: 'pessimistic' // Imagine le trafic routier de la manière la plus peessimiste possible
                        }
                    };

                    // On passe au traceur la fonction route qui prend en paramètres nos options (=query)
                    // et une function qui récupère la réponse de l'API sur le résultat du tracé et l'état de la requête HTTP
                    directionTracer.route(query, function (result,status) {
                        if (status === 'OK'){ // Si le statut renvoyez = 'OK"
                            directionDisplay.setDirections(result); // On dessine avec la fonction setDirections
                        }
                    })
                }

                calculateRoute();// On appelle la fonction

            }
            //  var myKey = "AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c";

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c&callback=mapRenderer"
                async defer></script>
			<script src="../js/jquery.min.js"></script>
			<script src="../js/browser.min.js"></script>
			<script src="../js/breakpoints.min.js"></script>
			<script src="../js/util.js"></script>
			<script src="../js/main.js"></script>
            <script src="../js/AjaxScripts/service/create.js"></script>
	</body>
</html>