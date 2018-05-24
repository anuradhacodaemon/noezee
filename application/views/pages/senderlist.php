<div id="links1"><div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Device Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <div class="parent-cont clearfix">
                    <div class="sender-cont">
                        <?php
                        if (count($joblisting) > 0) {
                            if ($page_no > 0) {
                                $i = $page_no;
                            } else {
                                $i = 1;
                            }
                            foreach ($joblisting as $k => $v) {
                               
                                $countMsg = $this->message_model->get_devicemsg_count($v['received_child_id']);
                                if ($countMsg > 0) {
                                    ?>
                                    <a href="<?php echo BASE_URL . 'parent/senders/' . $v['received_child_id'].'/1'; ?>"><?php echo $v['device_name'] ?><span><i class="fa fa-angle-right"></i></span></a>
                                    <?php
                                    $i++;
                                }
                            }
                        } else {
                            ?>

                            No Sender Device Found

    <?php
}
?>

                    </div>

<?php echo $pagination; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    //Image or video width & height will equal
   
     function loadlink(){
    $('#links1').load('test.php',function () {
         $(this).unwrap();
    });
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
  
}, 5000);
</script>