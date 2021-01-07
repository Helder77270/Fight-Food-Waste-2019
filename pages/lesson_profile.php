<?php
session_start();

require_once (__DIR__.'/../dao/UserDao.php');
require_once (__DIR__ .'/../languages/config.php');

if (empty($_SESSION['user'])){
    header('Location: ../../index.php');
}

$obj = unserialize($_SESSION['user']);
$id = $_GET['id'];

$mailUser = $obj->getMail();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Cours de cuisine</title>
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
            <h1>Cours</h1>

            <?php
            $myinfo = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lesson WHERE id = ?", [$id]);

                ?>
                <section>
                    <h2><?php echo utf8_encode($myinfo[0]['title']);?></h2>


                    <div class="row" style="margin-top: 20px">
                        <div class="col-6">
                            <img class="center" src="../images/services/casseroles.jpg" style="width: 100%; ">
                        </div>

                        <div class="col-6 row">
                            <div class="col-12"><h4>Descriptif :</h4><br><?php echo utf8_encode($myinfo[0]['description']);?></div>

                            <div class="col-12"><h4>Adresse :</h4><?php echo utf8_encode($myinfo[0]['address']);?></div>

                        </div>

                        <div class="col-6">
                                <h4>Date : </h4><?php echo utf8_encode($myinfo[0]['date']);?>
                        </div>
                        <div class="col-6">
                            <h4>Nombre de participants max :</h4>
                            <?php echo utf8_encode($myinfo[0]['nbLimit']);
                            $nbLimit = $myinfo[0]['nbLimit'];
                            ?>
                        </div>
                        <div class="col-12" style="text-align: center; margin-top: 40px">

                        <?php


                        $infoStatus = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lessonUser WHERE mailUser=? and idLesson=?", [$mailUser, $id]);

                        if ($infoStatus != NULL){
                            if ($infoStatus[0]['status'] == 1) {
                                ?>
                                <a style="color: lightgrey; background-color: #2d2e33; padding: 5px; border-radius: 2px;"
                                   href="../services/admin/lesson_user_modif_status.php?id=<?php echo $id; ?>&mail=<?php echo $mailUser; ?>&status=1&nb=<?php echo $nbLimit;?>">Se
                                    désinscrire</a>
                                <?php
                            }elseif ($infoStatus[0]['status'] == 0){
                                ?>
                                <a style="color: lightgrey; background-color: #2d2e33; padding: 5px; border-radius: 2px;"
                                   href="../services/admin/lesson_user_modif_status.php?id=<?php echo $id; ?>&mail=<?php echo $mailUser; ?>&status=0&nb=<?php echo $nbLimit;?>">Se réinscrire</a>
                                <?php
                            }
                        }else{
                            ?>
                            <form method="post" action="../services/admin/inscription_user_to_lesson.php?id=<?php echo $_GET['id'] ?>&nb=<?php echo $nbLimit;?>">
                                <input type="hidden" name="mail" value="<?php echo $mailUser;?>">
                                <input type="submit" value="S'inscrire">
                            </form>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="col-12" style="text-align: center">

                            <?php
                                $count = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lessonUser WHERE idLesson=? and status=1", [$id]);
                                $countMax = 0;
                                foreach ($count as $k){
                                    if ($count){
                                    $countMax ++;
                                    }
                                }
                            echo "Nombre d'inscrits : ".$countMax;
                            ?>
                        </div>
                    </div>

                </section>

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