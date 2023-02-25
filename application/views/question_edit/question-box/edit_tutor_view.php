<style>


div#myId {
    display: flex;
}

.dz-details{
  display: none;
}

.dz-image {
    border: 1px solid;
    width: 125px;
    margin: 0 9px;
}

.dz-error-mark{
  display: none;
}

input#box_qty_2 {
    padding: 0 252px;
}

.custom-file-input::-webkit-file-upload-button {
    visibility: hidden;
  }
  .custom-file-input::before {
    content: 'Upload Image Here';
    display: inline-block;
    background: linear-gradient(top, #f9f9f9, #e3e3e3);
    border: 1px solid #999;
    border-radius: 3px;
    padding: 5px 8px;
    outline: none;
    white-space: nowrap;
    -webkit-user-select: none;
    cursor: pointer;
    text-shadow: 1px 1px #fff;
    font-weight: 700;
    font-size: 10pt;
  }
  .custom-file-input:hover::before {
    border-color: black;
  }
  .custom-file-input:active::before {
    background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
  }


h1 {
  text-align: center;  
}



/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

.two {
    width: 179%;
}

button {
  background-color: #4CAF50;
  color: #1f1e1e;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background: none !important;
}

#nextBtn{
  background: none !important;
}

#prevBtn1 {
  background: none !important;
}

#nextBtn1{
  background: none !important;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

.step.active {
    opacity: 1;
    margin: 2%;
}

element.style {
    text-align: center;
    margin-top: 4%;
}
</style>

<style>

    .panel {
        margin-bottom: 11px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
        width: 85%;
        padding: 0px;
        margin-left: 27%;
    }

    .panel_2 {
          margin-bottom: 11px;
          background-color: #fff;
          border: 1px solid transparent;
          border-radius: 4px;
          -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
          box-shadow: 0 1px 1px rgba(0,0,0,.05);
          width: 85%;
          padding: 0px;
          margin-left: 27%;
          width: 85%;
      }

    .image_box_list {
    overflow: hidden;
    box-shadow: 0px 3px 5px #b9d6e8;
    background-color: #fbfeff;
    }

    input[type=text] {
        width: 50%;
        border: 1px solid #e1f2f7;
        /*padding: 7px 130px;
*/
    }


.ss_pagination{
  margin-right: 80px;
  background: #fff;
  margin-top: 1px;
  margin-bottom: 1px;
}
.ss_pagination button{   
background-color: transparent !important;
    padding: 10px 15px !important;
    line-height: 17px;
    margin: 4px 0px 5px 0px;
}
.ss_pagination button.activtab{
background: url(assets/images/ss_p_bg.jpg) repeat-x bottom !important;
border: 1px solid #979797 !important;
border-top: 2px solid #979797 !important;
border-radius: 5px;
  }
 .ss_pagination #prevBtn {
   color: #666 !important;
}
.ss_edit_img{
  overflow: hidden;
  max-height: 200px;
}
.ss_edit_img{
  max-width: 70%;
}


</style>
<input type="hidden" name="questionType" value="14">

<div class="error_show" style="color: red;width: 100%;text-align: center;"></div>

