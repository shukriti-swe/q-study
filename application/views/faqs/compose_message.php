<br>

<?php if (!empty( $this->session->flashdata('success_msg') )) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?> </div>
<?php  } ?>
<div class="row" style="margin-top:30px; margin-bottom:30px;">
    <div class="col-md-4 text-center">
    </div>
    <div class="col-md-5 text-center">
        <button class="btn btn-primary">Inbox</button>
        <div class="message-box">
            <?php foreach($messages as $msg):?>
            <div class="single-message">
                <span class="first-span"><button  data-toggle="modal" class="viewMessage" data="<?= $msg['id'];?>"><u>View</u></button></span><span><?= $msg['date_time'];?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- tutor message Compose Modal details modal -->
<div class="modal" id="messageComposeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 75%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <!--<h6 class="modal-title" id="exampleModalLabel">Q-study Message</h6>-->
        </div>
        <div class="modal-body">
        <form id="sendMessageCompose">
          <div class="row"> 
            <div class="col-md-12">
                <div id="sendMessage"></div>
                <!--<textarea class="form-control" aria-label="With textarea" rows="4" name="sendMessage" id="sendMessage"></textarea>-->
            </div>
          </div> 
          <br>
          <div class="text-right">
            <button type="button" class="btn btn-default" data-dismiss='modal'>Close</button>
          </div>
         </form>
        </div>
     </div>
    </div>
</div>
<style type="text/css">
    .message-box{
        border: 1px solid lightblue;
        border-radius: 3px;
        margin: 10px;
        padding:10px;
    }
    .viewMessage{
        display:inline-block;
        border: navajowhite;
        background: none;
    }
    .first-span{
       margin-right: 33px;
    }
    .single-message{
      margin-bottom: 10px;
    }
</style>
<script>
    $(document).ready(function(){
        $('.viewMessage').click(function(){
            var data = $(this).attr('data');
            $.ajax({
                url: '<?php echo site_url('CommonAccess/viewSingleMessage'); ?>',
                type: 'POST',
                data: {data:data}, 
                success: function (response) {
                    $('#sendMessage').html(response);
                    $('#messageComposeModal').modal('show');
                }
            });
            
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