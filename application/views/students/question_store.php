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
              <div class="form-group">
                <label for="sbjct"></label>
                <input type="hidden" id="country" name="country" value="<?php echo $user_info[0]['country_id'] ?>">
                <select style="min-width: 200px;" class="form-control"  disabled="disabled"  required="required">
                  <?php foreach ($allCountry as $country){?>
                    <option <?php echo($country['id'] == $user_info[0]['country_id']) ? 'selected' : ''?> value="<?= $country['id']?>">
                      <?= $country['countryName']?>
                    </option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label>Grade/Year/Level </label>
                <input type="number" style="width: 50px;" required="required" class="form-control" readonly="readonly" value="<?php echo $user_info[0]['student_grade']?>" name="grade">
              </div>
              <div class="form-group">
                <label for="sbjct">Subject</label>
                <select style="min-width: 180px;" class="form-control" id="subjects" name="subject_id" required="required">
                  <option value="">Select Subject</option>
                  <?php foreach ($std_subjects as $std_subject){?>
                    <option value="<?= $std_subject['id']?>">
                      <?= $std_subject['subject_name']?>
                    </option>
                  <?php }?>
                </select>
                <span id="subject_error" style="color:red;"></span>
              </div>
             
              <button type="button" class="btn btn-default" id="record_search_btn">Search</button>
            </form>
      </div>

        <div class="tab-content">
          <div class="ss_qstudy_list_bottom tab-pane active" id="all_list" role="tabpanel" style="height: 300px;overflow-y: scroll;">
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

  $(document).ready(function(){
  $('.mySlick').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
});

  $('.subjectNameQ').click(function(){
    var sub_id = $(this).attr('subjectId');
    var grade  = <?php echo $user_info[0]['student_grade']?>;

    $.ajax({
      url: 'Student/get_question_store_data',
      method: 'POST',
      data: {
        sub_id:sub_id, 
        grade:grade, 
      },
      dataType: 'json',
      success: function(data){
        if(data.error == 0)
        {
          $('#moduleTable').html(data.data);
        }else{
          alert(data.msg);
        }
      }
    });
  });

  $('#record_search_btn').click(function(){
    var subjects = $('#subjects').val();
    if(subjects == '')
    {
      //$('#subject_error').html('Subject is required');
      alert('Subject is required');
      return false;
    }
    var form  = $('#search_record');
    $.ajax({
      url: 'Student/search_question_store',
      method: 'POST',
      data:form.serialize(),
      dataType: 'json',
      success: function(data){
        if(data.error == 0)
        {
          $('#moduleTable').html(data.data);
        }else{
          alert(data.msg);
        }
      }
    });
  });
</script>
