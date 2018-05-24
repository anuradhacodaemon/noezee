<div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <ul class="breadcrumb clearfix">
                  <li><a href="<?php echo BASE_URL.'parent/welcome'?>">Home</a></li>
                  <li><a href="<?php echo BASE_URL ?>parent/senderlist">Device Listing</a></li>
                  <li class="active">Sender Listing</li>
                </ul>
                <div class="inner-heading clearfix">
                    <h2>Sender Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>

                <div class="parent-cont clearfix">
                    <div class="sender-cont">
                        <?php
                        if (count($joblisting) > 0) {
                            if ($page > 0) {
                                        $i = $page;
                                    } else {
                                        $i = 1;
                                    }
                            foreach ($joblisting as $k => $v) {
                                
                                if($v['received_user_address']!='') {
                                    $msg_id=$this->message_model->get_msg_id($v['received_user_address']);
                               ?>
                                    <a href="<?php echo BASE_URL . 'parent/messagelist/' . $msg_id[0]['msg_id'].'/'.$device_id; ?>"><?php echo $v['received_user_address'] ?><span><i class="fa fa-angle-right"></i></span></a>
                                    <?php
                                }
                                    $i++;
                                
                            }
                        } else {
                            ?>

                            No sender Found

    <?php
}
?>

                    </div>

<?php 
if ($total_rows > RECORD_LIMIT) { ?><ul class="pagination">
                            <?php
                            // SHOW PAGE NUMBERS
                            $url = BASE_URL . 'parent/senders/' . $device_id . '/';
                            $last = $this->uri->total_segments();
                            $record_num = $this->uri->segment($last);
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
                            </ul><?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //Image or video width & height will equal
   
    $(document).ready(function () {
         $(' .pagination .active a').on('click', function (e) {
            e.preventDefault();
        });
        
    });
</script>