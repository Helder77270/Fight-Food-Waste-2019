<?php
session_start();
require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__. '/../languages/config.php');
require_once "../languages/" . $_SESSION['lang'] . ".php";

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Smoothie BIO</title>
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
            <li><a href="services.php">Services</a></li>
            <li><a href="lessonIndex.php">Cours de cuisine</a></li>
            <li><a href="smoothieIndex.php">Smoothies BIO</a></li>
            <li><a href="../../index.php">A propos de nous</a></li>
            <li><a href="deconnect.php">Deconnexion</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <h1>Smoothies BIO</h1>


            <section>
                <div style="font-size: 20px;margin-bottom: 10px"><b><i>
                    Pour vos smoothies, il vous faudra un Blender et des fruits. Pensez à réutiliser vos vieux fruits, ils sont moches mais on évite le gâchis !
                        </i></b></div>
            </section>
            <!-- Text -->
            <section>
                <h2>Nos conseils</h2>
                <div class="">
                    <?php

                    $infoLesson = DatabaseManager::getSharedInstance()->selec("SELECT * FROM smoothie WHERE status=1", []);
                    foreach ($infoLesson as $key) {
                        echo "

                            <div style='margin-bottom: 10px;padding: 40px; background-color:#";

                        if ($key['color'] == 1){
                            echo "1AC385";
                        }elseif ($key['color'] == 2){
                            echo "C3B61A";
                        }elseif ($key['color'] == 3){
                            echo "C3551A; color:white;";
                        }

                        echo "'>
                                <h3><b>".$key['title']."</b></h3>
                                <h5>".$key['sub_title']."</h5>

                            <div class='row'>
                        
                                <div class='col-6'>".$key['description']."</div>
                                <div class='col-6' style='text-align: center'><img style='width: 200px;overflow: hidden;margin-top: -10px;' src='../images/smoothie/".$key['image'].".jpg'></div>
                                <div class='col-12' style='text-align: center'>".$key['description2']."</div>
              
                            </div>
                            </div>
                        ";
                    }
                    ?>
                </div>

            </section>

        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <div style="text-align: center">
                <a href="services.php?lang=fr">Français</a> | <a href="services.php?lang=en">English</a> | <a href="services.php?lang=pt">Português</a> | <a href="services.php?lang=it">Italiano</a> | <a href="services.php?lang=ir">Gaeilge</a>
            </div>
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