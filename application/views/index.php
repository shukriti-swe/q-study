<?php echo $header; ?>
<?php echo $menu; ?>
<div class="container ">
  <div class="row">
    <?php if ($this->session->flashdata('success_msg')) : ?>
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:10px;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><?php echo $this->session->flashdata('success_msg') ?> <span style="color: red;">  Note: If you don't see a confirmation e-mail than please check your bluk/spam folder.We sent a sms to your mobile for account details.  </span> </strong>
        </div>
      </div>
    <?php elseif ($this->session->flashdata('error_msg')) : ?>
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:10px;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><?php echo $this->session->flashdata('error_msg') ?></strong>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
<section class="main_content bg-gray animatedParent new_home">

  <!-- <img class="ss_leftff" src="<?php echo base_url();?>assets/images/feedback.png" style="float: left;position: relative;top: 120px;"> -->
  <div class="container-fluid container-fluid_padding">
     <div class="ss_container_rs">
    <div class="row">
      
      <div class="col-sm-4">
         <div class="ss_home_left_new">
            <div class="left_menu1 bottom10" style="text-align: center;">
                <a href="q-dictionary/search"> <img class="img-responsive "  src="<?php echo base_url();?>assets/images/h_left_dic.png"></a>
            </div>

            <div class="left_banner2 bottom10 ss_l_img">
              <a href="video"><img class="img-responsive "  src="assets/images/h_left_video.png"></a>
            </div>
        </div>

      </div>
      
      <div class="col-sm-5">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <!-- Wrapper for slides -->
          <div class="carousel-inner">

            <div class="item active">
              <img src="<?php echo base_url();?>assets/images/banner/2.jpg" alt="Chicago" style="width:100%;">
            </div>

            <div class="item">
              <img src="<?php echo base_url();?>assets/images/banner/3.jpg" alt="New york" style="width:100%;">
            </div>
            <div class="item">
              <img src="<?php echo base_url();?>assets/images/banner/4.jpg" alt="New york" style="width:100%;">
            </div>
            <div class="item">
              <img src="<?php echo base_url();?>assets/images/banner/5.jpg" alt="New york" style="width:100%;">
            </div>
            <div class="item">
              <img src="<?php echo base_url();?>assets/images/banner/6.jpg" alt="New york" style="width:100%;">
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      
      
      <div class="col-sm-3 e_p_right">
        <div class="tutor bottom10">
          <div class="text-left">
           <a href="<?php echo base_url('tutor/search'); ?>" class="btn ss_yellow_round">Find A Tutor</a> 
         </div>
         <div class="text-right">
          <img class="text-right" src="<?php echo base_url();?>assets/images/pp.jpg">
        </div>
        <h6 style="font-size:16px !important;"><b>Become a tutor...</b></h6>
        <a style="width:55%" class="a_button text-center" href="faq/view/other/become_a_tutor">Click Here</a>
      </div>
      <div class="ss_l_img">
        <img class="img-responsive "  src="<?php echo base_url();?>assets/images/3.jpg"></div>
      </div>

    </div>
    
  <!--   <div class="row ss_home_bottom">
      <div class="col-md-3 bottom10">
        <img class="img-responsive "  src="<?php //echo base_url();?>assets/images/left2.png">
      </div>

      <div class="col-md-5 bottom10 text-right">
        <img class="img-responsive"   src="<?php //echo base_url();?>assets/images/m.bottom.png">
      </div>

      <div class="col-md-4 bottom10">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <img class="img-responsive" style="" src="<?php //echo base_url();?>assets/images/4.jpg"> -->
 <!--          </div>
        </div> -->
          <!--<small style="font-size: 14px; margin-left:5%">Imagination is the highest kite that can fly- Lauren Bacall</small>
      </div>

    </div>-->      
    
    
    </div>
    
    <!--===================== End of Hosting Software ========================-->
  </div>
</section>
<style>
    @media only screen and (min-width: 800px) {
    .ss_leftff{
        top: 272px !important;
        position: absolute !important;
    }
    }
</style>
<!--===================== End of Why Choose ========================-->
<?php echo $footer_link; ?>
<?php echo $footer; ?>