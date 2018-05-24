<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Shop Apk Status</h2>

                    <div class="clearfix"></div>
                </div>


                <div class="x_content">

                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
                            <?php
                            if ($this->session->flashdata('item')) {
                                $message = $this->session->flashdata('item');
                                ?>
                                <div id="show"><?php echo $message['message'];
                                ?></div>
                                <?php
                            }
                            ?>
                        <input name="tokenid" class="form-control col-md-7 col-xs-12" type="hidden" value="<?php echo $pages[0]['token']; ?>">
                      
                     <input name="apk_hidden" class="form-control col-md-7 col-xs-12" type="hidden" value="<?php echo $pages[0]['apk']; ?>">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">App Path<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="first-name" required="required" name="apk_path" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $pages[0]['apk_path']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apk<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="first-name"  name="apk" class="form-control col-md-7 col-xs-12" type="file" >
                            </div>
                        </div>
                        
                         
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <label   >
                                    <input name="confirm_status" value="1" data-parsley-multiple="gender" type="radio" <?php if ($pages[0]['confirm_status'] == "1") { ?> checked="checked"<?php } ?>> &nbsp; Yes&nbsp;
                                </label>
                                <label   >
                                    <input name="confirm_status" value="0" data-parsley-multiple="gender" type="radio" <?php if ($pages[0]['confirm_status'] == "0") { ?> checked="checked"<?php } ?>> No
                                </label>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