<div class="row">
  <div class="col-sm-8">
    <div class="col-md-4">
    
  </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="image_box_list ss_m_qu">

            <div class="progress" style="display: none;">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Loading...
                </div>
            </div>
            <?php foreach ($tutor_edit as $key => $value) {  ?>
              <div class="tab_1 tabdata_1<?php echo $key ?>">
                <div class="form-group">
                 <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>
                  <div class="col-sm-8">
                    <div class="ss_edit_img">
                       <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $value["img"]; ?>">
                    </div>
                   
                     <div style="margin:10px 0px 30px 0px;">
                    <p style="color:red;" id="img_id_<?php echo $key ?>"></p>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>
                  <div class="col-sm-8">
                    <?php if ($value["audio"] !="none" ) { ?>
                       <audio controls>
                        <source src ="<?php echo base_url() ?>assets/uploads/question_media/<?php echo $value["audio"]; ?>" type="audio/mpeg" >
                       </audio>
                    <?php } ?>
                    
                   <div style="margin:10px 0px 30px 0px;">
                    <p style="color:red;" id="aud_id_'.$i.'"></p>
                   </div>
                  
                  </div>
                </div><br><br>
                <div class="form-group">
                 <div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>
                <div class="col-sm-8">
                  <?php if ($value["speech"] !="none") { ?>
                    Speech <div class="col-xs-4" style="font-size: 18px; padding-right:0px">
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="<?php echo $value["speech"] ?>"></div>
                  <?php } ?>
                  
                      <div style="margin:20px 0px;">
                  <p style="color:red;" id="spch_id_<?php echo $key ?>"></p>
                </div>
                </div>
              </div><br><br>
            </div>
          <?php  } ?>


           <div class="row" style="background-color: #3595d6; margin-bottom:0; clear: both;" >
           
             <div class="col-sm-12" style="">
             <div style="float:right;">
                 <div class="ss_pagination">
                  <div>
                    <button class="steprs_1" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn1" onclick="nextPrev_1(-999)" >Previous</button>

                   <?php foreach ($tutor_edit as $key => $value) { ?>
                  <button style="background: none; border: none; padding: 10px;font-weight: 500;" class="steprs_1 number_11<?php echo $key; ?>" style="width:45px;" id="qty2" value="<?php echo count($tutor_edit); ?>" type="button" onclick="showFixSlide_1(<?php echo $key; ?> )"><?php echo $key+1; ?></button>
                   <?php } ?> 

                    <button type="button" style="color: #4c4a4a ;border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn1" onclick="nextPrev_1(99999)">Next</button>
                    </div>
                   </div>

                  </div>
               </div>
           </div>
         </div>

         <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
          <script>
          function speak() {
              var word = $("#wordToSpeak").val();
              responsiveVoice.speak(word);
            }
          </script>

           <script>
            var currentTab2 = 0;
            $('.number_11'+0).addClass("activtab");
             // Current tab is set to be the first tab (0)
            showTab1(currentTab2); // Display the current tab

            var qty2 = $("#qty2").val();

            for (i = 0; i < 4; i++) {
                      $('.number_11'+i).show();
                    }
            for (i = 4; i < qty2; i++) {
              $('.number_11'+i).hide();
            }

            function showTab1(n) {
                $('.tab_1').hide();
                $('.tabdata_1'+n).show();
            }

            function showFixSlide_1(n) {
                  $(".steprs_1").each(function( index ) {
                    $(this).removeClass("activtab");
                })

               
                    $('.number_11'+n).addClass("activtab");

                
                console.log(n);
                
                currentTab2 = n;
                showTab1(n);
                fixStepIndicator1(n);
            }


                function nextPrev_1(n){

                    //previous clicked
                    if(n <0 ){

                        currentTab2 = currentTab2 - 1;
                        fixStepIndicator1(currentTab2);
                        if(currentTab2<0) currentTab2 = 0;

                    }
                    //next clicked
                    else{

                       currentTab2 = currentTab2 + 1;
                       fixStepIndicator1(currentTab2);
                       if(currentTab2 >= qty2) currentTab2 = qty2 - 1;
                        }
                  

                    fixStepIndicator1();
                    showTab1(currentTab2);

                }


            function fixStepIndicator1(currentTab) {

               x = currentTab2;

                $('.number_11'+parseInt(currentTab2 - 1)).removeClass("activtab");
                $('.number_11'+parseInt(currentTab2 + 1)).removeClass("activtab");

                $('.number_11'+currentTab2).addClass("activtab");

               if(x>=3){

                   s_1 = x+2;
                   s_2 = x-2;
                   for (i = s_2; i < s_1 + 1; i++) {
                      $('.number_11'+i).show();
                    }
                   for (i = 0; i < s_2; i++) {
                      $('.number_11'+i).hide();
                    }
                    for (i = s_1+1; i < qty2; i++) {
                      $('.number_11'+i).hide();
                    }

               }
               if(x<3){

                for (i = 0; i < 4; i++) {
                      $('.number_11'+i).show();
                    }
                for (i = 4; i < qty2; i++) {
                  $('.number_11'+i).hide();
                }

               }

               if( x <= qty2 && x >= qty2-4){
                for (i = qty2-5; i < qty2; i++) {
                      $('.number_11'+i).show();
                    }

                for (i = 0; i < qty2-4; i++) {
                      $('.number_11'+i).hide();
                    }

               }
            }
            </script>
    </div>
  </div>

    <br style="clear: both;"><br> <br><br>

    <div class="uploadsMsg"></div>
    <div class="ErrorMsg"></div>

    <div class="col-sm-8 two">
      <div class="col-md-4">
        <div class="text-right">

          <button class="btn btn-success" type="button" onclick="all_file()" >Upload all files</button>
          <button class="btn btn-info" type="button" onclick="manually_upload()"  >Upload manually</button>
          <br><br>

          <div class="upload_allFile" style="display: none;">
            <div style="overflow-x: scroll;width: 700px;">
              <div id="myId" style="width: 150px ; height: 150px;" class='custom-file-input'>  </div>
            </div>
            <button type="button" class="btn" onclick="start_upload()" style="margin-right: -169px;padding: 5px;background: yellowgreen;">Prepare Question</button>
          </div>

            <div class="form-group ss_h_mi" style="display: none;" >
              <br><br>

              <label for="exampleInputiamges1" class="upload_manually" style="display: none;" >Add More</label>

              <div class="select">
                  <input class="form-control upload_manually" style="display: none;" type="number" value="1" id="box_qty" onchange="getImageBox2(this)">
              </div>
                
            </div>
        </div>
        
        <div class="" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel_2 panel-default">
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="image_box_list ss_m_qu" style="margin-left: 60px;">
                   <p id="tbl_show"></p>
                </div>
              </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="PicList" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Uploaded Temporary Picture</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="all_picList"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>


