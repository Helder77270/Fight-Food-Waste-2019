$(document).ready(function () {

    var form = $('#contactform'); // sélectionne le formulaire

    $('#sendmessage').click(function (e) {

        e.preventDefault(e);
        $.ajax({


            url: '../services/mail/support.mail',
            type:'POST', // On envoie les données en POST
            data: form.serialize(), // Encode le formulaire en un seul string ex: https://api.jquery.com/serialize/

            success: function (response) {

                resultDiv.empty();
                response = JSON.parse(response); // Transform un JSON (ici la valeur de retourne de ma fonction de connexion PHP), en variable JavaScript
                // ex: $response = $parseJSON(["error" => "Aucune donnée envoyée"]
                // $response deviendrait --> "Aucune donnée envoyée"

                if (response.error) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    resultDiv.append("<div class='alert alert-danger' role='alert'>"+ response.error +"</div>");

                }else if (response.success) {
                    resultDiv.append("<div class='alert alert-success' role='alert' style='text-align: center;'>"+ response.success +"</div>");

                }
            },

            error: function (response) {
                resultDiv.empty();
                response = JSON.parse(response);
                if (response.error) {
                    // .append ajoute dans notre cas une div dans la div #result de login.php avec le message retourné
                    resultDiv.append("<div class='alert alert-danger' role='alert'>"+ response.error +"</div>");

                }else if (response.success) {
                    resultDiv.append("<div class='alert alert-success' role='alert' style='text-align: center;'>"+ response.success +"</div>");

                }
            }
        })

    })

});