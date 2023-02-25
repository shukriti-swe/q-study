  <!--  Groupboard --> 
 <?php
  if (isset($ck_schl_corporate_exist)) {
     $whiteboard_id = $ck_schl_corporate_exist[0]['whiteboar_id'];
 }else{
    $whiteboard_id = $user_info[0]['whiteboar_id'];
 }

?>

<div class="row">
    <div class="">

        <p class="alert alert-success" id="whiteboard_denied" style="margin: 0 31%;display: none;"  > 
            <b> Sorry! You did not purchase whiteboard </b>
        </p>
		<p class="alert alert-success" id="school_corporate_message" style="margin: 0 31%;display: none;"  > 
            <b> Sorry! Your tutor only assign question & module </b>
        </p>

        <ul class="personal_ul">
			<?php if($user_info[0]['user_type'] == 4 || $user_info[0]['user_type'] == 5){ ?>
				<li class="presonal2 school_corporate_msg" id="question"  style="cursor:pointer;"><a>Question</a></li>
            	<li class="presonal2 school_corporate_msg" id="module_event" style="cursor:pointer;"><a>Module/Event</a></li>
        	<?php }else{ ?>
				<li class="presonal2"><a href="question-list/<?php echo isset($countryScope)?$countryScope:''; ?>">Question</a></li>
            	<li class="presonal2"><a href="details-module">Module/Event</a></li>
                <li class="presonal2"><a href="Tutor/studyType">Q-study</a></li>
        	<?php } ?>
			
            <?php if (isset($user_type) && $user_type == 7){
                // if($this->session->userdata('selCountry')!=1){
                //     ?>
                <!-- //     <li class="presonal2"><a href="assign-subject">Assign Subject</a></li> -->
                 <?php //} ?>
                <li class="presonal2"><a href="assign-subject">Assign Subject</a></li>
                <?php }else{?>

            <li class="presonal4">
                <!--  Groupboard --> 
                <!-- <a onclick="permit_whiteboard('<?= $whiteboard_id; ?>')" style="cursor: pointer;" > 
                    <h5 style="font-size:18px;color: #114963;">Whiteboard</h5>
                    <img src="<?= base_url('/assets/images/icon_w_board.png') ?>"  height="40">
                </a> -->
                <a onclick="permit_whiteboard(1)" style="cursor: pointer;" > 
                    <h5 style="font-size:18px;color: #114963;">Whiteboard</h5>
                    <img src="<?= base_url('/assets/images/icon_w_board.png') ?>"  height="40">
                </a>
            </li>

            <?php }?>

        </ul>

        <div>
            <img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive">
        </div>

    </div>
</div>

<!--  Groupboard --> 
<script type="text/javascript">
    function permit_whiteboard(argument) {
        if (argument  == 0 ) {
            $("#whiteboard_denied").show();
            $("#whiteboard_denied").fadeOut( 3000 );

        }else{
            base_url = '<?= base_url('/whiteboard-items') ?>';
            window.location.href = base_url;
        }
    }
	
	$(".school_corporate_msg").click(function(){
		 $("#school_corporate_message").show();
         $("#school_corporate_message").fadeOut( 10000 );
	})
</script>

