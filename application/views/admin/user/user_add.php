<style>
  .panel-heading{
    background-color: #2F91BA !important;
  }

  .panel-title a {
    text-decoration: none;
    color: #fff !important;
  }
</style>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
      <?php echo $leftnav ?>
    </div>


    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; color:white;">  Add User </span></strong>
              </a>
            </h4>
          </div>

          <form autocomplete="off" action="user_add" method="POST">
            <div class="row panel-body">
              <div class="row">
                <div class="col-sm-12 text-right">
                  <button class="btn btn_next" type="button" onClick="location.reload()" id="cancelBtn"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                  <button type="submit" class="btn btn_next" id="saveBtn"><i class="fa fa-check" style="padding-right: 5px;"></i>Save</button>
                </div>
              </div>

            </div>


            <div class="row panel-body">
              <div class="row" style="padding:0px 5px 0px 5px;">
                <div class="col-sm-12">
                <label class="radio-inline">
                  <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio1" value="trial" required> Trial
                </label>
                <label class="radio-inline">
                  <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio2" value="signup" required> Signup
                </label>
                <label class="radio-inline">
                  <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio3" value="guest" required> Guest
                </label>
                <label class="radio-inline" style="margin: 0px !important;">
                      <input class="form-check-input" type="checkbox" name="suspension_status" value="1" id="suspension_status"> Active
                </label>
                <label class="radio-inline" style="margin: 0px !important;padding: 0px !important;">
                      <input class="form-check-input" type="checkbox" name="isExtendTrialPeriod" value="1" id="isExtendTrialPeriod"> Extend Trial Period
                </label>
                 <!-- <label class="radio-inline">
                  <input type="radio" name="subscription_type" id="inlineRadio4" value="data_input" required> Data Input
                </label>  -->

                <!-- shvou -->
                <?php 
                $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
                $duration = $tbl_setting->setting_value;
                if (isset($duration)): ?>
                  <label class="radio-inline trail_period"> 
                    <p> Days <strong style="padding: 2px 7px;border-radius:20%;border: 1px solid #ae9ebd;"><?=$duration;?></strong></p>
                  </label>
                <?php endif ?>
                <label class="radio-inline days_unlimited" style="display: none"> 
                    <p> Days <input type="number" name="guest_days" min="1" id="guest_days" style="width: 46px;border: 1px solid #aeacbd;border-radius: 4px;"></p>
                </label>

                <label class="days_unlimited" style="display: none"> 
                    <p> Unlimited <input class="form-check-input" type="checkbox" name="unlimited" value="1" id="unlimited"></p>
                </label>

                  
                </div>
                <!-- shvou -->
              </div>
            </div>

            <div class="row panel-body">
              <div class="row" style="padding:0px 5px 0px 5px;">

                <div class="col-sm-8">

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Mobile No</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="mobile" name="mobile">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Ref Link</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="ref_link" name="refLink">
                    </div>
                  </div>
                  
                <!-- </div>
                <div class="col-sm-6"> -->

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">User Type</label>
                    <div class="col-sm-8">
                      <select id="userType" class="form-control" name="userType" required>
                        <option selected>Choose...</option>
                        <?php foreach ($user_type as $userType) : ?>
                          <option value="<?php echo $userType['id'] ?>"><?php echo $userType['userType'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" id="grade" style="display:none">
                    <label for="" class="col-sm-4 col-form-label">Grade/Year/Level</label>
                    <div class="col-sm-8">
                      <select  class="form-control" name="grade">
                        <option selected value="">Choose...</option>
                        <?php for ($a=1; $a<=12; $a++) : ?>
                          <option value="<?php echo $a;?>"><?php echo $a; ?></option>
                        <?php endfor; ?>
                        <option value="13">Upper Level</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" id="parent" style="display:none">
                    <label for="" class="col-sm-4 col-form-label">Parent</label>
                    <div class="col-sm-8">
                      <select  class="form-control" name="parentId">
                        <option selected value="">Choose...</option>
                        <?php foreach ($parents as $parent) : ?>
                          <option value="<?php echo $parent['id'] ?>"><?php echo $parent['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" id="numOfChild" style="display:none">
                    <label for="" class="col-sm-4 col-form-label">Number of children</label>
                    <div class="col-sm-8">
                      <!-- // rakesh -->
                      <input type="text" name="numOfChild" value="1" readonly="" class="form-control">
                      
                    </div>
                  </div>

                  <!-- <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Active</label>
                    <div class="col-sm-8">
                      <input class="form-check-input" type="checkbox" name="suspension_status" value="1" id="suspension_status">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Extend Trial Period</label>
                    <div class="col-sm-8">
                      <input class="form-check-input" type="checkbox" name="isExtendTrialPeriod" value="1" id="isExtendTrialPeriod">
                    </div>
                  </div> -->
                  
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Country</label>
                    <div class="col-sm-8">
                      <select name="country" id="country" class="form-control" name="country" required>
                        <option value="">Choose...</option>
                        <?php foreach ($all_country as $country) : ?>
                          <option value="<?php echo $country['id'] ?>"><?php echo $country['countryName'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12" style="text-align: center">
                    <div class="ss_top_s_course">
                      <ul id="course_ul">

                      </ul>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </form>

        </div>

      </div>

    </div>

  </div>

</div>

<script src="<?php echo base_url();?>assets/js/intlTelInput.js"></script>
<script>

  var iti='';
  $( document ).ready(function() {
    var input = document.querySelector("#mobile");

    iti = intlTelInput(input, {
      utilsScript: "<?php echo base_url();?>assets/js/utils.js?1537727621611",
      autoHideDialCode: true,
      autoPlaceholder: "off",
      hiddenInput: "full_phone",
      defaultCountry: "aus",
      numberType: "MOBILE",
      separateDialCode:true,
    });
  });

     $(document).on('change', '#userType', function(){
      var userType = this.value;
      if(userType == 1) { 
        // rakesh
        $('#numOfChild').css('display', 'block');

            //hide other types
            $('#parent').css('display', 'none');
            $('#grade').css('display', 'none');


            var numOfChild = 1;
            var html='';


            for(var a=0; a<numOfChild; a++){

              html +='<div class="form-group childInfo row">';
              html += '<label for="" class="col-sm-4 col-form-label">Student Name</label>';
              html += '<div class="col-sm-8">';
              html += '<input class="form-check-input form-control" type="text" name="childName[]"  required>';
              html += '</div></div>';


              html +='<div class="form-group childInfo row">';
              html += '<label for="" class="col-sm-4 col-form-label">Year/Grade</label>';
              html += '<div class="col-sm-8">';
              html += '<input class="form-check-input form-control" type="number" min="1" max="12" name="childGrade[]" required>';
              html += '</div></div>';


              html +='<div class="form-group childInfo row">';
              html += '<label for="" class="col-sm-4 col-form-label">School/Tutor Link</label>';
              html += '<div class="col-sm-8">';
              html += '<input class="form-check-input form-control" type="text" name="childSCTLink[]" required>';
              html += '<hr>';
              html += '</div></div>';
            }

            $('#numOfChild').after(html);

          } else if(userType == 2 || userType == 6) {
            $('#parent').css('display', 'block');
            $('#grade').css('display', 'block');
            
            //hide other types
            $('#numOfChild').css('display', 'none');
            $('.childInfo').remove();

        } else { //else hide all custom
          $('#parent').css('display', 'none');
          $('#grade').css('display', 'none');
          $('#numOfChild').css('display', 'none');
          $('.childInfo').remove();
        }

      });

    $(document).on('change', "#numOfChild select", function(){
      var numOfChild = this.value;
      var html='';


      for(var a=0; a<numOfChild; a++){

        html +='<div class="form-group childInfo row">';
        html += '<label for="" class="col-sm-4 col-form-label">Student Name</label>';
        html += '<div class="col-sm-8">';
        html += '<input class="form-check-input form-control" type="text" name="childName[]"  required>';
        html += '</div></div>';


        html +='<div class="form-group childInfo row">';
        html += '<label for="" class="col-sm-4 col-form-label">Year/Grade</label>';
        html += '<div class="col-sm-8">';
        html += '<input class="form-check-input form-control" type="number" min="1" max="12" name="childGrade[]" required>';
        html += '</div></div>';


        html +='<div class="form-group childInfo row">';
        html += '<label for="" class="col-sm-4 col-form-label">School/Tutor Link</label>';
        html += '<div class="col-sm-8">';
        html += '<input class="form-check-input form-control" type="text" name="childSCTLink[]" required>';
        html += '<hr>';
        html += '</div></div>';
      }

      $('#numOfChild').after(html);


    })

    $(document).on('change', '#country', function(){
      var countryId = $(this).val();
      $.ajax({
        url:'Admin/coursesByCountry/'+countryId,
        success: function(response){
          $('#course_ul').html(response);          
        }


      })
    })

    $('.radio_button').change(function(){
      var value = $(this).val();
      if (value == 'guest') {
        $('.days_unlimited').show();
        $('.trail_period').hide();
      }else{
        $('.days_unlimited').hide();
        $('.trail_period').show();

      }
    })

    $("#unlimited").click(function(){
      if (this.checked) {
        $('#guest_days').attr('disabled',true);
      }else{
        $('#guest_days').attr('disabled',false);
      }
    });
	

  </script>
