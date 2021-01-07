<?php
require_once (__DIR__ .'/../languages/config.php');

require_once "../languages/".$_SESSION['lang'].".php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stop Waste - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- CSS -->
    <!--    <link href="../css/switchery.css">-->

    <!-- JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    <script src="../js/onRegister/dynamicRegisterForm.js"></script>
    <script src="../js/onRegister/registerVerif.js"></script>

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $lang['register_title']?></h1>
                        </div>
                        <!-- A transformer en AJAX aussi -->
                        <div class="user">
                            <form id="registerform"">

                            <div class="form-group">
                                <input type="radio" id="individual" name="type" value="Individual" onclick="showHide()"> <?php echo $lang['register_indv']?>
                                <input type="radio" id="volunteer" name="type" value="Volunteer" onclick="showHide()"> <?php echo $lang['register_volun']?>
                                <input type="radio" id="business" name="type" value="Business" onclick="showHide()"> <?php echo $lang['register_busi']?>
                            </div>

                            <!-- These form css works like this :

                               - If div class =  form-group row -> You will be able to use bootstrap properties to put different fields in line
                               - Remember bootstrap works as a grid with 12 column so "col-sm-6" means the field will be 50% of the free space
                               - If div class = form-group -> The field will take all the space he can
                               - To do css modifications go on the .min.css file

                             -->

                            <div id="formStatus" class="formAwaitRadioSelection">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="<?php echo $lang['register_username']?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstname" name="firstname" placeholder="<?php echo $lang['register_fn']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname" placeholder="<?php echo $lang['register_ln']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="mail" name="mail" placeholder="<?php echo $lang['register_mail']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control form-control-user" id="conf_mail" name="conf_mail" placeholder="<?php echo $lang['register_mail_conf']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="pwd" placeholder="<?php echo $lang['register_pwd']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="conf_password" name="conf_pwd" placeholder="<?php echo $lang['register_pwd_conf']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-2 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="country" name="country"
                                               list="datalistCOUNTRIES" placeholder="<?php echo $lang['register_country']?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="city" name="city"
                                               list="datalistCITY" placeholder="<?php echo $lang['register_city']?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="postalcode" name="postcode" placeholder="<?php echo $lang['register_cp']?>">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-user" id="housenumber"
                                           name="housenumber" placeholder="<?php echo $lang['register_nb_house']?>">
                                </div>
                                <div class="col-sm-10 form-group">
                                    <input type="text" class="form-control form-control-user" id="street" name="street" placeholder="<?php echo $lang['register_street']?>">
                                </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="lob" name="lob"
                                           list="datalistLOB" placeholder="<?php echo $lang['register_lob']?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="siret" name="siret" placeholder="<?php echo $lang['register_siret']?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-2 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="skill1" name="skill1" placeholder="<?php echo $lang['register_sk1']?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="skill2" name="skill2" placeholder="<?php echo $lang['register_sk2']?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="skill3" name="skill3" placeholder="<?php echo $lang['register_sk3']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="region" required>
                                            <option value="1">Ile-de-France</option>
                                            <option value="2">Loire-Atlantique</option>
                                            <option value="3">Campanie</option>
                                            <option value="4">District de Porto</option>
                                            <option value="5">Compté de Dublin</option>
                                            <option value="6">Provence-Alpes-Côte d’Azur‎</option>
                                            <option value="7">Nouvelle-Aquitaine</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Random token - fait un melange des letres de $str est prends les premiers 15 caractères du résultat -->
                                <?php
                                $str = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789!$()*";
                                $str = str_shuffle($str);
                                $str = substr($str, 0,15);
                                ?>

                                <div class="form-group">
                                    <input type="hidden" class="form-control form-control-user" id="token" name="token"
                                           placeholder="Token" value="<?php echo $str ?>">
                                </div>

                                <div id="result"></div>
                                <!-- If no echo the value will not be set in the field, property hidden make the field invisible -->
                            </div>
                            <input type="submit" id="registerbutton" name="regform" class="btn btn-primary btn-user btn-block" value="<?php echo $lang['register_ins']?>">
                            <hr>
                            <div class="text-center">
                                <p style="color:#FF0000;display:none" id="message" name="message"></p>
                            </div>

                            <!--
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                              <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                              <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>
                            -->
                            </form>
                            <div class="text-center">
                                <a class="small" href="../services/user/flou.php"><?php echo $lang['register_frgt_pwd']?></a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php"><?php echo $lang['register_btn_login']?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- This data list refers to the "Line of business field which means if we want to add option to the "Line of business fields it's here / WE COULD DO THIS WITH A PHP TABLE -->
    <datalist id="datalistLOB">
        <option value="Food sell"></option>
        <option value="Association"></option>
        <option value="School help"></option>
        <option value="Sports"></option>
    </datalist>

    <!-- This data list refers to the "Line of business field which means if we want to add option to the "Line of business fields it's here / WE COULD DO THIS WITH A PHP TABLE -->
    <datalist id="datalistCOUNTRIES">
        <option value="France"></option>
        <option value="Italy"></option>
        <option value="Portugal"></option>
        <option value="Irland"></option>
    </datalist>

    <!-- This data list refers to the "Line of business field which means if we want to add option to the "Line of business fields it's here / WE COULD DO THIS WITH A PHP TABLE -->
    <datalist id="datalistCITY">
        <option value="Nantes"></option>
        <option value="Marseille"></option>
        <option value="Limoges"></option>
        <option value="Porto"></option>
        <option value="Naples"></option>
        <option value="Dublin"></option>
    </datalist>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/AjaxScripts/user/register.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>


</body>

</html>
