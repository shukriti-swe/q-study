<div class="container top01">
  <div class="row">
    <div class="ss_student_progress">
      <div class="heading_title">
        <h3>Find Tutor</h3>
      </div>
      <div class="search_filter">
        <form class="form-inline" method="get" action="<?php echo base_url(); ?>tutor/search">
          <div class="form-group">
            <label for="exampleInputName2">Country</label>
            <div class="select">
              <select class="form-control select-hidden" name="country_id">
                <option value="">--select country--</option>
                <?php foreach ($country_list as $country) :  ?>
                  <option value="<?php echo $country['id']; ?>"><?php echo $country['countryName']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            
            <label for="exampleInputName2"><span style="color: #959595;">Suburb</span> /city/town</label>
            <div class="select">
              <select class="form-control select-hidden" name="city">
                <option value="">--select city--</option>
                <?php if (count($city_list)) : ?>
                    <?php foreach ($city_list as $city) :  ?>
                    <option value="<?php echo $city['city'] ?>"><?php echo $city['city']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
              </select>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">State/province</label>
            <div class="select">
              <select class="form-control select-hidden" name="state">
                <option value="">--select state--</option>
                <?php if (count($state_list)) : ?>
                    <?php foreach ($state_list as $state) :  ?>
                    <option value="<?php echo $state['state'] ?>"><?php echo $state['state']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
                
              </select>
              
            </div>
          </div>
          <div class="form-group" style="min-width: 250px;">
            <label for="exampleInputEmail2">Subject</label>
            <div class="select">
              <select class="form-control select-hidden" name="teach_subjects">
                <option value="">--Select subject--</option>
                <?php if (count($subject_list)) : ?>
                    <?php foreach ($subject_list as $subject) : ?>
                      <?php if($subject['teach_subjects'] != ''):?>
                    <option value="<?php echo $subject['teach_subjects'] ?>"><?php echo $subject['teach_subjects'] ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
              </select>

            </div>
          </div>
          
          <div class="form-group">
            <button type="submit" class="btn btn_green" style="background: #df3832;"><i class="fa fa-search"></i>  Search</button>
          </div>
        </form>
      </div>
    </div>
    
    
    <?php if (isset($searchItems) && count($searchItems)) : ?>
      <div class="row">
        <div class="col-sm-1">
          <img class="ss_tutor_img" src="assets/images/ss_tutor.png" class="img-responsive" />
        </div>
        <div class="col-sm-10">
          <div class="ss_tutor_p_list">
            <?php foreach ($searchItems as $tutor) : ?>
              <div class="col-sm-6 ">
                <div class="row">
                  <div class="col-xs-3 text-center tutor_search_card">
                    <?php if (isset($tutor['image']) && file_exists('assets/uploads/'.$tutor['image'])) : ?>
                      <img src="<?php echo base_url();?>assets/uploads/<?php echo $tutor['image'];?>" alt="User Image"  width="80" height="60" class="img-responsive"><br> 
                    <?php else : ?>
                      <img src="assets/images/default_user.jpg" alt="User Image" width="80" height="60" class="img-responsive"><br>   
                    <?php endif; ?>
                    <a href="tutor/profile/<?php echo $tutor['id']; ?>" class="btn btn-default">View Profile</a>
                  </div>
                  <div class="col-xs-9">
                    <h4 style="background:#8c8c8c"><?php echo $tutor['name']; ?></h4>
                    <p>
                      <?php
                        if (strlen($tutor['short_bio'])>200) {
                            echo substr($tutor['short_bio'], 0, 200).'...';
                        } else {
                            echo $tutor['short_bio'];
                        }
                      
                        ?>             
                    </p>
                  </div>
                </div>

              </div>
            <?php endforeach; ?>
            <nav aria-label="..." class="custom_pagination">
              <ul class="pagination pagination-lg">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
              </ul>
            </nav>
            
          </div>
          
        </div><div class="col-sm-1"></div>
    <?php endif; ?>
    </div>
  </div>
</div>
