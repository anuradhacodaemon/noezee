
<div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Media Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <?php
                //print_r($joblisting);
                if (count($joblisting) > 0) {
                    if ($page_no > 0) {
                        $i = $page_no;
                    } else {
                        $i = 1;
                    }
                    foreach ($joblisting as $k => $v) {
                        $media = $this->media_model->get_devicemedia($v['device_id']);

                        // if (count($media) > 0) {
                        ?>
                        <div class="inner-cont clearfix">
                            <div class="cont-heading clearfix">
                                <h2><b><a title="click to view image/video" href="<?php echo BASE_URL ?>parent/medialist/<?php echo $v['device_id'] . '/' . date("d-m-Y", strtotime($v['date'])) . '/1' ?>"><?php echo $v['device_name'] ?></a></b></h2>
                                <span><b>Created at</b> <?php
                                    echo date("d-m-Y", strtotime($v['date']));
                                    ?></span>
                            </div>
                            <div class="row">
                                <?php
                                $x = 0;
                                foreach ($media as $k1 => $v1) {
                                    $x++;
                                    $date = date(" D F d Y h:i A", strtotime($v1['add_date']));
                                    $favNum = $this->media_model->get_favorite($v1['id']);

                                    $url = MEDIAPATH3 . $v1['name'];
                                    $url1 = MEDIAPATH4 . $v1['image_thumb'];
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="img-thumbnail clearfix">
                                            <div class="img-cont">
                                                <img src="<?php echo $url1 ?>" alt="Image" title="" class="img-responsive" />
                                                <div class="action-cont">
                                                    <a href="#" class="btn-view"  data-toggle="modal" data-target="#myModal" onclick="getValAll<?php echo $x ?>('<?php echo $x ?>', '<?php echo $url ?>', '<?php echo $v1['id'] ?>', '<?php echo $date ?>', '<?php echo $v1['device_id'] ?>',<?php echo $favNum ?>)"><i class="fa fa-eye"></i> View</a>
                                                    <a href="#" class="btn-remove" onclick="deleteMedia<?php echo $x ?>('<?php echo $x ?>', '<?php echo $v1['id'] ?>')"><i class="fa fa-trash-o"></i> Remove</a>
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
                                                            location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
                                                        }
                                                    });
                                                } else
                                                {
                                                    //alert('no');
                                                }
                                            });
                                        }
                                        function getValAll<?php echo $x ?>(I, image, ID, Date, child_id, fav)
                                        {
                                            //alert(document.getElementById('shareDiv').style.display);
                                           document.getElementById('shareDiv').style.display = 'none';
                                            document.getElementById('Favorite1').style.display = 'none';
                                            document.getElementById('removeFavorite').style.display = 'none';
                                            document.getElementById('Favorite').style.display = 'inline-block';
                                            if (parseInt(fav) > 0)
                                            {
                                                //alert(fav);
                                                document.getElementById('Favorite1').style.display = 'inline-block';
                                                document.getElementById('Favorite').style.display = 'none';
                                                document.getElementById('removeFavorite').style.display = 'inline-block';
                                            }
                                            document.getElementById('imageID').src = image;
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
                                                            location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
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
                                                            location.href = '<?php echo BASE_URL . '/parent/media/' ?>';
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
                        <?php
                        //}
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

                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">  
                </div>
                <div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php
                    if ($total_rows > RECORD_LIMIT) {
                        echo $pagination;
                    }
                    ?>

                </div>
            </div>
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
                    <a href="javascript:void()" title="Share" onclick="getShare()"><i class="fa fa-share-alt"></i></a>
                    <a href="javascript:void()" title="Favorite" id="Favorite" ><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void()" title="This image/video is added as favorite" id="Favorite1"   style="display:none;"><i class="fa fa-star" style="color: #ffba00;"></i></a>

                    <a href="javascript:void()" title="Remove from favorite" id="removeFavorite"><i class="fa fa-trash-o"></i></a>
                    <button type="button" title="Close" class="close" data-dismiss="modal">
                        <img src="<?php echo BASE_URL; ?>public/web/img/close-icon.png" alt="">
                    </button>
                    <div id="shareDiv" style="display:none;">
                        <div class="share-icon">
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
                            <a id="gplus" href="https://plus.google.com/share?url=<?php echo $_SERVER['PHP_SELF'] ?>" onclick="javascript:window.open(this.href,
                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                    return false;"><img src="<?php echo BASE_URL; ?>public/web/img/google.png" class="img-responsive" width="35" height="35"></a>

                            <a href="mailto:<?php echo $this->session->userdata['ud']['adminusername'] ?>"><img src="<?php echo BASE_URL; ?>public/web/img/email.png" width="35" height="35" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <img  id= "imageID" src="" alt="Image" title="<?php echo $v1['name']; ?>" class="img-responsive modal-img">
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
            // foo1 = document.getElementById("emailDiv");
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
        if (winWidth <= 1199)
        {
            var winHeight = $(".img-cont").width();
            $(".img-cont").css("height", winHeight);
        }
    });
</script>

