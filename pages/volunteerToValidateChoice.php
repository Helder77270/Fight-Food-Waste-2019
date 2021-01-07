<?php
session_start();
//error_reporting(0);
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');

$mail = $_GET['mail'];
$obj = unserialize($_SESSION['user']);

if ($obj->getType() != "Admin"){
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Utilisateurs</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

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

                <h2>Administration</h2>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <h5 style="margin-top: 30px; text-align: center">Utilisateur : <b><i><?php echo $mail;?></i></b></h5>
                    <div class="row" style="text-align: center">
                    <?php
                    $infoMail = DatabaseManager::getSharedInstance()->selec("SELECT * FROM user WHERE mail=?", [$mail]);

                    echo "<div class='col-4'>".$infoMail[0]['username']."</div>";
                    echo "<div class='col-4'>".$infoMail[0]['firstname']."</div>";
                    echo "<div class='col-4'>".$infoMail[0]['name']."</div>";

                    echo "<div class='col-4'>".$infoMail[0]['type']."</div>";
                    echo "<div class='col-4'>".$infoMail[0]['mail']."</div>";
                    echo "<div class='col-4'>".$infoMail[0]['country']."</div>";

                    echo "<div class='col-4'>".$infoMail[0]['housenumber']." ".$infoMail[0]['street']."</div>";
                    echo "<div class='col-4'>".$infoMail[0]['city']."</div>";
                    echo "<div class='col-4'>Région : ".$infoMail[0]['region']."</div>";

                    ?>
                    </div>

                    <br><br>

                    <div class="row" style="color: #2c9faf">


                    <div class="col-8" style="text-align: center">
                        <?php
                        if ($infoMail[0]['status'] == 1) {
                            echo "<a href='../services/admin/volunteerToNo.php?mail=" . $mail . "'>Desactiver</a>";
                        }else{
                            echo "<a href='../services/admin/volunteer_confirm_mail.php?mail=" . $mail . "'>Valider</a>";
                        }
                        ?>
                    </div>
                    <div class="col-4" style="text-align: center">
                        <a href="volunteerToValidate.php">Annuler</a>
                    </div>
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
                    <span>Copyright &copy; Stop Waste 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
