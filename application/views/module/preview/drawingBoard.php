<!-- remove the close button as its not showing on jquery UI dialog -->
<style>
  .no-close .ui-dialog-titlebar-close {
    display: none;
  }
</style>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
jquery ui
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
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

<!-- wiris demo editor-->
<!-- <script src="https://www.wiris.net/demo/editor/editor"></script> -->
<script src="assets/js/wiris_editor.js"></script>



<!-- Large modal -->
<!-- <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Workout Draw</h4>
      </div>

      <div class="row">

        <div class="modal-body">

         <div id="wPaint" class="my-drawing" style="position:relative;width:800px; height:600px; background:#fff; border:solid black 1px;"></div>
         <div class="row">
          <div class="col-md-12">
            <div id="wPaint" class="my-drawing">
            </div>
          </div>

        </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="getQues" class="btn btn-primary">Get Question</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="setAnswer()">Set Answer</button>
        </div>

      </div>
    </div>
  </div>
</div> -->
<!-- jquery ui dialog -->
<div id="dialog" title="Basic dialog" class="my-drawing"></div>
<div id="wiris_dialog"></div>

<script type="text/javascript">
  var lc;
  function showDrawBoard(){

    //dialog open
    $( "#dialog" ).dialog({
    title: "Drawing Board",
    dialogClass: "no-close",
    height: 670,
    width: 870,
    buttons: [
      {
        text:"Close",
        icon: "ui-icon-heart",
        click: function() {
          //lc.teardown();
          $( this ).dialog( "close" );
        }
      },
    //   {
    //     text:"Get Question",
    //     //id:"getQues",
    //     click: function() {
    //       getQues();
    //     }
    //   },
      {
        text:"Set Answer",
        click: function() {
          //lc.teardown();
          setAnswer();
          $( this ).dialog( "close" );
        }
      },
    ]
    });


    lc = LC.init(//canvas init
        document.getElementsByClassName('my-drawing')[0],
        {
         imageURLPrefix: "<?php echo base_url(); ?>assets/js/literallycanvas/img",
         tools: LC.defaultTools.concat([MyTool]),
       });


       var unsubscribe = lc.on('drawingChange', function() {
       });
//unsubscribe();  // stop listening
        getQues();
     }

  /*custom literallycanvas tool*/
  var MyTool = function(lc) {  // take lc as constructor arg
    var self = this;

    return {
    usesSimpleAPI: false,  // DO NOT FORGET THIS!!!
    name: 'Math',
    iconName: 'formula',
    strokeWidth: lc.opts.defaultStrokeWidth,
    optionsStyle: 'stroke-width',
    didBecomeActive: function(lc) {
      editor = com.wiris.jsEditor.JsEditor.newInstance({'language': 'en'});
      editor.insertInto(document.getElementById('wiris_dialog'));
      $('.wrs_container').attr('id', 'id_added');
      $('#wiris_dialog').dialog({
        height: 350,
        width: 550,
        hide: { effect: "slideUp", duration: 1000 }, 
        //position: { my: "top", at: "right", of: 'window' }, 
        buttons: [
        {
          text:"Close",
          icon: "ui-icon-heart",
          click: function() {
            //lc.teardown();
            $( this ).dialog( "close" );
          }
        },
        {
          text:"Ok",
          click: function() {
          //lc.teardown();
          console.log(editor.getMathML());
          getWirisEqn();
          $( this ).dialog("option", "hide");
        }
      },
      ]
    });


    },
    willBecomeInactive: function(lc) {
      console.log('inactive');
    },
  }//end return
}//end function


  function setAnswer(){
    try {
        var imageData = (lc.getImage().toDataURL('image/png'));
      }
      catch(err) {
        lc.tool.commit(lc);
        var imageData = (lc.getImage().toDataURL('image/png'));
      }

    $.ajax({
    type: 'POST',
    url: 'module/get_draw_image',
    data: {
      imageData: imageData,
    },
    dataType: 'html',
      success: function (results) {
        $("#draggable").show();
        CKEDITOR.instances.workout.insertHtml('<img src="'+results+'">');
        // $("#setWorkoutHere").html('<img src="'+results+'">');
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
  });

   function getQues() { 
   var aa= $('#quesBody').width(); 
   if( aa< 750){
    center = Math.ceil((750 - aa) /2); 
   } 
    html2canvas(document.querySelector("#quesBody"),{scale:1}).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL(); 
      lc.saveShape(LC.createShape('Image', {x: center, y: 30,  image: img}));
      //console.log(canvas.toDataURL('image/png'));
    });
  }
  function getWirisEqn() {
    html2canvas(document.querySelector("#id_added")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      console.log(img);
      lc.saveShape(LC.createShape('Image', {x: 100, y: 100, image: img}));
    });
  }
</script>

