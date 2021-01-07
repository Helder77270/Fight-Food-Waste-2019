<?php
require_once (__DIR__ .'/../languages/config.php');

require_once "../languages/" . $_SESSION['lang'] . ".php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="../css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">

              <!-- Nested Row within Card Body -->

              <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?php echo $lang['login_welcome']?></h1>
                  </div>

                    <!-- Lié au script AJAX dans js/AjaxScripts/user/connect.js -->

                  <form id="loginform">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="mail" name=mail
                               placeholder="<?php echo $lang['login_plc_mail']?>">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="pwd" placeholder="<?php echo $lang['login_plc_pwd']?>">
                    </div>

                    <!-- Validation's button -->
                    <input type="submit" id="loginbutton" name="loginbutton" class="btn btn-primary btn-user" value="<?php echo $lang['login_btn_connect']?>">
                    <hr>
                  </form>

                <div id="result"></div>

                    <!-- Forget password -->
                  <div class="text-center">
                    <a class="small" href="../services/user/flou.php"><?php echo $lang['login_frgt_pwd']?></a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php"><?php echo $lang['login_create_acc']?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../js/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../js/AjaxScripts/user/connect.js"></script>
</body>

</html>
