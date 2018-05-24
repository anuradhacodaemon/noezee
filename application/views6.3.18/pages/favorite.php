<?php
$device_name = $this->media_model->get_device_name($device_id);
$Date = $date;
?>

<div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumb clearfix">
                    <li><a href="<?php echo BASE_URL . 'parent/welcome' ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL ?>parent/device/details/<?php echo $this->session->userdata['ud']['adminid'] ?>">Child Device Listing</a></li>
                    <li class="active">Favorite Library</li>
                </ul>
                <div class="inner-heading clearfix">
                    <h2>Favorite Library </h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <?php
                if (count($joblisting) > 0) {
                    if ($page > 0) {
                        $i = $page;
                    } else {
                        $i = 1;
                    }
                    ?>
                    <div class="inner-cont clearfix">
                        <div class="cont-heading clearfix">
                            <h2><b></b> <?php echo $device_name[0]['device_name'] ?></h2>
                            <span><b>Created at</b> <?php
                                echo $date;
                                ?></span>
                        </div>
                        <div class="row">
                            <?php
                            $x = 0;
                            foreach ($joblisting as $k1 => $v1) {
                                $x++;
                                $date = date(" D F d Y h:i A", strtotime($v1['add_date']));
                                $favNum = $this->device_model->get_favorite($v1['id']);


                                $url = MEDIAPATH3 . $v1['name'];
                                $url1 = MEDIAPATH4 . $v1['image_thumb'];
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="img-thumbnail clearfix">
                                        <div class="img-cont clearfix"><?php
                                            if ($v1['type'] == '.jpg' || $v1['type'] == '.jpeg' || $v1['type'] == '.gif' || $v1['type'] == '.png' || $v1['type'] == '.bmp' || $v1['type'] == 'jpg' || $v1['type'] == 'jpeg' || $v1['type'] == 'gif' || $v1['type'] == 'png' || $v1['type'] == 'bmp') {

                                                $type = 'image';
                                                ?>
                                                <img src="<?php echo $url1 ?>" alt="Image" title="" class="img-responsive" />
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
                                                <a href="javascript:void()" class="btn-view"  data-toggle="modal" data-target="#myModal" onclick="getValAll<?php echo $x ?>('<?php echo $x ?>', '<?php echo $url ?>', '<?php echo $v1['id'] ?>', '<?php echo $date ?>', '<?php echo $v1['device_id'] ?>', '<?php echo $type ?>',<?php echo $favNum ?>)"><i class="fa fa-eye"></i> View</a>
                                                <a href="javascript:void()" class="btn-remove" onclick="deleteMedia<?php echo $x ?>('<?php echo $x ?>', '<?php echo $v1['id'] ?>')"><i class="fa fa-trash-o"></i> Remove</a>
                                            </div>

                                            <!-- Button trigger modal -->

                                        </div>
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
                                                        location.href = '<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>';
                                                    }
                                                });
                                            } else
                                            {
                                                //alert('no');
                                            }
                                        });
                                    }
                                    function getValAll<?php echo $x ?>(I, image, ID, Date, child_id, type, fav)
                                    {
                                        document.getElementById('shareDiv').style.display = 'none';
                                        document.getElementById('Favorite1').style.display = 'none';
                                        document.getElementById('removeFavorite').style.display = 'none';
                                        document.getElementById('Favorite').style.display = 'inline-block';

                                        if (type == 'image')
                                        {
                                            //alert('i');

                                            if (parseInt(fav) > 0)
                                            {
                                                //alert(fav);
                                                document.getElementById('Favorite1').style.display = 'inline-block';
                                                document.getElementById('Favorite').style.display = 'none';
                                                document.getElementById('removeFavorite').style.display = 'inline-block';

                                            }
                                            document.getElementById('myVideo').style.display = 'none';
                                            document.getElementById('imageID').style.display = 'block';

                                            document.getElementById('imageID').src = image;
                                        } else if (type == 'video')
                                        {
                                            //alert('v');
                                            if (parseInt(fav) > 0)
                                            {
                                                //alert(fav);
                                                document.getElementById('Favorite1').style.display = 'inline-block';
                                                document.getElementById('Favorite').style.display = 'none';
                                                document.getElementById('removeFavorite').style.display = 'inline-block';

                                            }
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
                                                        location.href = '<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>';
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
                                                        location.href = '<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>';
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



                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div>
                    <div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers">
                        <?php if ($total_rows > RECORD_LIMIT) { ?> <ul class="pagination">
                            <?php
                            // SHOW PAGE NUMBERS
                            $url = BASE_URL . 'parent/device/favorite/' . $device_id . '/' . $Date . '/';
                            $last = $this->uri->total_segments();
                            $record_num = $this->uri->segment($last);
                            //echo $number_of_pages;
                            if ($page <= $number_of_pages && $page > 1) {
                                $active = $record_num == 1 ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "/" . ($page - 1) . "'>Prev</a> </li>";
                            }
                            for ($i = 1; $i <= $number_of_pages; $i++) {
                                $active = $record_num == $i ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "" . $i . "'>" . $i . "</a> </li>";
                            }
                            if ($page < $number_of_pages) {
                                $active = $record_num == $number_of_pages ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "/" . ($page + 1) . "'>Next</a></li> ";
                            }
                            ?>
                            </ul>
                        <?php } ?>

                    </div>
                </div>
                <?php
            } else {
                echo "No Favorite Found";
            }
            ?>
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
                    <a href="javascript:void()" title="Share " onclick="getShare()"><i class="fa fa-share-alt"></i></a>
                    <a href="javascript:void()" title="Favorite" id="Favorite" ><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void()" title="This image/video is added as favorite" id="Favorite1"   style="display:none;"><i class="fa fa-star" style="color: #ffba00;"></i></a>
                    <a href="javascript:void()" title="Remove from favorite" id="removeFavorite"><i class="fa fa-trash-o"></i></a>
                    <button type="button" title="Close" class="close" data-dismiss="modal">
                        <img src="<?php echo BASE_URL; ?>public/web/img/close-icon.png" alt="">
                    </button>
                    <div id="shareDiv" style="display:none;">
                        <div class="share-icon share-icon-favourite">
                            <!--<a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/facebook.png" class="img-responsive"></a>-->
                            <a href="javascript:void()" id="fbDiv"><img src="<?php echo BASE_URL; ?>public/web/img/fb.png" alt="Facebook" width="35" height="35" title="Facebook" class="img-responsive"></a>

    <!--<a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/twitter.png" class="img-responsive"></a>-->
                            <a  id="twdiv" class="twitter-share-button"
                                href="https://twitter.com/share"
                                data-size="large"
                                data-text="custom share text"
                                data-url="<?php echo $_SERVER['PHP_SELF'] ?>"
                                data-hashtags="example,demo"
                                data-via="twitterdev"
                                data-related="twitterapi,twitter">
                                <img src="<?php echo BASE_URL; ?>public/web/img/tw.png" class="img-responsive" width="35" height="35">
                            </a>

                            <a href="http://pinterest.com/pin/create/button/?url=/node/[nid]&description=[noezee]" target="_blank"><img src="<?php echo BASE_URL; ?>public/web/img/pinterest.png" class="img-responsive" width="35" height="35"></a>

   <!-- <a href="#"><img src="<?php echo BASE_URL; ?>public/web/img/googleplus.png" class="img-responsive"></a>-->
                            <a id="gplus"  href="https://plus.google.com/share?url=<?php echo $_SERVER['PHP_SELF'] ?>" onclick="javascript:window.open(this.href,
                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                    return false;"><img src="<?php echo BASE_URL; ?>public/web/img/google.png" class="img-responsive" width="35" height="35"></a>

                            <a href="mailto:<?php echo $this->session->userdata['ud']['adminusername'] ?>"><img src="<?php echo BASE_URL; ?>public/web/img/email.png" width="35" height="35" class="img-responsive"></a>
                        </div>
                    </div>
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
            var url2 = 'https://plus.google.com/share?url=<?php echo BASE_URL . 'parent/media/details/' ?>' + document.getElementById("media_id").value;
            //foo1 = document.getElementById("emailDiv");
            // foo1.setAttribute("href", url);
            foo2 = document.getElementById("fbDiv");
            foo2.setAttribute("onclick", "window.open('https://www.facebook.com/sharer/sharer.php?u=" + url1 + "','facebook-share-dialog','width=626,height=436');return false;");
            foo3 = document.getElementById("twdiv");
            foo3.setAttribute("data-url", url1);
            foo4 = document.getElementById("gplus");
            foo4.setAttribute("href", url2);
        } else {
            x.style.display = "none";
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    //Image or video width & height will equal
    var winWidth = $(window).width();
    $(document).ready(function () {
        $(' .pagination .active a').on('click', function (e) {
            e.preventDefault();
        });

        if (winWidth <= 1199)
        {
            var winHeight = $(".img-cont").width();
            $(".img-cont").css("height", winHeight);
        }
    });
</script>
