<?php 

    // print_r($module_info[0]["instruction"]);
    $question_instruct = json_decode($question_info_s[0]['question_instruction']);
    $extension = array();

    if($question_instruct){
        $extension = pathinfo(trim($module_info[0]["instruction"]));
    }
    $extension2 = strip_tags($module_info[0]["instruction"]);
    
    $extension = pathinfo(trim($extension2));

    // if ($extension["filename"] == "") {
    //   $extension = pathinfo(trim('image.jpg'));

    // }

    if ($extension["filename"] == "") {
      $instruction_value = 0;

    }else{
      $instruction_value = 1;
    }
	
    $strpos = strpos($extension2 , "https://q-study.com/assets/uploads/" );
    if ($strpos !== false ) {
      $with_full_url = 1;
    }else{
      $with_full_url = 0;
    }

?>

<?php 

if (isset($qstudy_module_videos[0]['files'])) {
  $files = json_decode($qstudy_module_videos[0]['files'] , true);

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
<?php  if (count($qstudy_module_videos)) { ?>
   <!-- Video Modal -->
  <div class="modal fade" id="qstudy_module_videos" role="dialog">
      <div class="modal-dialog" style="width: 86%; margin-top: 180px;">
          <div class="modal-content" style="width: 288px;">
              <div class="modal-header">
                <p>Video Instruction</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
     
              </div>
              <div class="modal-body">

                <ul class="video_help">
                  <?php  foreach ($title as $key => $value) { ?>
                    <li onclick="videoShow('<?= $videos[$key]['Audio'] ?>')"  > <?= $value["title"]; ?></li>
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

<?php } ?>  



<?php  if ($with_full_url) { ?>

<!-- Modal -->
<div class="modal fade" id="myModal_two" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close_btn">&times;</button>
                <!--<h4 class="modal-title">Video Lesson</h4>-->
            </div>
            <div class="modal-body">
                <?php $video_file = $module_info[0]["video_link"];

                $vowels = array(']', '[', '\n', '"');
                $onlyconsonants = str_replace($vowels, "", $module_info[0]["video_link"]);

                 $extension22 = pathinfo(trim($onlyconsonants));

                 if (!empty($extension22)) { ?>
                   <video id="videoPause" controls preload="auto" width="570" height="300">
                  <source src="<?php  echo $onlyconsonants; ?>" type="video/mp4" >

                  </video>
                <?php }else{ ?>
                  <iframe width="420" height="315" id="youtube_frame" src="">
                  </iframe>
               <?php  }
                  ?>

                
            </div>
            <div class="modal-footer">
                <!-- <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
            </div>
        </div>

    </div>
</div>



<!-- Video Modal -->
  <div class="modal fade" id="instruction_modal" role="dialog">
      <div class="modal-dialog">

          
          <div class="modal-content">
              <div class="modal-header">
                <p>Video</p>
                  <button type="button" class="close" data-dismiss="modal" id="instruction_close">&times;</button>
              </div>
              <div class="modal-body">

                  <video controls preload="auto" id="instruction_pause" width="570" height="300">
                  <!--<source src="--><?php // echo base_url('assets/uploads/'. $extension2); ?><!--" type="video/mp4" >-->
				  <source src="<?php  echo $extension2 ; ?>" type="video/mp4" >

                  </video>
              </div>
              <div class="modal-footer">

                 <!--  <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
              </div>
          </div>

      </div>
  </div>

  <!-- Video Modal -->
  <div class="modal fade" id="img_modal" role="dialog">
      <div class="modal-dialog">

          
          <div class="modal-content">
              <div class="modal-header">
                <p>Instruction</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
              
              </div>
              <div class="modal-body">

                <?php echo trim($module_info[0]["instruction"]);  ?>

              </div>
              <div class="modal-footer">

                 <!--  <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
              </div>
          </div>

      </div>
  </div>

  <!-- Video Modal -->
  <div class="modal fade" id="pdf_modal" role="dialog">
      <div class="modal-dialog" >

          
          <div class="modal-content">
              <div class="modal-header">
                <p>Instruction</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
               
              </div>
              <div class="modal-body">

                <a href="<?php  echo $extension2; ?>" width="570" height="300" target="_blank"><?php  echo $extension2; ?></a>


              </div>
              <div class="modal-footer">

                 <!--  <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
              </div>
          </div>

      </div>
  </div>

   <!-- Video Modal -->
  <div class="modal fade" id="doc_modal" role="dialog">
      <div class="modal-dialog">

          
          <div class="modal-content">
              <div class="modal-header">
                <p>Doc</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
     
              </div>
              <div class="modal-body">

                <a href="<?php  echo $extension2; ?>" width="570" height="300" target="_blank"><?php  echo $extension2; ?></a>


              </div>
              <div class="modal-footer">

                 <!--  <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
              </div>
          </div>

      </div>
  </div>

    <?php } ?>  

<script>
    // function openVideo() {
    //     var type = <?php // echo $moduleVidType;  ?>
    //     var link = <?php // echo $moduleVid;  ?>
    //     if(type=='youtube'){
    //         open_youtube_video(link);
    //         console.log('youtube');
    //     } else if(type=='general') {
    //         open_video(link);
    //         console.log('general');
    //     }
    // }


<?php  if ($question_info_s[0]['question_name_type'] == 1) { ?>

  function abc(){

      var type = "";
      var link = '';
      <?php if($extension) {?>
          type = "<?php echo $extension['extension'];  ?>";
          // link = "<?php echo trim($module_info[0]["instruction"]);  ?>";
          // console.log(link)
      <?php }?>
      if(type == 'mp4' || type == 'm4v' || type =='webm' || type == 'oog' || type == 'WMV' || type =='MOV' || type == 'FLV' || type =="MP4" || type =='M4V' || type == 'WEBM' || type == 'OOG' || type =='mov' || type == 'flv' ){
          open_video();
      } 
     else if(type == 'JPEG' || type == 'jpeg' || type =='GIF' || type == 'gif' || type == 'PNG' || type =='png' || type == 'jpg' || type =="JPG") {
      open_image();
     }
     else if(type == 'PDF' || type == 'pdf' ) {
      open_pdf();
     }else if(type == 'doc' || type == 'DOC' || type =='docx' || type =='DOCX' ) {
      open_doc();
     }
      // else {
      //     open_youtube_video(link);
      // }  
  }

<?php  } ?>
// jQuery(document).ready(function() {
    
//      $(document).on('click', "#openVideo", function(){
               
//      })
// });

    //youtube video
    function open_youtube_video(video_link){
        $('#myModal').modal('show');
        $("#youtube_frame").attr("src", "https:"+video_link+"?rel=0&autoplay=0&loop=1&playlist="+video_link);
    }

    //doc
    function open_video_two(){
        $('#myModal_two').modal('show');
    }

    //doc
    function open_doc(){
        $('#doc_modal').modal('show');
    }

    //Pdf 
    function open_pdf(){
        $('#pdf_modal').modal('show');
    }

    //open Image
    function open_image(){
        $('#img_modal').modal('show');
    }

    //Image 
    // var myPlayer = videojs('my-video1');
    // function open_video(video_link) {
        // $('#instruction_modal').modal('show');
        // myPlayer.src(video_link);
        // myPlayer.ready(function() {
            
            // myPlayer.muted(false);
            // myPlayer.on('timeupdate', function (e) {

                // var whereYouAt = myPlayer.currentTime();
                // var minutes = Math.floor(whereYouAt / 60);   
                // var seconds = Math.floor(whereYouAt - minutes * 60)
                // var x = minutes < 10 ? "0" + minutes : minutes;
                // var y = seconds < 10 ? "0" + seconds : seconds;

                // var duration = myPlayer.duration();
                // var duration_minutes = Math.floor(duration / 60);   
                // var duration_seconds = Math.floor(duration - minutes * 60)
                // var duration_x = duration_minutes < 10 ? "0" + duration_minutes : duration_minutes;
                // var duration_y = duration_seconds < 10 ? "0" + duration_seconds : duration_seconds;

                // $("span.vjs-remaining-time-display").text(x + ":" + y + ' / ' + duration_x + ":" + duration_y);
            // });

            // myPlayer.on("pause", function () {
                // $('.vjs-big-play-button').css('display', 'block');
            // });
            // myPlayer.on("play", function () {
                // $('.vjs-big-play-button').css('display', 'none');
            // });
        // });
    // }

    // function stopVideo() {
        // myPlayer.pause();
    // }
</script>

<script type="text/javascript">
  $(".Instruction_click").click(function () {
    $('#instruction_modal').modal('show');
    });
</script>

<script type="text/javascript">

  <?php if (empty($module_info[0]['instruction']) ) { ?>
      function abc(){

        var d = new Date();
        var n = d.getTime();

       $(".Instruction_click").after("<br><br><div id='instruc_msg'></div>");
       $("#instruc_msg").html("<p id='instruc_msg"+n+"' style='color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 9px 0;' > No Instruction has been given. </p>");
       $("#instruc_msg"+n+"").fadeOut(4000);
    }
  <?php } ?>
  
</script>

<script> 
    $("#close_btn").click(function () {
       var vid = document.getElementById("videoPause");
		vid.pause();
    });
	$('#myModal_two').on('hidden.bs.modal', function (e) {
		var vid = document.getElementById("videoPause");
		vid.pause();
});
$("#instruction_close").click(function () {
       var vid = document.getElementById("instruction_pause");
		vid.pause();
    });
	$('#instruction_modal').on('hidden.bs.modal', function (e) {
		var vid = document.getElementById("instruction_pause");
		vid.pause();
});
</script>

<?php  if (count($qstudy_module_videos)) { ?>
  <script type="text/javascript">
    $(".qstudy_Instruction_click").click(function () {
      $('#qstudy_module_videos').modal('show');
      });

    function videoShow(videoLink){
        $("#show_video").html('<video id="myVideo" controls preload="auto" width="570" height="300"><source src="'+videoLink+'" type="video/mp4" >');
        $('#show_videoHelp').modal('show');
    }

    var vid = document.getElementById("myVideo"); 
    function pauseVid() { 
       vid.pause(); 
     }


  </script>
<?php }else{ ?>

<script type="text/javascript">
  $(".qstudy_Instruction_click").click(function () {
      var d = new Date();
      var n = d.getTime();

      $(".qstudy_Instruction_click").after("<br><div id='instruc_msg'></div>");
      $("#instruc_msg").html("<p id='instruc_msg"+n+"' style='color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 9px 0;' > No Instruction has been given. </p>");
      $("#instruc_msg"+n+"").fadeOut(4000);

  });

</script>
<?php } ?>