<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo (isset($title)) ? $title : 'Noezee'; ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo BASE_URL; ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo BASE_URL; ?>public/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo BASE_URL; ?>public/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo BASE_URL; ?>public/build/css/custom.min.css" rel="stylesheet">

    </head>

    <body class="login">
        <div>


            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content login_section">
                        <form id="demo-form2" data-parsley-validate  method="POST" action="<?php echo BASE_URL ?>clientforgot/changepassword" onsubmit="return validateForm()">
                            <input type="hidden" class="form-control"  name="user" value="<?php echo $user; ?>"/>
                            <h1><?php echo $this->lang->line('restorepassword'); ?></h1>
                            <div class="alert">
                                <?php
                                if ($this->session->flashdata('item')) {
                                    $message = $this->session->flashdata('item');
                                    ?>
                                    <div id="show"><?php echo $message['message'];
                                    ?></div>
                                    <?php
                                }
                                echo form_error('password');
                                ?>
                            </div>
                            <div>
                                <input type="password" id="password"   class="form-control"  placeholder="<?php echo $this->lang->line('password'); ?>" name="password"/>
                                <span style="color: red;" id="req"></span>

                            </div>
                            <div>
                                <input type="password" id="c_password"   class="form-control" placeholder="<?php echo $this->lang->line('cpassword'); ?>" name="c_password"/>
                                <span style="color: red;" id="msg"></span></div>
                            <div>
                                <input type="submit" value="<?php echo $this->lang->line('restorepassword'); ?>" class="btn btn-default submit"/>


                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">


                                <div>
                                    <h1><img src="<?php echo BASE_URL; ?>public/images/gray_logo_yellow_background.png" width="50" height="50"> Noezee!</h1>
                                    <p>All Right Reserved</p>
                                </div>
                            </div>
                        </form>
                    </section>

                </div>


            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

        <script>
                            function validateForm() {
                                var x = document.forms["demo-form2"]["password"].value;
                                var y = document.forms["demo-form2"]["c_password"].value;
                                if (x == "") {
                                    $('#req').html('<?php echo $this->lang->line('req'); ?>');
                                    return false;
                                } else if (y == "") {
                                    $('#req').html('');    
                                    $('#msg').html('<?php echo $this->lang->line('req'); ?>');
                                    return false;
                                }
                                if (y != x) {
                                    $('#msg').html('<?php echo $this->lang->line('matches'); ?>');
                                    return false;
                                } else
                                    return true;
                            }
        </script>
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
