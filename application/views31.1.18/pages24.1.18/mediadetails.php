

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> Media Details</h2>

                <div class="clearfix"></div>
            </div><?php //$takenby = $this->jobs->get_dispatcher($jobDetails[0]['dispatcherid']);  ?>
            <div class="">
                <div class="page-title">
                    <div class="title_left">

                        <a href="<?php echo base_url() . 'admin' ?>" class="dark_grey">Home</a> >  <a href="<?php echo base_url() . 'parent/media' ?>" class="dark_grey">Media Listing</a> >Details
                        <h3> Media Detail<small> </small></h3>
                    </div>

                </div>
                <div class="title_center">
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">



                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12">


                                    <br />

                                    <div id="mainb" style="height:0px;"></div>




                                    <div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                            <div class="profile_img"><h2>Image/Video</h2>
                                                <div id="crop-avatar">
                                                    <!-- Current avatar -->
                                                    <?php
                                                    if ($jobDetails[0]['type'] == '.png' ||
                                                            $jobDetails[0]['type'] == '.jpg' || $jobDetails[0]['type'] == '.gif' ||
                                                            $jobDetails[0]['type'] == '.PNG' || $jobDetails[0]['type'] == '.JPG' ||
                                                            $jobDetails[0]['type'] == '.GIF' || $jobDetails[0]['type'] == '.jpeg' || $jobDetails[0]['type'] == '.JPEG' || $jobDetails[0]['type'] == '.bmp' || $jobDetails[0]['type'] == '.BMP') {
                                                        if ($jobDetails[0]['name'] != '') {
                                                            $img = BASE_URL . 'upload/category/' . $jobDetails[0]['name'];
                                                        } else {
                                                            $img = BASE_URL . 'public/img/no-image-box.png';
                                                        }
                                                        
                                                        ?>
                                                        <a href="javascript:void()" onclick="loadImg('<?php echo $img ?>')"  id="fc_edit" data-toggle="modal" data-target="#CalenderModalView"><img class="img-responsive avatar-view" src="<?php echo $img ?>" ></a>
                                                    <?php
                                                    }
                                                    else if ($jobDetails[0]['type'] == 'png' ||
                                                            $jobDetails[0]['type'] == 'jpg' || $jobDetails[0]['type'] == 'gif' ||
                                                            $jobDetails[0]['type'] == 'PNG' || $jobDetails[0]['type'] == 'JPG' ||
                                                            $jobDetails[0]['type'] == 'GIF' || $jobDetails[0]['type'] == 'jpeg' || $jobDetails[0]['type'] == 'JPEG' || $jobDetails[0]['type'] == 'bmp' || $jobDetails[0]['type'] == 'BMP') {
                                                        if ($jobDetails[0]['name'] != '') {
                                                            $img =  MEDIAPATH3 . $jobDetails[0]['name'];
                                                        } else {
                                                            $img = BASE_URL . 'public/img/no-image-box.png';
                                                        }
                                                        
                                                        ?>
                                                        <a href="javascript:void()" onclick="loadImg('<?php echo $img ?>')"  id="fc_edit" data-toggle="modal" data-target="#CalenderModalView"><img class="img-responsive avatar-view" src="<?php echo $img ?>" ></a>
                                                    <?php
                                                    }
                                                    
                                                    else {

                                                        if ($jobDetails[0]['type'] == '.3gp') {
                                                          echo 'Your browser does not support 3pg video. Please check in android app';  
                                                        } else {
                                                            ?>                      

                                                            <video width="400" controls>
                                                                <source src="<?php echo BASE_URL . 'upload/category/' . $jobDetails[0]['name'] ?>" type='video/3gpp; codecs="mp4v.20.8"'>

                                                                <source src="<?php echo BASE_URL . 'upload/category/' . $jobDetails[0]['name'] ?>" type="video/mp4">
                                                                <source src="<?php echo BASE_URL . 'upload/category/' . $jobDetails[0]['name'] ?>" type="video/webm">
                                                                <source src="<?php echo BASE_URL . 'upload/category/' . $jobDetails[0]['name'] ?>" type="video/mvk">

                                                                Your browser does not support HTML5 video.
                                                            </video>                   
    <?php }
}
?>    



                                                </div>
                                            </div>


                                        </div>





                                    </div>


                                </div>

                                <!-- start project-detail sidebar -->



                            </div>
                            <!-- end project-detail sidebar -->

                        </div>
                    </div>
                </div>
            </div>
            <script>
                function loadImg(img)
                {
                    document.getElementById('imageID').src = img;
                }

            </script>
            <div id="CalenderModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">


                        <div class="modal-body">

                            <div id="testmodal2" style="padding: 5px 20px;">
                                <form id="antoform2" class="form-horizontal calender" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-12">

                                            <img class="img-responsive avatar-view" id="imageID" >
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        </div>
                    </div>
                </div>
            </div>   
            <div id="CalenderModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">


                        <div class="modal-body">

                            <div id="testmodal2" style="padding: 5px 20px;">
                                <form id="antoform2" class="form-horizontal calender" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-12">

                                            <img class="img-responsive avatar-view" src="<?php echo $img ?>" >
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=239879159848555';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-share-button" data-href="<?php echo $_SERVER['PHP_SELF'] ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
<a href="https://plus.google.com/share?url=<?php echo $_SERVER['PHP_SELF'] ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
  src="https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/></a>