<style type="text/css">
    .pointer {cursor: pointer;}

    .top_signup li span {
        min-width: 40px;
        text-align: center;
        line-height: 20px;
        display: inline-block;
        margin-left: 5px;
        background: #333;
        color: white;
        font-size: 16px;
        font-weight: bold;
    }
    .top_signup li {
        display: inline-block;
        padding: 0px !important;
    }
    
    
    
    
    .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
<?php
if ($this->session->userdata('user_id')) {
    $user = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
    $user = $user[0];
    $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
    $duration = $tbl_setting->setting_value;
    // echo "<pre>";
    // print_r($user);die();
    
    $email = '';

    if ($this->session->userdata('user_email'))
    {
        $email = $this->session->userdata('user_email');
    }else{
        $email = $this->session->userdata('email');
    }
}

?>
<?php 

if (isset($video_help[0]['userfile'])) {
    $files = json_decode($video_help[0]['userfile'] , true);
    $title_num  = count($files) / 2 ;
    foreach ($files as $key => $value) {
        if ($key < $title_num) {
            $title[] = $value;
        }else{
            $videos[] = $value;
        }
    }
}

 ?>
<div class="sign_up_header new_hed">
    <div class="col-sm-4">
        <?php if(isset($pageType) and $pageType=='q-dictionary'): ?>
            <div class="col-md-12" style="margin-top: 5px; margin-bottom:10px;">
                <img src="assets/images/q-dictionary.png" alt="User Image" style="width: 265px; height:125px"/>   
            </div>  
        <?php elseif ($this->session->userdata('user_id')) : ?>
            <div class="col-md-12">
                <span style="float: left;">Welcome <?php echo $email; ?></span>
                <a href="<?php echo base_url();?>logout" class="col-xs-4">
                    <button class="btn btn-default btnChngByHover" style="padding: 3px 12px;border-color: #ccc;font-weight: bold;border-color: #ccc;font-weight: bold;">Logout</button>
                </a>  
            </div>
            <?php
            if ($this->session->userdata('user_id')) {
                $data['user_id']=$this->session->userdata('user_id');

                $this->db->select('*');
                $this->db->from('profile');
                $this->db->where('user_id',$data['user_id']);
                $queries = $this->db->get();
                $profile = $queries->result_array();
                // if($profile[0]['profile_image'] != ''){echo $profile[0]['profile_image'];}
                
            }
            ?>
            <div class="col-md-12" style="margin-top: 5px; margin-bottom:10px;">
                <div class="col-md-5">
                    <?php if (isset($profile[0]['profile_image']) && file_exists('assets/uploads/profile/thumbnail/'.$profile[0]['profile_image'])) : ?>
                        <img src="<?php echo base_url();?>assets/uploads/profile/thumbnail/<?php echo $profile[0]['profile_image'];?>"  alt="User Image" style="width: 125px; height:115px" class="ss_user"/>
                    <?php else : ?>
                        <img src="assets/images/default_user.jpg" alt="User Image" style="width: 125px; height:115px" class="ss_user" />   
                    <?php endif; ?>
                    <!-- <a href="#" class="mobile"><img src="assets/images/logo_signup.png" ></a> -->
                </div>
                <?php
                if (isset($user['subscription_type']) && $user['subscription_type'] == 'trial') {

                    $trail_start_date = date('Y-m-d',$user['created']);
                    $trail_end_date  = date('Y-m-d', strtotime('+'.$duration.' days', strtotime($trail_start_date)));
                    $today = date('Y-m-d');
                    $diff = strtotime($trail_end_date) - strtotime($today);
                    $days = floor($diff/(60*60*24));

                }

                if (isset($days)): ?>
                    <div class="col-md-7">
                        <p style="letter-spacing:0px !important;font-size: 16px;">Free Trail <span style="padding: 4px 16px;border-radius:10%;border: 1px solid #ae9ebd;"><?=($days >=0)?$days:0;?></span> Days</p>
                    </div>
                <?php endif ?>

                <!-- after payment -->
                <?php 
                    $end_subs       = $user['end_subscription'];
                    $payment_status = $user['payment_status'];
                    $subscription_type = $user['subscription_type'];
                    if (isset($end_subs)) {
                         $d1 = date('Y-m-d',strtotime($end_subs));
                         $d2 = date('Y-m-d');
                         $diff = strtotime($d1) - strtotime($d2);
                         $r_days = floor($diff/(60*60*24));
                    }
                    // echo $end_subs;
                    if (isset($end_subs) && $subscription_type != "trial" && $user['user_type'] != 4) : ?>
                        <div class="col-md-7" style="padding: 0 ;">
                            <p style="letter-spacing:0px !important;font-size: 16px;">
                                <?= (isset($subscription_type) && $subscription_type =="guest")?"Guest":"Registration";?> <span style="padding: 4px 16px;border-radius:10%;border: 1px solid #ae9ebd;"><?=($r_days >=0)?$r_days:0;?></span> Days</p>
                            
                        </div>
                        <?php if ($payment_status == "Cancel"): ?>
                            <p style="position: relative;"><u >Subscription will cancel after this date</u></p>
                        <?php endif ?>
                    <?php endif ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-4 text-center">
        <!-- <?php if (isset($pageType) and $pageType=='q-dictionary') : ?>
            <a href="#"><img src="assets/images/q-dictionary.png" ></a>
        <?php else : ?>
            <a href="#"><img src="assets/images/logo_signup.png" ></a>
        <?php endif; ?> -->
            <a href="#" class="desktop"><img src="assets/images/logo_signup.png" ></a>
            <?php 
            if($this->session->userdata('selCountry')){
            ?>
            <h5 style="font-weight: bold;text-decoration:underline;color: #d20404;"><?=$this->session->userdata('setCountryName')?></h5>
            <?php }?>
    </div>
    <div class="col-sm-4">
        <div class="top_signup" style="overflow: inherit;">
            <ul>
                <!-- <li><a href="<?php echo isset($_SESSION['prevUrl'])?$_SESSION['prevUrl']:'#'; ?>">Back</a></li> -->
                <?php if (!empty($has_back_button)) { ?>
                    <li><a style="color: #333;" href="<?php echo $has_back_button; ?>">Back</a></li>
               <?php }else { ?>
                <!--<li><a style="color: #333;" href="<?php echo isset($_SESSION['prevUrl'])?$_SESSION['prevUrl']:'#'; ?>">Back</a></li>-->
                <li><a style="color: #333; cursor: pointer;" id="back_url">Back</a></li>
              <?php } ?>
                
                <li><a style="color: #333;" class="pointer" onclick="open_videoHelp()" ><img src="<?php echo base_url();?>assets/images/icon_video.png"/> Video Help </a><span style="color: white;">  <?php if (isset($video_help_serial) && !empty($video_help_serial)  ) { echo  $video_help_serial;  } ?></span></li>
                
                <?php if ($this->session->userdata('user_id')) : ?>
                <li><a href="contact_us" style="color: #333; cursor: pointer;background: transparent;">Contact</a></li>
                <li class="dropdown">
                  <a href="see-compose-message" id="compose_message" style="color: #333;background: transparent;" class="pointer"><img style="width: 30px;" src="<?php echo base_url();?>assets/images/images/notification.PNG"/></a>
                  <div id="myDropdown" class="dropdown-content"   style="min-width: 70px !important;right: -10px;top: 20px;background:none !important;box-shadow: none;">
                    <a href="see-compose-message" style="background: transparent;"><img src="<?php echo base_url();?>assets/images/images/noti.png"/></a>
                  </div>
                </li>
                <?php endif; ?> 
            </ul>
            <div id="show_videoCount_"></div>
        </div>
    </div>
