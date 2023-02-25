
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- jquery ui -->
<!-- dependency: React.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-with-addons.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>

<script src="<?php echo base_url(); ?>assets/js/html2canvas/html2canvas.js"></script>
<script src="<?php echo base_url(); ?>assets/js/literallycanvas/js/literallycanvas.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/literallycanvas/css/literallycanvas.css">
<!-- html2canvas -->
<!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>-->
<script src="assets/js/html2canvas/html2canvas.js"></script>





<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Workout Draw</h4>
      </div>

      <!-- <div class="row"> -->

      <div class="modal-body">

       <!-- <div id="wPaint" class="my-drawing" style="position:relative;width:800px; height:600px; background:#fff; border:solid black 1px;"></div> -->
       <div class="row">
        <div class="col-md-12">
          <div id="wPaint" class="my-drawing">
          </div>
        </div>
        
      </div>
      <!-- </div> -->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="getQues" class="btn btn-primary">Get Question</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="setAnswer()">Set Answer</button>
      </div>

    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  var lc;
  function showDrawBoard(){
    lc = LC.init(
      document.getElementsByClassName('my-drawing')[0],
      {
        imageURLPrefix: "<?php echo base_url(); ?>assets/js/literallycanvas/img",
        //imageSize: {width: 600, height: 400},
      });
  }


  function setAnswer(){
    var imageData = (lc.getImage().toDataURL('image/png'));

    $.ajax({
      type: 'POST',
      url: 'module/get_draw_image',
      data: {
        imageData: imageData,
      },
      dataType: 'html',
      success: function (results) {
        $("#draggable").show();
        //CKEDITOR.instances.workout.insertHtml('<img src="'+results+'">');
        $("#setWorkoutHere").html('<img src="'+results+'">');
      }
    });
  }
  //get question(modal button) activity
  $(document).on('click', '#getQues', function(){
    html2canvas(document.querySelector("#quesBody")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      lc.saveShape(LC.createShape('Image', {x: 100, y: 100, image: img}));
      //console.log(canvas.toDataURL('image/png'));
    });
  })


</script>

