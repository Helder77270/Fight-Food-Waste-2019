$(document).ready(function () {

    var form = $('#tourForm'); // sélectionne le formulaire
    var order_list = $('#ord_list');
    var coords = $('#coords');
    var generateButton = $('#generate');
     window.response2 = "ntm";

    generateButton.click(function (e) {

        e.preventDefault(e); // empêche le bouton #loginbuttion de faire son action de base (submit le formulaire) pour laisser place à notre évèvement (la connexion / requêtage des données user en BDD
        $.ajax({

            url: '../services/orders/generateTour.php', //Appelle le script PHP à exécuter, chemin à écrire comme si on cherchait de fichier de par la page sur laquelle il est intégrer
            type:'POST', // On envoie les données en POST
            data: form.serialize(), // Encode le formulaire en un seul string ex: https://api.jquery.com/serialize/

            success: function (response) {

                order_list.empty();

                response = $.parseJSON(response); // Transform un JSON (ici la valeur de retourne de ma fonction de connexion PHP), en variable JavaScript
                // ex: $response = $parseJSON(["error" => "Aucune donnée envoyée"]
                // $response deviendrait --> "Aucune donnée envoyée"

                console.log(response.order_name);
                console.log(response.points);

                if (response.points) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    // response.forEach(function (element) {
                    //     order_list.append(" <option>"+element+"</option> ");
                    // });
                    var wayptsArray = new Array();
                    $.each(response.points, function (i,item) {
                      var wayptsLat = item['results'][0]['geometry']['location']['lat'];
                      var wayptsLng = item['results'][0]['geometry']['location']['lng'];
                      wayptsArray.push(wayptsLat,wayptsLng);
                    });

                    window.response2 = wayptsArray;
                    console.log(window.response2);
                    console.log(window.response2[0]);console.log(window.response2[1]);
                    window.location.search = "lat1=" + window.response2[0] + "&lng1=" + window.response2[1];
                }else {
                    console.log("Pas de résultats : coordonnées");

                }
                if (response.order_name) {
                    $.each(response.order_name, function (i,item) {
                        order_list.append("<p>"+response.order_name[i]+"</p>");
                    });

                }else {
                    console.log("Pas de résultats : order_name");
                }
            },
            error: function (response) {
                order_list.empty();
                response = $.parseJSON(response);
                if (response.error) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    order_list.append("<div class='alert alert-danger' role='alert'>"+ response.error +"</div>");

                }else if (response.success) {
                    order_list.append("<div class='alert alert-success' role='alert'>"+ response.success +"</div>");

                }
            }
        })
    })
});