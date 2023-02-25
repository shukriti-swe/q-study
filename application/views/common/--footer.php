    

<!--===================== End of Footer ========================-->
</div>
<div  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="login_form">
  <!-- Modal -->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form-horizontal" method="post">
				<div class="modal-header">
					<h4>Please Login</h4>
				</div>
				<p id="error_msg" style="display: none;color: #dd1a1a;font-weight: bolder;">Username or Password is  Incorrect</p>
        <p id="error_msg_2" style="display: none;color: #dd1a1a;font-weight: bolder;"> Your Q-study free trial has expired </p>
				<div class="modal-body">
				
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-4 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="user_name" id="user_name" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password" id="user_password" placeholder="">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
					<button type="button" onclick="chkLoginAccess()" class="btn btn_blue">Login</button>
					<a href="<?php echo base_url(); ?>forgot_password" class="text-center" style="font-size:13px; margin:7px 0px 0px 25px">Forgot password</a>
				</div>
			</form>
		</div>
	</div>

</div>

<!--wrapper-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/css3-animate-it.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/counter.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script> 
<!-- <script src="<?php //echo base_url();?>assets/js/countrySelect.min.js"></script>
-->

<script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>
<script src="<?php echo base_url();?>assets/js/intlTelInput.js"></script>  
<script>
  // $("#country").countrySelect();
  // $("#phone").intlTelInput();

  $( document ).ready(function() {
    $( '.ss_bottom_s_course .select' ).on( 'click', function() {
      $( this ).parent().find( 'div.active' ).removeClass( 'active' );
      $( this ).addClass( 'active' );
    });

    $(".select2").select2({

    });
 $( '.top_menu_link' ).on( 'click', function() {
  $('.ss_new_menu').slideToggle('fast');
   });   

  });


    /*var AnswerInput = document.getElementsByName('item_id[]');
       var qtyInput = document.getElementsByName('qty[]');
//        console.log(AnswerInput.length);
       if(AnswerInput.length > 0){
           for (i=0; i<AnswerInput.length; i++){
               if (AnswerInput[i].value == 0 || qtyInput[i].value == ''){
                  $("#text-center").css("display", "block");    
                  return false;
              }
          }
       }if(AnswerInput.length <= 0){
           $("#must_select").css("display", "block");
           return false
         }*/
       </script>
       <script>
        function chkLoginAccess() {

          var pathname = '<?php echo base_url(); ?>';
          var user_name = $("#user_name").val();
          var password = $("#user_password").val();
          $.ajax({
            type: 'POST',
            url: 'loginChk',
            data: {
              user_name: user_name,
              password: password
            },
            dataType: 'html',
            success: function(results){
              if(results == 0){
                $("#error_msg").show();
              }if(results == 2){
                $("#error_msg_2").show();
              }if(results == 1){
                window.location.href = pathname+"dashboard";
              }
            }
          });

        }
      </script>
    </body>
</html>
