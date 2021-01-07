<?php
session_start();

require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__ .'/../languages/config.php');

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Service profile</title>
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

            $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM service_fr", []);
            foreach ($info as $key) {
                ?>
                <li><a href=""><?php echo utf8_encode($key['name']);?></a></li>
                <?php
            }
            ?>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <h1>Profile service</h1>

            <?php
            $id = $_GET['id'];
            $myinfo = DatabaseManager::getSharedInstance()->selec("SELECT * FROM services WHERE id = ?", [$id]);

            foreach ($myinfo as $key) {
                ?>
                <section>
                    <h2><?php echo utf8_encode($key['name']);?></h2>

                    <img class="center" src="../images/services/<?php echo utf8_encode($key['image']);?>" style="width: 70%; "></td>

                    <br>

                    <div class="row" style="margin-top: 30px">
                        <div class="col-8">
                            <h4>Description :</h4>
                            <p><?php echo utf8_encode($key['description']);?></p>
                        </div>

                        <div class="col-2"><h4>Date : </h4>
                            <p><?php echo utf8_encode($key['date']);?></p>
                        </div>

                        <div class="col-2"><h4>Ville : </h4>
                            <p><?php echo utf8_encode($key['city']);?></p>
                        </div>

                    </div>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-6">
                            <h4>Adresse : </h4>
                            <p><?php echo utf8_encode($key['address']);?></p>
                        </div>

                        <div class="col-6">
                            <h4>Contacter : </h4>
                            <p><?php echo utf8_encode($key['phone']);?></p>
                            <p><?php echo utf8_encode($key['mail']);?></p>
                        </div>
                    </div>
                </section>

                <?php
            }
            ?>

            <section>



            </section>

        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="copyright">
                <li>&copy; Stop Waste 2019</li>
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

</body>
</html>