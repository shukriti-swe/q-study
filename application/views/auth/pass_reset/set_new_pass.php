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
                    <div class="card-header">
                        Account recovery
                    </div>
                    <div class="card-body">


                        <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url(); ?>set_password" id="passResetForm" novalidate="novalidate">
                            <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="authCode" id="authCode" value="<?php echo $authCode; ?>">
                            <div class="form-group ">
                                <div class="col-12">
                                    <p class="card-text m-t-20"></p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-6"><label for="">Password</label></div>
                                <div class="col-12">
                                    <input class="form-control" type="password" required placeholder="Password" name="password" id="password" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-6"><label for="">Confirm Password</label></div>
                                <div class="col-12">
                                    <input class="form-control" type="password" required placeholder="Password again" name="conf_password" id="conf_password" aria-required="true">
                                </div>
                            </div>




                            <div class="form-group text-center m-t-40">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">Continue</button>
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

        $("#passResetForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength:6,
                },
                conf_password: {
                    required: true,
                    minlength:6,
                    equalTo: "#password",
                }

            }
        });
    </script>



</body>
</html>