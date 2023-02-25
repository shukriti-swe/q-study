<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/intlTelInput.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/intlTelInput.min.css">
    
    <style>
    .wrapper-page {
        margin: 5% auto;
        position: relative;
        width: 520px;
    }
    .error{
        color:red;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="row">

            <div class="wrapper-page">                

                <div class="card">
                    <b><p id="error_match" style="color:red; text-align: center;"></p></b> 
                    <div class="card-header">
                        Account recovery
                    </div>
                    <div class="card-body">


                        <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url(); ?>pass_reset_link" id="loginForm" novalidate="novalidate" >

                            <div class="form-group ">
                                <div class="col-12">
                                    <p class="card-text m-t-20">Recover your account providing email address & Mobile </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="">Parent</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="">School</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="">Corporate</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="">Tutor</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-12">
                                <input class="form-control" type="email" required="" placeholder="Email" name="email" id="email" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group" style="margin: 15px;">
                            <input class="form-control" type="tel" placeholder="Mobile no" id="mobile" name="mobile" onchange="myFunction(this)">
                            <input type="hidden" id="full_number" name="full_number">
                            <p id="error_mobile" style="color:red"></p>
                        </div>


                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" id="btnSubmit" type="button">Continue</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>
</div>



<!-- jQuery  -->


<script type="text/javaScript">
            var input = document.querySelector("#mobile");

            iti = intlTelInput(input, {
                utilsScript: "<?php echo base_url();?>assets/js/utils.js?1537727621611",
                initialCountry:'AU',
                autoHideDialCode: true,
                autoPlaceholder: "off",
                //defaultCountry: "auto",
                numberType: "MOBILE",
                separateDialCode:true,
            });

            $("#btnSubmit").click(function(){
              $("#full_number").val(iti.getNumber());

              var phone = $("#full_number").val();
              var email = $("#email").val();

              var inlineRadio1 = $('input[type="radio"][name="inlineRadioOptions"]:checked').val()


              if (inlineRadio1 != undefined) {
                $.ajax({
                    url: '<?php echo site_url('login/passwdCheck'); ?>',
                    type: 'POST',
                    data: {
                        phone: phone,
                        email: email
                    },
                    success: function (response) {

                        if (phone !="" && email !="" ) {
                            if ( response.replace(/[^a-zA-Z0-9]/g, '') == 0 ) {
                                $("#error_match").html("We have not found any match with provided Email & Phone no.")
                            }else{
                                document.getElementById('loginForm').submit();
                            }

                        }else{
                            $("#error_match").html("All fields are mandatory. ")
                        }
                    }
                });

              }else{
                $("#error_match").html("All fields are mandatory. ")
              }
              
            });


    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url:'emailCheck',
                    type:"POST",
                    data: {
                        'email': function(){ 
                            return $("#email").val(); 
                        },
                    }
                },
            },

        },
        messages:{
            email:{
                remote: "User email not recorded! Please register first.",
            },
        },
    });
    
    $(document).ready(function(){
        $(".flash_msg").fadeOut(5000);
    });

</script>

<script type="text/javascript">
    function myFunction(argument) {
        $("#full_number").val(iti.getNumber());

        var phone = $("#full_number").val()
        $.ajax({
                url: '<?php echo site_url('login/phoneCheck'); ?>',
                type: 'POST',
                data: {
                    phone: phone
                },
                success: function (response) {

                    if ( response.replace(/[^a-zA-Z0-9]/g, '') == 0 ) {
                        $("#error_mobile").html("User phone not recorded! Please register first.")
                    }else{
                        $("#error_mobile").html("")
                    }
                }
            });
    }
</script>

<script type="text/javascript">
    setInterval(circulate1,1000);

    function circulate1() { 
        var text = $("#email-error").text()
        if (text == "Please enter a valid email address." || text == "This field is required." ) {
            $("#error_match").html("");
        }
    }
    
</script>

</body>
</html>
