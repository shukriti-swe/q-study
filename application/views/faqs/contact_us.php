<br>
<div  class="container">
<?php if (!empty( $this->session->flashdata('success_msg') )) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?> </div>
<?php  } ?>
<div class="row" style="margin-top:20px; margin-bottom:30px;">
    <div class="col-md-4 text-center">
        <img src="assets/images/banner/contact_us_1.png" alt="" width="215px" height="285px">
    </div>
    
    <div class="col-md-5 uploadbuttonFixed">
        <!--<img style="display: block;margin:auto; margin-bottom:80px;" src="assets/images/banner/contact_us_2.jpg" alt="" width="240" height="200" >--><div class="form-group">
        
        <?php if (!isset($user_info)) { ?>
            <?php if (isset($contacts_email->setting_value)) : ?>
            <div class="">
                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                <div class="panel-body col-sm-10 setEmailClass">
                    Email: <?php echo $contacts_email->setting_value; ?>
                </div>
            </div>
            <?php else : ?>
                <div class="panel-body">
                    <strong style="color:#0078AE;">SHOP 2/60 A THE BOULEVARDE LAKEMBA NSW 2195 AUSTRALIA</strong>
                </div>
                <div class="panel-body">
                    <p>Phone : 02 80045632</p>
                    <p>Mobile : 0414339854</p>
                    <p>Email : info@q-study.com</p>
                </div>
            <?php endif; ?>
        <form class="form-horizontal" method="POST" name="contact" action="contact_us">
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Name"  name="userName">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="userEmail">
                </div>
            </div>
            <div class="form-group">
                <label for="messageBody" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="messageBody" name="userMessage"></textarea>
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">Send</button>
                </div>
            </div>

        </form>
        <?php } ?>
        <?php if (isset($user_info)) { ?>
        <form class="form-horizontal" method="POST" name="contact" action="send_feedback">
            <div class="form-group">
                <label for="messageBody" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <!--<label>Insert q-study Ref. no:</label>-->
                    <!--<input type="text" class="form-control" id="refLink" placeholder="Ref. No" name="ref_link" value="">-->
                    <!--<input type="hidden" name="hiddenRefLink" id="hiddenRefLink" value="0">-->
                    <!--<p id="error_refLink" class="text-danger"></p>-->
                    <button type="button" class="btn btn-info btn-sm">Send Message To Q-Study</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2" style="padding: 0px;">
                    <button type="button" class="btn btn-default btn-sm button_setting inactive" value="bug_report">Bug Report</button>
                    <button type="button" class="btn btn-default btn-sm button_setting inactive" value="complaint">Complaint</button>
                    <button type="button" class="btn btn-default btn-sm button_setting inactive" value="feedback">Feedback</button>
                    <button type="button" class="btn btn-default btn-sm button_setting inactive" value="other">Other</button>
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="feedback_topic" value="" id="feedback_topic">
                    <textarea class="form-control" rows="6" id="detailsBody" name="details_body" style="height: 137px;"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info" id="sendButton">Send</button>
                </div>
            </div>


            <div class="form-group fileList">
                <div class="col-sm-offset-2 col-sm-10">
                <?php foreach ($uploaded_files as $key => $value): ?>
                    <span><?= $value['filename'] ?></span>
                <?php endforeach ?>
                </div>
            </div>
        </form>
        <div onload="setup()" class="mainDivUploadFile">
            <form id='formid' action="feedbackfileUpload" method="POST" enctype="multipart/form-data"> 
                <input id='fileid' type='file' name='filename[]' multiple="multiple" hidden style="display: none" />
                <!-- <input id='buttonid' type='button' value='Upload' />  -->
                <button class="btn btn-info fileUploadButton" id='buttonid' type='button' value='Upload' ><i class="fa fa-file" aria-hidden="true"></i></button>
                <!-- <input type='submit' value='Submit' />  -->
                <input type="hidden" name="userId" value="<?= (isset($user_info))?$user_info->id:null; ?>">
            </form>
        </div>
        
        <?php } ?>
    </div>
    <!--<div class="col-md-3 text-left" style="padding-left:0px !important;">-->
    <!--    <div class="panel panel-default">-->
    <!--        <?php if (isset($contacts_email->setting_value)) : ?>-->
    <!--            <div class="panel-body">-->
    <!--                Email: <?php echo $contacts_email->setting_value; ?>-->
    <!--            </div>-->
    <!--        <?php else : ?>-->
    <!--                <div class="panel-body">-->
    <!--                    <strong style="color:#0078AE;">SHOP 2/60 A THE BOULEVARDE LAKEMBA NSW 2195 AUSTRALIA</strong>-->
    <!--                </div>-->
    <!--                <div class="panel-body">-->
    <!--                    <p>Phone : 02 80045632</p>-->
    <!--                    <p>Mobile : 0414339854</p>-->
    <!--                    <p>Email : info@q-study.com</p>-->
    <!--                </div>-->
    <!--        <?php endif; ?>-->
    <!--    </div>-->
    <!--</div>-->
    </div>
