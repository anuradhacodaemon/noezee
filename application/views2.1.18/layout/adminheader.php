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

                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo BASE_URL . MASTERADMIN ?>" class="site_title"><img src="<?php echo BASE_URL ?>public/admin/images/gray_logo_yellow_background.png" width="50" height="50"> <span>noeZee</span></a>
                        </div>
                        <div class="clearfix"></div>


                        <!-- menu prile quick info -->
                        <div class="profile col-lg-12">
                            <!--<div class="profile_pic">
                                <img src="<?php echo BASE_URL1 ?>public/images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>-->
                            <div class="profile_info">
                                <span><?php echo $this->lang->line('Welcome'); ?>

                                   
                                </span>
                            </div>
                        </div>
                        <!-- /menu prile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>&nbsp; </h3>
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo BASE_URL ?>admin/media"><i class="fa fa-edit"></i>Media</a>
                                    </li>
                                    
                                    
                                    
                                    <li><a href="<?php echo BASE_URL ?>admin/feedback"><i class="fa fa-edit"></i>Feedback</a>
                                    </li>
                                     <li><a href="<?php echo BASE_URL ?>admin/user"><i class="fa fa-edit"></i>User</a>
                                    </li> 
                                    
                                    <li><a href="<?php echo BASE_URL ?>admin/device"><i class="fa fa-edit"></i>Device</a>
                                    </li>
                                    <li><a href="<?php echo BASE_URL ?>admin/favorite"><i class="fa fa-edit"></i>Favorite</a>
                                    </li>

					<li><a href="<?php echo BASE_URL ?>admin/home/logout"><i class="fa fa-power-off">   </i> Logout</a>
                    </li>				
                                </ul>
                                </li>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- top navigation -->

               