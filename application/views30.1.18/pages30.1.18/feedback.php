  <div class="inner-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="inner-heading clearfix">
                <h2>Feedback Listing</h2> &nbsp;&nbsp;<small><a href="<?php echo BASE_URL.'parent/feedback/addfeedback'?>">Add New</a></small>
              <span><?php echo $this->session->userdata['ud']['adminusername']?></span>
            </div>
            <div class="parent-cont clearfix">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    
                    <th class="text-center">S No</th>
                    
                    <th> Content</th>
                    <th>Created at</th>
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
                      <td><?php echo $v['content'] ?></td>
                      <td><?php
                                echo date("d-m-Y", strtotime($v['date']));
                                        ?></td>
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
          </div>
        </div>
      </div>
    </div>