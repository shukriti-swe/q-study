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
  
  <?php if ($this->session->flashdata('success_msg')) :?>
    <div class="col-md-8" id="flashmsg">
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success_msg'); ?>
      </div>
    </div>
    <?php endif; ?>
  <div class="col-md-8 user_list">
    <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title text-center">
            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
              <strong><span style="font-size : 18px; "> <?php echo $title; ?>  </span></strong>
            </a>
          </h4>
        </div>
        <div class="row panel-body">

            <?php if ($item_type=='video') : ?>
            <div class="videoItem" style="">

            </div>
            <?php else : ?>
              <div class="col-sm-12"><?php echo $body; ?></div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>

    </div>
  </div>
  <input type="hidden" id="itemType" value="<?php echo $item_type; ?>">
  <input type="hidden" id="itemBody" value="<?php echo strip_tags($body); ?>">
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
        var vjsInstance = `<video id='my-video' class='video-js' controls preload='auto' width='795' height='315'
        poster='MY_VIDEO_POSTER.jpg' data-setup='{}'>
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
  </script>