  <div class="inner-main inner_container">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
              <h2>Parent Device Listing</h2>
              <span><?php echo $this->session->userdata['ud']['adminusername']?></span>
            </div>
            <div class="parent-cont hide-mob clearfix">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    
                    <th class="text-center">S No</th>
                    <th>Device Id</th>
                    <th>Device name</th>
                    <th>Created at</th>
                    <th class="text-center">View Child</th>
                  </thead>
                  <tbody> <?php
                        
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
                      <td class="text-center"><a href="<?php echo BASE_URL . 'parent/device/details/' . $v['user_id'] ?>"><i class="fa fa-eye"></i></a></td>
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
                <?php echo $pagination; ?>
            </div>
            <!-- Mobile view only -->
            <div class="mobile-device-cont">
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
                <a href="<?php echo BASE_URL . 'parent/device/details/' . $v['user_id'] ?>" class="childview"><i class="fa fa-eye"></i>View Child </a>
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
                <span class="label-text">Showing 1 - 10 of 18 records</span>
                <?php echo $pagination; ?>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>