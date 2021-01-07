<?php

session_start();
//error_reporting(0);
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');
$obj = unserialize($_SESSION['user']);

if ($obj->getType() != "Admin"){
    header('Location: ../index.php');
}

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
                <i class="fas fa-fw fa-tachometer-alt"></i>
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
                    <a class="collapse-item" href="userAdministrationList.php">Profils</a>
                    <a class="collapse-item" href="products.php">Produits</a>
                </div>
            </div>
        </li>

    </ul>
    <!-- END OF SIDE BAR -->

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
                </ul>
            </nav>
            <!-- End of Topbar -->








            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Redistribution</h1>
                </div>

                <!-- Content Row -->
                <div class="row align-center ">
                    <div class="row">


                        <div class="col-md-2">
                            <input type="checkbox" id="produit1" name="produit1">
                            <label for="produit1">Produit 1</label>
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" id="produit2" name="produit2">
                            <label for="produit2">Produit 2</label>
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" id="produit3" name="produit3" checked>
                            <label for="produit3">Produit 3</label>
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" id="produit4" name="produit4"checked>
                            <label for="produit4">Produit 4</label>
                        </div>


                        <div class="col-xs-6 col-md-2">
                            <input type="checkbox" id="" name="">
                            <label for="">Produit 5</label>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <input type="checkbox" id="" name="">
                            <label for="produit2">Produit 6</label>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <input type="checkbox" id="" name="" checked>
                            <label for="produit3">Produit 7</label>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <input type="checkbox" id="" name="">
                            <label for="produit4">Produit 8</label>
                        </div>

                        <div class="col-12">
                            <select name="type" id="demo-category" >
                                <option value="1">Produit 1</option>
                                <option value="2">Produit 2</option>
                                <option value="3">Produit 3</option>
                                <option value="4">Produit 4</option>
                            </select>
                        </div>


                        <div class="col-12">
                            <select name="type" id="demo-category" >
                                <option value="1">Camion 1</option>
                                <option value="2">Camion 2</option>
                                <option value="3">Camion 3</option>
                                <option value="4">Camion 4</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <select name="type" id="demo-category" >
                                <option value="1">User 1</option>
                                <option value="2">User 2</option>
                                <option value="3">User 3</option>
                                <option value="4">User 4</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-12 col-12-small" style="text-align: center">
                        <input type="submit" id="" value="Valider" />
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
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

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
