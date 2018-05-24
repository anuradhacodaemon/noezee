


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sender Listing</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">


                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">

                            <th class="column-title">SNo  </th>

                           

                            <th class="column-title"> Name</th>

                          <th class="column-title"> View</th>
                        </tr>
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
                                    $msg_id=$this->message_model->get_msg_id($v['received_user_address']);

                               if ($v['received_user_address']!='') {
                                    ?>
                                <tr class="even pointer">

                                    <td class=" "><?php echo $i ?></td>

                                    

                                    <td class=""><?php echo $v['received_user_address'] ?></td>
 


                                    <td class="last"> 

                                        <a href="<?php echo BASE_URL . 'admin/messagelist/' . $msg_id[0]['msg_id'].'/'.$device_id; ?>" class="dark_grey " ><i class="fa fa-eye"></i> </a>
                                    </td> 

                                </tr>
                                <?php
                                $i++;
                               }
                            }
                        } else {
                            ?>

                            <tr class="even pointer">

                                <td class="text-center" colspan="6"><?php echo "No sender found"; ?></td>
                            </tr>
                            <?php
                        }
                        ?>




                    </tbody>
                </table>
                
            </div>           
    </div>
</div>
 <div class="" id="" role="status" aria-live="polite"> <?php

             
if ($total_rows > RECORD_LIMIT) { ?><div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers"><ul  class="pagination">
                            <?php
                            // SHOW PAGE NUMBERS
                            $url = BASE_URL . 'admin/senders/' . $device_id . '/';
                            $last = $this->uri->total_segments();
                            $record_num = $this->uri->segment($last);
                            if ($page <= $number_of_pages && $page > 1) {
                                $active = $record_num == 1 ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "/" . ($page - 1) . "'><</a> </li>";
                            }
                            for ($i = 1; $i <= $number_of_pages; $i++) {
                                $active = $record_num == $i ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "" . $i . "'>" . $i . "</a> </li>";
                            }
                            if ($page < $number_of_pages) {
                                $active = $record_num == $number_of_pages ? 'active' : '';
                                echo "<li class='" . $active . "'><a href='" . $url . "/" . ($page + 1) . "'>></a></li> ";
                            }
                            ?>
                            </ul><?php } ?> </div>
                 </div>
<script>
    //Image or video width & height will equal
   
    $(document).ready(function () {
         $(' .pagination .active a').on('click', function (e) {
            e.preventDefault();
        });
        
    });
</script>