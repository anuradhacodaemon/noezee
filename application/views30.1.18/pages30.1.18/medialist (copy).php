


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> Media Listing<small><?php echo $this->session->userdata['ud']['adminusername']?></small></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">


                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">

                            <th class="column-title">SNo  </th>

                            <th class="column-title">Type</th>

                            <th class="column-title"> Device Id</th>


                            <th class="column-title table-font">Created At</th>


                            <th class="column-title no-link last"><span class="nobr">Action</span>
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


                                    <td class=""><?php echo $v['device_id'] ?></td>

                                    <td class=""><?php
                                echo date("d-m-Y", strtotime($v['date']));
                                        ?></td>


                                    <td class="last"> 

                                        <a href="<?php echo BASE_URL . 'parent/media/details/' . $v['id'] ?>" class="dark_grey " ><i class="fa fa-eye"></i> </a>
                                    
                                     <?php if($v['status']==1) { ?>
                                            <a href="javascript:" onclick="inactiveFranchise(<?php echo $v['id']?>)" style="color:#000"><i class="fa fa-check-circle fa-cog-green" aria-hidden="true"></i></a>
                                             <?php } else {?>
                                                                                        <a href="javascript:"  onclick="activeFranchise(<?php echo $v['id']?>)" style="color:#000"><i class="fa fa-times-circle-o fa-cog-red" aria-hidden="true"></i></a>

                                             <?php } ?>
                                    </td> 

                                </tr>
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

 <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
   
 <script src="http://bootboxjs.com/bootbox.js"></script>
--> 

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
    
        function inactiveFranchise(categoryid) {


    bootbox.confirm("Inactive", function(result) {
     if(result)
      {   $.ajax({
                type: "GET",
                url: "<?php echo BASE_URL  . 'parent/media/delete_inactive/' ?>" + categoryid,
                success: function (data)
                {
                    //alert(data);
                    location.href = '<?php echo BASE_URL  . 'parent/media/' ?>' ;
                }
            });}
     else
     {
         //alert('no');
     }
    });
  //});
  }
   function activeFranchise(categoryid) {

  //$('#btnlock'+jobid).click(function() {
    bootbox.confirm("Active", function(result) {
     if(result)
      {   $.ajax({
                type: "GET",
                url: "<?php echo BASE_URL  . 'parent/media/delete_active/' ?>" + categoryid,
                success: function (data)
                {
                    location.href = '<?php echo BASE_URL  . 'parent/media/' ?>' ;
                }
            });}
     else
     {
         //alert('no');
     }
    });
  //});
  }
</script>
