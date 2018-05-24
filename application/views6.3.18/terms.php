<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <link rel="shortcut icon" href="<?php echo BASE_URL; ?>public/web/img/favicon.ico" type="image/x-icon"> -->
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
   <?php include('elements/header.php')?>
    <!-- Login section starts here -->
    <div class="terms-main inner-main inner_container">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
                <h2>Terms & Conditions</h2>
                <span><?php 
                 if (isset($this->session->userdata['ud'])) {
                echo $this->session->userdata['ud']['adminusername'];
                 }
                
                ?></span>
            </div>
          </div>
        </div>
          <p class="content">These Terms and Conditions ("Agreement") governs the use of the services ("Service") that are made available by Website.com Solutions Inc. ("Website.com", "we" or "us"). These Terms and Conditions represent the whole agreement and understanding between Website.com and the individual or entity who subscribes to our service ("Subscriber" or "you").

PLEASE READ THIS AGREEMENT CAREFULLY. By submitting your application and by your use of the Service, you agree to comply with all of the terms and conditions set out in this Agreement. Website.com may terminate your account at any time, with or without notice, for conduct that is in breach of this Agreement, for conduct that Website.com believes is harmful to its business, or for conduct where the use of the Service is harmful to any other party.</p>
      </div>
    </div>
    <!-- Login section ends here -->
    
    <!-- Footer starts here -->
    <?php include('elements/footer.php')?>
    <!-- Footer ends here -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>public/web/js/bootstrap.min.js"></script>
    <!--<script>
      var winWidth = $(window).width();
      $(document).ready(function() {
      if (winWidth > 767 && winWidth < 1921)
      {
        var winHeight = $(window).height();
        var footerHeight = $(".footer-main").height();
        var restHeight = winHeight - footerHeight;
        $(".terms-main").css("height", restHeight-60);
      }
      });
    </script>-->
  </body>
</html>
