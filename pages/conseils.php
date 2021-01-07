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
            <h1>Nos conseils</h1>

            <?php
            $myinfo = DatabaseManager::getSharedInstance()->selec("SELECT * FROM conseils", []);

            foreach ($myinfo as $key) {
                ?>
                    <section style="background-color: lightgrey; margin-top: 30px; padding-bottom: 20px; background-image: url('../images/<?php echo $key["img"]?>')">
                        <div>
                            <div style="text-align: center">
                            <h2><?php echo $key['name']?></h2>
                            <h3><?php echo $key['titre']?></h3>
                            </div>
                            <div class="row" style="margin-left: 15px; margin-right: 15px">
                                <div class="col-6">
                                    <p>
                                        <?php echo $key['text1']?>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <?php echo $key['text2']?>
                                    </p>
                                </div>
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