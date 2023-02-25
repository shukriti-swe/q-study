<!-- remove the close button as its not showing on jquery UI dialog -->
<style>
.no-close .ui-dialog-titlebar-close {
  display: none;
}
</style>

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

<!-- jquery ui dialog -->
<div id="dialog" title="Basic dialog" class="my-drawing"></div>
<div id="wiris_dialog"></div>



<!--  -->
<!-- till now only designed for workout quiz -->
<!--  -->
<script type="text/javascript">
  var lc;
  var bgImage = $('#workoutImage').children('p').children('img').attr('src');
  var answerId = $('#answerId').val();
  var questionId = $('#questionId').val();
  
  function test(){
    console.log(bgImage);
      //dialog open
      var userType = parseInt($('#userType').val());
      var btn = [];
      if(userType==6){ //while student see report
        btn = [ {
          text:"Close",
          icon: "ui-icon-heart",
          click: function() {
            //lc.teardown();
            $( this ).dialog( "close" );
          }
        }];
      
      } else {
        var btn = [
        {
          text:"Close",
          icon: "ui-icon-heart",
          click: function() {
            //lc.teardown();
            $( this ).dialog( "close" );
          }
        },
        /*{
          text:"Student Answer",
          
          click: function() {
            getQues();
          }
        },*/
        {
          text:"Save",
          click: function() {
            setAnswer();
            $( this ).dialog( "close" );
          }
        },
        ]
      }

      $( "#dialog" ).dialog({
        title: "Drawing Board",
        dialogClass: "no-close",
        height: 600,
        width: 800,
        buttons: btn,
      });


      var backgroundImage = new Image()
      backgroundImage.src = bgImage; 
       lc = LC.init(//canvas init
        document.getElementsByClassName('my-drawing')[0],
        {
         imageURLPrefix: "<?php echo base_url(); ?>assets/js/literallycanvas/img",
         tools: LC.defaultTools.concat([MyTool]),
         backgroundShapes: [
         LC.createShape(
          'Image', {x: 20, y: 20, image: backgroundImage, scale: 2}),
         ]
       });
     }
     //lc.setZoom(3);

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

            buttons: [
            {
              text:"Close",
              icon: "ui-icon-heart",
              click: function() {
                $( this ).dialog( "close" );
              }
            },
            {
              text:"Ok",
              click: function() {

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

function student_progress_workout_quiz_drawing(type='', img_name=''){

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
                }<?php if ($_SESSION['userType'] !=6 && $module_info[0]['user_type'] == $_SESSION['userType']){?>
				,{
                    text:"Save",

                    click: function() {

                        save(type,img_name);
                        $( this ).dialog( "close" );

                    }
                },
				<?php }?>
            ]
        });




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
                    alert('didBecomeActive');
                    editor = com.wiris.jsEditor.JsEditor.newInstance({'language': 'en'});
                    editor.insertInto(document.getElementById('wiris_dialog'));
                    $('.wrs_container').attr('id', 'id_added');
                    $('#wiris_dialog').dialog({
                        height: 350,
                        width: 550,
                        hide: { effect: "slideUp", duration: 1000 },

                        buttons: [
                            {
                                text:"Close",
                                icon: "ui-icon-heart",
                                click: function() {

                                    $( this ).dialog( "close" );
                                }
                            },
                            {
                                text:"Ok",
                                click: function() {

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



        lc = LC.init(//canvas init
            document.getElementsByClassName('my-drawing')[0],
            {
                imageURLPrefix: "<?php echo base_url(); ?>assets/js/literallycanvas/img",
                tools: LC.defaultTools.concat([MyTool]),
            });

        var newImage = new Image();
        newImage.src = img_name;

        lc.saveShape(LC.createShape('Image', {x: 0, y: 0, image: newImage}));

    }

function save() {

        try {
            var imageData = (lc.getImage().toDataURL('image/png'));
        }
        catch(err) {
            lc.tool.commit(lc);
            var imageData = (lc.getImage().toDataURL('image/png'));
        }


        // $("#draggable").show();
        //CKEDITOR.instances.answer.insertHtml('<img src="'+imageData+'">');

        $.ajax({
            type: 'POST',
            url: 'module/get_draw_image',
            data: {
                imageData: imageData,
            },
            dataType: 'html',
            success: function (results) {
                // alert(results);
                // $("#draggable").show();
                var imageLink = '<img src="'+results+'">';
                var ans_id = $('#answerId').val();
                var workout_question_order_id = $('#workout_question_order_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'Student_Copy/st_progress_image_update_answer_workout_quiz',
                    data: {ans_id:ans_id,workout_question_order_id:workout_question_order_id,imageLink:imageLink},
                    dataType: 'html',
                    success: function (results) {

                        var obj = JSON.parse(results);
                        alert(obj.msg);
                    }
                });



                // CKEDITOR.instances.answer.insertHtml('<img src="'+results+'">');



            }
        });
    }

    function setAnswer(){
      var imageData = (lc.getImage().toDataURL('image/png'));

      $.ajax({
        type: 'POST',
        url: 'module/saveScrutiniseReport',
        data: {
          imageData: imageData,
          'answerId': answerId,
          'questionId': questionId,
        },
        dataType: 'html',
        success: function (results) {
          $("#draggable").show();
          CKEDITOR.instances.workout.insertHtml('<img src="'+results+'">');
          swal('Your feedback recorded successfully.');
        }
      });
    }
  //get question(modal button) activity
  $(document).on('click', '#getQues', function(){
    html2canvas(document.querySelector("#quesBody")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      lc.saveShape(LC.createShape('Image', {x: 100, y: 100, image: img}));

    });
  });

  function getQues() {
    html2canvas(document.querySelector("#quesBody")).then(canvas => {
      var img = new Image();
      //img.src = canvas.toDataURL();
      //img.src = 'https://freedogsblog.files.wordpress.com/2014/02/so-cute-puppies-hd-wallpaper.jpg';
      img.src = bgImage;
      console.log(bgImage);
      lc.saveShape(LC.createShape('Image', {x: 10, y: 20, image: img}));

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

