<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"> -->
    <title>noeZee</title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>public/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>public/web/css/bootstrap-theme.min.css" rel="stylesheet">
    
    <!-- Fonts -->
    <link href="<?php echo BASE_URL; ?>public/web/css/font.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo BASE_URL; ?>public/web/css/main-layout.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>public/web/css/responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- Login section starts here -->
    <div class="login-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <?php
              if ($this->session->flashdata('item')) {
                  $message = $this->session->flashdata('item');
                  ?>
                  <div class="alert alert-danger">
                  <div id="show"><?php echo $message['message'];
                  ?></div>
                  </div>
                  <?php
              }
              ?>
          </div>
          <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
              <form method="POST" action="<?php echo BASE_URL ?>parent/home/login">
              
              <div class="logo-sect">
              <img src="<?php echo BASE_URL; ?>public/web/img/login_logo.png" alt="Logo" title="noeZee" class="img-responsive" />
            </div>
            <div class="login-cont">
             
              <div class = "input-group">
                 <span class = "input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type = "text" class = "form-control" placeholder = "Email" name="email">
              </div>
              <div class = "input-group">
                 <span class = "input-group-addon"><i class="fa fa-lock"></i></span>
                 <input type = "password" class = "form-control" placeholder = "Password" name="password">
              </div>
              <input type="submit" class="btn btn-primary btn-block margintop_10" value="Login" />
              <a href="<?php echo BASE_URL.'parent/forgot'?>" class="forgot">Forgot password ?</a>
            </div>
              </form>
          
          </div>
        
        
        </div>
      </div>
    </div>
    <!-- Login section ends here -->
    
    <!-- Footer starts here -->
    <footer class="footer-main clearfix">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="copyright">
              &copy; 2017 All Rights Reserved. 
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <div class="ftr-nav">
              <?php if (!isset($this->session->userdata['ud'])) {?>
               <a href="<?php echo BASE_URL?>">Home</a>
                <?php } else { ?>
                <a href="<?php echo BASE_URL.'parent/welcome'?>">Home</a>
                <?php } ?>
              <a href="<?php echo BASE_URL.'parent/terms'?>">Terms & Conditions</a>
              <a href="<?php echo BASE_URL.'parent/privacy'?>">Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer ends here -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      var winWidth = $(window).width();
      $(document).ready(function() {
      if (winWidth > 767 && winWidth < 1921)
      {
        var winHeight = $(window).height();
        var footerHeight = $(".footer-main").height();
        var restHeight = winHeight - footerHeight;
        $(".login-main").css("height", restHeight-60);
      }
      });
    </script>
    <script>
       $(document).ready(function() {
            <?php
            if (!empty($this->session->flashdata('item'))) {
                ?>
                window.setTimeout(function(){
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
                });
                }, 4000);
                $(".forgot_section").hide();
            <?php } ?>
            });
    </script>
  </body>
</html>