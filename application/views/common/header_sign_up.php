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

<style type="text/css">
	.pointer {cursor: pointer;}
</style>

<section class="main_content ss_sign_up_content bg-gray animatedParent">
<div class="container-fluid container-fluid_padding">
	<div class="row"> 
		 <div class="sign_up_header">
		 	<div class="col-sm-4"></div>
		 	<div class="col-sm-4 text-center">
		 		<a href="#" class="logo_image"><img src="<?php echo base_url();?>assets/images/logo_signup.png"></a>
		 	</div>
		 	<div class="col-sm-4">
		 		<div class="top_signup">
		 			<ul>
		 				<li>
							<a href="<?php if(isset($back_url)){echo $back_url;}?>">Back</a>
						</li>
		 				<li><a class="pointer" onclick="open_videoHelp()" ><img src="<?php echo base_url();?>assets/images/icon_video.png"/> Video Help </a><span>  <?php if (isset($video_help_serial) && !empty($video_help_serial)  ) { echo  $video_help_serial;  } ?></span></li>
		 			</ul>

		 			<div id="show_videoCount_"></div>
		 		</div>
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
			function open_videoHelp(){
		          $('#open_videoHelp').modal('show');
		      }

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
	<?php }else{ ?>

		<script type="text/javascript">
			function open_videoHelp(){
	              $('#show_videoCount_').html(' <div id="show_videoCount">No Video Has been Given</div> ');
	              $("#show_videoCount_").fadeOut(5000);
	          }
		</script>

	<?php } ?>