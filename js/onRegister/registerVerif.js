jQuery(document).ready(function(){
    console.log("jquery est fucking pret");

    //document.getElementById("registerbutton").style.display='block';
    //---------------------------------------------
    // Variables qui appelle les champs par leur ID
    //---------------------------------------------

    var $username = $('#username');
    var $firstname = $('#firstname');
    var $lastname = $('#lastname');
    var $mail = $('#mail');
    var $conf_mail = $('#conf_mail');
    var $password = $('#password');
    var $conf_password = $('#conf_password');
    var $postalcode = $('#postalcode');
    var $housenumber = $('#housenumber');
    var $country = $('#country');
    var $city = $('#city');
    var $street = $('#street');
    var $skill1 = $('#skill1');
    var $skill2 = $('#skill2');
    var $skill3 = $('#skill3');
    var $siret = $('#siret');
    var $lob = $('#lob');
    var $individual = $('#individual');
    var $volunteer = $('#volunteer');
    var $business = $('#business');
    //---------------------------------------------

    //---------------------------------------------
    // Variables des Verifs pour envoie des champs initialiser a KO puis fonctionne lorsque = a OK
    //---------------------------------------------
    var IsGoodUsername = 'KO';
    var IsGoodFirstname = 'KO';
    var IsGoodLastname = 'KO';
    var IsGoodMail = 'KO';
    var IsGoodConf_mail = 'KO';
    var IsGoodPassword = 'KO';
    var IsGoodConf_Password = 'KO';
    var IsGoodPostalcode = 'KO';
    var IsGoodHouseNumber = 'KO';
    var IsGoodCountry = 'KO';
    var IsGoodCity = 'KO';
    var IsGoodStreet = 'KO';
    var IsGoodSkill1 = 'KO';
    var IsGoodSkill2 = 'KO';
    var IsGoodSkill3 = 'KO';
    var IsGoodLob = 'KO';
    var IsGoodSiret= 'KO';

    //---------------------------------------------

    //---------------------------------------------
    // RegEx pour la verification des champs du formulaire
    //---------------------------------------------
    var regexUsername = new RegExp("^[0-9a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{2,27}$");
    var regexFirstLast = new RegExp("^([a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,26})(-?)([a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,26})$");
    var regexMail= new RegExp("[A-Za-z0-9](([_\\.\\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\\.\\-]?[a-zA-Z0-9]+)*)\\.([A-Za-z]{2,})");
    var regexPassword= new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,25}$");
    var regexPostalcode= new RegExp("^([0-9]{4,5})(-?)([0-9]{1,4})$");
    var regexCountryCity = new RegExp("^[A-Z].[a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\\ \\-]*$");
    var regexStreet= new RegExp("^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\\ \\-]{4,50}$");
    var regexSkill=new RegExp("^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\\ \\-]*$");
    var regexSiret=new RegExp("^[0-9]{14}$");
    var regexLob=new RegExp("^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\\ \\-]*$");
    var regexHousenumber=new RegExp("^([0-9]{1,3})*(\\ )*(BIS|TER|QUAT|bis|ter|quat|)$");

    //---------------------------------------------
    //---------------------------------------------
    // Ces fonctions permettent d'appeller les fonction incluses au click des buttons radio
    //---------------------------------------------

    $individual.click(function(){
        effacer_formulaire();
        NoneErrorMessage();
       // document.getElementById("registerbutton").style.display='none';
    });
    $volunteer.click(function(){
        effacer_formulaire();
        NoneErrorMessage();
        //document.getElementById("registerbutton").style.display='none';

    });
    $business.click(function(){
        effacer_formulaire();
        NoneErrorMessage();
        //document.getElementById("registerbutton").style.display='none';

    });

    //---------------------------------------------
    //---------------------------------------------
    // Ces fonctions permettent pour chaque champs lorsque les touches du clavier sont relachées de tester si les criteres de validation sont bon
    //---------------------------------------------


    $username.keyup(function(){
        if($(this).val().length > 2 && $(this).val().length < 25) {
            if (regexUsername.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodUsername = "OK";
                NoneErrorMessage();
               // console.log("Username OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodUsername = "KO";
                ErrorMessage('Presence de Caractere Spécial !');
               // document.getElementById("registerbutton").style.display='none';
                //console.log("Presence de Caractere Spécial !");
            }
            } else{
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodUsername = "KO";
                ErrorMessage('Nombre de caracteres non respecter (min 2, max 25)');
                //console.log("Nombre de caracteres non respecter (min 2, max 25)");
            }
        });


    $firstname.keyup(function(){
        if($(this).val().length > 2 && $(this).val().length < 25) {
            if (regexFirstLast.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodFirstname = "OK";
                NoneErrorMessage();
                console.log("Firstname OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodFirstname = "KO";
                ErrorMessage('Presence de Caractere Spécial ou Chiffre !');
               // document.getElementById("registerbutton").style.display='none';
                console.log("Presence de Caractere Spécial ou Chiffre !");
            }
        } else{
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodFirstname = "KO";
            ErrorMessage('Nombre de caracteres non respecter (min 2, max 25)');
            //document.getElementById("registerbutton").style.display='none';
            console.log("Nombre de caracteres non respecter (min 2, max 25)");
        }
    });


    $lastname.keyup(function(){
        if($(this).val().length > 2 && $(this).val().length < 25) {
            if (regexFirstLast.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodLastname = "OK";
                NoneErrorMessage();
                console.log("Lastname OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodLastname = "KO";
                ErrorMessage('Presence de Caractere Spécial ou Chiffre !');
                //document.getElementById("registerbutton").style.display='none';
                console.log("Presence de Caractere Spécial ou Chiffre !");
            }
        } else{
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodLastname = "KO";
            ErrorMessage('Nombre de caracteres non respecter (min 2, max 25)');
            //document.getElementById("registerbutton").style.display='none';
            console.log("Nombre de caracteres non respecter (min 2, max 25)");
        }
    });

    $mail.keyup(function(){
            if (regexMail.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodMail = "OK";
                NoneErrorMessage();
               // console.log("Email OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodMail = "KO";
                ErrorMessage('Format de l\'email pas bon !');
               // document.getElementById("registerbutton").style.display='none';
                //console.log("Format de l'email pas bon !");
            }
    });

    $conf_mail.keyup(function(){
        if ($(this).val() === $mail.val() && $(this).length === $mail.length) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodConf_mail = "OK";
            NoneErrorMessage();
            console.log("Verification Email OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodConf_mail = "KO";
            ErrorMessage('Email different !');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Email different !");
        }
    });


    $password.keyup(function(){
        if($(this).val().length > 2 && $(this).val().length < 25) {
            if (regexPassword.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodPassword = "OK";
                NoneErrorMessage();
                console.log("Password OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodPassword = "KO";
                ErrorMessage('Le mot de passe doit contenir 8 caracteres min et 25 max, 1 MAJ et 1 min (minimum) !');
               // document.getElementById("registerbutton").style.display='none';
                console.log("Le mot de passe doit contenir 8 caracteres min et 25 max, 1 MAJ et 1 min (minimum) !");
            }
        } else{
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodPassword = "KO";
            ErrorMessage('Nombre de caracteres non respecter (min 8, max 25)');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Nombre de caracteres non respecter (min 8, max 25)");
        }
    });

    $conf_password.keyup(function(){
        if ($(this).val() === $password.val() && $(this).length === $password.length) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodConf_Password = "OK";
            NoneErrorMessage();
            console.log("Verification mot de passe OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodConf_Password = "KO";
            ErrorMessage('Mot de passe different !');
            //document.getElementById("registerbutton").style.display='none';
            console.log("Mot de passe different !");
        }
    });

    $postalcode.keyup(function(){
            if (regexPostalcode.test($(this).val())) {
                $(this).css({
                    borderColor: 'green',
                    color: 'green'
                });
                IsGoodPostalcode= "OK";
                NoneErrorMessage();
                console.log("Code Postal OK!");
            } else {
                $(this).css({
                    borderColor: 'red',
                    color: 'red'
                });
                IsGoodPostalcode= "KO";
                ErrorMessage('Le Code Postal est formé de chiffres !');
               //document.getElementById("registerbutton").style.display='none';
                console.log("Le Code Postal est formé de 5 chiffres !");
            }
    });

    $housenumber.keyup(function(){
        if (regexHousenumber.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodHouseNumber= "OK";
            NoneErrorMessage();
            console.log("Code Postal OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodHouseNumber= "KO";
            ErrorMessage('Le champ House number doit contenir entre 1 et 3 chiffres et en complement (BIS,TER,QUAT) si nécessaire');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Le champ House number doit contenir entre 1 et 3 chiffres et en complement (BIS,TER,QUAT) si nécessaire");
        }
    });

    $country.keyup(function(){
        if (regexCountryCity.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodCountry = "OK";
            NoneErrorMessage();
            console.log("Pays OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodCountry = "KO";
            ErrorMessage('Le pays doit commencer par une MAJ !');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Le pays doit commencer par une MAJ !");
        }
    });


    $city.keyup(function(){
        if (regexCountryCity.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodCity = "OK";
            NoneErrorMessage();
            console.log("Ville OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodCity = "KO";
            ErrorMessage('La ville doit commencer par une MAJ !');
            //document.getElementById("registerbutton").style.display='none';
            console.log("La ville doit commencer par une MAJ !");
        }
    });

    $street.keyup(function(){
        if (regexStreet.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodStreet= "OK";
            NoneErrorMessage();
            console.log("Street OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodStreet= "KO";
            ErrorMessage('La rue ne doit pas contenir de chiffre !');
            //document.getElementById("registerbutton").style.display='none';
            console.log("La rue ne doit pas contenir de chiffre !");
        }
    });

    $skill1.keyup(function(){
        if (regexSkill.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodSkill1 = "OK";
            NoneErrorMessage();
            console.log("Skill OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodSkill1 = "KO";
            ErrorMessage('Le skill ne doit pas contenir de chiffre !');
            //document.getElementById("registerbutton").style.display='none';
            console.log("Le skill ne doit pas contenir de chiffre !");
        }
    });

    $skill2.keyup(function(){
        if (regexSkill.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodSkill2 = "OK";
            NoneErrorMessage();
            console.log("Skill OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodSkill2 = "KO";
            ErrorMessage('Le skill ne doit pas contenir de chiffre !');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Le skill ne doit pas contenir de chiffre !");
        }
    });

    $skill3.keyup(function(){
        if (regexSkill.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodSkill3 = "OK";
            NoneErrorMessage();
            console.log("Skill OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodSkill3 = "KO";
            ErrorMessage('Le skill ne doit pas contenir de chiffre !');
            //document.getElementById("registerbutton").style.display='none';
            console.log("Le skill ne doit pas contenir de chiffre !");
        }
    });

    $lob.keyup(function(){
        if (regexLob.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodLob = "OK";
            NoneErrorMessage();
            console.log("LOB OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodLob = "KO";
            ErrorMessage('Lob est un metier (pas de chiffre ni caractere special) !');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Lob est un metier (pas de chiffre) !");
        }
    });

    $siret.keyup(function(){
        if (regexSiret.test($(this).val())) {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
            IsGoodSiret = "OK";
            NoneErrorMessage();
            console.log("Siret OK!");
        } else {
            $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            IsGoodSiret = "KO";
            ErrorMessage('Le Siret est composé de 14 chiffres !');
           // document.getElementById("registerbutton").style.display='none';
            console.log("Le Siret est composé de 14 chiffres !");
        }
    });

    //---------------------------------------------
    //---------------------------------------------
    // Cette fonction permet d'effacer les données du formulaire lorsque la personne click sur un autre bouton radio
    //---------------------------------------------

    function effacer_formulaire(){

        $username.val('');
        IsGoodUsername = 'KO';
        $username.css({
                borderColor: 'silver',
                color: 'silver'
            });
        $firstname.val('');
        IsGoodFirstname = 'KO';
        $firstname.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $lastname.val('');
        IsGoodLastname = 'KO';
        $lastname.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $mail.val('');
        IsGoodMail = 'KO';
        $mail.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $conf_mail.val('');
        IsGoodConf_mail = 'KO';
        $conf_mail.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $password.val('');
        IsGoodPassword = 'KO';
        $password.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $conf_password.val('');
        IsGoodConf_Password = 'KO';
        $conf_password.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $postalcode.val('');
        IsGoodPostalcode = 'KO';
        $postalcode.css({
            borderColor: 'silver',
            color: 'silver'
        });

        $housenumber.val('');
        IsGoodHouseNumber = 'KO';
        $housenumber.css({
            borderColor: 'silver',
            color: 'silver'
        });

        $country.val('');
        IsGoodCountry = 'KO';
        $country.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $city.val('');
        IsGoodCity = 'KO';
        $city.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $street.val('');
        IsGoodStreet= 'KO';
        $street.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $skill1.val('');
        IsGoodSkill1 = 'KO';
        $skill1.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $skill2.val('');
        IsGoodSkill2 = 'KO';
        $skill2.css({
            borderColor: 'silver',
            color: 'silver'
        });
        $skill3.val('');
        IsGoodSkill3 = 'KO';
        $skill3.css({
            borderColor: 'silver',
            color: 'silver'
        });

        $lob.val('');
        IsGoodLob = 'KO';
        $lob.css({
            borderColor: 'silver',
            color: 'silver'
        });

        $siret.val('');
        IsGoodSiret = 'KO';
        $siret.css({
            borderColor: 'silver',
            color: 'silver'
        });


    }

    //---------------------------------------------
    //---------------------------------------------
    // Ces fonctions permettent lorsque le focus est perdu sur les champs du formulaire d'appeler les fonctions incluses qui permettent d'afficher le bouton inscrire
    //---------------------------------------------

    jQuery(document).focusout(function() {
       if($('input:checked').val()=== 'Individual'){
            IsgoodIndividual(IsGoodUsername, IsGoodFirstname, IsGoodLastname, IsGoodMail, IsGoodConf_mail, IsGoodPassword, IsGoodConf_Password, IsGoodPostalcode,IsGoodHouseNumber ,IsGoodCountry, IsGoodCity, IsGoodStreet);
        }
        if($('input:checked').val()=== 'Volunteer'){
            IsgoodVolunteer(IsGoodUsername, IsGoodFirstname, IsGoodLastname, IsGoodMail, IsGoodConf_mail, IsGoodPassword, IsGoodConf_Password, IsGoodPostalcode,IsGoodHouseNumber, IsGoodCountry, IsGoodCity, IsGoodStreet,IsGoodSkill1,IsGoodSkill2,IsGoodSkill3);
        }
        if($('input:checked').val()=== 'Business') {
            IsgoodBusiness(IsGoodUsername, IsGoodMail, IsGoodConf_mail, IsGoodPassword, IsGoodConf_Password, IsGoodPostalcode,IsGoodHouseNumber, IsGoodCountry, IsGoodCity, IsGoodStreet, IsGoodLob, IsGoodSiret);
        }
    });

    //---------------------------------------------
    //---------------------------------------------
    // Ces fonctions permettent de verifier si tous les champs sont OK et affiche le bouton d'inscription
    //---------------------------------------------

    function IsgoodIndividual(Champ,Champ1,Champ2,Champ3,Champ4,Champ5,Champ6,Champ7,Champ8,Champ9,Champ10,Champ11) {
        if (Champ === "OK" && Champ1 === "OK" && Champ2 === "OK" && Champ3 === "OK" && Champ4 === "OK" && Champ5 === "OK" && Champ6 === "OK" && Champ7 === "OK" && Champ8 === "OK" && Champ9 === "OK" && Champ10 === "OK" && Champ11 === "OK") {
            console.log("ALL GOOD !!!!");
            document.getElementById("registerbutton").style.display = 'block';
        }
    }

    function IsgoodVolunteer(Champ,Champ1,Champ2,Champ3,Champ4,Champ5,Champ6,Champ7,Champ8,Champ9,Champ10,Champ11,Champ12,Champ13,Champ14) {
        if (Champ === "OK" && Champ1 === "OK" && Champ2 === "OK" && Champ3 === "OK" && Champ4 === "OK" && Champ5 === "OK" && Champ6 === "OK" && Champ7 === "OK" && Champ8 === "OK" && Champ9 === "OK" && Champ10 === "OK" && Champ11 === "OK" && Champ12 === "OK" && Champ13 === "OK" && Champ14 === "OK") {
            console.log("ALL GOOD !!!!");
            document.getElementById("registerbutton").style.display = 'block';
        }
    }

    function IsgoodBusiness(Champ,Champ1,Champ2,Champ3,Champ4,Champ5,Champ6,Champ7,Champ8,Champ9,Champ10,Champ11) {
        if (Champ === "OK" && Champ1 === "OK" && Champ2 === "OK" && Champ3 === "OK" && Champ4 === "OK" && Champ5 === "OK" && Champ6 === "OK" && Champ7 === "OK" && Champ8 === "OK" && Champ9 === "OK" && Champ10 === "OK" && Champ11 === "OK") {
            console.log("ALL GOOD !!!!");
            document.getElementById("registerbutton").style.display = 'block';
        }
    }

    //---------------------------------------------
    //---------------------------------------------
    // Ces fonctions permettent d'afficher ou d'enlever le message d'erreur en rouge lors du remplissage des champs
    //---------------------------------------------

    function ErrorMessage(message){
        document.getElementById("message").textContent=message;
        document.getElementById("message").style.display='block';
    }

    function NoneErrorMessage(){
        document.getElementById("message").style.display='none';
    }

    //---------------------------------------------

});


//REGEX MAIL : [A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})
/*console.log("ALL GOOD !!!!");
$registerbutton.fadeIn('500');
}else{
    console.log("NOT ALL GOOD !!!");
    $registerbutton.fadeOut('500');*/
