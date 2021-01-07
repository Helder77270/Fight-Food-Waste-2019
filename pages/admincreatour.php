<?php

session_start();
//error_reporting(0);
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__.'/../dao/OrderDao.php');
require_once (__DIR__.'/../dao/TruckDao.php');
require_once (__DIR__ . '/../models/GoogleMapsAPIObject.php');
//require_once (__DIR__ . '/../services/orders/OrderService.php');

$obj = unserialize($_SESSION['user']);

if ($obj->getType() != "Admin"){
    header('Location: ../index.php');
}

$Volunteer = UserDao::userIsVolunteerAndNotBusy("Volunteer");

$Truck = TruckDao::allTrucksName(0);

$Order = OrderDao::numOrderByRegion(1);



$obj = new GoogleMapsAPIObject("AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c"); // API key qui nous est personnelle -> Permettra de faire des requetes https juste pour nous
//$res1 = $obj->getLatAndLng(17,"chemin du port","Montévrain","France"); // Fais la requête comme t'as fait pour le C St Phan
//$res2 = $obj->getLatAndLng(134,"rue du chateau","Boulogne-Billancourt","France");
//$res3 = $obj->getLatAndLng(90,"avenue Jean d'Estienne d'Orves", "Joinville Le Pont","France");
//$res4 = $obj->getLatAndLng(242,"Faubourg Saint-Antoine", "Paris","France");
//$res5 = $obj->getLatAndLng(17, "rue de la forge royale","Paris","France");
//$hangar = $obj->getLatAndLng(20, "rue Meynadier","Paris","France");
//
//$res = array($res1,$res2,$res3,$res4,$res5,$hangar);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stop Waste - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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



            <!-- Begin Page Content -->


                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Création de tournée</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row" style="text-align: center; padding: 15px">
                        <h4>Selection</h4>
                        <div class="col-12" style="padding: 10px">
                            <select name="user" id="demo-category" >
                                <?php
                                foreach ($Volunteer as $item) {
                                    ?>
                                    <option id="volunteerList" name="user"
                                            value="<?php echo $item['mail']; ?>"><?php echo $item['name'] . " " . $item['firstname']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12" style="padding: 10px">
                            <select name="truck" id="demo-category" >
                                <?php
                                foreach ($Truck as $item){
                                    ?>
                                    <option id="truckList" value="<?php echo $item['license_plate'];?>"><?php echo $item['brand']." : ".$item['license_plate'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12" style="padding: 10px" id="ord_list">

                            <input type="submit" id="generate" value="generate" onclick="getData()">
                        </div>
                    </div>
                </div>
        </div>


    </div>
</div>

<script type="text/javascript">

    function getData() {
        var usr = document.getElementById("volunteerList").getAttribute("value");
        var truck = document.getElementById("truckList").getAttribute("value");

        window.location.href = "tourPreview.php?usr=" + usr + "&truck=" + truck ;
    }

</script>


<!-- /.container-fluid -->


<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; StopWaste 2019 - ADMINISTRATION</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->




</body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>





