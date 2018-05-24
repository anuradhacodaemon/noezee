<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo (isset($title)) ? $title : 'noezee'; ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>public/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo BASE_URL; ?>public/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo BASE_URL; ?>public/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo BASE_URL; ?>public/admin/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo BASE_URL; ?>public/admin/css/custom.css" rel="stylesheet">

    </head>

    <body class="login">
        <div>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content login_section">
                        <form method="POST" action="<?php echo BASE_URL ?>admin/home/login">
                            <h1>Login</h1>
                            <div class="alert">
                                <?php
                                if ($this->session->flashdata('item')) {
                                    $message = $this->session->flashdata('item');
                                    ?>
                                    <div id="show"><?php echo $message['message'];
                                    ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <input type="text" class="form-control" required="required" placeholder="<?php echo $this->lang->line('username'); ?>" name="username"/>
                            </div>
                            <div>
                                <input type="password" class="form-control" required="required" placeholder="<?php echo $this->lang->line('password'); ?>" name="password"/>
                            </div>
                            <div class="col-lg-12 text-center">
                                <input type="submit" value="Login" class="btn submit btn-yellow"/>

                            </div>


                            <div class="clearfix"></div>

                            <div class="separator">


                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><img src="<?php echo BASE_URL; ?>public/admin/images/gray_logo_yellow_background.png" width="50" height="50"> noeZee Admin!</h1>
                                    <p><?php echo $this->lang->line('lfooter'); ?><a href="<?php echo BASE_URL1 ?>privacy-policy" target="_blank" class="to_register dark_grey"><?php echo $this->lang->line('privacy'); ?></a><?php echo $this->lang->line('and'); ?><a href="<?php echo BASE_URL1 ?>term-condition"  target="_blank" class="to_register dark_grey"> <?php echo $this->lang->line('terms'); ?></a></p>
                                </div>
                            </div>
                        </form>
                    </section>

                </div>


            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

        <script type="application/javascript">

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
