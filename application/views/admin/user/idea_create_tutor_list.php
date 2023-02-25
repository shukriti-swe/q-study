<div class="" style="margin-left: 15px;">
    <div class="row">
     
    <div class="col-md-12  ">
        <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true"> 
            <div class="top_headed">
              <h2>tutors all Idea</h2>

            </div> 
        </div>
        <div class="row">
          <div class="col-md-4 table-responsive text-center">
             
            <table class="rs_n_table table table-bordered" ccellspacing="30">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Idea list</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach($tutor_idea as $tutor){ ?>
                      <tr>
                        <td style="border:0;width: 35px;text-align: center;"><?=$i;?></td>
                        <td>
                          <!-- <a href="<?php echo base_url('admin/idea_create_tutor_setting/'.$tutor['tutor_id'].'/'.$tutor['idea_id'].'/'.$tutor['question_id'].'/'.$tutor['idea_no'])?>">View</a> -->

                          <a href="<?php echo base_url('admin/idea_create_tutor_setting/'.$tutor['user_id'].'/'.$tutor['question_id'])?>">View</a>
                        </td> 
                        
                      </tr>
                      <?php $i++;}?>
                      
                    </tbody>
                </table>
          </div>
           
          
        </div>
        <br>
        <br>
        <div class="form-group p2 text-center">
              <button class="btn btn-default" id="preview-button" value="">
                <i class="fa fa-arrow-circle-left"></i> Preview
              </button>
              <button class="btn btn-default" id="next-button" value="30">
                Next <i class="fa fa-arrow-circle-right"></i>
              </button>
          </div>
      </div>
  </div>
</div>
<style type="text/css">
  .w-100{
    max-width: 100px;
  }
  .top_headed{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .top_headed > div { 
    box-sizing: border-box;
    margin: 10px 10px 0 0; 
  }
  .top_headed label{
    margin-bottom: 5px;
  }
  .p2{
    padding: 10px;
  }
  .btn-text{
    background: #fff;
      color: #17a8e9;
      font-weight: bold;
      text-decoration: underline;
  }
  .rs_n_table{
    border: none;
     border-collapse: separate;
      border-spacing: 10px 0px;
  } 
  .rs_n_table a{
    color: #333;
  }
  .rs_n_table td{
    vertical-align: middle !important;
    border-color: #b7dde9 !important;
  }
  body .rs_n_table thead th{
    border: none !important;
    text-align: center;
    font-size: 14px;
      padding-left: 0;
      padding-right: 0;
  }
</style>
 