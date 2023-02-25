<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title">Video Lesson</h4>-->
            </div>
            <div class="modal-body">
                <iframe width="420" height="315" id="youtube_frame" src="">
                </iframe>
            </div>
            <div class="modal-footer">
                <!-- <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
            </div>
        </div>

    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="video_modal" role="dialog">
    <div class="modal-dialog">

        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="stopVideo()">&times;</button>
            </div>
            <div class="modal-body">

                <video id="my-video" class="video-js" controls preload="auto" width="570" height="300"
                data-setup="{}">
                <source src="" type='video/mp4'>

                </video>
            </div>
            <div class="modal-footer">
               <!--  <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
            </div>
        </div>

    </div>
</div>

<!-- 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="assets/js/jquery.youtubevideo.js"></script>
<script src="assets/js/demo.js"></script>

<!--  Video JS  -->
<!-- <script src="https://vjs.zencdn.net/7.3.0/video.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>

<script>
    // function openVideo() {
    //     var type = <?php echo $moduleVidType;  ?>
    //     var link = <?php echo $moduleVid;  ?>
    //     if(type=='youtube'){
    //         open_youtube_video(link);
    //         console.log('youtube');
    //     } else if(type=='general') {
    //         open_video(link);
    //         console.log('general');
    //     }
    // }

jQuery(document).ready(function() {
    
     $(document).on('click', "#openVideo", function(){
           var type = "<?php echo $moduleVidType;  ?>";
            var link = "<?php echo $moduleVid;  ?>";
            console.log(link);
            if(type=='youtube'){
                open_youtube_video(link);
                console.log('youtube');
            } else if(type=='general') {
                open_video_two(link);
                console.log('general');
            }      
     })
});

    //youtube video
    function open_youtube_video(video_link){
        $('#myModal').modal('show');
        $("#youtube_frame").attr("src", "https:"+video_link+"?rel=0&autoplay=0&loop=1&playlist="+video_link);
    }
    //general video
    // var myPlayer = videojs('my-video');
    // function open_video(video_link) {
        // $('#video_modal').modal('show');
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

<script> 
	$('#myModal').on('hidden.bs.modal', function (e) {
		var iframe = document.getElementById("youtube_frame");
		if ( iframe ) {
			var iframeSrc = iframe.src;
			iframe.src = iframeSrc;
		}
})
</script>


<div class="modal fade" id="myModal_two" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close_btn">&times;</button>
                <!--<h4 class="modal-title">Video Lesson</h4>-->
            </div>
            <div class="modal-body">
                  <video id="videoPause" controls preload="auto" width="570" height="300">
                    <source src="<?php echo $moduleVid;  ?>" type="video/mp4" >
                  </video>

                
            </div>
            <div class="modal-footer">
                <!-- <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a> -->
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    function open_video_two(argument) {
        $('#myModal_two').modal('show');
    }
</script>


<script> 
    $('#myModal_two').on('hidden.bs.modal', function (e) {
        
        var vid = document.getElementById("videoPause"); 
        function pauseVid() { 
           vid.pause(); 
         }

})
</script>
