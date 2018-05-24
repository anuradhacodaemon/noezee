
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title)) ? $title : 'noezee'; ?> </title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo BASE_URL; ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>public/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>public/admin/css/animate.min.css" rel="stylesheet">
        <!-- Custom styling plus plugins -->
        <link href="<?php echo BASE_URL; ?>public/admin/css/custom.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>public/admin/fonts/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?php echo BASE_URL; ?>public/admin/css/components.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>public/admin/css/icheck/flat/green.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>

    </head>
    
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
<?php echo (!empty($header))?$header:'';?>
				<!-- top navigation -->

                <!-- /top navigation -->
                <<?php echo (!empty($nav))?$nav:'';?>
                <!-- page content -->

                <div class="right_col" role="main">
<?php echo (!empty($layout_content))?$layout_content:'';?>
					  </div>
                <!-- /page content -->  
<?php echo (!empty($footer))?$footer:'';?>
				
				 <!-- /footer content -->
              
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <!-- Bootstrap -->
        <script src="<?php echo BASE_URL; ?>public/admin/js/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/js/bootbox.js"></script>

       <!-- <script src="<?php echo BASE_URL; ?>public/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>-->
        <!-- FastClick -->
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/nprogress/nprogress.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/moment/min/moment.min.js"></script>

        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/daterangepicker.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/anytime.min.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/pickadate/picker.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/pickadate/picker.date.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/pickadate/picker.time.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/pickadate/legacy.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/vendors/pickers/picker_date.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?php echo BASE_URL; ?>public/admin/build/js/custom.min.js"></script>
        <script src="<?php echo BASE_URL; ?>public/admin/js/pace/pace.min.js"></script> 
        <script>


        </script>
    </body>
</html>

