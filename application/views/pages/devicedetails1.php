  <div class="inner-main inner_container">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
              <h2>Child Device Listing</h2>
              <span><?php echo $this->session->userdata['ud']['adminusername']?></span>
            </div>
            <div class="parent-cont hide-mob clearfix">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    
                    <th class="text-center">Sr no</th>
                    <th>Device Id</th>
                    <th>Device name</th>
                    <th>Created at</th>
                    <th class="text-center">Media</th>
                    <th class="text-center">Favourite</th>
                  </thead>
                  <tbody>
                      <?php
                        
                        if (count($joblisting) > 0) {
                            $i=0;
                            foreach ($joblisting as $k => $v) {
                                //$neighborhoodname=$this->jobs->get_neighborhood($v['franchise_id'],$v['job_id']);
                                ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td><?php echo $v['device_id'] ?></td>
                      <td><?php echo $v['device_name'] ?></td>
                      <td><?php
                                echo date("d-m-Y", strtotime($v['date']));
                                        ?></td>
                      <td class="text-center">
                        <a href="<?php echo BASE_URL . 'parent/gallery/m/' . $v['device_id'] ?>"><i class="fa fa-picture-o"></i></a>
                        <a href="<?php echo BASE_URL . 'parent/gallery/v/' . $v['device_id'] ?>"><i class="fa fa-file-video-o"></i></a>
                      </td>
                      <td class="text-center"><a href="<?php echo BASE_URL . 'parent/device/favorite/' . $v['device_id'].'/'.date("d-m-Y", strtotime($v['date']));?>"><i class="fa fa-star"></i></a></td>
                    </tr>
                   <?php
                                $i++;
                            }
                        } else {
                            ?>

                            <tr class="even pointer">

                                <td class="text-center" colspan="6">No Device Found</td>
                            </tr>
                            <?php
                        }
                        ?>
                  </tbody>
                </table>
              </div>
              <div class="dataTables_info margintop_10" id="datatable_info" role="status" aria-live="polite">
              </div>
              <div class="margintop_10"><ul class="pagination">
<?php // SHOW PAGE NUMBERS
$url=BASE_URL . 'parent/device/details1/' . $userId.'/';
$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
    if ($page) {
        $active= $record_num==1? 'active':'';
        echo "<li class='".$active."'><a href='".$url."/1'>First</a> </li>";
    }
    for ($i=1;$i<=$number_of_pages;$i++) {
$active= $record_num==$i? 'active':'';
        echo "<li class='".$active."'><a href='".$url."".$i."'>".$i."</a> </li>";
    }    
    if (($page + 1) != $number_of_pages) {
$active= $record_num==$number_of_pages? 'active':'';
        echo "<li class='".$active."'><a href='".$url.".".$number_of_pages."'>Last</a></li> ";
    }?>
</ul>

</div>
              <div class="clearfix"></div>
            </div>
            <!-- Mobile view only -->
            <div class="mobile-device-cont">
                <?php
                        
                  if (count($joblisting) > 0) {
                   
                    foreach ($joblisting as $k => $v) {
                    //$neighborhoodname=$this->jobs->get_neighborhood($v['franchise_id'],$v['job_id']);
                ?>
                <dl>
                <dt>Device Id</dt>
                <dd><?php echo $v['device_id'] ?></dd>
                <div class="clearfix"></div>
                <dt>Device name</dt>
                <dd><?php echo $v['device_name'] ?></dd>
                <div class="clearfix"></div>
                <dt>Created at</dt>
                <dd><?php
                      echo date("d-m-Y", strtotime($v['date']));
                    ?>
                </dd>
                <div class="clearfix"></div>
                <dt>Media</dt>
                <dd>
                  <a href="<?php echo BASE_URL . 'parent/gallery/m/' . $v['device_id'] ?>"><i class="fa fa-picture-o"></i></a>
                  <a href="<?php echo BASE_URL . 'parent/gallery/v/' . $v['device_id'] ?>"><i class="fa fa-file-video-o"></i></a>
                </dd>
                <div class="clearfix"></div>
                <dt>Favourite</dt>
                <dd>
                  <a href="<?php echo BASE_URL . 'parent/device/favorite/' . $v['device_id'].'/'.date("d-m-Y", strtotime($v['date']));?>"><i class="fa fa-star"></i></a>
                </dd>
                <div class="clearfix"></div>
                </dl>
                <?php
                  $i++;
                      }
                  } else {
                      ?>

                      <tr class="even pointer">

                          <td class="text-center" colspan="6">No Device Found</td>
                      </tr>
                      <?php
                  }
                ?>
                <div class="dataTables_info margintop_10" id="datatable_info" role="status" aria-live="polite"><?php echo $this->lang->line('showing'); ?> <?php
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
                    ?> of <?php echo $total_rows; ?>  <?php echo $this->lang->line('entries'); ?>
                </div>
                <div class="margintop_10"><?php echo $pagination; ?></div>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
