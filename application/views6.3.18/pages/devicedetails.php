<div class="inner-main inner_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-heading clearfix">
                    <h2>Child Device Listing</h2>
                    <span><?php echo $this->session->userdata['ud']['adminusername'] ?></span>
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
                                    if ($page > 0) {
                                        $i = $page;
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
                                                <a href="<?php echo BASE_URL . 'parent/gallery/m/' . $v['device_id'] ?>"><i class="fa fa-camera"></i></a>
                                                <a href="<?php echo BASE_URL . 'parent/gallery/v/' . $v['device_id'] ?>"><i class="fa fa-video-camera"></i></a>
                                            </td>
                                            <td class="text-center"><a href="<?php echo BASE_URL . 'parent/device/favorite/' . $v['device_id'] . '/' . date("d-m-Y", strtotime($v['date'])) . '/1'; ?>"><i class="fa fa-star"></i></a></td>
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

                        <div class="margintop_10"> <?php if ($total_rows > RECORD_LIMIT) { ?><ul class="pagination">
                                <?php
                                // SHOW PAGE NUMBERS
                                $url = BASE_URL . 'parent/device/details/' . $userId . '/';
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
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- Mobile view only -->
                <div class="mobile-device-cont">
                    <?php
                    if (count($joblisting) > 0) {
                        if ($page > 0) {
                            $i = $page;
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
                                <dt>Media</dt>
                                <dd>
                                    <a href="<?php echo BASE_URL . 'parent/gallery/m/' . $v['device_id'] ?>"><i class="fa fa-camera"></i></a>
                                    <a href="<?php echo BASE_URL . 'parent/gallery/v/' . $v['device_id'] ?>"><i class="fa fa-video-camera"></i></a>
                                </dd>
                                <div class="clearfix"></div>
                                <dt>Favourite</dt>
                                <dd>
                                    <a href="<?php echo BASE_URL . 'parent/device/favorite/' . $v['device_id'] . '/' . date("d-m-Y", strtotime($v['date'])); ?>"><i class="fa fa-star"></i></a>
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
                    <div class="dataTables_info margintop_10" id="datatable_info" role="status" aria-live="polite">

                    </div>
                    <div class="margintop_10"> <?php if ($total_rows > RECORD_LIMIT) { ?><ul class="pagination">
                            <?php
                            // SHOW PAGE NUMBERS
                            $url = BASE_URL . 'parent/device/details/' . $userId . '/';
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
                            </ul><?php } ?></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
