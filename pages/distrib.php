<?php
session_start();
//error_reporting(0);
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');
$obj = unserialize($_SESSION['user']);


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
                    <a class="collapse-item" href="#">Vos distributions</a>
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


                <div class="row">



                    <?php
                    echo $obj->getMail();


                    $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM orders WHERE fk_mail_user=?", [$obj->getMail()]);

                    foreach ($info as $key){


                    }



                    ?>


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
