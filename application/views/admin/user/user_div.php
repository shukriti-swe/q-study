<style>
.table-bordered>thead>tr>th{
 border: 1px solid #000 !important; 
}
.dataTables_filter{
  margin-bottom: 5px;
}
</style>


<table id ='myTable' class="table table-bordered">
   <thead>
    <tr>
      <th>Country Name</th>
      <th>User Type</th>
      <th>User Name</th>
      <th>User Email</th>
      <th style="width: 95px;">Action</th>
  </tr>
</thead>
<?php
 // echo "<pre>";
 // print_r($total_registered);die();
?>

<tbody>

    <?php foreach ($total_registered as $row) {?>

      <?php 

       // Groupboard 
      $color = '';

      $color = in_array($row['id'], $groupboard_assigner)  ? "red":"";
      $color = in_array($row['id'], $groupboard_taker)  ? "black":$color;

       ?>

        <tr id="<?php echo $row['id']; ?>">
            <td><a><?php echo $row['countryName'];?></a></td>

            <?php if (!empty($color)) { ?>
              <td>
                <?php echo $row['userType'];?>
                <p  style="color: <?= $color; ?>; font-weight: 600; ">
                  (Whiteboard)
                </p>
                <?php
                  $end_subscription = $row['end_subscription'];
                  if (isset($end_subscription)) {
                     $d1 = date('Y-m-d',strtotime($end_subscription));
                     $d2 = date('Y-m-d');
                     $diff = strtotime($d1) - strtotime($d2);
                     $days = floor($diff/(60*60*24));
                  }
                  if (isset($days) && $days < 0 && $row['user_type'] == 3): ?>
                  <p style="color:blue;font-weight: bold;"><u><a href="<?= base_url()?>all-groupboard">Available</a></u></p>
                <?php endif ?>

              </td>
            <?php  }else{ ?>
              <td>
				  <?php echo $row['userType'];?>  <?= ($row['userType'] == "Tutor" && $row['parent_id'] != null )? "(School)<br><p style='color:black;font-weight:bold'>(Whiteboard)</p>":""; ?>
				  <?= ($row['userType'] == "Tutor" && $row['subscription_type'] == "trial" )? "<br><p style='color:red;font-weight:bold'>(Whiteboard)</p>":""; ?>
			  </td>
            <?php  } ?>

            
            <td id="userName">
                <a href="edit_user/<?php echo $row['id'];?>">
                  <!--  Groupboard  -->
                  <?php if (!empty($color)) { ?>
                      <p  style="color: <?= $color; ?>; font-weight: 600; ">
                        <?php echo $row['name'];?>
                      </p>
                  <?php  }else{ ?>
                    <?php echo $row['name'];?>
                  <?php  } ?>
                </a>

                <?php  
                  if ($row['subscription_type']  ==  "guest") {
                    echo "<span style='color:#cccc29;text-decoration: underline;'>Guest</span> <span  style='color:#cccc29;' > ".date("F j, Y" , $row['created'] )." </span>";
                  }

                  if ($row['subscription_type']  ==  "trial") {

                   $trail_period = trailPeriod();
                    $Date =  date("Y-m-d");
                    $x = date('Y-m-d', $row['created'] );
                    $y = strtotime($x. ' + '.$trail_period[0]['setting_value'].' days');

                    if ($y > strtotime( date('Y-m-d') ) ) {
                      echo "<span style='color:#98051a;text-decoration: underline;'>Trial  </span> <span  style='color:#98051a;' > ".date("F j, Y" , $row['created'] )." </span> ";
                    }else{
                      echo "<span style='color:#d0d0d0;text-decoration: underline;'>Trial </span> <span  style='color:#d0d0d0;' > ".date("F j, Y" , $row['created'] )." </span> ";
                    }

                    
                  }

                  if ($row['subscription_type']  ==  "direct_deposite" && $row['direct_deposite'] == 0 ) {
                    echo "<span style='color:#e43a52;text-decoration: underline;'>Direct Deposit</span> <span  style='color:#e43a52;' > ".date("F j, Y" , $row['created'] )." </span> ";

                     if ($row['end_subscription']) {
                      echo "<span style='color:#d67b7b;text-decoration: underline;'>END:</span> <span  style='color:#e43a3a;' > ".date("F j, Y" , strtotime($row['end_subscription'])  )." </span>";
                    }
                  }

                  if ($row['subscription_type']  ==  "direct_deposite" && $row['direct_deposite'] == 1 ) {
                    echo "<span style='color:#6ce43a;text-decoration: underline;'>Registration</span> <span  style='color:#6ce43a;' > ".date("F j, Y" , $row['created'] )." </span> ";

                    if ($row['end_subscription']) {
                      echo "<span style='color:#d67b7b;text-decoration: underline;'>END:</span> <span  style='color:#e43a3a;' > ".date("F j, Y" , strtotime($row['end_subscription'])  )." </span>";
                    }
                  }

                  if ( ( $row['subscription_type']  ==  "" || $row['subscription_type'] == "signup" ) && $row['userType']  !=  "Student"  ) {

                    if ( strtotime($row['end_subscription'])  > strtotime(date("Y-m-d"))  ) {
                      echo "<span style='color:#6ce43a;text-decoration: underline;'>Registration</span> <span  style='color:#6ce43a;' > ".date("F j, Y" , $row['created'] )." </span> <br>";

                      if ($row['end_subscription']) {
                        echo "<span style='color:#d67b7b;text-decoration: underline;'>END:</span> <span  style='color:#e43a3a;' > ".date("F j, Y" , strtotime($row['end_subscription'])  )." </span>";
                      }

                    }else{


                      echo "<span style='color:#d0d0d0;text-decoration: underline;'>Registration</span> <span  style='color:#d0d0d0;' > ".date("F j, Y" , $row['created'] )." </span>  ";

                      if ($row['end_subscription']) {
                        echo "<span style='color:#d67b7b;text-decoration: underline;'>END:</span> <span  style='color:#e43a3a;' > ".date("F j, Y" , strtotime($row['end_subscription'])  )." </span>";
                      }


                    }
                  }
                ?>
            </td>
            <td ><?php echo $row['user_email']; ?></td>
            <input type="hidden" id="usersTrialEnd" value="<?php echo strlen($row['trial_end_date'])? date('d-M-Y', strtotime($row['trial_end_date'])) : ''; ?>">
            <td>
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
                </td>

            </tr>
    <?php }?>
    </tbody>
