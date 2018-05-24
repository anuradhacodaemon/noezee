  <div class="inner-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
              <h2>Child Device Listing</h2>
              <span><?php echo $this->session->userdata['ud']['adminusername']?></span>
            </div>
            <div class="parent-cont clearfix">
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
                            if ($page_no > 0) {
                                $i = $page_no;
                            } else {
                                $i = 1;
                            }
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
                        <a href="<?php echo BASE_URL . 'parent/device/media/m/' . $v['device_id'] ?>"><i class="fa fa-picture-o"></i></a>
                        <a href="<?php echo BASE_URL . 'parent/device/media/v/' . $v['device_id'] ?>"><i class="fa fa-file-video-o"></i></a>
                      </td>
                      <td class="text-center"><a href="<?php echo BASE_URL . 'parent/device/favorite/' . $v['device_id'].'/'.date("d-m-Y", strtotime($v['date']));
                                        ?>"><img src="<?php echo BASE_URL; ?>public/web/img/favorite-icon.png" alt="" ></a></td>
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
             <!-- <span class="label-text">Showing 1 - 10 of 18 records</span>-->
                
                
                <?php
                
                if(count($joblisting) >0)
                {    
                echo $pagination;
                
                }
                else{
                echo '<a href="javascript:" onclick="goBack()">Go Back</a>';
                }
                ?>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
function goBack() {
    window.history.back();
}
</script>
