  <!-- Login section starts here -->
    <div class="login-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="logo-sect">
              <img src="<?php echo BASE_URL.'public/web/'?>img/login_logo.png" alt="Logo" title="noeZee" class="img-responsive" />
            </div>
            <div class="login-cont">
              <h1>Forget Password</h1>
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
              <form method="POST" action="<?php echo BASE_URL.'parent/forgot/mailsent'?>" >
              <div class = "input-group">
                 <span class = "input-group-addon"><i class="fa fa-envelope"></i></span>
                 <input type = "text" name="email"  required class = "form-control" placeholder = "Email id">
              </div>
              <input type="submit" class="btn btn-primary btn-block margintop_10" value="Submit" />
              </form>
            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      var winWidth = $(window).width();
      $(document).ready(function() {
      if (winWidth <= 414)
      {
        var winHeight = $(window).height();
        var footerHeight = $(".footer-main").height();
        var restHeight = winHeight - footerHeight;
        $(".login-main").css("height", restHeight-60);
      }
      else if (winWidth > 767 && winWidth < 1921)
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
    