<div class="inner-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Media Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <div class="inner-cont clearfix">
                    <div class="cont-heading clearfix">
                        <h2><b>Device Id :</b><?php echo $device_id ?></h2>
                        <span><b>Created at</b> <?php echo $date ?></span>
                    </div>


                    <div class="row">
                        <?php
                        if (count($joblisting) > 0) {
                            if ($page_no > 0) {
                                $i = $page_no;
                            } else {
                                $i = 1;
                            }
                            foreach ($joblisting as $k => $v) {

                                if ($v['type'] == '.jpg' || $v['type'] == '.jpeg' || $v['type'] == '.gif' || $v['type'] == '.png' || $v['type'] == '.bmp' || $v['type'] == 'jpg' || $v['type'] == 'jpeg' || $v['type'] == 'gif' || $v['type'] == 'png' || $v['type'] == 'bmp') {
                                    $type = 'image';
                                    //$thumnailurl = base_url() . MEDIAPATH . $v['name'];
                                    $url = MEDIAPATH3 . $v['name'];
                                }
                                if ($v['type'] == '.webp' || $v['type'] == '.3gp' || $v['type'] == '.mp4' || $v['type'] == '.webm' || $v['type'] == '.mkv' || $v['type'] == 'webp' || $v['type'] == '3gp' || $v['type'] == 'mp4' || $v['type'] == 'webm' || $v['type'] == 'mkv') {
                                    $type = 'video';
                                    $url = MEDIAPATH3 . $v['name'];
                                }
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="img-cont clearfix">
                                <?php
                                if ($v['type'] == '.jpg' || $v['type'] == '.jpeg' || $v['type'] == '.gif' || $v['type'] == '.png' || $v['type'] == '.bmp' || $v['type'] == 'jpg' || $v['type'] == 'jpeg' || $v['type'] == 'gif' || $v['type'] == 'png' || $v['type'] == 'bmp') {
                                    ?>
                                            <img alt="Image" title="" class="img-responsive" src="<?php echo $url ?>"  />
                                        <?php
                                        } else {
                                            if ($v['type'] == '.3gp') {
                                                echo 'Your browser does not support 3pg video. Please check in android app';
                                            } else {
                                                ?>                      

                                                <video alt="Video" title="" class="img-responsive" controls>
                                                    <source src="<?php echo $url ?>" type='video/3gpp; codecs="mp4v.20.8"'>

                                                    <source src="<?php echo $url ?>" type="video/mp4">
                                                    <source src="<?php echo $url ?>" type="video/webm">
                                                    <source src="<?php echo $url ?>" type="video/mvk">

                                                    Your browser does not support HTML5 video.
                                                </video>                   
            <?php }
            ?>    

        <?php } ?>

                                        <div class="action-cont">
                                            <a href="#" class="btn-view"><i class="fa fa-eye"></i> View</a>
                                            <a href="#" class="btn-remove"><i class="fa fa-trash-o"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
        <?php
        $i++;
    }
} else {
    ?>
                            <div class="inner-cont clearfix">
                                <div class="cont-heading clearfix">
                                    <h2><b>No Media found</b> </h2>

                                </div>

                            </div>
    <?php
}
?>


                    </div>

                    
                        <?php echo $pagination; ?> 

                    
                </div>
            </div>


        </div>
    </div>
</div>
</div>