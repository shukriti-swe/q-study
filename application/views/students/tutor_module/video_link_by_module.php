<style>
    a {
        cursor:pointer;
    }
	
	.video-js .vjs-big-play-button {
		top: 43%;
		left: 43%;
	}
</style>
<div class="container">
    <div class="row">
        <!--<div class="col-sm-2"></div>-->
        <div class="col-sm-12">
            <div class="ss_qstudy_list">
                
                <div class="ss_qstudy_list_mid">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3 style="text-align: left;"><?php echo $tutor_info[0]['name'];?></h3>
                        </div>
                        <div class="col-sm-4">
                            <h3>Index</h3>
                        </div>
                        <div class="col-sm-4 ss_qstudy_list_mid_right">
                            <div class="profise_techer">
                                <?php if ($tutor_info[0]['image']): ?>
                                    <img src="<?php echo 'assets/uploads/' . $tutor_info[0]['image']; ?>">
                                <?php else: ?>
                                    <img src="assets/images/default_user.jpg">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="ss_qstudy_list_bottom">
                        <ul>
                            <?php if($tutor_info[0]['user_type'] == 3) {
                                foreach (json_decode($module_info[0]['video_link']) as $video_link) { ?>
                            <li>
                                <!--<div class="demo-adaptive" data-ytb-video="Ur7sXaC0t6E"></div>-->
						
                                <?php $video_link = explode("//", $video_link);
                                    
                                    foreach ($video_link as $link) { 
                                        $video_id = explode("/", $link);
                                        if($link){?>
                                            <a onclick="open_youtube_video('<?php if(isset($video_id[2])){echo trim($video_id[2]);}?>')">
                                                <?php echo $link.'<br>';?>
                                            </a>
                                <?php }}?>
                            </li>
                            <?php }}?>
                            
                            <?php if($tutor_info[0]['user_type'] == 7) {
    
                                foreach (json_decode($module_info[0]['video_link']) as $video_link) { ?>
                            <li>						
                                <?php 
                                    $check_youtube_video_link = explode("//", trim($video_link));
                                   // echo '<pre>';print_r($check_youtube_video_link);
                                     
                                    if($video_link && ($check_youtube_video_link[0] == 'http:' || $check_youtube_video_link[0] == 'https:')){?>
                                        <a onclick="open_video('<?php if(isset($video_link)){echo trim(strip_tags($video_link));}?>')">
                                            <?php echo $video_link.'<br>';?>
                                        </a>
                                <?php } else {
                                    $video_link = explode("//", $video_link);
                                    foreach ($video_link as $link) { 
                                    $video_id = explode("/", $link);
                                    if($link){?>
                                   <a onclick="open_youtube_video('<?php if(isset($video_id[2])){echo trim($video_id[2]);}?>')">
                                        <?php echo $link.'<br>';?>
                                    </a>   
                                <?php }?>
                                    <?php }}?>
                            </li>
                            <?php }}?>
                        </ul>
                        
                        <div class="text-center">
                            <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a>
                        </div>						
                    </div>
                    
                </div>
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
                                <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a>
                            </div>
                        </div>

                    </div>
                </div>
                
                <!-- Video Modal -->
                <div class="modal fade" id="video_modal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <!--<h4 class="modal-title">Video Lesson</h4>-->
                            </div>
                            <div class="modal-body">
<!--                                <video width = "500" height = "300" controls >
                                    <source src="" type="video/mp4" id="video_frame">
                                </video>-->
                                <video id="my-video" class="video-js" controls preload="auto" width="570" height="300"
                                       data-setup="{}">
                                    <source src="" type='video/mp4'>
                                    
                                </video>
                            </div>
                            <div class="modal-footer">
                                <a href="get_tutor_tutorial_module/<?php echo $module_info[0]['id']?>/1" class="btn btn_next">Skip</a>
                            </div>
                        </div>

                    </div>
                </div>
                 
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function () {

        // $('.demo-adaptive').youtubeVideo({
            // beforeInit: function(sets) {
                    ////console.log( sets.title );
            // }
        // });

    });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="assets/js/jquery.youtubevideo.js"></script>
<script src="assets/js/demo.js"></script>


<!--  Video JS  -->
<script src="https://vjs.zencdn.net/7.3.0/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>


<script type="text/javascript">

        var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-36251023-1']);
          _gaq.push(['_setDomainName', 'jqueryscript.net']);
          _gaq.push(['_trackPageview']);

        (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

</script>


<script>
    
    function open_youtube_video(video_link){
        $('#myModal').modal('show');
        $("#youtube_frame").attr("src", "https://www.youtube.com/embed/"+video_link+"?rel=0&autoplay=0&loop=1&playlist="+video_link);
    }
    
    function open_video(video_link) {
	
		
	
//        alert(video_link);
//        document.getElementById('video_frame').src = video_link;
        $('#video_modal').modal('show');
		
		
        var myPlayer = videojs('my-video');
		
        myPlayer.src(video_link);
		
        myPlayer.ready(function() {
          //// get, should be false
            console.log(video_link);
            console.log(myPlayer.muted());
            //// set to true
            myPlayer.muted(true);
			myPlayer.on('timeupdate', function (e) {
				
				var whereYouAt = myPlayer.currentTime();
				var minutes = Math.floor(whereYouAt / 60);   
				var seconds = Math.floor(whereYouAt - minutes * 60)
				var x = minutes < 10 ? "0" + minutes : minutes;
				var y = seconds < 10 ? "0" + seconds : seconds;

				var duration = myPlayer.duration();
				var duration_minutes = Math.floor(duration / 60);   
				var duration_seconds = Math.floor(duration - minutes * 60)
				var duration_x = duration_minutes < 10 ? "0" + duration_minutes : duration_minutes;
				var duration_y = duration_seconds < 10 ? "0" + duration_seconds : duration_seconds;
				
				$("span.vjs-remaining-time-display").text(x + ":" + y + ' / ' + duration_x + ":" + duration_y);
				
				
			});
			
			myPlayer.on("pause", function () {
				$('.vjs-big-play-button').css('display', 'block');
			});
			myPlayer.on("play", function () {
				$('.vjs-big-play-button').css('display', 'none');
			});
			
        });
		
		
//        $("source").attr("src", video_link);
    }
    
    /*set chapters according to subject*/
    $(document).on('change', '#subjects', function () {
        var subjectId = $(this).val();
        $.ajax({
            url: 'Student/renderedChapters/' + subjectId,
            method: 'POST',
            success: function (data) {
                $('#subject_chapter').html(data);
            }
        })
    });

    $(document).on('click', '#moduleSearchBtn', function (event) {
        event.preventDefault();
        var chapterId = $("#subject_chapter :selected").val();
        var subjectId = $("#subjects :selected").val();
        $.ajax({
            url: 'Student/studentsModuleByQStudy',
            method: 'POST',
            data: {chapterId: chapterId, subjectId: subjectId},
            success: function (data) {
                $('#moduleTable').html(data);
            }
        })
    });

</script>