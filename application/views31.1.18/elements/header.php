
  <header class="header-main clearfix">
      <div class="container">
        <div class="row">
		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                                     <?php if (!isset($this->session->userdata['ud'])) {?>
               <a href="<?php echo BASE_URL?>" class="navbar-brand"><img src="<?php echo BASE_URL; ?>public/web/img/logo.png" alt="Logo" title="noeZee" class="img-responsive" />
                    </a>
                <?php } else { ?>
                <a href="<?php echo BASE_URL.'parent/media'?>"><img src="<?php echo BASE_URL; ?>public/web/img/logo.png" alt="Logo" title="noeZee" class="img-responsive" />
                    </a>
                <?php } ?>
                   
				</div>
				<!-- Collection of nav links and other content for toggling -->
				 <?php if (isset($this->session->userdata['ud'])) {
                                ?>
                                <div id="navbarCollapse" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
                    <li>Welcome <span>Parent !</span></li>
                    <li class="active"><a href="<?php echo BASE_URL?>parent/media">Media</a></li>
                    <li><a href = "<?php echo BASE_URL?>parent/device">Device</a></li>
                                        <li><a href = "<?php echo BASE_URL?>parent/feedback">Feedback</a></li>

                    <li><a href = "<?php echo BASE_URL?>parent/home/logout">Logout</a></li>
					</ul>
				</div>
                                 <?php } ?>
			</nav>
		  </div>
        </div>
      </div>
	</header>