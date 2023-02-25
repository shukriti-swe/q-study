
<!DOCTYPE html>
<html lang="en">
    <head>
		<base href="<?php echo base_url();?>" />
        <?php echo $headerlink;?>
		
    </head>
    <body>
        <div class="wrapper">
            <!--===================== Header ========================-->

            <section class="main_content ss_sign_up_content bg-gray animatedParent">
                <div class="container-fluid container-fluid_padding">
                    <div class="row"> 
                        
                        <?php echo $header;?>

                    </div> 
                    <div class="">
                        <div class="row">
                            
                            <?php echo $maincontent;?>
							<div class="modal fade tutorialModalMaster" id="tutorialModalMaster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="width:70%">
                                    <div class="modal-content" style="height: 94vh;">
                                        <div class="modal-header" style="padding: 5px;border-bottom: none;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding:0px 30px;">
                                            <div id="img_show" >

                                            </div>
                                        </div>
                                        <div class="modal-footer" style="padding: 15px;border-top:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							 <div class="modal fade question_tutorial_master_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="width:70%">
                                    <div class="modal-content" style="height: 96vh;">
                                        <div class="modal-header" style="padding: 5px;border-bottom: none;">
                                            <button type="button" class="close preview_close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding:0px 30px;">
                                            <div id="img_show" >
                                                <div id="myCarousel" class="carousel" data-ride="carousel" style="border: none;">
                                                    <!-- Indicators -->
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">

                                                    </div>

                                                    <!-- Left and right controls -->
                                                    <div style="text-align: center;">
<!--                            <button class="sound_play" style="position: relative;bottom: -25px;left: 28%;background: transparent;border: none;color: #2198c5;"></button>-->
                            <a class=""  style="width:90px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                <span class=" icon-change sound_play" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;"><img src="<?php base_url('/')?>assets/images/icon_sound.png"></span>
                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="left carousel-control prev-btn-c" href="#myCarousel" data-slide="prev" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;">Previous</span>
                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control next-btn-c" href="#myCarousel" data-slide="next" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;margin-right: 52px;">
                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #6e6a6a;font-size: 17px;">Next</span>
                                <!--                            <span class="glyphicon glyphicon-chevron-right icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #2198c5;font-size: 17px;">Next</span>-->
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="padding: 15px;border-top:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <!--===================== End of Footer ========================-->
        </div>
        
        <!--wrapper-->
        
        <?php echo $footerlink;?>
        
        
    </body>
</html>