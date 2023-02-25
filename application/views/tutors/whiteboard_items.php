  <!--  Groupboard --> 
 <?php
  if (isset($ck_schl_corporate_exist) && !empty($ck_schl_corporate_exist)) {
    $whiteboard_id = $ck_schl_corporate_exist[0]['whiteboar_id'];
 }else{
    $whiteboard_id = $user_info[0]['whiteboar_id'];
    $subType = $user_info[0]['subscription_type'];
 }
//  echo $whiteboard_id;die();
if($user_info[0]['user_type'] == 4 || $user_info[0]['user_type'] == 5 ){
    $school_corporate = 1;
}

?>

<div class="row">
    <div class="">

        <p class="alert alert-success" id="whiteboard_denied" style="margin: 0 31%;display: none;"  >
            <b> Sorry! your tutor can only use whiteboard </b>
        </p>
        <p class="alert alert-success" id="trial_whiteboard_denied" style="margin: 0 31%;display: none;"  >
            <b> Sorry! you did not purchase whiteboard </b>
        </p>
        <p class="alert alert-success" id="whiteboard_active" style="margin: 0 31%;display: none;"  >
            <b> Your whiteboard will active within one day. </b>
        </p>
        <br>
        <ul class="personal_ul">
            <?php if($school_tutor == 1) { ?>
                <li class="presonal2"><a href="WhiteBoardTutor" style="cursor: pointer;">Whiteboard</a></li>
            <?php }else if(isset($school_corporate)) { ?>
                <li class="presonal2"><a  onclick="permit_school_corporate()" id="school_corporate" style="cursor: pointer;">Whiteboard</a></li>
            <?php }else{ ?>
                <li class="presonal2"><a onclick="permit_whiteboard('<?= $whiteboard_id ?>','<?= $subType ?>','<?= $whiteboard ?>')" style="cursor: pointer;">Whiteboard</a></li>
            <?php } ?>
            <li class="presonal2"><a href="tutor-question-store">Resources</a></li>
        </ul>
    </div>
</div>
<!--  Groupboard --> 
<script type="text/javascript">
    function permit_whiteboard(argument,type,whiteboard) {
        if (argument  == 0 && type == 'trial' && whiteboard == 1) {
            $("#whiteboard_active").show();
            $("#whiteboard_active").fadeOut( 6000 );

        }else if (argument  == 0 && type == 'signup' && whiteboard == 1) {
            $("#whiteboard_active").show();
            $("#whiteboard_active").fadeOut( 6000 );

        }else if (argument  == 0 && type == '' && whiteboard == 0) {
            base_url = '<?= base_url('/WhiteBoardTutor') ?>';
            window.location.href = base_url;

        }else if (argument  == 0 && type == 'trial'  && whiteboard == 0) {
            $("#trial_whiteboard_denied").show();
            $("#trial_whiteboard_denied").fadeOut( 6000 );

        }else if (argument  == 0 && type == 'signup'  && whiteboard == 0) {
            $("#trial_whiteboard_denied").show();
            $("#trial_whiteboard_denied").fadeOut( 6000 );

        }else{
            base_url = '<?= base_url('/WhiteBoardTutor') ?>';
            window.location.href = base_url;
        }
    }
    
    function permit_school_corporate(){
        $("#whiteboard_denied").show();
        $("#whiteboard_denied").fadeOut( 6000 );
    }
</script>