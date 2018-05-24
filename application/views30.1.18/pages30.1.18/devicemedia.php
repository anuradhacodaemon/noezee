<?php $device_name=$this->device_model->get_device_name($device_id);?>
<div class="inner-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Media Gallery </h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <?php
                if (count($joblisting) > 0) {
                    if ($page_no > 0) {
                        $i = $page_no;
                    } else {
                        $i = 1;
                    }
                    ?>
                    <div class="inner-cont clearfix">
                        <div class="cont-heading clearfix">
                            <h2><b></b> <a href="<?php echo BASE_URL ?>parent/media/device/<?php echo $device_id  ?>"><?php echo  $device_name[0]['device_name'] ?></a></h2>
                            <span><b><?php if ($type == 'm')
                    echo 'image';
                if ($type == 'v')
                    echo 'video';
                ?></b> </span>
                        </div>
                        <div class="row">
                            <?php
                            $x = 0;
                            foreach ($joblisting as $k1 => $v1) {
                                $x++;
                                $date = date(" D F d Y h:i A", strtotime($v1['add_date']));


                                $url = MEDIAPATH3 . $v1['name'];
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="img-cont clearfix"><?php
                                        if ($v1['type'] == '.jpg' || $v1['type'] == '.jpeg' || $v1['type'] == '.gif' || $v1['type'] == '.png' || $v1['type'] == '.bmp' || $v1['type'] == 'jpg' || $v1['type'] == 'jpeg' || $v1['type'] == 'gif' || $v1['type'] == 'png' || $v1['type'] == 'bmp') {

                                            $type = 'image';
                                            ?>
                                            <img src="<?php echo $url ?>" alt="Image" title="" class="img-responsive" />
                                            <?php
                                        } else {
                                            if ($v1['type'] == '.3gp') {
                                                $type = 'video';
                                                echo 'Your browser does not support 3pg video. Please check in android app';
                                            } else {
                                                $type = 'video';
                                                ?>                      

                                                <video id="" width="100%" height="100%" controls>
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
                                            <a href="#" class="btn-view"  data-toggle="modal" data-target="#myModal" onclick="getValAll<?php echo $x ?>('<?php echo $x ?>', '<?php echo $url ?>', '<?php echo $v1['id'] ?>', '<?php echo $date ?>', '<?php echo $v1['device_id'] ?>', '<?php echo $type ?>')"><i class="fa fa-eye"></i> View</a>
                                            <a href="#" class="btn-remove" onclick="deleteMedia<?php echo $x ?>('<?php echo $x ?>', '<?php echo $v1['id'] ?>')"><i class="fa fa-trash-o"></i> Remove</a>
                                        </div>

                                        <!-- Button trigger modal -->

                                    </div>

                                </div>
                                <script type="text/javascript">
                                    //<![CDATA[

                                    function deleteMedia<?php echo $x ?>(I, ID)
                                    {
                                        bootbox.confirm("Do you want to remove this media?", function (result) {
                                            if (result)
                                            {
                                                //alert('yes');
                                                $.ajax({
                                                    type: "GET",
                                                    url: "<?php echo BASE_URL . 'parent/media/delete_inactive/' ?>" + ID,
                                                    success: function (data)
                                                    {
                                                        location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
                                                    }
                                                });
                                            } else
                                            {
                                                //alert('no');
                                            }
                                        });
                                    }
                                    function getValAll<?php echo $x ?>(I, image, ID, Date, child_id, type)
                                    {
                                        if (type == 'image')
                                        {
                                            //alert('i');
                                            document.getElementById('myVideo').style.display = 'none';
                                            document.getElementById('imageID').style.display = 'block';

                                            document.getElementById('imageID').src = image;
                                        } else if (type == 'video')
                                        {
                                            //alert('v');
                                            document.getElementById('myVideo').style.display = 'block';
                                            document.getElementById('imageID').style.display = 'none';
                                            document.getElementById('myVideo').src = image;
                                        }
                                        document.getElementById('DateId').innerHTML = Date;
                                        document.getElementById('child_id').value = child_id;
                                        document.getElementById('media_id').value = ID;
                                        document.getElementById('Indexid').value = I;
                                        foo = document.getElementById("Favorite");
                                        foo.setAttribute("onclick", "javascript:addfavorite<?php echo $x ?>();");
                                        foo1 = document.getElementById("removeFavorite");
                                        foo1.setAttribute("onclick", "javascript:removefavorite<?php echo $x ?>();");
                                    }

                                    function addfavorite<?php echo $x ?>()
                                    {
                                        bootbox.confirm("Do you want to add this media as favorite?", function (result) {
                                            if (result)
                                            {
                                                //alert('yes');
                                                $.ajax({
                                                    type: "GET",
                                                    url: "<?php echo BASE_URL . 'parent/media/addfavorite/' ?>" + document.getElementById('media_id').value + '/' + document.getElementById('child_id').value,
                                                    success: function (data)
                                                    {
                                                        //location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
                                                    }
                                                });

                                            } else
                                            {
                                                // alert('no');
                                            }
                                        });
                                    }

                                    function removefavorite<?php echo $x ?>()
                                    {
                                        bootbox.confirm("Do you want to remove this media as favorite?", function (result) {
                                            if (result)
                                            {
                                                //alert('yes');
                                                $.ajax({
                                                    type: "GET",
                                                    url: "<?php echo BASE_URL . 'parent/media/removefavorite/' ?>" + document.getElementById('media_id').value + '/' + document.getElementById('child_id').value,
                                                    success: function (data)
                                                    {
                                                        //location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
                                                    }
                                                });

                                            } else
                                            {
                                                // alert('no');
                                            }
                                        });
                                    }
                                    //]]> 
                                </script>
    <?php } ?>
                        </div>

                    </div>



                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"><?php echo $this->lang->line('showing'); ?> <?php
                        if ($total_rows > 0) {
                            echo ($page_no + 1);
                        } else {
                            echo "0";
                        }
                        ?> - <?php
                        if (($page_no + $record_limit) < $total_rows) {
                            echo ($page_no + $record_limit);
                        } else {
                            echo $total_rows;
                        }
                        ?> of <?php echo $total_rows; ?>  <?php echo $this->lang->line('entries'); ?></div>
                    <div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers">
                <?php echo $pagination; ?>

                    </div>
                </div>
<?php } ?>
        </div>
    </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" name="child_id" id="child_id">
    <input type="hidden" name="media_id" id="media_id">
    <input type="hidden" name="Indexid" id="Indexid">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header text-right">
                    <a href="javascript:void()" title="Share " onclick="getShare()"><img src="<?php echo BASE_URL; ?>public/web/img/share-icon.png" alt=""></a>
                    <a href="#" title="Favorite" id="Favorite" ><img src="<?php echo BASE_URL; ?>public/web/img/favorite-icon.png" alt="" ></a>
                    <a href="#" title="Delete" id="removeFavorite"><img src="<?php echo BASE_URL; ?>public/web/img/delete-icon.png" alt=""></a>
                    <button type="button" title="Close" class="close" data-dismiss="modal">
                        <img src="<?php echo BASE_URL; ?>public/web/img/close-icon.png" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <img  id= "imageID" style="display:none;" src="" alt="Image" title="<?php echo $v1['name']; ?>" class="img-responsive modal-img">
                    <video id="myVideo" style="display:none;" width="100%" height="100%" controls>
                        <source src="" type='video/3gpp; codecs="mp4v.20.8"'>

                        <source src="" type="video/mp4">
                        <source src="" type="video/webm">
                        <source src="" type="video/mvk">

                        Your browser does not support HTML5 video.
                    </video>

                    <p class="text-center" id="DateId"></p>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" id="shareDiv" style="display:none;">
                        <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-4">
                            <!--<a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/facebook.png" class="img-responsive"></a>-->
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=336424816765337&autoLogAppEvents=1';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>

                            <div class="fb-share-button" id="fbDiv" data-href="<?php echo $_SERVER['PHP_SELF'] ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <!--<a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/twitter.png" class="img-responsive"></a>-->
                            <a id="twdiv" class="twitter-share-button"
                               href="https://twitter.com/share"
                               data-size="large"
                               data-text="custom share text"
                               data-url="<?php echo $_SERVER['PHP_SELF'] ?>"
                               data-hashtags="example,demo"
                               data-via="twitterdev"
                               data-related="twitterapi,twitter">
                                <img src="<?php echo BASE_URL; ?>public/web/img/twitter.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                               <a href="http://pinterest.com/pin/create/button/?url=/node/[nid]&description=[noezee]" target="_blank"><img src="<?php echo BASE_URL; ?>public/web/img/instagram.png" class="img-responsive"></a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-sm-offset-0 col-xs-4 col-xs-offset-2 margin-t-10-mob">
                           <!-- <a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/googleplus.png" class="img-responsive"></a>-->
                            <a id="gplus" href="https://plus.google.com/share?url=<?php echo $_SERVER['PHP_SELF'] ?>" onclick="javascript:window.open(this.href,
                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                    return false;"><img src="<?php echo BASE_URL; ?>public/web/img/googleplus.png" class="img-responsive"></a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-4 margin-t-10-mob">
                            <a href="#" id="emailDiv"><img src="<?php echo BASE_URL; ?>public/web/img/email.png" class="img-responsive" width="30" height="30"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->

<script>

    function getShare() {
        var x = document.getElementById("shareDiv");
        if (x.style.display === "none") {
            x.style.display = "block";
            // alert(document.getElementById("media_id").value);
            var url = '<?php echo BASE_URL . 'parent/media/email/' ?>' + document.getElementById("media_id").value;
            var url1 = '<?php echo BASE_URL . 'parent/media/details/' ?>' + document.getElementById("media_id").value;
            var url2 ='https://plus.google.com/share?url=<?php echo BASE_URL . 'parent/media/details/'?>'+ document.getElementById("media_id").value; 
            foo1 = document.getElementById("emailDiv");
            foo1.setAttribute("href", url);
            foo2 = document.getElementById("fbDiv");
            foo2.setAttribute("data-href", url1);
            foo3 = document.getElementById("twdiv");
            foo3.setAttribute("data-url", url1);
            foo4 = document.getElementById("gplus");
            foo4.setAttribute("href", url2 );
        } else {
            x.style.display = "none";
        }
    }
</script>