</div>

<?php if (isset($title)) { ?>
    
    <div class="modal fade" id="open_videoHelp" role="dialog">
        <div class="modal-dialog" style="margin-right: 1%;margin-top: 5%;">
            <div class="modal-content" style="margin: 45px 100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close_btn" onclick="pauseVid()">&times;</button>
                </div>
                <div class="modal-body">

                    <ul class="video_help">
                        <?php foreach ($title as $key => $value) { ?>
                            <li onclick="videoShow('<?= $videos[$key]['Audio'] ?>')"  > <?= $value['title'] ?> </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="modal-footer"> 
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="show_videoHelp" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close_btn" onclick="pauseVid()">&times;</button>
                </div>
                <div class="modal-body">

                    <span id="show_video"></span>

                </div>
                <div class="modal-footer"> 
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        
        // function open_videoHelp(){
        //       $('#open_videoHelp').modal('show');
        //   }

          function videoShow(videoLink){
              $("#show_video").html('<video id="myVideo" controls preload="auto" width="570" height="300"><source src="'+videoLink+'" type="video/mp4" >');
              $('#show_videoHelp').modal('show');
          }
    </script>

    <script type="text/javascript">
        var vid = document.getElementById("myVideo"); 
        function pauseVid() { 
           vid.pause(); 
         }
    </script>
    
<?php } ?>

<script type="text/javascript">
    <?php if (isset($title) && !empty($title)  ) { ?>
        function open_videoHelp(){
              $('#open_videoHelp').modal('show');
          }
    <?php }else{ ?>
        function open_videoHelp(){
              $('#show_videoCount_').html(' <div id="show_videoCount">No Video Has been Given</div> ');
              $("#show_videoCount_").fadeOut(5000);
          }
    <?php } ?>


    $(document).ready(function(){
        $('#back_url').click(function(){
            window.history.go(-1);

        })
    })
    
</script>
<script>
// $("#compose_message").click(function(){

$(document).ready(function(){
    $.ajax({
        url: '<?php echo site_url('CommonAccess/countMessage'); ?>',
        type: 'POST',
        success: function (response) {
            if(response == 1){
                $("#myDropdown").toggle();
            }
        }
    });
});
</script>
