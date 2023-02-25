<div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <div class="col-md-8">
        <?php if (!empty( $this->session->flashdata('success_msg') )) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?> </div>
          <?php  } ?>
          <div class="msg_success_add"></div>
        <form action="" method="post">
            <div class="button_schedule text-right" >
                <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
                <button class="btn btn_next" type="submit"><i class="fa fa-home"></i> Save</button>
            </div>
            <input type="hidden" name="country_id" value="<?php echo $country_info[0]['id']?>">
            <div class="row schedule_country_details">
                <div class="col-md-1" style="padding: 0;">
                    <P style=" color: #000; "><i class="fa fa-file" style=" color: #fbea71; "></i> <?php echo $country_info[0]['countryName']?></P>
                </div>
                <div class="col-md-11" style="padding: 0;font-size: 15px;">
                    <div class="details">
                        <a href="directDepositSetting/<?= $country_info[0]['id']?>"><u>Direct Deposit Payment</u></a>
                    </div>
                    
                    <div class="details">
                        <label><input type="checkbox" value="1" name="user_active_status" <?= (isset($getDepositDetails->active_status) && $getDepositDetails->active_status == 1)?'checked':'' ?> > Active</label>
                    </div>
                    
                    <div class="details">
                        <a data-toggle="modal" data-target="#instantModal" ><u>Instant message online</u></a>
                    </div>
                    
                    <div class="details">
                        <a href="" data-toggle="modal" data-target="#emailModal"><u>Email formate message</u></a>
                    </div>
                    
                    <div class="details">
                        <a href="" data-toggle="modal" data-target="#inboxModal"><u>Inbox formate message</u></a>
                    </div>
                </div>

                <div class="col-md-12 checkbox_n">
                    <div class="checkbox">
                        <label><input type="checkbox" value="3" name="user_type"> Converted Dollar</label>
                    </div><br>
                    <div class="covator">
                        <span style="display: inline-flex;margin-right:3px;font-size: 25px;">$ <span> <input class="form-control" type="number" name="">
                    </div>
                    <div class="covator">
                       <span style="display: inline-flex;margin-right:3px;font-size: 25px;">$ <span> <input class="form-control" type="number" name="">
                    </div>
                    <div class="covator">
                        <a id="bank_details"><u>Bank Details</u></a>
                    </div>
                    <div class="bank_detainls_box">
                        <a class="messageBoxClose"><i class="fa fa-times"></i></a>
                        <textarea class="form-control" rows="6" name="bank_details"><?= (isset($getDepositDetails->bank_details))?$getDepositDetails->bank_details:'' ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- instant modal user account modal -->
<div class="modal fade" id="instantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 80%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6 class="modal-title text-center" id="exampleModalLabel">Request To Pay By Direct Deposit</h6>
            </div>
            <div class="modal-body">
              <div class="row"> 
                <p style="margin:15px;">You have requested that you wish to purchase a <span style="font-size: 18px"><b>Q-Study</b></span>  product using direct deposit. We have sent you an email to you at <span style="font-size: 18px"><b> ------ </b></span>    with instruction on paying for your product by direct deposit. Moreover, the message and direct deposit information are given in the inbox of the front page of the student   </p>
                <p class="text-danger" style="margin:15px;">Note: If you don't see a confirmation e-mail then please check your bulk/spam folder.</p>
              </div> 
              <br>
              <div class=" text-right">
                <button class="btn btn-success" data-dismiss='modal'>Close</button>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- instant modal user account modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 80%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5>Email Message</h5>
            </div>
            <form id="emailBankDetails">
            <div class="modal-body">
              <div class="row"> 
                <div class="mailbody">
                    <p>Dear : <input type="text"></p>
                    <p>Thank you for subscribing Q-study </p>
                    <p>Your Choosen Product:<br> 
                        <input type="text">
                        <input type="text">
                        <input type="text">
                    </p>
                    <p>Please make payment of <span><input type="text"></span> to Q-study</p>
                    <textarea class="form-control" rows="6" name="bankDetainEmail" id="bankDetainEmail"><?= (isset($getDepositDetails->email_message))?$getDepositDetails->email_message:'' ?></textarea>
                    <p>After payment has been made, please email us so we can active your acount without delay. Please write your name,email address and your Ref.Link <span><input type="text"></span> as the reference.  </p>
                    <p>Moreover, the message and direct deposit information are given in the inboxof the front page of the student. </p>
                    <p>Thanks</p>
                    <p><b>Q-Study</b></p>
                </div>
              </div> 
              <br>
              <div class=" text-right">
                <button type="button" class="btn btn-success" id="emailBankDetailsbutton">Submit</button>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- inbox modal user account modal -->
<div class="modal fade" id="inboxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 80%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5>Inbox Message</h5>
            </div>
            <form id="">
            <div class="modal-body">
              <div class="row"> 
                <div class="mailbody">
                    <p>Dear : <input type="text"></p>
                    <p>Thank you for subscribing Q-study </p>
                    <p>Your Choosen Product:<br> 
                        <input type="text">
                        <input type="text">
                        <input type="text">
                    </p>
                    <p>Please make payment of <span><input type="text"></span> to Q-study</p>
                    <textarea class="form-control" rows="6" name="bankDetailsInbox" id="bankDetailsInbox"><?= (isset($getDepositDetails->inbox_message))?$getDepositDetails->inbox_message:'' ?></textarea>
                    <p>After payment has been made, please email or message to your payment information in the Q-study contact of the front page of the student so we can active your acount without delay.</p>
                    <p>Moreover, You can watch the video how to send payment information. </p>
                    <p> Please write your name,email address and your Ref.Link as the reference.  </p>
                    <p>Thanks</p>
                    <p><b>Q-Study</b></p>
                </div>
              </div> 
              <br>
              <div class=" text-right">
                <button type="button" class="btn btn-success" id="bankDetailsInboxbutton">Submit</button>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>
<style>
.details{
    display:inline-block;
    margin-right: 12px;
}
.covator{
    display:inline-block;
    margin-right: 12px;
    width: 12%;
}
#bank_details{
    cursor:pointer;
}
.bank_detainls_box{
    width: 50%;
    float: right;
    margin-right: 177px;
    display:none;
}
.messageBoxClose{
    float: right;
    cursor:pointer;
}
.mailbody{
    padding: 0px 25px;
}
.mailbody p input{
    height: 15px;
    border: 1px solid;
}
.mailbody p span input{
    height: 15px;
    border: 1px solid;width: 20%;
}
</style>
<script>
$('#bank_details').click(function(){
    $('.bank_detainls_box').show();
})
$('.messageBoxClose').click(function(){
    $('.bank_detainls_box').hide();
})
// this is the id of the form
$("#emailBankDetailsbutton").click(function(e) {
    var data = $('#bankDetainEmail').val();
    var country_id = "<?= $country_info[0]['id'] ?>"
    $.ajax({
           type: "POST",
           url: 'Admin/emailBankDetails',
           data:{data:data,country_id:country_id}, // serializes the form's elements.
           success: function(data)
           {
              $('#emailModal').modal('hide');
              $('.msg_success_add').html(data);
           }
         });

    
});
$("#bankDetailsInboxbutton").click(function(e) {
    var data = $('#bankDetailsInbox').val();
    var country_id = "<?= $country_info[0]['id'] ?>"
    $.ajax({
           type: "POST",
           url: 'Admin/inboxBankDetails',
           data:{data:data,country_id:country_id}, // serializes the form's elements.
           success: function(data)
           {
              $('#inboxModal').modal('hide');
              $('.msg_success_add').html(data);
           }
         });

    
});
</script>

