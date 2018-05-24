


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Media Detail</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                        <div class="x_panel">
                         

                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12">


                                    <div>
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
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

                                                            <video width="100%" controls>
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
                                                
                                                <br>
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
       



