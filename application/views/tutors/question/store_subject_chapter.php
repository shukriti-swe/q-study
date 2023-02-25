<style>
  .serial-label{
    color: #337ab7;
    margin-bottom: 5px;
    display: block;
  }
  #pdf_serial{
    width:50px;
    border-radius: 0px;
  }
  #chapter_serial{
    width:50px;
    border-radius: 0px;
  }
  .stroe-box{
    border:1px solid #ccc;
    padding: 15px;
    min-height: 250px;
  }
  .file-field{
    border: none;
    border-radius: 0px;
    box-shadow: none;
  }
  .person{
    height: 25px;
    align-items: center;
    margin-top: 8px;
    color: #555555;
    text-decoration: underline;
  }
  .title-text{
    box-shadow: none;
    margin-bottom: 5px;
  }
  .title-content-one{

    position: relative;
  }
  .title-content-two{
    
    position: relative;
  }
  .title-content-one .form-control{
    width:100%;
  }
  .title-content-two .form-control{
    width:100%;
  }
  .title-content-one i{
    color: #4c8e0c;
    cursor: pointer;
    position: absolute;
    top: 8px;
    right: -35px;
  }
  .title-content-two i{
    color: #4c8e0c;
    cursor: pointer;
    position: absolute;
    top: 8px;
    right: -35px;
  }
  .color-red{
    color:red;
  }
  .record-img-li{
    padding: 3px 10px;
    border: 1px solid #ccc;
  }
</style>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  All Subject & Chapters </span></strong>
              </a>
            </h4>
          </div>

          <div class="panel-body">
            <div id="accordion">
              <?php echo $allSubs; ?>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
  <div class="modal fade" id="EditSubjectName" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="subject_form">
                        <div class="form-group">
                            <label style="padding: 10px 0px;">Subject Name</label>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="subject name" name="subject-name" value="" required>
                            <input type="hidden" name="subject-id" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_subject_btn">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/sweet_alert.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion();
  });

  $(document).on('click', '.delChapIcon', function(){
    var chapId = $(this).parent('td').attr('id');
    var obj = $(this);
    swal({
      title: "Are you sure?",
      text: "Once deleted, all question associated with this chapter will be deleted",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:'delete_store_chapter/'+chapId,
          method:'get',
          success:function (data) {
            if(data=='true'){
              swal("Chapter has been deleted successfully!", {
                icon: "success",
              }).then(obj.closest('tr').fadeOut(4000))
            } else {
              swal("Chapter not deleted!", {
                icon: "warning",
              });
            }
          }
        })//end ajax
        
      } else {
        swal("Chapter not deleted.");
      }
    });
  });

  $(document).on('click', '.delSubBtn', function(){
    var subId = $(this).attr('subId');
    swal({
      title: "Are you sure?",
      text: "Remember, all chapters and question associated with this subject will be deleted",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:'delete_store_subject/'+subId,
          method:'get',
          success:function (data) {
            if(data=='true'){
              swal("Subject has been deleted successfully!", {
                icon: "success",
              }).then(window.location.reload());  
            } else {
              swal("Subject not deleted!", {
                icon: "warning",
              });
            }
          }
        })//end ajax
        
      } else {
        swal("Subject not deleted.");
      }
    });
  });

</script>
<script>
    $(".subject_edit_btn").click(function () {
        var subjectId = $(this).data('subjectid');
        var subject_name = $(this).data('subject_name');
        $('input[name="subject-name"]').val(subject_name);
        $('input[name="subject-id"]').val(subjectId);
        $("#EditSubjectName").modal('show');
    });
    $("#update_subject_btn").click(function () {
        var data = $('#subject_form').serialize();
        $.ajax({
            method: 'POST',
            url:'update-store-subject-name',
            data: data,
            success: function(response){
                $("#EditSubjectName").modal('hide');

                swal('Updated',response,'success');
                $('#subject_form')[0].reset();
                window.location.reload();
            },
            error: function(){
                alert('Could not add data');
            }
        });
    });
</script>