</div>
<style type="text/css">
    .setEmailClass{
        border: 1px solid lightblue;
        border-radius: 3px;
        margin-bottom: 10px;
        position: relative;
        top: -25px;
    }
    .button_setting{
       margin-bottom: 5px;
       float: right;
       width:75px;
       height: 30px;
       font-size: 11px;
       line-height: 16px;
    }
    .mainDivUploadFile{
        position: absolute;
        left: 162px;
        bottom: 115px;
    }
    .uploadbuttonFixed{
        position: relative;
        padding-bottom: 100px;
    }
    .fileList{
        bottom: 50px;
        left: 44px;
        position: absolute;
    }
    #d6d6d6
</style>
<script>
    $(document).ready(function(){
        setup();
        $('.button_setting').click(function(){
            var value = $(this).val();
            $('#feedback_topic').val(value);
            $('.button_setting').removeClass('active').addClass('inactive');
            $(this).removeClass('inactive').addClass('active');
        })

        $('#refLink').change(function(){
            var refLink = $(this).val();
            if (refLink != '') {
                $.ajax({
                    url: '<?php echo site_url('CommonAccess/checkRefLink'); ?>',
                    type: 'POST',
                    data: {
                        refLink,
                    }, 
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            $('#error_refLink').html('');
                            $('#hiddenRefLink').val(0);
                            return true;
                        }else{
                            $('#error_refLink').html('Worng Ref. link!!');
                            $('#hiddenRefLink').val(1);
                            return false;                        
                        }
                    }
                });

            }else{
                $('#error_refLink').html('');
                $('#hiddenRefLink').val(0);
                return true;
                
            }
        })

        $('#sendButton').click(function(){
            var feedback_topic = $('#feedback_topic').val();
            var detailsBody = $('#detailsBody').val();
            var refLink = $('#refLink').val();

            var hiddenRefLink = $('#hiddenRefLink').val();


            if (refLink == '') {
                 $('#refLink').val('');
            }

            if (hiddenRefLink == 1) {
                $('#error_refLink').html('Please enter valid refLink');
                return false; 
            }else{
                $('#error_refLink').html('');
            }


            if (feedback_topic == '') {
                $('#error_refLink').html('Please select feedback topic');
                return false; 
            }else{
                $('#error_refLink').html('');
            }

            if (detailsBody == '') {
                $('#error_refLink').html('Please enter topic details');
                return false; 
            }else{
                $('#error_refLink').html('');
            }




        })



        function setup() {
            document.getElementById('buttonid').addEventListener('click', openDialog);
            function openDialog() {
                document.getElementById('fileid').click();
            }
            document.getElementById('fileid').addEventListener('change', submitForm);
            function submitForm() {
                document.getElementById('formid').submit();
            }
        }

    })


</script>