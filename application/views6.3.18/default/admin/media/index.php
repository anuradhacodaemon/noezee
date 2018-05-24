


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> Media Listing</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">


                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">

                            <th class="column-title">SNo  </th>

                            <th class="column-title">Type</th>

                            <th class="column-title"> Name</th>
<th class="column-title"> User</th>

                            <th class="column-title table-font">Created At</th>


                            <th class="column-title no-link last"><span class="nobr">View</span>
                            </th>

                        </tr>
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
                                <tr class="even pointer">

                                    <td class=" "><?php echo $i ?></td>

                                    <td class=" "><?php
                                        if (strpos($v['type'], '.') === false) {
                                         
                                             $a = explode('.', $v['type']);
                                            

                                            if ($a[0] == 'png' || $a[0] == 'jpg' || $a[0] == 'gif' || $a[0] == 'PNG' || $a[0] == 'JPG' || $a[0] == 'GIF' || $a[0] == 'jpeg' || $a[0] == 'JPEG' || $a[0] == 'bmp' || $a[0] == 'BMP') {


                                                echo 'image';
                                            } else {
                                                echo 'video';
                                            }
                                        } else {
                                          
                                           if ($v['type'] == 'png' ||
                                                    $v['type'] == 'jpg' || $v['type'] == 'gif' ||
                                                   $v['type'] == 'PNG' || $v['type'] == 'JPG' ||
                                                    $v['type'] == 'GIF' || $v['type'] == 'jpeg' || $v['type'] == 'JPEG' || $v['type'] == 'bmp' || $v['type'] == 'BMP') {


                                                echo 'image';
                                            } else {
                                                echo 'video';
                                            }  
                                            
                                        }
                                        ?></td>


                                    <td class=""><?php echo $v['name'] ?></td>
 <td class=""><?php echo $v['email'] ?></td>
                                    <td class=""><?php
                                echo date("d-m-Y", strtotime($v['date']));
                                        ?></td>


                                    <td class="last"> 

                                        <a href="<?php echo BASE_URL . 'admin/media/details/' . $v['id'] ?>" class="dark_grey " ><i class="fa fa-eye"></i> </a>
                                    </td> 

                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>

                            <tr class="even pointer">

                                <td class="text-center" colspan="6"><?php echo $this->lang->line('NoJobFound'); ?></td>
                            </tr>
                            <?php
                        }
                        ?>




                    </tbody>
                </table>
            </div>
            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"><?php echo $this->lang->line('showing'); ?> <?php
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
                ?> of <?php echo $total_rows; ?>  <?php echo $this->lang->line('entries'); ?></div>
            <div id="datatable-fixed-header_paginate" class="dataTables_paginate paging_simple_numbers">
                <?php echo $pagination; ?>

            </div>
        </div>
    </div>
</div>
<input id="lang" type="hidden" value="<?php
                if ($this->session->userdata('site_lang')) {
                    $language = $this->session->userdata('site_lang');
                    if ($language == 'spanish')
                        echo 'es';
                } else {
                    echo 'en';
                }
                ?>"/>
<script>

    function submitForm()
    {

        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("?");
        $("#filter_form").attr('action', '<?php echo base_url() . DISPATCHERADMIN . '/jobs?' ?>' + vars);
        $("#filter_form").submit();

    }
    function sortList(sortBy, sortDirection)
    {
        $("#sort_by").val(sortBy);
        $("#sort_direction").val(sortDirection);
        $("#filter_form").submit();

    }

    function paidbyclient(jobid, id) {

        //$('#btnlock'+jobid).click(function() {
        bootbox.confirm("<?php echo $this->lang->line('paymentdone'); ?>", function (result) {
            if (result)
            {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() . MASTERADMIN . '/job/paid_by_client/' ?>" + jobid + '/' + id,
                    success: function (data)
                    {
                        location.href = '<?php echo base_url() . MASTERADMIN . '/job/' ?>';
                    }
                });
            } else
            {
                //alert('no');
            }
        });
        //});
    }

    function paidtotechnician(jobid, id) {

        //$('#btnlock'+jobid).click(function() {
        bootbox.confirm("<?php echo $this->lang->line('paymentdone'); ?>", function (result) {
            if (result)
            {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() . MASTERADMIN . '/job/paid_to_technician/' ?>" + jobid + '/' + id,
                    success: function (data)
                    {
                        location.href = '<?php echo base_url() . MASTERADMIN . '/job/' ?>';
                    }
                });
            } else
            {
                //alert('no');
            }
        });
        //});
    }

</script>
 <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
   
 <script src="http://bootboxjs.com/bootbox.js"></script>
--> 
<script>
    function lockjob(jobid) {

//$('#btnlock'+jobid).click(function() {
        bootbox.confirm("<?php echo $this->lang->line('lockjob'); ?>", function (result) {
            if (result)
            {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() . DISPATCHERADMIN . '/jobs/lockjob/' ?>" + jobid,
                    success: function (data)
                    {
                        location.href = '<?php echo base_url() . DISPATCHERADMIN . '/jobs/details/' ?>' + jobid;
                    }
                });
            } else
            {
                //alert('no');
            }
        });
//});
    }
</script>  
<script>
    function submitForm()
    {

        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("?");
        $("#filter_form").attr('action', '<?php echo base_url() . MASTERADMIN . '/job?' ?>' + vars);
        $("#filter_form").submit();

    }
    function sortList(sortBy, sortDirection)
    {

        $("#sort_by").val(sortBy);
        $("#sort_direction").val(sortDirection);
        $("#filter_form").submit();

    }
</script>