<input type="hidden" name="image_quantity" id="image_quantity" value="">


<script>

  // var x = 0;
  // var img_id = 0;

  // var myDropzone = new Dropzone("div#myId", { url: "story_Upload"});
  // myDropzone.on("complete", function(file) {
  //   x++;
  //   img_url = '<?= base_url('/assets/uploads/') ?>'+(file.xhr.response);
  //   $(".all_picList").append("<div class='col-sm-2' style='border: 1px solid #8c8c8c;cursor: pointer;' data-dismiss='modal' onclick='img_urlFunction("+JSON.stringify(img_url)+")' > <img src="+JSON.stringify(img_url)+" /> </div>")

  // });

var x = 0;
var img_id = 0;
var flag = 1;
var imgdata = [];
var imgBoxdata = [];

var myDropzone = new Dropzone("div#myId", { url: "story_Upload"});
myDropzone.on("complete", function(file) {

  filename = file.name;
  z = filename.replace(filename.split('.').pop(), "");

  x++;

  imgdata.push(parseInt(z));
  img_url = (file.xhr.response);
  imgBoxdata.push(img_url);

  $(".uploadsMsg").html("<div class='uploads"+x+"' style='padding: 10px;background: darkseagreen;'>Uploaded Successfully</div>");
  $(".uploads"+x+"").fadeOut(3000);

  // if (z == ""+x+"." && flag == 1) {

  //   $(".uploadsMsg").html("<div class='uploads"+x+"' style='padding: 10px;background: darkseagreen;'>Uploaded Successfully</div>");
  //   $(".uploads"+x+"").fadeOut(5000);

  //   img_url = '<?= base_url('/assets/uploads/') ?>'+(file.xhr.response);

  //   imgdata.push(img_url);

  //   $(".all_picList").append("<div class='col-sm-2' style='border: 1px solid #8c8c8c;cursor: pointer;' data-dismiss='modal' onclick='img_urlFunction("+JSON.stringify(img_url)+")' > <img src="+JSON.stringify(img_url)+" /> </div>")

  // }else{
  //   flag = 0;
  //   $(".ErrorMsg").html("<div class='uploads"+x+"' style='padding: 10px;background: #ff6565;color: #fdfdfd;'> Picture serial is not maintined properly. "+file.name+" </div>");
  //   $(".uploads"+x+"").fadeOut(5000);
  //   $(".all_picList").html("");
  //   $(".prepareQuestion").hide("");
  //   imgdata = [];
  // }

});


    function start_upload() {
      if (x) {
        flag = 1;
        imgdata.sort(function(a, b){return a-b});

        for (var i = 1; i <= imgdata.length; i++) {
          if (imgdata[i-1] != i) {
            var flag = 0;
          }
        }

        if (flag) {
          $(".ErrorMsg").html("");
          $(".upload_allFile").hide();
          getImageBoxTwo(x , imgBoxdata);
        }else{
          $(".ErrorMsg").html("<div class='uploads' style='padding: 10px;background: #ff6565;color: #fdfdfd;'> Picture serial at number "+i+" is empty. </div>");
        }

      }else{
        alert("Upload picture First")
      }
    }

  function insertFile(argument) {
    img_id = argument;
    $('#PicList').modal('show');
  }

  function img_urlFunction(argument) {
    $("#image_"+img_id+"").val(argument)
  }

    function getImageBox2() {
        var qty = $("#box_qty").val();
        $.ajax({
          url:"<?php echo base_url(); ?>Tutor/input_tutor",
          type:"post",
          dataType:'html',
          data:{qty:qty},
          success:function(data){

            $('#tbl_show').html(data);
            
          }
        });
    }

    function getImageBoxTwo(qty , imgdata) {

        $.ajax({
          url:"<?php echo base_url(); ?>Tutor/input_tutor_two",
          type:"post",
          dataType:'html',
          data:{qty:qty ,imgdata:imgdata },
          success:function(data){

            $('#tbl_show').html(data);
            
          }
        });
    }

    function getImageBOXSS() {
      var qty = $("#box_qty_2").val();

      $.ajax({
        url:"<?php echo base_url(); ?>Tutor/input_tutor_two",
        type:"post",
        dataType:'html',
        data:{qty:qty},
        success:function(data){

          $('#tbl_show').html(data);
          
        }
      });
    }
