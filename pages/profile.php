<?php
//session_start();
//include "../languages/config.php";


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


<!DOCTYPE html>
<html>

<head>
    <?php
        session_start();
        require_once __DIR__.'/../dao/UserDao.php';
        $usr = unserialize($_SESSION['user']);

        //Les deux link suivants permettent de s'adapter selon le chemin
        require_once __DIR__.'/../languages/config.php';
        require_once "../languages/" . $_SESSION['lang'] . ".php";
        if (empty($_SESSION['user'])){
            header('Location: ../../index.php');
        }
        $type = $usr->getType();
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $lang['profile_title']?></title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">

    <!-- JavaScripts-->
    <script src="../js/jquery.min.js"></script>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">Stop Waste</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">

                <span>Autres </span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pour :</h6>
                    <a class="collapse-item" href="panier.php">Votre panier</a>
                    <a class="collapse-item" href="distrib.php">Vos distributions</a>
                    <a class="collapse-item" href="../index.php#contactform">Nous contacter</a>
                </div>
            </div>
        </li>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- On récupère l'id du produit envoyé par la page product.php qu'on utilisera pour récupérer chaque données -->

                <div style="text-align: center;">
                    <a href="profile.php?lang=fr">Français</a> | <a href="profile.php?lang=en">English</a> | <a href="profile.php?lang=pt">Português</a> | <a href="profile.php?lang=it">Italiano</a> | <a href="profile.php?lang=ir">Gaeilge</a>

                </div>
                <div style="text-align: end">
                    <a href="deconnect.php">Deconnexion</a>
                </div>

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800" style="margin-top: 30px"> <?php echo $usr->getFirstname()." ". $usr->getName(); ?></h1>

                <div class="container emp-profile">
                    <div class="row">
                        <div class="col-md-4">
                            <form type="POST" enctype="multipart/form-data" id="formimg">
                                <div class="profile-img">
                                    <img src="../images/musk.jpg" alt="" style="height: 150px"/>
                                    <div class="file btn btn-lg btn-primary">
                                        <input type="file" name="file"/>
                                    </div>
                                    <div>
                                        <input value="<?php echo $lang['profil_changephoto'];?>" type="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5>

                                    <!-- La fonction select(), renvoie un tableau donc je fais un foreach pour traverser le tableau
                                      pour pouvoir afficher la valeur.
                                      Sans le foreach on a une erreur qui dit qu'on ne peut pas echo un tableau
                                      -->


                                </h5>
                                <h6>
                                    <!-- Web Developer and Designer -->
                                </h6>

                                <p class="proile-rating"><span><?php echo $lang['profil_hihowareyou']?><?php echo $usr->getFirstname();?> ?</span></p>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-work">

                                <!-- Lié au script AJAX dans ../js/AjaxScripts/product/delete.js -->

                                <span> <?php echo $lang['profil_generalinformation']?> </span>
                                <p><?php echo $usr->getCity(); ?></p>
                                <p><?php echo $usr->getCountry(); ?></p>
                                <p><?php echo $usr->getPostalcode(); ?></p>
                                <p><?php echo $usr->getHousenumber()." ".$usr->getStreet() ;?></p>
                                <p><?php echo $usr->getCountry(); ?></p>
                                <p><?php echo $usr->getSkill1(); ?></p>
                                <p><?php echo $usr->getSkill2(); ?></p>
                                <p><?php echo $usr->getSkill3(); ?></p>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="tabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="modifForm">
                                        <div class="for-pwd-htm">
                                            <!-- A modifier en AJAX si possible -->
                                            <form id="user_update_form">

                                                <input id="uid" name="uid" type="hidden"
                                                       class="form-control form-control-user"
                                                       value="<?php echo $usr->getId(); ?>">

                                                <div class="group">
                                                    <label for="utype" class="label"><?php echo "type" ?></label>
                                                    <input id="utype" name="utype" type="text"
                                                           class="form-control form-control-user" disabled="disabled"
                                                           value="<?php echo $usr->getType();  ?>">
                                                    <input type="hidden"
                                                           id="uTypeReal"
                                                           name="uTypeReal"
                                                           value="<?php echo $usr->getType(); ?>">
                                                </div>



                                                <div class="group">
                                                    <label for="uusername" class="label"><?php echo $lang['profile_username'];?></label>
                                                    <input id="uusername" name="uusername" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getUsername(); ?>">
                                                </div>
                                                <?php if($type !== "Business") { ?>

                                                <div class="group">
                                                    <label for="ulastname" class="label"><?php echo $lang['profile_name'];?></label>
                                                    <input id="ulastname" name="ulastname" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getName(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="ufirstname" class="label"><?php echo $lang['profile_firstname'];?></label>
                                                    <input id="ufirstname" name="ufirstname" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getFirstname(); ?>">
                                                </div>
                                                <?php } ?>

                                                <div class="group">
                                                    <label for="umail" class="label"><?php echo $lang['profile_email'];?></label>
                                                    <input id="umail" name="umail" type="text"
                                                           class="form-control form-control-user" disabled="disabled"
                                                           value="<?php echo $usr->getMail(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="uhousenumber" class="label"><?php echo /*$lang['profile_email'];*/ "housenumber"?></label>
                                                    <input id="uhousenumber" name="uhousenumber" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getHousenumber(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="ucity" class="label"><?php echo /*$lang['profile_email'];*/ "city"?></label>
                                                    <input id="ucity" name="ucity" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getCity(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="ustreet" class="label"><?php echo /*$lang['profile_email'];*/ "street"?></label>
                                                    <input id="ustreet" name="ustreet" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getStreet(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="upostalcode" class="label"><?php echo /*$lang['profile_email'];*/ "postalcode"?></label>
                                                    <input id="upostalcode" name="upostalcode" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getPostalcode(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="ucountry" class="label"><?php echo /*$lang['profile_email'];*/ "country"?></label>
                                                    <input id="ucountry" name="ucountry" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getCountry(); ?>">
                                                </div>
                                                <?php if($type === "Business") { ?>
                                                <div class="group">
                                                    <label for="ulob" class="label"><?php echo /*$lang['profile_email'];*/ "lob"?></label>
                                                    <input id="ulob" name="ulob" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getLob(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="usiret" class="label"><?php echo /*$lang['profile_email'];*/ "siret"?></label>
                                                    <input id="usiret" name="usiret" type="text"
                                                           class="form-control form-control-user" disabled="disabled"
                                                           value="<?php echo $usr->getSiret(); ?>">
                                                </div>
                                                <?php }
                                                if($type === "Volunteer") {
                                                ?>
                                                <div class="group">
                                                    <label for="uskill1" class="label"><?php echo /*$lang['profile_email'];*/ "SKILLS 1"?></label>
                                                    <input id="getSkill1" name="uskill1" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getSkill1(); ?>">
                                                </div>
                                                <div class="group">
                                                    <label for="uskill2" class="label"><?php echo /*$lang['profile_email'];*/ "SKILLS 2"?></label>
                                                    <input id="uskill2" name="uskill2" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getSkill2(); ?>">
                                                </div>
                                                <hr>
                                                <div class="group">
                                                    <label for="uskill3" class="label"><?php echo /*$lang['profile_email'];*/ "SKILLS 3"?></label>
                                                    <input id="uskill3" name="uskill3" type="text"
                                                           class="form-control form-control-user"
                                                           value="<?php echo $usr->getSkill3(); ?>">
                                                </div>
                                                <?php } ?>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" id="update_user" name="update_user"
                                                                class="profile-edit-btn" value="Send modifications">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <button id="backbutton" name="backbutton"
                                                                class="profile-edit-btn" value="Return to preview">
                                                    </div>
                                                </div>

                                                <div id="result"></div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="hr"></div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/AjaxScripts/user/modify.js"></script>
<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
