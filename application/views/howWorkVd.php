<div class="row">
                            
                            <style>
  .panel-default > .panel-heading {
    background-color: #D63832 !important;
    color: #fff !important;
  }
  .video-js{
        margin: auto !important;
    }
</style>

<div class="row" style="margin-top:50px;">
  <div class="col-md-2"> </div>
  
    <div class="col-md-8 user_list">
    <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title text-center">
            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
              <strong><span style="font-size : 18px; "> Video Tour  </span></strong>
            </a>
          </h4>
        </div>
        <div class="row panel-body">

                        <div class="videoItem" style=""><video  class="video-js" controls  width="795" height="315" poster="MY_VIDEO_POSTER.jpg" autoplay>
        <source src=" 


https://q-study.com/assets/uploads/OPT_UP2.mp4

" type="video/mp4">
        </video></div>
                        
          </div>
        </div>
      </div>

    </div>
  </div>
  <input type="hidden" id="itemType" value="video">
  <input type="hidden" id="itemBody" value=" 


https://q-study.com/assets/uploads/OPT_UP2.mp4

">
  <script>
    var itemType = $('#itemType').val();
    var body = $('#itemBody').val();

    if(itemType=='video'){
      var linkStatus  = getId(body);
      console.log('status:'+linkStatus);
      if(linkStatus!='error'){
        var videoId = getId(body);
        var iframeMarkup = '<iframe width="560" height="315" src="//www.youtube.com/embed/' 
        + videoId + '" frameborder="0" allowfullscreen></iframe>';
        $('.videoItem').html(iframeMarkup);
        console.log(videoId);
        console.log(iframeMarkup);
      } else {
        var vjsInstance = `<video  class='video-js' controls autoplay width='795' height='315'
        poster='MY_VIDEO_POSTER.jpg' >
        <source src='`+body+`' type='video/mp4'>
        </video>`;
        $('.videoItem').html(vjsInstance);
      }
    }



    function getId(url) {
      var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
      var match = url.match(regExp);
      //console.log('match:'+match);
      //console.log('len:'+match[2].length);
      if (match /*&& match[2].length == 11*/) {
        return match[2];
      } else {
        return 'error';
      }
    }


    function detectYtLink() {
      return true;
    }
  </script>             <div class="modal fade tutorialModalMaster" id="tutorialModalMaster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog ui-draggable" role="document" style="width:70%">
                                    <div class="modal-content" style="height: 94vh;">
                                        <div class="modal-header ui-draggable-handle" style="padding: 5px;border-bottom: none;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding:0px 30px;">
                                            <div id="img_show">

                                            </div>
                                        </div>
                                        <div class="modal-footer" style="padding: 15px;border-top:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
              
               <div class="modal fade question_tutorial_master_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog ui-draggable" role="document" style="width:70%">
                                    <div class="modal-content" style="height: 96vh;">
                                        <div class="modal-header ui-draggable-handle" style="padding: 5px;border-bottom: none;">
                                            <button type="button" class="close preview_close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding:0px 30px;">
                                            <div id="img_show">
                                                <div id="myCarousel" class="carousel" data-ride="carousel" style="border: none;">
                                                    <!-- Indicators -->
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">

                                                    </div>

                                                    <!-- Left and right controls -->
                                                    <div style="text-align: center;">
<!--                            <button class="sound_play" style="position: relative;bottom: -25px;left: 28%;background: transparent;border: none;color: #2198c5;"></button>-->
                            <a class="" style="width:90px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                <span class=" icon-change sound_play" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;"><img src="assets/images/icon_sound.png"></span>
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