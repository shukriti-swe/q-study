             
<div class="ss_section_mes"> 
    <?php if ($this->session->userdata('error_msg')) { ?>
        <div class="alert alert-danger" style="margin-top: 20px ; margin-bottom: 20px;">                    
            <span><?= $this->session->userdata('error_msg'); ?></span>
            <i style="float: right; cursor: pointer" href="#" class="fa fa-times-circle" data-dismiss="alert"></i>
        </div>
    <?php } $this->session->unset_userdata('error_msg'); ?>
    <?php if ($this->session->userdata('success_msg')) { ?>
        <div class="alert alert-success" style="margin-top: 20px ; margin-bottom: 20px;">                    
            <span><?= $this->session->userdata('success_msg'); ?></span>
            <i style="float: right; cursor: pointer" href="#" class="fa fa-times-circle" data-dismiss="alert"></i>
        </div>
    <?php } $this->session->unset_userdata('success_msg'); ?>

    <?php if ($this->session->userdata('status_msg')) { ?>
        <div class="alert alert-warning" style="margin-top: 20px ; margin-bottom: 20px;">                    
            <span><?= $this->session->userdata('status_msg'); ?></span>
            <i style="float: right; cursor: pointer" href="#" class="fa fa-times-circle" data-dismiss="alert"></i>
        </div>
    <?php } $this->session->unset_userdata('status_msg'); ?>
    
    <div id="only_blog_comment" style="display: none;">
        <div class="alert alert-success" style="margin-top: 20px ; margin-bottom: 20px;">                    
            <span id="comment_success_msg"></span>
            <i style="float: right; cursor: pointer" href="#" class="fa fa-times-circle" data-dismiss="alert"></i>
        </div>
    </div>
</div>  
<div class="col-md-1"> 
</div>              

