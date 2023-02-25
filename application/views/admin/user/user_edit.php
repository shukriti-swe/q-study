<?php
// <!-- shvou -->
  $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
  $duration = $tbl_setting->setting_value;
  if (isset($user_info[0]['subscription_type']) && $user_info[0]['subscription_type'] == 'trial') {
    $trail_start_date = date('Y-m-d',$user_info[0]['created']);
    $trail_end_date  = date('Y-m-d', strtotime('+'.$duration.' days', strtotime($trail_start_date)));
    $today = date('Y-m-d');
    $trail_days = $trail_end_date - $trail_start_date;
    $diff = abs(strtotime($trail_end_date) - strtotime($today));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
  }

  $usertype = $user_info[0]['user_type'];
  if ($usertype == 1) {
    $user_type_status = 'Parent';
  }else if($usertype == 2){
    $user_type_status = 'Upper Level Student';
  }else if($usertype == 3){
    $user_type_status = 'Tutor';
  }else if($usertype == 4){
    $user_type_status = 'School';
  }else if($usertype == 5){
    $user_type_status = 'Corporate';
  }else if($usertype == 6){
    $user_type_status = 'Student';
  }else if($usertype == 7){
    $user_type_status = 'Q-study';
  }
 // echo "<pre>";
 // print_r($user_info[0]);die();
?>
<!-- shvou -->
<style>
  .panel-heading{
    background-color: #2F91BA !important;
  }

  .panel-title a {
    text-decoration: none;
    color: #fff !important;
  }
</style>

<!-- flash message -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
    <?php $this->load->view('flash_message_section'); ?>
  </div>
