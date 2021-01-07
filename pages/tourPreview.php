<?php

require_once __DIR__ . '/../models/GoogleMapsAPIObject.php';
require_once __DIR__ . '/../services/orders/OrderService.php';
require_once __DIR__.'/../dao/OrderDao.php';
$obj = new GoogleMapsAPIObject("AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c"); // API key qui nous est personnelle -> Permettra de faire des requetes https juste pour nous

$res = DatabaseManager::getSharedInstance()->selec("SELECT region FROM user WHERE mail=?",[$_GET['usr']]);
$region = $res[0]['region'];
$order = OrderDao::numOrderByRegion($region);

$newValue = array();
$res = array();

foreach ($order as $item){
    $orders[] = $item['num_order'];
    $res[] = DatabaseManager::getSharedInstance()->selec("SELECT housenumber,street,city,country FROM orders INNER JOIN user ON orders.fk_mail_user = user.mail WHERE orders.num_order = ? ",[$item['num_order']]);
}


$res1 = $obj->getLatAndLng($res[0][0]['housenumber'],$res[0][0]['street'],$res[0][0]['city'],$res[0][0]['country']); // Fais la requête comme t'as fait pour le C St Phan
$res2 = $obj->getLatAndLng($res[1][0]['housenumber'],$res[1][0]['street'],$res[1][0]['city'],$res[1][0]['country']);
$res3 = $obj->getLatAndLng($res[2][0]['housenumber'],$res[2][0]['street'], $res[2][0]['city'],$res[2][0]['country']);
$res4 = $obj->getLatAndLng($res[3][0]['housenumber'],$res[3][0]['street'], $res[3][0]['city'],$res[3][0]['country']);
$res5 = $obj->getLatAndLng($res[4][0]['housenumber'], $res[4][0]['street'],$res[4][0]['city'],$res[4][0]['country']);
$hangar = $obj->getLatAndLng(20, "rue Meynadier","Paris","France");

$res = array($res1,$res2,$res3,$res4,$res5,$hangar);
//var_dump($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">

    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map.

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


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
        <div class="sidebar-brand-text mx-3">Stop Waste</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="admin.php">
            <span>Accueil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <span>Pour l'admin</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tu peux choisir :</h6>
                <a class="collapse-item" href="volunteerToValidate.php">Profils</a>
                <a class="collapse-item" href="panier.php">Panier</a>
                <a class="collapse-item" href="products.php">Produits</a>
                <a class="collapse-item" href="ordersToValidate.php">Commande à valider</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <h1 style="margin-left: 40px">Administration</h1>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                </li>
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->

                        <?php
                        $notif = 0;
                        $infoNotif = DatabaseManager::getSharedInstance()->selec("SELECT * FROM user WHERE status=0 AND type=?", ['Volunteer']);

                        foreach ($infoNotif as $key){
                            if($infoNotif){
                                $notif++;
                            }
                        }

                        ?>

                        <span class="badge badge-danger badge-counter"><?php echo $notif?></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Nouveaux comptes :
                        </h6>


                        <?php
                        foreach ($infoNotif as $key){
                            ?>


                            <a class="dropdown-item d-flex align-items-center" href="<?php echo "volunteerToValidateChoice.php?mail=".$key['mail'];?>">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><?php echo $key['firstname']." ". $key['name']?></div>
                                    <span class="font-weight-bold"><?php echo "mail : ".$key['mail']?></span>
                                </div>
                            </a>

                            <?php
                        }

                        ?>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- End of Topbar -->

<div class="row">
    <div class="col-12" style="text-align: center">

        <!--Cette div est celle de la map google-->
        <div id="map" style="width: 100%; height: 500px"></div>
    </div>

</div>
<script>
    // Fonction callback appelée par l'API Google IL FAUT CODER TOUT GOOGLE MAPS DEDANS
    function mapRenderer() {

        // Activation du service Directions de Google
        var directionTracer = new google.maps.DirectionsService();

        // // Affiche le tracé de la route
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
            zoom : 20, // Puissance du zoom
            center : address1,
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
                    trafficModel: 'pessimistic' // Imagine le trafic routier de la manière la plus pessimiste possible
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


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c&callback=mapRenderer"></script>

<section style="margin-top: 20px">
    <form id="tourForm">
        <div class="row" style="text-align: center">

            <div class="col-3" style="margin-bottom: 10px">Mail: <input type='text' name="usrMail" value="<?php echo $_GET['usr']?>" style='width: 300px; text-align: center'></div>
            <div class="col-3" style="margin-bottom: 10px">Plaque :<input type='text' name="truckPlate" value="<?php echo $_GET['truck']?>" style='width: 300px; text-align: center'></div>
            <div class="col-3" style="margin-bottom: 10px">1ère :<input type='text' name="orders1" value="<?php echo $orders[0]?>" style='width: 300px; text-align: center'></div>
            <div class="col-3" style="margin-bottom: 10px">2ème :<input type='text' name="orders2" value="<?php echo $orders[1]?>" style='width: 300px; text-align: center'></div>
            <div class="col-4" style="margin-bottom: 10px">3ème :<input type='text' name="orders3" value="<?php echo $orders[2]?>" style='width: 300px; text-align: center'></div>
            <div class="col-4" style="margin-bottom: 10px">4ème :<input type='text' name="orders4" value="<?php echo $orders[3]?>" style='width: 300px; text-align: center'></div>
            <div class="col-4" style="margin-bottom: 10px">5ème :<input type='text' name="orders5" value="<?php echo $orders[4]?>" style='width: 300px; text-align: center'></div>

            <div class="col-12"><button type="submit" id="tourButton" style="padding: 5px; border-radius: 2px">Créer la tournée</button></div>

        </div>

    </form>
    <div id="result"></div>
</section>
    </div></div></div>
</body>
<?php
foreach ($orders as $key){
    echo "<div class='col-4'>
    <input type='hidden' value='$key' style='width: 200px'></div>";
}
?>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/AjaxScripts/tour/create.js"></script>
</html>


