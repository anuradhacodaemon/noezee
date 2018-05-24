
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title)) ? $title : 'noezee'; ?> </title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo BASE_URL1; ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL1; ?>public/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL1; ?>public/admin/css/animate.min.css" rel="stylesheet">
        <!-- Custom styling plus plugins -->
        <link href="<?php echo BASE_URL1; ?>public/admin/css/custom.css" rel="stylesheet">
        <link href="<?php echo BASE_URL1; ?>public/admin/fonts/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?php echo BASE_URL1; ?>public/admin/css/components.css" rel="stylesheet">
        <link href="<?php echo BASE_URL1; ?>public/admin/css/icheck/flat/green.css" rel="stylesheet">
        <script src="<?php echo BASE_URL1; ?>public/admin/js/jquery.min.js"></script>

    </head>
    
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <?php
                 $this->load->view('layout/adminheader', $data);
                ?>
                <!-- top navigation -->

                <!-- /top navigation -->
                <?php $this->load->view('layout/navigation', $data); ?>
                <!-- page content -->

                <div class="right_col" role="main">

                <?php $this->load->view($view, $data); ?>

                  </div>
                <!-- /page content -->    
                <?php $this->load->view('layout/footer', $data); ?>
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
        <script src="<?php echo BASE_URL1; ?>public/admin/js/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/js/bootbox.js"></script>

       <!-- <script src="<?php echo BASE_URL1; ?>public/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>-->
        <!-- FastClick -->
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/nprogress/nprogress.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/moment/min/moment.min.js"></script>

        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/daterangepicker.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/anytime.min.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/pickadate/picker.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/pickadate/picker.date.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/pickadate/picker.time.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/pickadate/legacy.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/vendors/pickers/picker_date.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?php echo BASE_URL1; ?>public/admin/build/js/custom.min.js"></script>
        <script src="<?php echo BASE_URL1; ?>public/admin/js/pace/pace.min.js"></script> 
        <script>


        </script>
    </body>
</html>

