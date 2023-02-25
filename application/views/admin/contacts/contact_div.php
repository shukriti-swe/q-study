<div class="table-responsive">
    <table class="table table-bordered2" id="table">
        <thead>

        <tr>
            <th scope="col">SL</th>
            <th scope="col">Contact Name</th>
            <th scope="col">Contact Email</th>
            <th scope="col">Contact Message</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $serial = 1; ?>
        <?php foreach ($all_contacts as $contact) : ?>

            <tr id="<?php echo  $contact['id'];?>">
                <td ><?php echo $serial++; ?></td>
                <td >
                    <?php echo $contact['user_name']; ?>
                      <?php if($contact['feedback_topic'] == 'feedback'){ ?>
                        <button class="btn btn-sm" >Feedback</button>
                      <?php }else if($contact['feedback_topic'] == 'complaint') { ?>
                        <button class="btn btn-sm">Complaint</button>
                      <?php }else if($contact['feedback_topic'] == 'bug_report') { ?>
                        <button class="btn btn-sm">Bug Report</button>
                      <?php }else if($contact['feedback_topic'] == 'other') { ?>
                        <button class="btn btn-sm">Other</button>
                      <?php } ?>
                </td>
                <td >
                  <span>
                      <?php echo $contact['user_email']; ?>
                      
                  </span> 
                  <span style="color: red"><?= ($contact['refLink'] != null)?$contact['refLink']:'' ?> </span>
                  <?php foreach ($contact['files'] as $file) : ?>
                    <a href="download_feedback_file/<?= $file['id']; ?>"><?= $file['filename'] ?></a>
                  <?php endforeach; ?>
                </td>
                <td ><?php echo $contact['message_body']; ?></td>
                <td><button style="border:none;background:none;" id='deleteContactMessage'><i class="fa fa-trash"></i></button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<style>
td span button{
    background:#dfdfdf;
}
</style>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    //datatable
    jQuery(document).ready(function() {
        $('#table').dataTable({});
    });
    
     $(document).on('click', '#deleteContactMessage', function(){
         var val = $(this).closest('tr').attr('id');
         var x = confirm("Are you sure you want to delete?");
          if (x){
             
             $.ajax({
                'url': 'Admin/deleteContactMessage',
                data: {val:val},
                method:'POST',
                success : function(res){
                    $('tr#'+val).fadeOut('500');
                    // var tr = $(this).closest("tr");
                    // tr.remove();
                }
              })
          }else{
            return false;
          }
     })
</script>