</div>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
      <?php echo $leftnav ?>
    </div>


    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div id="successMessage" style="background: #ecdfdf;"></div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; color:white;">  Edit User </span></strong>
              </a>
            </h4>
          </div>
          <input type="hidden" name="userdelId" id="accToDel" value="<?php echo $userId; ?>">
          <form autocomplete="off" action="edit_user/<?php echo $userId; ?>" method="POST">
            <div class="row panel-body">
              <div class="DirectDeposite"> 
              </div>
              <div class="row">
                <div class="col-sm-6 text-right">
                    <!--
                  <?php if ($user_info[0]['subscription_type'] =="direct_deposite" ) {   ?>
                        <label style="color: red;"> <u>Direct Deposite </u></label> 
                        <input type="hidden" name="subscription_type" value="direct_deposite">
                  <?php }  ?>
                  -->
                  <?php if ($checkDirectDepositCourseStatus > 0) {   ?>
                        <label style="color: red;"> <u>Direct Deposite </u></label> 
                        <input type="hidden" name="subscription_type" value="direct_deposite">
                  <?php }  ?>
                  
                </div>
                <div class="col-sm-12 row">
                  <div class="col-md-7 text-right">
                    <button type="button" class="btn btn-default"><?= $user_type_status; ?></button>
                    <a  href="<?php echo base_url('Admin/userSummary/').$user_info[0]['id']; ?>" class="btn btn-default">Summary</a>
                    <div class="edit_page_action" style="display: inline-block;border: 2px solid lightgray;padding: 7px;border-radius: 5%;margin-top: 3px !important;">
                      <?php if (!$row['suspension_status']) : ?>
                        <a  style="display: inline;" href="<?php echo base_url('Admin/suspendUser/').$row['id']; ?>"><i style="padding:0px 2px 0px 2px" data-toggle="tooltip" title="suspend" class="fa fa-pause-circle-o"></i></a>
                      <?php else : ?>
                        <a  style="color:red; display: inline;" href="<?php echo base_url('Admin/unsuspendUser/').$row['id']; ?>"><i style="padding:0px 2px 0px 2px" data-toggle="tooltip" title="unsuspend" class="fa fa-play-circle-o"></i></a>
                      <?php endif; ?>
                  
                      <span class="updTrialPeriod1" data-toggle="modal" data-target="#updTrialPeriod" id="updTrialPeriod1">
                          <i style="padding-right:2px" data-toggle="tooltip" title="Extend Trial Period" class="fa fa-wrench" ></i>
                      </span>
                      
                      <span class="updPackage" data-toggle="modal" data-target="#updPackageModal" id="updPackage">
                          <i style="padding-right:2px" data-toggle="tooltip" title="Add Packages" class="fa fa-archive" ></i>
                      </span>
                      
                      <span class="delAcc" data-toggle="modal" data-target="#delAccModal" id="delAcc">
                          <i style="padding-right:2px;" data-toggle="tooltip" title="Delete User" class="fa fa-times" ></i>
                      </span> 
                    </div>
                  </div>
                  <div class="col-md-5 text-right">
                    <button class="btn btn_next" id="cancelBtn"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                    <button type="submit" class="btn btn_next" id="saveBtn">
                      <i class="fa fa-check" style="padding-right: 5px;"></i>Update
                    </button>
                  </div>
                </div>
              </div>

            </div>
            <div class="row panel-body">
              <!-- shvou -->
              
              <div class="row <?=((isset($days)))?"col-md-8":"col-md-7";?>" style="padding:0px 5px 0px 5px;">
                <div class="<?=(isset($days))?"col-sm-4":"col-sm-5"?>">Subscription Type:</div>

                <?php if ($user_info[0]['user_type']==6) : ?>

                  <?php  
                  $parent_detail = getParentIDPaymetStatus($parent[0]['parent_id']);

                  if ($parent_detail[0]['subscription_type'] =="direct_deposite") {
                    $parent_direct_deposite = 1;
                  }

                   ?>
                <?php endif ; ?>

                <?php $uSubType=$user_info[0]['subscription_type']; ?>

                <?php if ($user_info[0]['subscription_type'] =="direct_deposite" || isset($parent_direct_deposite) ) {   ?>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio1" value="trial"   <?php echo $uSubType=='trial'? ' checked':' '; ?>> Trial
                    </label>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio2" value="signup"   <?php echo $uSubType=='signup'? ' checked':' '; ?>> Signup
                    </label>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio3" value="guest"   <?php echo $uSubType=='guest'? ' checked':' '; ?>> Guest
                    </label>

                <?php }  ?>

                <?php if ($user_info[0]['subscription_type'] !="direct_deposite" ) {   ?>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio1" value="trial" required  <?= ($uSubType=='trial' && $activeTrilUser > 0) ? 'checked':''; ?>> Trial
                    </label>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio2" value="signup" required  <?php echo $uSubType=='signup'? 'checked':' '; ?>> Signup
                    </label>
                    <label class="radio-inline">
                      <input class="radio_button" type="radio" name="subscription_type" id="inlineRadio3" value="guest"  required <?php echo $uSubType=='guest'? 'checked':' '; ?>> Guest
                    </label> 
                    <!-- shvou -->
                <?php }  ?>
                
              </div>
            <!-- shvou -->
            <?php 
            $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
            $duration = $tbl_setting->setting_value;
            if (isset($duration)): ?>
              <label class="radio-inline trail_period" <?= ($user_info[0]['subscription_type'] == "trial")? "": "style='display: none'";?>> 
                <p> Days <strong style="padding: 2px 7px;border-radius:20%;border: 1px solid #ae9ebd;"><?=$duration;?></strong></p>
              </label>
            <?php endif ?>

            <?php 
              $end_subs  = $user_info[0]['end_subscription'];
              if (isset($end_subs)) {
                   $d1 = date('Y-m-d',strtotime($end_subs));
                   $d2 = date('Y-m-d');
                   $diff = strtotime($d1) - strtotime($d2);
                   $days = floor($diff/(60*60*24));
              }
            if ($user_info[0]['subscription_type'] == "guest"){ ?>

              
                <label class="radio-inline days_unlimited" style="margin: 0;padding: 0" <?= ($user_info[0]['subscription_type'] == "guest")? "": "style='display: none'";?> > 
                
                    <p> Days <input type="number" name="guest_days" min="1" id="guest_days" style="width: 46px;border: 1px solid #aeacbd;border-radius: 4px;"  value="<?= (isset($days))?$days :""; ?>"></p>
                </label>
                <label class="radio-inline days_unlimited" style="margin: 0;padding: 0" <?= ($user_info[0]['subscription_type'] == "guest")? "": "style='display: none'";?>> 
                    <p> Unlimited <input class="form-check-input" type="checkbox" name="unlimited" value="1" id="unlimited" <?= ($user_info[0]['unlimited'] == 0)?";":"checked"; ?> ></p>
                </label>
            <?php }else{ ?>
              <label class="radio-inline days_unlimited"  <?= ($user_info[0]['subscription_type'] == "signup")? "style='margin: 0;padding: 0;'": "style='margin: 0;padding: 0;display: none'";?>  > 
                    <p> Days <input type="number" name="guest_days" id="guest_days" style="width: 46px;border: 1px solid #aeacbd;border-radius: 4px;"  value="<?= (isset($days))?$days :""; ?>" ></p>
                </label>

                <label class="radio-inline days_unlimited" style="margin: 0;padding: 0;display: none"> 
                    <p> Unlimited <input class="form-check-input" type="checkbox" name="unlimited" value="1" id="unlimited" ></p>
                </label>
            <?php } ?>
            </div>   

            <div class="row panel-body">
              <div class="row" style="padding:0px 5px 0px 5px;">
                <div class="col-sm-6">
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_info[0]['name']?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="email" name="user_email" value="<?php echo $user_info[0]['user_email']?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" id="password" name="user_pawd" >
                    </div>
                    <div class="col-sm-1" style="padding:0 0 0 0px !important;"><i id="revPass" class="fa fa-eye"></i></div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Mobile No</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="mobile" name="user_mobile" value="<?php echo $user_info[0]['user_mobile']?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Ref Link</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="ref_link" name="SCT_link" value="<?php echo $user_info[0]['SCT_link']?>">
                    </div>
                  </div>
                  
                  <!-- <div class="form-group row">
                    <?php if ($user_info[0]['user_type']==1) : ?>
                      <label for="" class="col-sm-4 col-form-label">Student Info:</lavel>
                      <?php $cnt=0; ?>
                      <?php foreach ($allChild as $child) : ?>
                        <a href="edit_user/<?php echo $child['id']; ?>"><?php echo $child['name']; ?></a>
                      <?php endforeach; ?>
                    <?php endif ; ?>
                    <?php if ($user_info[0]['user_type']==6) : ?>
                      <a href="edit_user/<?php echo $parent[0]['parent_id']; ?>">Parent Info</a>
                    <?php endif ; ?>
                  </div> -->

                  <!-- </div>
                  <div class="col-sm-6"> -->

                    <div class="form-group row">
                      <label for="" class="col-sm-4 col-form-label">User Type</label>
                      <div class="col-sm-8">
                        <select id="userType" class="form-control" name="user_type" required readonly>
                          <option selected>Choose...</option>
                          <?php foreach ($user_type as $userType) : ?>
                            <option value="<?php echo $userType['id'] ?>" 
                              <?php if($user_info[0]['user_type'] == $userType['id']){echo 'selected';}?>>
                              <?php echo $userType['userType'] ?>
                            </option>
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
                        <select  class="form-control" name="parent_id">
                          <option selected value="">Choose...</option>
                          <?php foreach ($parents as $parent) : ?>
                            <option value="<?php echo $parent['id'] ?>">
                              <?php echo $parent['name'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row" id="numOfChild" style="display:none">
                      <label for="" class="col-sm-4 col-form-label">Number of children</label>
                      <div class="col-sm-8">
                        <select  class="form-control" name="numOfChild">

                          <option selected value="">Choose...</option>
                          <?php for ($a=1; $a<=10; $a++) : ?>
                            <option value="<?php echo $a;?>"><?php echo $a; ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Country</label>
                    <div class="col-sm-8">
                      <select  id="country" class="form-control" name="country_id">
                        <option value="">Choose...</option>
                        <?php foreach ($all_country as $country) : ?>
                          <option value="<?php echo $country['id'] ?>"<?php if($user_info[0]['country_id'] == $country['id']){echo 'selected';}?>>
                            <?php echo $country['countryName'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <?php 
                      $id = $user_info[0]['id'];
                      $NumberOfStudent = $this->db->where('parent_id',$id)->get('tbl_useraccount')->result_array();
                      
                    if (isset($NumberOfStudent) && count($NumberOfStudent) > 0 && $user_info[0]['user_type']==1): ?>
                        
                      <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Student Limit:</label>
                        <div class="col-sm-8">
                          <?= count($NumberOfStudent);?> 
                        </div>
                      </div>

                      <!-- <?php foreach ($school_tutor as $key => $value): ?>
                        <div class="form-group row">
                          <label for="" class="col-sm-4 col-form-label">Name: </label>
                          <div class="col-sm-8">
                            <a href="edit_user/<?php echo $value['id'];?>"> <?= $value['name'];?> </a>
                           
                          </div>
                        </div>
                      <?php endforeach ?> -->
                   <?php endif ?>
                  
                  <?php if($user_info[0]['user_type']==2 || $user_info[0]['user_type']==6): ?>
                    <div class="form-group row">
                      <label for="" class="col-sm-4 col-form-label">Grade</label>
                      <div class="col-sm-8">
                        <select class="form-control select-hidden" name="grade">
                          <option value="">Select Grade/Year/Level</option>
                          <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                          <?php foreach ($grades as $stGrade) { ?>
                            <?php $sel = isset($user_info[0])&&($stGrade==$user_info[0]['student_grade']) ? 'selected' : '';?>
                            <option value="<?php echo $stGrade; ?>" <?php echo $sel; ?>>
                              <?php echo $stGrade; ?>
                            </option>
                          <?php } ?>
                          <option value="13">Upper Level</option>
                        </select>

                      </div>
                    </div>
                  <?php endif; ?>

                </div>
                <div class="col-sm-6">
                  <?php if ($whiteboard ) {   ?> <!-- Groupboard -->
                      <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label text-right">Groupboard ID : </label>
                        <div class="col-sm-4">
                          <input type="number" name="groupboard_id" placeholder="Groupboard ID" class="form-control" id="groupboard_id" value="<?=  $user_info[0]['whiteboar_id'] == 0 ? "": $user_info[0]['whiteboar_id']; ?>">
                        </div>

                        <label for="" class="col-sm-6 col-form-label text-right">Groupboard SL : </label>
                        <div class="col-sm-4">
                          <div id="groupboard_id_sl" ></div>
                        </div>
                      </div>
                  <?php }else{ ?>
                    <input type="hidden" name="groupboard_id" placeholder="Groupboard ID" value="" >
                  <?php  }  ?>

                    <?php if ( ($user_info[0]['user_type'] == 1 || $user_info[0]['user_type'] == 2 || $user_info[0]['user_type'] == 3 || $user_info[0]['user_type'] == 5 || $user_info[0]['user_type'] == 6 )  && ($checkDirectDepositCourseStatus > 0) ) {   ?>

                      <div class="form-group row">
                          <label for="" class="col-sm-6 col-form-label text-right">Active (Direct Deposite) <span style="color: red;"> Pending  </span>  </label>
                          <div class="col-sm-6">
                           <input class="form-check-input" type="checkbox" name="direct_deposite" value="1" id="direct_deposite"  >
                         </div>
                       </div>
                     <?php }  ?>

                     <?php if ( ($user_info[0]['user_type'] == 1 || $user_info[0]['user_type'] == 2 || $user_info[0]['user_type'] == 3 || $user_info[0]['user_type'] == 5 ||  $user_info[0]['user_type'] == 6) &&  ($checkDirectDepositCourseStatus == 0) && ($checkDirectDepositCourse > 0)  ) {   ?>

                      <div class="form-group row">
                          <label for="" class="col-sm-6 col-form-label text-right">Active (Direct Deposite)</label>
                          <div class="col-sm-6">
                            <input class="form-check-input" type="checkbox" name="direct_deposite" value="1" checked id="direct_deposite">
                          </div>
                       </div>

                     <?php }  ?>

                    <div class="form-group row">
                      <label for="" class="col-sm-6 col-form-label text-right">Address</label>
                      <div class="col-sm-6">
                       <input class="form-check-input" type="checkbox" name="address_status" value="1" id="address_status">
                     </div>
                   </div>
                   <div class="form-group row">
                      <label for="" class="col-sm-6 col-form-label text-right">
                        Inactive</label>
                      <div class="col-sm-6">
                       <input class="form-check-input" type="checkbox" <?= ($user_info[0]['subscription_status'] == 0 && $user_info[0]['subscription_status'] != '')?'checked':''; ?> >
                     </div>
                   </div>

                   <!--<?php if ($user_info[0]['subscription_status'] == 1): ?>-->
                   <!--<div class="form-group row">-->
                   <!--   <label for="" class="col-sm-6 col-form-label text-right">-->
                   <!--     Active</label>-->
                   <!--   <div class="col-sm-6">-->
                   <!--    <input class="form-check-input" type="checkbox" checked>-->
                   <!--  </div>-->
                   <!--</div>-->
                   <!--<?php endif ?>-->

                    <div class="form-group row">
                      <label for="" class="col-sm-6 col-form-label text-right">Suspend</label>
                      <div class="col-sm-6">
                       <input class="form-check-input" type="checkbox" name="suspension_status" value="1" id="suspension_status" <?php echo !$user_info[0]['suspension_status'] ? '':'checked'; ?>>
                     </div>
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-sm-6 col-form-label text-right">Extend Trial Period</label>
                    <div class="col-sm-6">
                      <input class="form-check-input" type="checkbox" name="trial_end_date" value="1" 
                      <?php if($user_info[0]['trial_end_date']){echo 'checked';}?> id="isExtendTrialPeriod">
                    </div>
                  </div>


                  <?php if ($user_info[0]['user_type'] == 3 && $user_info[0]['subscription_type'] !="direct_deposite"): ?>
                      <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label text-right">Permission</label>
                        <div class="col-sm-6">
                         <input class="form-check-input" type="checkbox" name="tutor_permission" value="1" id="tutor_permission" <?= ($user_info[0]['tutor_permission'] == 1) ? "checked" : "";?> >

                        </div>
                    </div>
                  <?php endif ?>

                  <?php if ($user_info[0]['user_type'] == 6): ?>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label text-right">Stop SMS</label>
                        <div class="col-sm-6">
                         <input class="form-check-input" type="checkbox" name="sms_status_stop" value="1" id="sms_status_stop" <?= ($user_info[0]['sms_status_stop'] == 1) ? "checked" : "";?> >

                        </div>
                     </div>
                  <?php endif ?>



                    <div class="form-group row">
                      <label for="" class="col-sm-6 col-form-label text-right">Recommended Tutor</label>
                      <div class="col-sm-6">
                       <input class="form-check-input" type="checkbox" name="recommended_tutor" value="1" id="recommended_tutor">
                     </div>
                   </div>
                    
                    <?php if ( $user_info[0]['user_type'] == 3  ) {   ?>
                        <div class="form-group row">
                          <label for="" class="col-sm-8 col-form-label"><a data-toggle="modal" data-target="#account_details_modal"><u>Bank Account Details
                          </u><span style="color:red"> <?= (isset($account_detail)?'(Active)':'') ?> </span> </a></label>
                          <div class="col-sm-2">
                             
                          </div>
                       </div>
                     <?php }  ?>
                   
                   <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>Student Prize</td>
                        <td>
                          <?php if (count($student_prize_list) > 0 && (!isset($checkUnavailableProduct)) && $student_prize_list[0]['status'] != 'paid'): ?>
                            <a data-toggle="modal" data-target="#studentWonPrizeDetails"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($student_prize_list[0]['status'] == 'paid'){ ?>
                            <input type="checkbox" name="student_prize_list" value="1" checked>
                          <?php }else{ ?>
                            <input type="checkbox" name="student_prize_list" value="1">
                            <?php if (count($student_prize_list) > 0): ?>
                                <input type="checkbox" name="student_prize_unavailable" value="1" <?= (isset($checkUnavailableProduct))?'checked':''?>>
                                <i class="fa fa-window-close" aria-hidden="true" style="position: relative;top: -16px;right: 19px;"></i>
                            <?php endif ?>
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <?php if ( ($user_info[0]['user_type'] == 1 || $user_info[0]['user_type'] == 2 || $user_info[0]['user_type'] == 3 || $user_info[0]['user_type'] == 5 || $user_info[0]['user_type'] == 6  )    &&  ($checkDirectDepositCourseStatus == 0) ) {   ?>
                              Direct Deposit(normal course)
                            <?php }else{ ?>
                                Direct Deposit(normal course)
                            <?php } ?>
                        </td>
                        <td>
                          <?php if ( ($user_info[0]['user_type'] == 1 || $user_info[0]['user_type'] == 2 || $user_info[0]['user_type'] == 3 || $user_info[0]['user_type'] == 5 || $user_info[0]['user_type'] == 6  )  &&  ($checkDirectDepositCourse > 0) && ($checkDirectDepositCourseStatus != 0)) {   ?>
                            
                            <a><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ( ($user_info[0]['user_type'] == 1 || $user_info[0]['user_type'] == 2 || $user_info[0]['user_type'] == 3 || $user_info[0]['user_type'] == 5 || $user_info[0]['user_type'] == 6  )  && ($checkDirectDepositCourseStatus == 0) && ($checkDirectDepositCourse > 0) ) {   ?>
                            <input type="checkbox" name="" checked>
                          <?php }else{ ?>
                            <input type="checkbox" name="direct_deposite"  value="1" id="direct_deposite">
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            Direct Deposit(resourse)
                        </td>
                        
                        <td>
                          <?php if (($deposit_resources_status == 0)) {   ?>
                            <a><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($deposit_resources_status == 1) { ?>
                            <input type="checkbox" name="deposit_resources_status" value="1" checked>
                          <?php }else{ ?>
                            <input type="checkbox" name="deposit_resources_status" value="1">
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            Groupboard (trial)
                         </td>
                        <td>
                          <?php if (isset($groupboard_trial) && $user_info[0]['whiteboar_id'] == 0) {   ?>
                            <a><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (isset($groupboard_trial)  && $user_info[0]['whiteboar_id'] != 0) {   ?>
                            <input type="checkbox" checked>
                          <?php }else{ ?>
                            <input type="checkbox">
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            Groupboard(signup)
                        </td>
                        <td>
                          <?php if (isset($groupboard_signup) && $user_info[0]['whiteboar_id'] == 0) {   ?>
                            <a><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (isset($groupboard_signup)  && $user_info[0]['whiteboar_id'] != 0) {   ?>
                            <input type="checkbox" checked>
                          <?php }else{ ?>
                            <input type="checkbox">
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Tutor(commission)</td>
                        <td>
                          <?php if ( (isset($tutorpendingComissions) || isset($tutorpaidComissions)) && $tutorpendingComissions != 0 ) {   ?>
                            <a data-toggle="modal" data-target="#tutorCommisionDetails"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                            
                          <?php if ($tutorpendingComissions == 0 && $tutorpaidComissions != 0) {   ?>
                                <input type="checkbox" name="tutorCommisionPaid" value="1" checked>
                          <?php }else{ ?>
                                <input type="checkbox" name="tutorCommisionPaid" value="1">
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Vocabulary(commission)</td>
                        <td>
                          <?php if (isset($vocabularyCommission) && $vocabularyCommission != 0) {   ?>
                            <a href="q-dictionary/payment"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (isset($vocabularyCommission) && $vocabularyCommission == 0) {   ?>
                                <input type="checkbox" name="tutorCommisionPaid" value="1" checked>
                          <?php }else{ ?>
                                <input type="checkbox" name="tutorCommisionPaid" value="1">
                          <?php } ?>
                        </td>
                      </tr>

                      <tr>
                        <td>Inative</td>
                        <td></td>
                        <td>
                          <input type="checkbox" name="">
                        </td>
                      </tr>
                      <tr>
                        <td>Inative tutor/corporate/school</td>
                        <td></td>
                        <td>
                          <input type="checkbox" name="">
                        </td>
                      </tr>

                      <tr>
                        <td>Student who score 90% up</td>
                        <td>
                          <?php if (isset($studentScore)) {   ?>
                            <a data-toggle="modal" data-target="#studentScoreDetails"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                          <input type="checkbox" name="">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <?php if (isset($user_message)) {   ?>
                            <a href="contact-mail" > Email <span style="color:red;font-weight:bold;display: inline;"><?= (isset($user_message))?$user_info[0]['SCT_link']:'' ?></span>
                                </a>
                          <?php }else{ ?>
                            Email
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (isset($user_message) && ($messages_users[0]['status'] != 'seen') ) {   ?>
                            <a><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                          <?php } ?>
                        </td>
                        <td>
                            
                          <?php if (($messages_users[0]['status'] == 'seen')) {   ?>
                            <input type="checkbox" name="checkUserMessage" value="1" checked>
                          <?php }else{ ?>
                            <input type="checkbox" name="checkUserMessage" value="1" >
                          <?php } ?>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                  <div class="" style="padding: 8px 3px;">
                    <a data-toggle="modal" data-target="#messageComposeModal" style="text-decoration: underline;cursor:pointer">Compose</a>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12" style="">
                    <!-- info here -->
                    <div class="info-details" style="margin-left: 12px;margin-top: 7px;">
                        <?php if ($user_info[0]['user_type']==3) : ?>
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Student Info:</label>
                          <?php $cnt=0; ?>
                          <?php foreach ($studentsRefLink as $srl) : ?>
                            <div class="col-sm-2">
                              <a  href="edit_user/<?php echo $srl['id']; ?>"><?php echo $srl['name']; ?></a>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <?php endif ; ?>
                        <?php if (isset($tutorRefLink)) : ?>
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Tutor Info:</label>
                          <?php $cnt=0; ?>
                          <?php foreach ($tutorRefLink as $srl) : ?>
                            <div class="col-sm-2">
                              <a  href="edit_user/<?php echo $srl['id']; ?>"><?php echo $srl['name']; ?></a>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <?php endif ; ?>
                        
                        <?php if ($user_info[0]['user_type'] == 6) : ?>
                            
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Parent Info:</label>
                          <div class="col-sm-2">
                          <a href="edit_user/<?php echo $user_info[0]['parent_id']; ?>">Parent</a>
                          </div>
                        </div>
                        <?php endif ; ?>

                        <?php 
                          $id = $user_info[0]['id'];
                          $NumberOfTutor = $this->db->where('parent_id',$id)->get('tbl_useraccount')->result_array();
                            
                          if (isset($NumberOfTutor) && count($NumberOfTutor) > 0 && $user_info[0]['user_type'] == 5): ?>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Teacher Info:</label>
                            <?php foreach ($NumberOfTutor as $NOfT => $value): ?>
                              <div class="col-sm-2">
                                <a  href="edit_user/<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
                              </div>
                            <?php endforeach ?>
                          </div>
                          <?php endif ?>

                        <?php 
                          $id = $user_info[0]['id'];
                          $NumberOfTutor = $this->db->where('parent_id',$id)->limit(4,0)->get('tbl_useraccount')->result_array();
                            
                         if (isset($NumberOfTutor) && count($NumberOfTutor) > 0 && $user_info[0]['user_type'] == 4): ?>
                         <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Teacher Info:</label>
                            <div id="returnSchoolTeacher">
                            <?php foreach ($NumberOfTutor as $value): ?>
                              <div class="col-sm-2">
                                <a  href="edit_user/<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
                              </div>
                            <?php endforeach ?>
                            </div>
                            <div class="col-sm-2">
                              <button type="button" style="border: none;" value="4" id="schoolTutorNext" parent-id="<?= $id;?>"><i class="fa fa-arrow-right"></i></button>
                            </div>
                         </div>
                        <?php endif ?>

                      <div class="form-group row">
                        <?php 
                          $parent_id = $user_info[0]['parent_id'];
                          $corporate = $this->db->where('id',$parent_id)->get('tbl_useraccount')->row();
                          if (isset($corporate) && $user_info[0]['user_type'] == 3): ?>
                            <label class="col-sm-2 col-form-label" style="margin: 0;padding: 0;margin-left: 15px;"><?=($corporate->user_type == 5)?"Corporate Info:":"School Info:" ?></label>
                            <div class="col-sm-2" style="margin: 0;padding: 0;">
                              <a  href="edit_user/<?php echo $corporate->id; ?>"><?php echo $corporate->name; ?></a>
                            </div>
                        <?php endif ?>
                      </div>
                      <div class="form-group row">
                        <?php 
                          $id = $user_info[0]['id'];
                          $students = $this->db->where('parent_id',$id)->get('tbl_useraccount')->result_array();
                          if (isset($students) && $user_info[0]['user_type'] == 1): ?>
                            <label class="col-sm-2 col-form-label">Students Info: </label>
                            <?php foreach ($students as $value): ?>
                              <div class="col-sm-2">
                                <a  href="edit_user/<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
                              </div>
                            <?php endforeach ?>
                        <?php endif ?>
                      </div>
                    </div>
                    <div class="ss_top_s_course">
                      <ul id="course_ul">
                        <?php echo isset($courses)?$courses:''; ?>
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
<style>
    .county_by_course{
        position: absolute;
        right: 10px;
        bottom: 10px;
    }
</style>
<!-- delete user account modal -->
<div class="modal fade" id="delAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Delete User</h4>
        </div>
      <div class="modal-body">

      <div class="row"> 
        <div class="col-md-12 text-center">
          <p for="recipient-name" class="control-label ">Really want to delete this user?</p>
        </div>
      </div> 
    
      <div class="row">
        <div class="col-md-12 text-center">
          <button class="btn btn-success" data-dismiss='modal'>No</button>
          <button class="btn btn-danger" id="delAccModalBtn" >Yes</button>
        </div>
     </div>
    </div>
    </div>
 </div>
</div>

<!-- tutor commission details modal -->
<div class="modal fade" id="tutorCommisionDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 80%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h6 class="modal-title" id="exampleModalLabel">Tutor Commission Details</h6>
        </div>
        <div class="modal-body">
          <div class="row"> 
            <div class="col-md-6 text-center">
                <b>Paid Commission: $<?= isset($tutorpaidComissions)?$tutorpaidComissions:0; ?></b> 
            </div>
            <div class="col-md-6 text-center">
                <b style="color:red">Pending Commission: $<?= isset($tutorpendingComissions)?$tutorpendingComissions:0; ?></b> 
            </div>
          </div> 
          <br>
          <div class=" text-right">
            <button class="btn btn-success" data-dismiss='modal'>Close</button>
          </div>
        </div>
     </div>
    </div>
</div>


<!-- tutor message Compose Modal details modal -->
<div class="modal fade" id="messageComposeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 60%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h6 class="modal-title" id="exampleModalLabel">Message Compose</h6>
        </div>
        <div class="modal-body">
        <form id="sendMessageCompose">
          <div class="row"> 
            <div class="col-md-12 text-center">
                <textarea class="form-control" aria-label="With textarea" rows="4" name="sendMessage" id="sendMessage"></textarea>
                <input type="hidden" name="reciver_id" id="reciver_id" value="<?= $user_info[0]['id'] ?>">
            </div>
          </div> 
          <br>
          <div class="">
            <button type="button" class="btn btn-default" id="sendMessageComposeId">Send</button>
          </div>
         </form>
        </div>
     </div>
    </div>
</div>

<!-- tutor commission details modal -->
<div class="modal fade" id="studentWonPrizeDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 80%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h6 class="modal-title" id="exampleModalLabel">Student Prize Details</h6>
        </div>
        <div class="modal-body">
          <div class="row"> 
            <?php foreach ($student_prize_list as $key => $value): ?>
            <div class="col-md-6 text-center">
               <img src="<?= base_url()?>img/product/<?= $value['image'] ?>" style="">
               <label><?= $value['product_title'] ?> <b>(<?= $value['status'] ?>)</b></label>
            </div>
            <?php endforeach ?>
          </div> 
          <br>
          <div class=" text-right">
            <button class="btn btn-success" data-dismiss='modal'>Close</button>
          </div>
        </div>
     </div>
    </div>
</div>
<!-- account details modal -->
<!-- The Modal -->
<div class="modal" id="account_details_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Account Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
		<p class="payment-errors"></p>
 	 	<div class="ss_payment_form_top">
 	 		<a href=""><img src="<?php echo base_url();?>assets/images/icon_paypal.jpg"></a>
 	 		<span>Paypal account details: </span> <input class="form-control" type="email" value="<?= (isset($account_detail->paypal_details))?$account_detail->paypal_details:null?>" name="paypal_details" id="paypal_details" style="width: 50%;display: inline-block;">
 	 	</div>
 	 	<div class="ss_payment_form_bottom">
 	 		<b>Bank Details</b>
 	 		<div class="row">
 	 		</div>
 	 		<textarea class="form-control" name="bank_details" id="bank_details" rows="10"><?= (isset($account_detail->bank_details))?$account_detail->bank_details:null?></textarea>
 	 	</div>
 	 	<div class="ss_payment_form_agre" style="padding-left: 15px !important;padding: 1px;">
	    	<div class="row">
	    	</div>
 	 	</div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="" onclick="myFunction()">Copy</button>
      </div>

    </div>
  </div>
</div>

<!-- student account details details modal -->
<!-- The Modal -->
<div class="modal fade" id="studentScoreDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 50%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h6 class="modal-title" id="exampleModalLabel">Student Score</h6>
        </div>
        <div class="modal-body">
          <div class="row"> 
            <div class="col-md-12">
                <b>Number of Test: <?= isset($studentScoreDetails[0]['total_row'])?$studentScoreDetails[0]['total_row']:0; ?></b> 
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <b>Total Score: <?= isset($studentScoreDetails[0]['total_percentage'])?$studentScoreDetails[0]['total_percentage']:0; ?></b> 
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <b>Percentage: <?= isset($studentScoreDetails[0]['percentage'])?number_format($studentScoreDetails[0]['percentage']):0; ?>%</b> 
            </div>
          </div> 
          <br>
          <br>
          <div class=" text-right">
            <button class="btn btn-success" data-dismiss='modal'>Close</button>
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
  

    //add/hide form fields based on user type selection
    $(document).on('change', '#userType', function(){
      var userType = this.value;
      if(userType == 1) { 
        $('#numOfChild').css('display', 'block');

            //hide other types
            $('#parent').css('display', 'none');
            $('#grade').css('display', 'none');

          }else if(userType == 2 || userType == 6){
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

    $('#revPass').on('click', function(){
      $('#password').attr('type', 'text')
    })

    //get courses on country change
    $(document).on('change', '#country', function(){
      var countryId = $(this).val();
      var studentId = <?php echo $user_info[0]['id']; ?> 
      $.ajax({
        url:'Admin/coursesByCountry/'+countryId+'/'+studentId,
        success: function(response){
          $('#course_ul').html(response);          
        }
      })
    })

    $( "#groupboard_id" ).change(function() {

      var studentId = <?php echo $user_info[0]['id']; ?> 

      // <!-- Groupboard --> 
       $.ajax({
        url:'Admin/check_groupboardSerial/'+this.value+'/'+studentId,
        success: function(response){

          if ( response == "This room is not available" || response == "No rooms"  ) {
           
            $('#groupboard_id').val(0);
            $('#groupboard_id_sl').html(response); 
          }else{
            $('#groupboard_id_sl').html(response);  
          }    
        }
      })
    });


    // added AS 

    $('.radio_button').change(function(){
      var value = $(this).val();
      if (value == 'guest') {
        $('.days_unlimited').show();
        $('.trail_period').hide();
        $('#guest_days').attr('disabled',false);
        $('#unlimited').attr('disabled',false);
      }else if(value == 'signup'){
        $('.days_unlimited').show();
        $('.trail_period').hide();
        $('#guest_days').attr('disabled',false);
        $('#unlimited').attr('disabled',true);

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

    $('#schoolTutorNext').click(function(){
      var val = $(this).val();
      var parent_id = $(this).attr('parent-id');
      $.ajax({
        'url': 'Admin/schoolTutorNext',
        data: {val:val,parent_id:parent_id},
        method:'POST',
        success : function(res){
            if(res == 'empty'){
                return false;
            }
          $('#returnSchoolTeacher').html(res);
          var value = parseInt(val) + 4;
          $('#schoolTutorNext').val(value);
        }
      })

    })

        /*delete modal button click action*/
     $('#delAccModalBtn').on('click', function(){
      var uId = $('#accToDel').val();
        // console.log(uId);
        $.ajax({
          'url': 'Admin/deleteuser',
          data: {uId:uId},
          method:'POST',
          success : function(data){
            alert('Account deleted Successfully');
            window.location='user_list';
          }
      })
    })
    
    
      $('#sendMessageComposeId').on('click', function(){
        var textmessage  = $('#sendMessage').val();
        var reciver_id   = $('#reciver_id').val(); 
        $.ajax({
          'url': 'Admin/sendMessageCompose',
          data: {textmessage:textmessage,reciver_id:reciver_id},
          method:'POST',
          success : function(data){
              $('#messageComposeModal').modal('hide');
              $('#successMessage').html("<div class='alert alert-primary' role='alert'>Message send successfully!!</div>");
          }
      })
    })
    
    function myFunction() {
      /* Get the text field */
      var copyText = document.getElementById("bank_details");
    
      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
      /* Copy the text inside the text field */
      document.execCommand("copy");
    
      /* Alert the copied text */
      //alert("Copied the text: " + copyText.value);
    }
  </script>