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
    <!-- Header starts here -->
   <?php echo (!empty($header))?$header:'';?>
    <!-- Header ends here -->
    
    <!-- Main section starts here -->
   <?php echo (!empty($layout_content))?$layout_content:'';?>
    <!-- Main section ends here -->
    
    <!-- Footer starts here -->
   <?php echo (!empty($footer))?$footer:'';?>
    <!-- Footer ends here -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>public/web/js/bootstrap.min.js"></script>
     <script src="<?php echo BASE_URL; ?>public/admin/js/bootbox.js"></script>

  </body>
</html>