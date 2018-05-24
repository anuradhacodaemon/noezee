<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <title>noeZee</title>

        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>public/web/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>public/web/css/bootstrap-theme.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="<?php echo BASE_URL; ?>public/web/css/font.css" rel="stylesheet">

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
    <body class="landing">
        <div class="landing-main">
            <div class="landing-cont">
                <img src="<?php echo BASE_URL; ?>public/web/img/landing_logo.png" alt="Logo" title="noeZee" class="img-responsive" />
                <h1>NoeZee web service is On</h1>
                <p>Talk to your parent or guardian about smart use of this device</p>
                <button type="button" class="btn btn-start" onClick="goTo()">Go to Login</button>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo BASE_URL; ?>public/web/js/bootstrap.min.js"></script>
        <script>
                    function goTo() {

<?php
if (isset($this->session->userdata['ud'])) {
    ?>
                            window.location.href = '<?php echo BASE_URL . 'parent/media' ?>';
<?php } else {
    ?>
                            window.location.href = '<?php echo BASE_URL . 'parent' ?>';
    <?php }
?>
                    }
        </script>
    </body>
</html>