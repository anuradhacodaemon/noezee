<div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Feedback Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
                </div>
                <a class="addnew" href="<?php echo BASE_URL . 'parent/feedback/addfeedback' ?>">Add New</a>
                <div class="clearfix"></div>
                <div class="parent-cont hide-mob margintop_0 clearfix">
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
                                            <td><?php if ($v['date'] !='0000-00-00 00:00:00')
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
                                <dt>Content</dt>
                                <dd><?php echo $v['content'] ?></dd>
                                <div class="clearfix"></div>
                                <dt>Created at</dt>
                                <dd><?php if ($v['date'] !='0000-00-00 00:00:00') echo date("d-m-Y", strtotime($v['date'])); ?></dd>
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
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>