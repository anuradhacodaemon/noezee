
          

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Media Gallery <small> <?php if($type=='m') echo 'image';
                    if($type=='v') echo 'video';?> </small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">

                      
<?php
                        
                        if (count($joblisting) > 0) {
                            if ($page_no > 0) {
                                $i = $page_no;
                            } else {
                                $i = 1;
                            }
                            foreach ($joblisting as $k => $v) {
                                //$neighborhoodname=$this->jobs->get_neighborhood($v['franchise_id'],$v['job_id']);
                              
                               if ($v['type'] == '.jpg' || $v['type'] == '.jpeg' || $v['type'] == '.gif' || $v['type'] == '.png' || $v['type'] == '.bmp'
                                    || $v['type'] == 'jpg' || $v['type'] == 'jpeg' || $v['type'] == 'gif' || $v['type'] == 'png' || $v['type'] == 'bmp') {
                                $type = 'image';
                                //$thumnailurl = base_url() . MEDIAPATH . $v['name'];
                                 $url=MEDIAPATH3 . $v['name']; 

                                
                                    }
                            if ($v['type'] == '.webp' || $v['type'] == '.3gp' || $v['type'] == '.mp4' || $v['type'] == '.webm' || $v['type'] == '.mkv' || $v['type'] == 'webp' || $v['type'] == '3gp' || $v['type'] == 'mp4' || $v['type'] == 'webm' || $v['type'] == 'mkv') {
                                $type = 'video';
                                  $url=MEDIAPATH3 . $v['name']; 
                            }
                                ?>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                              <?php
                               if ($v['type'] == '.jpg' || $v['type'] == '.jpeg' || $v['type'] == '.gif' || $v['type'] == '.png' || $v['type'] == '.bmp'
                                    || $v['type'] == 'jpg' || $v['type'] == 'jpeg' || $v['type'] == 'gif' || $v['type'] == 'png' || $v['type'] == 'bmp') {
                               ?>
                            <img style="width: 100%; display: block;" src="<?php echo $url?>" alt="image" />
                                    <?php } else { 
                            if ($v['type'] == '.3gp') {
                                                          echo 'Your browser does not support 3pg video. Please check in android app';  
                                                        } else {
                                                            ?>                      

                                                            <video width="400" controls>
                                                                <source src="<?php echo $url ?>" type='video/3gpp; codecs="mp4v.20.8"'>

                                                                <source src="<?php echo $url ?>" type="video/mp4">
                                                                <source src="<?php echo $url ?>" type="video/webm">
                                                                <source src="<?php echo $url ?>" type="video/mvk">

                                                                Your browser does not support HTML5 video.
                                                            </video>                   
    <?php }

?>    

                                    <?php } ?>
                            <div class="mask">
                              <p><?php echo $v['name'] ?></p>
                              <div class="tools tools-bottom">
                                <!--<a href="#"><i class="fa fa-link"></i></a>
                                <a href="#"><i class="fa fa-pencil"></i></a>
                                <a href="#"><i class="fa fa-times"></i></a> -->
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><?php echo $v['device_id'] ?></p>
                          </div>
                        </div>
                      </div>
                      <?php
                                $i++;
                            }
                        } else {
                            ?>

                            <tr class="even pointer">

                                <td class="text-center" colspan="6">No Media Found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </div>
                  </div>
                </div>
              
              <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">showing <?php
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
                ?> of <?php echo $total_rows; ?>  entries</div> 
            <div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers">
                <?php echo $pagination; ?>

            </div>
        </div>
              </div>
            </div>
        
        </div>