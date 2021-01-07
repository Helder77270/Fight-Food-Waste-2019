<?php
session_start();

require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__ .'/../languages/config.php');
require_once "../languages/" . $_SESSION['lang'] . ".php";
$obj = unserialize($_SESSION['user']);

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}

/*
if(!empty($_FILES)){
    $f_name = $_FILES['picture']['name'];
    $file_ext = strrchr($f_name, ".");
    $f_name_tmp = $_FILES['picture']['tmp_name'];
    $f_dir = '../images/usr/' . $f_name;
    $ext_aut = array('.jpg', '.jpeg', '.png');

    echo 'Nom : '.$f_name.'</br>';
    echo 'Ext : '.$file_ext.'</br>';

    if (in_array($file_ext, $ext_aut)){
        if(move_uploaded_file($f_name_tmp, $f_dir)){
            echo 'Fichier upload avec succès';
        }else{
            echo "Une erreur est survenue";
        }
    }else{
        echo 'Seuls les images sont autorisées';
    }
}
*/
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $lang['crea_pro_ajout']?></title>
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
            $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_".$lang['serv'], []);
            foreach ($info as $key) {
                ?>
                <li><a href=""><?php echo utf8_encode($key['name']);?></a></li>
            <?php } ?>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <h1><?php echo $lang['crea_pro_ajout']?></h1>

            <section>
                <!-- Le enctype="multipart/form-data" permet la lecture d'image -->
                <form id="servicecreationform" enctype="multipart/form-data" >
                    <div class="row gtr-uniform">
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_ajout']?></h2>
                            <input type="text" name="name" id="" value="" placeholder="<?php echo $lang['crea_pro_plc_name']?>" />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_desc']?></h2>
                            <input type="text" name="description" id="" value="" placeholder="<?php echo $lang['crea_pro_plc_desc']?>" />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_address']?></h2>
                            <input type="text" name="address" id="" value="<?php echo $obj->gethousenumber()." ".$obj->getstreet(); ?>" placeholder="Où vous trouver ?" />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_city']?></h2>
                            <input type="text" name="city" id="" value="<?php echo $obj->getcity(); ?>" placeholder="Où vous trouver ?" />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_cp']?></h2>
                            <input type="text" name="postal_code" id="" value="<?php echo $obj->getpostalcode(); ?>" placeholder="Où vous trouver ?" />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_contact']?></h2>
                            <input type="text" name="phone_number" id="" value="" placeholder="Numéro de téléphone" />
                            <br>
                            <h2><?php echo $lang['crea_pro_mail']?></h2>
                            <input type="mail" name="mail" id="" value="<?php echo $obj->getMail(); ?>" placeholder="Votre e-mail" style="width: 100%; border:none;"/>
                            <hr>
                        </div>


                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_image']?></h2>
                            <input type="file" id="picture_service" name="picture" > <!--  accept="image/png, image/jpeg"-->
                        </div>


                        <div class="col-6 col-12-xsmall">
                            <h2><?php echo $lang['crea_pro_date']?></h2>
                            <input type="date" name="date" id="" value="" style="border-radius: 10%; "/>
                        </div>
                        <div class="col-12">
                            <select name="type" id="demo-category">
                                <option value="3"><?php echo $lang['crea_pro_sh_car']?></option>
                                <option value="4"><?php echo $lang['crea_pro_exch_srv']?></option>
                                <option value="5"><?php echo $lang['crea_pro_srv_rep']?></option>
                                <option value="6"><?php echo $lang['crea_pro_guar']?></option>
                            </select>
                        </div>
                        <div class="align-center col-6 col-12-small" style="text-align: center">
                            <input type="submit" id="validatebutton" value="<?php echo $lang['crea_pro_valid']?>" />
                        </div>
                        <div class="align-center col-6 col-12-small" style="text-align: center">
                            <input type="reset" value="<?php echo $lang['crea_pro_reset']?>" />
                        </div>
                    </div>
                </form>
            </section>
            <div id="result"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <a href="services_crea.php?lang=fr">Français</a> | <a href="services_crea.php?lang=en">English</a> | <a href="services_crea.php?lang=pt">Português</a> | <a href="services_crea.php?lang=it">Italiano</a> | <a href="services_crea.php?lang=ir">Gaeilge</a>

            <ul class="copyright">
                <li>&copy; Stop Waste</li>
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
<script src="../js/AjaxScripts/service/create.js"></script>
</body>
</html>