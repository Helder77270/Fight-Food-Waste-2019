$(document).ready(function () {

    var form = $('#user_update_form'); // sélectionne le formulaire
    var button_update_user= $('#update_user');
    var resultDiv = $('#result');

    console.log(form.serialize());
    //var id = $("#myIdUser").attr("value");

    button_update_user.click(function (e) { //

        e.preventDefault(e); // empêche le bouton #loginbuttion de faire son action de base (submit le formulaire) pour laisser place à notre évèvement (la connexion / requêtage des données user en BDD
        $.ajax({

            url: '../services/user/modify.php', //Appelle le script PHP à exécuter, chemin à écrire comme si on cherchait de fichier de par la page sur laquelle il est intégrer
            type:'POST', // On envoie les données en POST
            data: form.serialize(), // Encode le formulaire en un seul string ex: https://api.jquery.com/serialize/

            success: function (response) {

                resultDiv.empty();
                response = $.parseJSON(response); // Transform un JSON (ici la valeur de retourne de ma fonction de connexion PHP), en variable JavaScript
                // ex: $response = $parseJSON(["error" => "Aucune donnée envoyée"]
                // $response deviendrait --> "Aucune donnée envoyée"

                if (response.error) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    resultDiv.append("<br><div class='alert alert-danger' role='alert'>"+ response.error +"</div>");

                }else if (response.success) {
                    resultDiv.append("<br><div class='alert alert-success' role='alert' style='text-align: center;'>"+ response.success +"</div>");
                    //window.location.href = '../index.php'; // C'est l'égal du header location en php

                }
            },
            error: function (response) {
                resultDiv.empty();
                response = $.parseJSON(response);
                if (response.error) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    resultDiv.append("<br><div class='alert alert-danger' role='alert'>"+ response.error +"</div>");

                }else if (response.success) {
                    resultDiv.append("<br><div class='alert alert-success' role='alert' style='text-align: center;'>"+ response.success +"</div>");

                }
            }
        })
    })
});