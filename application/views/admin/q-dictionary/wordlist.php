<style>
  .table-bordered2 thead{
    background-color:#D6E4F6;
  }
</style>
<div class="row">
  <div class="col-md-4">
      <?php echo $leftnav ?>
  </div>

  <div class="col-md-8">
  <div class="ss_question_add" style="margin-top: 0">
    <div class="ss_s_b_main  " style="min-height: 100vh">

      <div class="dictionary_admin_word_list">

        <table class="table table-bordered2" id="table">
          <thead>

            <tr>
              <th scope="col">Date</th>
              <th scope="col">Type Of Creator</th>
              <th scope="col">Country Name</th>
              <th scope="col">Creator Name</th>
              <th scope="col">Word</th>
              <th scope="col">Total words</th>
              <th scope="col" class="text-center">View</th>
              <th scope="col" class="text-center">Select</th>
              <th scope="col" class="text-center">Delete</th> 
            </tr>
          </thead>
          <tbody>
            <!-- <?php foreach ($wordChunk as $userChunk) : ?>
                <?php $cnt=1; ?>
                <?php foreach ($userChunk as $word) : ?>
                <tr>                                                  
                  <td scope="col"><?php echo date('d-M-Y', $word['ques_created_at']); ?></td>
                  <td scope="col"><?php echo $word['creator_type']; ?></td>
                  <td scope="col"><?php echo $word['creator_country']; ?></td>
                  <td scope="col"><?php echo $word['word_creator']; ?></td>
                  <td scope="col"><?php echo $word['word']; ?></td>
                  <td scope="col"><?php echo $cnt++;?></td>
                  <td scope="col" class="text-center"> <a href="q-dictionary/approve/<?php echo $word['word_id']; ?>">View</a> </td>
                  <td scope="col" class="text-center"><input class="approvalCheck" wordId="<?php echo $word['word_id']; ?>" type="checkbox" name=""<?php echo $word['word_approved']?'checked':''; ?>></td>
                  <td scope="col" class="text-center"><a href="#" wordId="<?php echo $word['word_id']; ?>" class="wordDel"> <span class="glyphicon glyphicon-remove"></span> </a></td>  
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?> -->

          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="assets/js/sweet_alert.js"></script>

<script>
  $(document).ready(function(){
    $("#table").DataTable({
      "serverSide": true,
      "ajax": "<?php echo base_url(); ?>Admin/wordForDataTable",
      "dataSrc": "tableData",
      "columns":[
        {'data':'ques_created_at'},
        {'data':'creator_type'},
        {'data':'creator_country'},
        {'data':'word_creator'},
        {'data':'word'},
        {'data':'sl'},
        {'data':'view'},
        {'data':'select'},
        {'data':'delete'},
      ]
    });
  });
  
  //word approve checkbox check/uncheck
  $(document).on('change', '.approvalCheck', function(){
    var wordId = $(this).attr('wordId');
    if(this.checked){
      $.ajax({
        url: 'Admin/wordApprove/'+wordId,
      })
      .done(function(data) {
        console.log(data);
        swal('Word approved successfully!');
      })
      .fail(function() {
        console.log("error");
      })
      
    } else {
      $.ajax({
        url: 'Admin/wordReject/'+wordId,
      })
      .done(function(data) {
        console.log(data);
        swal('Word rejectd!');
      })
      .fail(function() {
        console.log("error");
      })
    }
  });

  //word delete
  $(document).on('click', '.wordDel', function(e){
    e.preventDefault();
    swal('Really want to delete this word?', {
     buttons: {
      cancel:'No',
      catch: {
        text: "Yes",
        value: "Yes",
      }
    },
  }).then((value)=>{
    switch(value){

      case "Yes" :
      var wordId = $(this).attr('wordId');
      var obj=$(this);
      e.preventDefault();
      $.ajax({
        url: 'question_delete/'+wordId,
      })
      .done(function() {
        swal('Word Deleted Successfully!');
        $(obj).closest('tr').fadeOut(4000);
      })
      .fail(function() {
        console.log("error");
      });
      swal("Word deleted");
      break;

      default:
      swal("Word not deleted");
    }
  })
})
  
</script>
