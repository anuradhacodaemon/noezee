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
               <a href="<?php echo BASE_URL?>" class="navbar-brand">Home
                    </a>
                <?php } else { ?>
                <a href="<?php echo BASE_URL.'parent/welcome'?>">Home
                    </a>
                <?php } ?>
               
              <a href="<?php echo BASE_URL.'parent/terms'?>">Terms & Conditions</a>
              <a href="<?php echo BASE_URL.'parent/privacy'?>">Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </footer>