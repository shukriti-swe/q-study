<?php echo $header; ?>
<?php echo $header_sign_up; ?> 

<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 34px;
        user-select: none;
        -webkit-user-select: none;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 34px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 32px;
        position: absolute;
        top: 2px;
        right: 1px;
        width: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-4" style="margin-top: 40px;">
            <form method="post" action="<?php echo base_url(); ?>select_course">
                
                <?php
                echo $this->session->userdata('country_error');
                $this->session->unset_userdata('country_error');
                ?><br>

                <div class="form-group row">
                    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Country:</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="colFormLabelLg" name="country">
                            <?php foreach ($country_db as $data) { ?>
                                <option value='<?php echo $data['id']; ?>'><?php echo $data['countryName']; ?></option>

                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-4" style="margin-left: 39%;"> 
                    <button class="btn btn_next">
                        <img src="<?php echo base_url(); ?>assets/images/arrow_next.png"/>Next
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php echo $footer; ?>
 
