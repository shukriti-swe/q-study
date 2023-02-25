
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- jquery ui -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <!-- wPaint js-->  
  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/jquery.1.10.2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/jquery.ui.core.1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/jquery.ui.widget.1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/jquery.ui.mouse.1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/jquery.ui.draggable.1.10.3.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/wPaint/lib/wColorPicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/wPaint.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/plugins/main/wPaint.menu.main.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wPaint/plugins/shapes/wPaint.menu.main.shapes.min.js"></script>
  
  <!-- html2canvas -->
  <!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>-->
  <script src="assets/js/html2canvas/html2canvas.js"></script>

  <!-- wPaint css-->
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wPaint/wPaint.min.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wPaint/lib/wColorPicker.min.css">



  <!-- Large modal -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" >

        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Workout Draw</h4>
        </div>

        <!-- <div class="row"> -->

        <div class="modal-body">

          <div id="wPaint" style="position:relative;width:800px; height:600px; background:#fff; border:solid black 1px;">
        <!--<div id="setQues" style="margin:0 auto; width:50%; background-color: '#fff'; text-align: center;">
      </div>-->
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


<script type="text/javascript">
  function setAnswer(){
    var imageData = $("#wPaint").wPaint("image");

    $.ajax({
      type: 'POST',
      url: 'module/get_draw_image',
      data: {
        imageData: imageData,
      },
      dataType: 'html',
      success: function (results) {
        //console.log(results);
        $("#draggable").show();
        //CKEDITOR.instances.workout.insertHtml('<img src="'+results+'">');
        $("#setWorkoutHere").html('<img src="'+results+'">');
      }
    });
  }
  //get question(modal button) activity
  $(document).on('click', '#getQues', function(){
    html2canvas(document.querySelector("#quesBody")).then(canvas => {
    //document.body.appendChild(canvas)
    // $('#setQues').html(canvas);
    $('#wPaint').wPaint('image', canvas.toDataURL("image/png"));
    console.log(canvas.toDataURL("image/png"));
  });
  })

  //wPaint custom setup for drawingboard
  $.extend($.fn.wPaint.defaults, {
        mode:        'pencil',  // set mode
        lineWidth:   '4',       // starting line width
        fillStyle:   '#CACACA', // starting fill style
        strokeStyle: '#000',  // start stroke style
      });
  //drawingboard init load
  function showDrawBoard(){
    $("#wPaint").wPaint({
      path: '<?php echo base_url(); ?>assets/js/wPaint/',
    });
  }
</script>

