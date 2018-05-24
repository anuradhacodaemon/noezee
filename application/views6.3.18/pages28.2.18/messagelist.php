<?php

function get_day_name($timestamp) {

    $date = $timestamp;

    if ($date == date('Y-m-d')) {
        $date = 'Today';
    } else if ($date == date('Y-m-d', date("Y-m-d H:i:s") - (24 * 60 * 60))) {
        $date = 'Yesterday';
    } else
        $date = date('M d Y', strtotime($timestamp));
    return $date;
}

?>

<div class="inner-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumb clearfix">
              <li><a href="<?php echo BASE_URL.'parent/welcome'?>">Home</a></li>
              <li><a href="<?php echo BASE_URL ?>parent/senderlist">Device Listing</a></li>
              <li><a href="<?php echo BASE_URL.'parent/senders/'.$device_id.'/1' ?>">Sender Listing</a></li>
              <li class="active">Chat Listing</li>
            </ul>
                <div class="inner-heading clearfix">
                    <h2>Chat Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>

                <div class="parent-cont clearfix">
                    <?php
                    if (count($joblisting) > 0) {
                        if ($page > 0) {
                            $i = $page;
                        } else {
                            $i = 1;
                        }
                        foreach ($joblisting as $k => $v) {

                            $date = get_day_name($v['currentdate']);
                            $user_data2 = $this->message_model->get_sendermessage($this->session->userdata['ud']['adminid'], $v['currentdate'],$device_id,$received_user_address);
                            ?><div class="datebox clearfix">
                                <div class="date-cont"><?php echo $date; ?></div>
                                <?php
                                foreach ($user_data2 as $k1 => $v1) {
                                    if ($v1['msg_type'] == 2 || $v1['msg_type'] == 2) {
                                        ?>
                                        <div class="parent-chat-cont">
                                            <h5><?php echo $v1['received_user_address']; ?><span><?php echo date("h :i a", strtotime($v1['currenttime'])); ?></i></span></h5>
                                            <p><?php echo $v1['content']; ?></p>
                                        </div>
                                    <?php } if ($v1['msg_type'] == 1) { ?>
                                        <div class="chat-cont">
                                            <h5><?php echo $v1['received_user_address']; ?><span><?php echo date("h :i a", strtotime($v1['currenttime'])); ?></i></span></h5>
                                            <p><?php echo $v1['content']; ?></p>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <?php
                            $i++;
                        }
                    } else {
                        ?>

                        No Message Found
                        <?php
                    }
                    ?>

                    <?php
                    //echo $total_rows;
                    
                    if ($total_rows > RECORD_LIMIT) { ?><ul class="pagination">
                        <?php
                        // SHOW PAGE NUMBERS
                        $url = BASE_URL . 'parent/messagelist/' . $msg_id . '/' . $device_id . '/';
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
<!-- Main section ends here -->

<script>
    //Image or video width & height will equal

    $(document).ready(function () {
        $(' .pagination .active a').on('click', function (e) {
            e.preventDefault();
        });

    });
</script>