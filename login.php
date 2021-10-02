<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from big-bang-studio.com/cosmos/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 12:55:37 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.html">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="manifest.html">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="authentication-body">
    <div class="container-fluid">
      <div class="authentication-header m-b-30">
        <div class="clearfix">
          <div class="pull-left">
            <a class="authentication-logo" href="">
              <img src="img/logo.png" alt="" height="25">
              <span>SIMRS</span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="authentication-content m-b-30">
            <h3 class="m-t-0 m-b-30 text-center">You look great today!</h3>
            <form method="post">
              <div class="form-group">
                <label for="form-control-1">Username</label>
                <input type="text" class="form-control" id="form-control-1" placeholder="Username" name="txtUsername">
              </div>
              <div class="form-group">
                <label for="form-control-2">Password</label>
                <input type="password" class="form-control" id="form-control-2" placeholder="Password" name="txtPassword">
              </div>
              <div class="form-group">
                <label class="custom-control custom-control-info custom-checkbox active">
                  <input class="custom-control-input" type="checkbox" name="mode" checked="checked">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-label">Keep me signed in</span>
                </label>
                <a href="http://big-bang-studio.com/pages-reset-password.html" class="text-info pull-right">Forgot password?</a>
              </div>
              <button type="submit" name="btnSubmit" class="btn btn-info btn-block">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="authentication-footer">
        <span class="text-muted">Need help? Contact us mail@example.com</span>
      </div>
    </div>
	
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
	<?php
      include('koneksi.php');
      if(isset($_POST['btnSubmit'])){
        $username = isset($_POST['txtUsername'])?$_POST['txtUsername']:"";
        $password = isset($_POST['txtPassword'])?md5($_POST['txtPassword']):"";
        $login = mysqli_query($koneksi,"select * from user where username = '$username' and password = '$password'");
        $cek=mysqli_num_rows($login);
        if($cek==1){
          session_start();
          $data = mysqli_fetch_array($login);
          $_SESSION['user']=$data['username'];
          $_SESSION['level']=$data['level'];
          header("location:index.php");
        }else{
          echo "<script>alert('Username atau Password Salah')</script>";
        }
      }
    ?>
  </body>

<!-- Mirrored from big-bang-studio.com/cosmos/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 12:55:37 GMT -->
</html>