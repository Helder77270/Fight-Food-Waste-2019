<?php

require_once __DIR__ . '/../../models/GoogleMapsAPIObject.php';
require_once __DIR__ . '/../../services/orders/OrderService.php';

$obj = new GoogleMapsAPIObject("AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c"); // API key qui nous est personnelle -> Permettra de faire des requetes https juste pour nous
$res1 = $obj->getLatAndLng(17,"chemin du port","Montévrain","France"); // Fais la requête comme t'as fait pour le C St Phan
$res2 = $obj->getLatAndLng(134,"rue du chateau","Boulogne-Billancourt","France");
$res3 = $obj->getLatAndLng(90,"avenue Jean d'Estienne d'Orves", "Joinville Le Pont","France");
$res4 = $obj->getLatAndLng(242,"Faubourg Saint-Antoine", "Paris","France");
$res5 = $obj->getLatAndLng(17, "rue de la forge royale","Paris","France");
$hangar = $obj->getLatAndLng(20, "rue Meynadier","Paris","France");

$res = array($res1,$res2,$res3,$res4,$res5,$hangar);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

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


<body>


<!--Cette div est celle de la map google-->
<div id="map"></div>
<script>
    // Fonction callback appelée par l'API Google IL FAUT CODER TOUT GOOGLE MAPS DEDANS
    function mapRenderer() {

        // Activation du service Directions de Google
        var directionTracer = new google.maps.DirectionsService();

        // // Affiche le tracé de la route
        var directionDisplay = new google.maps.DirectionsRenderer();

    // On récupère la latitude et la longitude des différentes adresses retournées
    var address1 = new google.maps.LatLng(<?php echo $res[0]['results'][0]['geometry']['location']['lat']; ?>,<?php echo $res[0]['results'][0]['geometry']['location']['lng']; ?>);


    // Tableau d'options d'initialisation de la map
        var options = {
            zoom : 14, // Puissance du zoom
            center : address1,
            draggable:false // Empêche tout déplacement sur la carte
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c&callback=mapRenderer" async defer></script>
</body>
</html>
<!--async : charger/exécuter les scripts de façon asynchrone.-->
<!--defer : différer l'exécution à la fin du chargement du document.-->

