<?php
session_start();
//error_reporting(0);
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');

$id = $_GET['id'];
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



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <span>Pour l'admin</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tu peux choisir :</h6>
                    <a class="collapse-item" href="#">Profils</a>
                    <a class="collapse-item" href="products.php">Produits</a>
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
                    <?php
                    $infoLesson = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lesson WHERE id=?", [$id]);
                    ?>

                    <h5 style="margin-top: 30px; text-align: center">Cours : <b><i><?php echo $infoLesson[0]['title'];?></i></b></h5>
                    <div class="row" style="text-align: center">

                    <?php
                    echo "<div class='col-4'>Date : ".$infoLesson[0]['date']."</div>";
                    echo "<div class='col-4'>Nb max : ".$infoLesson[0]['nbLimit']."</div>";
                    echo "<div class='col-4'> Adresse : ".$infoLesson[0]['address']."</div>";
                    ?>

                    </div>
                    <br><br>
                    <div class="row" style="text-align: center">
                        <div class="col-4"><b>Mail</b></div>
                        <div class="col-2"><b>Username</b></div>
                        <div class="col-2"><b>Status</b></div>
                        <div class="col-4"><b></b></div>
                    </div>
                    <?php
                    $idLessonUser = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lessonUser", []);
                    foreach ($idLessonUser as $k){
                        $infoLessonUser = DatabaseManager::getSharedInstance()->selec("SELECT * FROM user WHERE mail=?", [$k['mailUser']]);

                        foreach ($infoLessonUser as $key){
                            echo "<div class='row' style='text-align: center'>";
                            echo "<div class='col-4'>".$key['mail']."</div>";
                            echo "<div class='col-2'>".$key['username']."</div>";
                            echo "<div class='col-2'>".$k['status']."</div>";
                            echo "<div class='col-4'><a href='../services/admin/lesson_modif_status.php?status=". $k['status']."&mail=".$key['mail']."&id=".$k['idLesson']."'>Changer</a></div>";
                            echo "</div>";
                        }
                    }

                    ?>

                        <form action="../services/admin/inscription_to_lesson.php?id=<?php echo $id; ?>" method="post">
                            <div class="row" style="text-align: center">
                                <div class="col-6"><input name="mail" type="text" list="datalistUser" placeholder="Entrer une adresse mail"></div>
                                <div class="col-4"><input type="submit"></div>
                            </div>
                        </form>



                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <datalist id="datalistUser">
            <?php
            $infoUser = DatabaseManager::getSharedInstance()->selec("SELECT * FROM user", []);
            foreach ($infoUser as $key) {
                ?>
                <option value="<?php echo $key['mail'];?>"></option>
                <?php
            }
            ?>
        </datalist>
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
