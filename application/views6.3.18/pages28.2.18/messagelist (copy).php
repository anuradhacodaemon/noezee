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
    ?><div class="inner-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
              <h2>Message Listing</h2>
              <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
            </div>
            <div class="parent-cont clearfix">
             <?php
                                if (count($joblisting) > 0) {
                                    if ($page_no > 0) {
                                $i = $page_no;
                            } else {
                                $i = 1;
                            }
                                    foreach ($joblisting as $k => $v) {
                                        
                                        $date = get_day_name($v['currentdate']);
                    $user_data2 = $this->message_model->get_sendermessage($this->session->userdata['ud']['adminid'], $v['currentdate']);
                                        ?>
              <div class="datebox">
                <div class="date-cont"><?php echo $date;?></div>
               <?php  foreach ($user_data2 as $k1 => $v1) {
                ?>
                <div class="message-cont">
                  <h5><?php echo $v1['received_user_address']; ?><span><?php echo date("h :i a", strtotime($v1['currenttime'])); ?></i></span></h5>
                  <p><?php echo $v1['content']; ?></p>
                </div>
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
                
                
              
            <?php echo $pagination;?>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>