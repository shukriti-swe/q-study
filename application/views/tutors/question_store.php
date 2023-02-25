<style>
  .slick-prev:before, .slick-next:before {
    color: #337ab7 !important;   
  }

   #mySlickCourse{
      margin-bottom: 15px;
  }
  .slick-prev:before, .slick-next:before{
      color: #ffffff !important;
      font-size: 14px
  }
  .slick-prev{
      left: -10px;
  }
  .slick-next{
      right: -0px;
  }
  .slick-list{
      margin-right: 15px !important;
  }
  #mySlickCourse .courseName{
      font-size: 13px;
  }

  .slick-slide {
    margin: 0 10px;
    height: auto !important;
  }
  /* the parent */
  .slick-list {
    margin: 0 -10px;
  }

  .badge{white-space: normal !important;}
  .ss_qstudy_list_mid_right
  {
      text-align: right;
  }
  @media only screen and (min-width: 768px) and (max-width: 1199px){
    
    
    .form-inline .form-control {
      width:110px;
      font-size: 13px;
    }
  }
    @media only screen and (max-width: 1200px) {
    .ss_qstudy_list .tab-content{
      padding-bottom:0px;
    }
  }
   @media only screen and (min-width: 768px) and (max-width: 991px){
    .mySlickSubject .slick-list{
      overflow:inherit;
    } 
  .mySlickSubject .slick-list .slick-slide{
        display: inline-block;
    width: auto !important;
  }   
  }

  .ss_qstudy_list_mid_right{
    text-align: right!important;
  }

  .ss_qstudy_list_mid_right .profise_techer {
      height: 60px;
      width: 60px;
      overflow: hidden;
      display: inline-block;
      padding: 1px;
      border: 1px solid #e5e8ec;
      background-color: #132c54;
  }
.ss_qstudy_list_mid_right .profise_techer_two {
      height: 60px;
      width: 60px;
      overflow: hidden;
      display: inline-block;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-11">
      <div class="ss_qstudy_list">
        <div class="ss_qstudy_list_top">
            <form class="form-inline" id="search_record">
              <div class="form-group" style="float: left;">
                  <?php if ($school_tutor == 1) {   ?>
                  
                  <?php }else{ ?>
                        <div id="href_url" style="display: inline-block;">
                            <a href="" >
                              <i class="fa fa-shopping-cart" style="font-size: 35px;margin-left: 5px"></i>
                            </a>
                        </div>
                        <span  style="border: 1px solid #c7b7b7;
                                border-radius: 5px;
                                padding: 8px 6px;
                                position: absolute;
                                margin-left: 8px;
                                color: red;
                                font-weight: bold;">
                              $<strong id='resource_amount'>0</strong></span>
                              <input type="hidden" name="resource_amount" id="resource_amount" value="">
                  <?php } ?>
              </div>
              <div class="form-group">
                <label for="sbjct"></label>
                <select style="min-width: 200px;" class="form-control" id="country"  name="country" required="required">
                  <option value="">Country</option>
                  <?php foreach ($allCountry as $country){?>
                    <option value="<?= $country['id']?>">
                      <?= $country['countryName']?>
                    </option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label for="sbjct">Grade</label>
                <select class="form-control" id="grade" name="grade">
                  <option value="" name="studentGrade">Select Grade/Year/Level</option>
                    <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                    <?php foreach ($grades as $stGrade) { ?>
                      <option value="<?php echo $stGrade; ?>">
                        <?php echo $stGrade; ?>
                      </option>
                    <?php } ?>
                    <option value="13">Upper Level</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sbjct">Subject</label>
                <select class="form-control" id="subjects" name="subject_id">
                  <option value="">Select Subject</option>
                  <?php foreach ($all_subject as $subject){?>
                    <option value="<?= $subject['id']?>">
                      <?= $subject['subject_name']?>
                    </option>
                  <?php }?>
                </select>
              </div>
             
              <button type="button" class="btn btn-default" id="record_search_btn">Search</button>
            </form>
      </div>
        <div class="tab-content">
          <div class="ss_qstudy_list_bottom tab-pane active" style="height: 300px;overflow-y: scroll;" id="all_list" role="tabpanel">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Chapter</th>
                    <th>PDF</th>
                  </tr>
                </thead>

                <tbody id="moduleTable">

                </tbody>
              </table>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  /*set chapters according to subject*/
  // $(document).on('change', '#subjects', function(){
  //   var subjectId = $(this).val();
  //   $.ajax({
  //     url:'Student/renderedChapters/'+subjectId,
  //     method: 'POST',
  //     success: function(data){
  //       $('#subject_chapter').html(data);
  //     }
  //   })
  // });

  $('#record_search_btn').click(function(){
	  var country = $('#country').val();
    if(country == '')
    {
      
      alert('Country is required');
      return false;
    }
    var grade = $('#grade').val();
    if(grade == '')
    {
      //$('#subject_error').html('Subject is required');
      alert('Grade is required');
      return false;
    }
    var subjects = $('#subjects').val();
    if(subjects == '')
    {
      //$('#subject_error').html('Subject is required');
      alert('Subject is required');
      return false;
    }
    var form  = $('#search_record');
    $.ajax({
      url: 'Tutor/search_question_store',
      method: 'POST',
      data:form.serialize(),
      dataType: 'json',
      success: function(data){
        if(data.error == 0)
        {
          $('#moduleTable').html(data.data);
          $('#resource_amount').html(data.success_amount);
          $('#resource_amount').val(data.success_amount);
          $('#href_url').html(data.href_url);
          
          
        }else{
          alert(data.msg);
        }
      }
    });
  });

</script>