</script>

<script type="text/javascript">
  $( ".ss_q_btn" ).click(function() {

  // $("div").removeClass("error_show");
  $('.error_show').html('');



  $("form#question_form :input").each(function(){
    if($(this).val() == ''){
   
    var name = $(this).attr('count_here');
    

    if (name !== undefined ) {
      $('.error_show').prepend("<div>"+name+" is empty</div>");
      
      return;
    }
      
    }
  });

});
</script>

<script type="text/javascript">
  function all_file() {
    $(".upload_manually").hide();
    $(".upload_allFile").show();
    $("#tbl_show").html('');
  }

  function manually_upload() {
    $(".upload_allFile").hide();
    $("#tbl_show").html('');
    $(".upload_manually").show();
  }

  $(document).ready(function(){  
      $('#upload_form').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/ajax_upload",   
                     //base_url() = http://localhost/tutorial/codeigniter  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                          $('#uploaded_image').html(data);  
                     }  
                });  
           }  
      });  
 });  

  function UploadAllFiles() {
    $.ajax({  
           url:"<?php echo base_url(); ?>Tutor/upload_allFiles",  
           method:"POST",  
           data:new FormData(this),  
           contentType: false,  
           cache: false,  
           processData:false,  
           success:function(data)  
           {  
                $('#uploaded_image').html(data);  
           }  
      });  
  }

</script>