</table>

<!-- Update user trial period -->
<div class="modal fade" id="updTrialPeriod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Extend Trial period</h4>
    </div>
    <div class="modal-body">
        <p id="userTrialInfo"></p><br><br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label for="recipient-name" class="control-label">Extend Trial Duration(Days)</label>
                </div>
                <div class="col-md-8">
                    <input type="hidden" id="hiddenUserId" value="">
                    <input type="number" min="1" max="30" class="form-control" id="extendAmound" placeholder="Days">
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="updTrialBtn" class="btn btn-primary">Save</button>
    </div>
</div>
</div>
</div>

<!-- Update user package -->
<div class="modal fade" id="updPackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Add package</h4>
    </div>
    <div class="modal-body">
        <p id="usersPackageInfo"></p><br><br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="recipient-name" class="control-label">Add packages</label>
                </div>
                <div class="col-md-8">
                    <input type="hidden" id="hiddenUserId" value="">
                    <form id="pkgSel">
                        <select class="form-control select2" multiple="multiple" id="notTakenCourses" name="notTakenCourses">

                        </select>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="updPkgBtn" class="btn btn-primary">Save</button>
    </div>
</div>
</div>
</div>

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

<div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" id="updTrialBtn" class="btn btn-primary">Save</button> -->
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
    //select2 effect
    $('.select2').select2();

    $('.updTrialPeriod1').on('click', function(){
        var userId = $(this).closest('tr').attr('id');
        var userName = $(this).closest('tr').find('#userName').html();
        var usersTrialEnd = $(this).closest('tr').find('#usersTrialEnd').val();
        var info = '<strong>' + userName+"" + ' trial end after : </strong>'+usersTrialEnd ;
        $('#userTrialInfo').html(info);
        $('#hiddenUserId').val(userId);
    });

    //update trial modal button action
    $("#updTrialBtn").on('click', function(){
        var userId = $('#hiddenUserId').val();
        var extendAmount = $('#extendAmound').val();
        $.ajax({
            url:'Admin/extendTrialPeriod',
            method: 'POST',
            data : {'userId': userId, 'extendAmound': extendAmount},
            success: function(data){
                alert('User trial extended successfully');
                $('#updTrialPeriod').modal('toggle');
            },
        });
    });

    //add package icon action
    $('.updPackage').on('click', function(){
        var userId = $(this).closest('tr').attr('id');
        var userName = $(this).closest('tr').find('#userName').html();
        $('#hiddenUserId').val(userId);

        $.ajax({
            url:'Admin/usersCurrentPackages',
            method: 'POST',
            data: {'userId': userId},
            success: function(data){
                var userInfo = userName+"'s current packages : "+data;
                $('#usersPackageInfo').html(userInfo);
            }
        })
        $.ajax({
            url:'Admin/packageNotTaken',
            method: 'POST',
            data:{'userId': userId},
            success: function(data){
                $('#notTakenCourses').html(data);    
            }
        })
    });

    //package save
    $('#updPkgBtn').on('click', function(){
        var pkgSelected = $('#pkgSel').serializeArray();
        var userId =  $('#hiddenUserId').val();
        $.ajax({
            url:'Admin/addPackages',
            method: 'POST',
            data:{'userId': userId, 'pkgSelected':pkgSelected},
            success: function(data){
                alert('Package Updated Successfully');
                $('#updPackageModal').modal('toggle');
            }
        })
    });


     //data table on user list    
     $(document).ready( function () {
      $('#myTable').DataTable();
    });

     /*delete modal button click action*/
     $('#delAccModalBtn').on('click', function(){
      var uId = $('#accToDel').val();
        //console.log(uId);
        $.ajax({
          'url': 'Admin/deleteuser',
          data: {uId:uId},
          method:'POST',
          success : function(data){
            alert('Account deleted Successfully');
            $('tr#'+uId).fadeOut(5000);
            $('#delAccModal').modal('hide');
        }
      })
    })

</script>