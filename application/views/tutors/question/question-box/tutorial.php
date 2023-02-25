<style>

div#myId {
    display: flex;
}

.dz-details{
  display: none;
}


.dz-error-mark{
  display: none;
}

.dz-image {
    border: 1px solid;
    width: 125px;
    margin: 0 9px;
}

input#box_qty_2 {
     padding: 0 381px; 
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
  /*display: none;*/
}

/*button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}*/

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
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
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }

    .ss_question_add {
        clear: both;
        margin-top: 30px;
        position: relative;
        width: 173%;
        margin-top: 5%;
    }
    .panel {
    margin-bottom: 11px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    width: 120%;
    padding: 0px;
    margin-left: 27%;
}

    .image_box_list {
    overflow: hidden;
    box-shadow: 0px 0px 0px 1px #91b7ef;
    background-color: #fbfbfb;
}

    input[type=text] {
        width: 50%;
        border: 1px solid #e1f2f7;
        /*padding: 7px 130px;
*/
    }

  #tbl_show {
    color: #222222;
    font-size: 14px;
    line-height: 24px;
    letter-spacing: .5px;
   
}
#tbl_show .tab{
   width: 59%;
   padding: 20px;
}
.blue{
  color: red;
}


.ss_pagination{
  margin-right: 80px;
  background: #fff;
  margin-top: 1px;
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

</style>

<input type="hidden" name="questionType" value="14">
<div class="ErrorMsg"></div>

<br><br>

<div class="text-right">
    <div class="col-sm-4">
        <div class="text-right">

          <button class="btn btn-success" type="button" onclick="all_file()" >Upload all files</button>
          <button class="btn btn-info" type="button" onclick="manually_upload()"  >Upload manually</button>
          <br><br>

          <div class="upload_allFile" style="display: none;">
            <div style="overflow-x: scroll;width: 700px;">
              <div id="myId" style="width: 150px ; height: 150px;" class='custom-file-input'>  </div>
            </div>
            <button type="button" class="btn" onclick="start_upload()" style="margin-right: -169px;padding: 5px;background: yellowgreen;">Prepare Question</button><br>
            <div class="uploadsMsg"> </div>
          </div>
          <br>

          <div style="display: none;" class="upload_manually">
            <div class="form-group ss_h_mi">
              <div class="error_show" style="color: #e41818;width: 166%;text-align: center; margin: 10px;"></div>
                <label for="exampleInputiamges1">How many images</label>
                <div class="select">
                    <input class="form-control" type="number" value="1" id="box_qty" onchange="getImageBox(this)">
                </div>
            </div>
          </div>
        </div>
        
        <div class="" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">

                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                   
                        <div class="image_box_list ss_m_qu">
                          <div class="progress" style="display: none;">
                              <div class="progress-bar progress-bar-striped active" role="progressbar"
                                   aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Loading...
                              </div>
                          </div>
                            
                           <div id="tbl_show"></div>
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


<input type="hidden" id="check">
<input type="hidden" name="image_quantity" id="image_quantity" value="">

<script>

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

//ss_q_btn

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

    function getImageBox() {
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