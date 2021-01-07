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
require_once __DIR__.'/../utils/DatabaseManager.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Product Addition</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/modifyProduct.css" rel="stylesheet">

    <!-- JavaScripts-->
    <script src="../js/jquery.min.js"></script>


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

                <!-- On récupère l'id du produit envoyé par la page product.php qu'on utilisera pour récupérer chaque données -->
                <?php $id = $_GET['id']; ?>

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"> <?php echo "ID : " . $id . " : Product preview and modification page" ?></h1>

                <div class="container emp-profile">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                                    <div class="file btn btn-lg btn-primary">
                                        Change Photo
                                        <input type="file" name="file"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h5>

                                        <!-- La fonction select(), renvoie un tableau donc je fais un foreach pour traverser le tableau
                                          pour pouvoir afficher la valeur.
                                          Sans le foreach on a une erreur qui dit qu'on ne peut pas echo un tableau
                                          -->
                                        <?php
                                        $res = DatabaseManager::getSharedInstance()->selec("SELECT * FROM product WHERE id=?", [$id]);
                                        foreach ($res as $row) {
                                            echo $row['name'];
                                        } ?>

                                    </h5>
                                    <h6>
                                       <!-- Web Developer and Designer -->
                                    </h6>

                                    <p class="proile-rating">Quantity : <span><?php foreach ($res as $row) {
                                                echo $row['quantity'];
                                            } ?></span></p>

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
                                    <form action="" method="post"
                                        <input type="hidden" id="myIdProduct" value="<?php echo $id; ?>">
                                        <input type="submit" id="deleteprod" value="Delete product"
                                               class="col-md-12 btn-danger">
                                    </form>


                                    <p>SKILLS</p>
                                    <a href="">Web Designer</a><br/>
                                    <a href="">Web Developer</a><br/>
                                    <a href="">WordPress</a><br/>
                                    <a href="">WooCommerce</a><br/>
                                    <a href="">PHP, .Net</a><br/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="tabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="modifForm">
                                            <div class="for-pwd-htm">
                                                <!-- A modifier en AJAX si possible -->
                                                <form id="productModification">
                                                    <div class="group">
                                                        <input id="id" name="id" type="hidden"
                                                               class="form-control form-control-user"
                                                               value="<?php echo $id ?>">
                                                    </div>
                                                    <div class="group">
                                                        <label for="Product name" class="label">Barcode</label>
                                                        <input id="pbarcode" name="pbarcode" type="text"
                                                               class="form-control form-control-user"
                                                               value="<?php
                                                                   echo $res[0]['barcode'];
                                                                ?>">
                                                    </div>
                                                    <div class="group">
                                                        <label for="Product name" class="label">Product name</label>
                                                        <input id="pname" name="pname" type="text"
                                                               class="form-control form-control-user"
                                                               value="<?php
                                                                   echo $res[0]['name'];
                                                                ?>">
                                                    </div>
                                                    <div class="group">
                                                        <label for="Quantity" class="label">Quantity</label>
                                                        <input id="pquantity" name="pquantity" type="text"
                                                               class="form-control form-control-user"
                                                               value="<?php
                                                               echo $res[0]['quantity'];
                                                                ?>">
                                                    </div>
                                                    <div class="group">
                                                        <label for="Image Link" class="label">Image Link</label>
                                                        <input id="pimage" name="pimage" type="text"
                                                               class="form-control form-control-user"
                                                               value="<?php
                                                               echo $res[0]['image'];
                                                                ?>">
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="submit" id="updateprod" name="updateprod"
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
                                            <div class="previewMode">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Product Id</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $id ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php  echo $res[0]['name'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label>Image storage</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php  echo $res[0]['image'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button type="button" class="profile-edit-btn" id="edit_profile"
                                                name="btnAddMore"
                                                value="Edit Profile"> Update product
                                        </button>
                                    </div>
                                         </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>230</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Your Bio</label><br/>
                                                <p>Your detail description</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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
                <a class="btn btn-primary" href="../pages/login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/onModifProduct/hideAndShowModifProduct.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>
<script src="../js/AjaxScripts/product/delete.js"></script>
<script src="../js/AjaxScripts/product/modify.js"></script>
</body>

</html>
