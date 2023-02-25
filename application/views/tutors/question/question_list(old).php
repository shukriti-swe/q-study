<div class="row" >
	<div class="col-sm-2"></div>
	<div class="col-sm-10 ">
		<?php if ($this->session->flashdata('success_msg')) : ?>
			<div class="alert alert-warning alert-dismissible fade in" role="alert"> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <?php echo $this->session->flashdata('success_msg') ?>
      </div>
    <?php endif; ?>
    <div class="ss_q_list_top">
     <form class="form-inline">

      <span>Quiz</span>

      <div class="form-group">
       <select class="form-control" >
        <option>Select Question type</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group">
     <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
   </div>
   <button type="submit" class="btn btn_gray">To Go</button>
 </form>
 <a class="ss_q_link pull-left" href="q-dictionary/search">Q- Dictionary</a>
 <a style="color:#4BBCC0; background-color: #fff" class="ss_q_link pull-left" href="subject/all">Delete Subject & Chapter</a>

</div>
<div class="ss_question_list">
  <?php foreach ($all_question_type as $key) {?>
    <div class="row">
      <div class="col-sm-3">
        <ul class="ss_q_left"> 
          <li>
            <a href="<?php echo base_url();?>create-question/<?=$key['id']?>"><?php echo $key['questionType'];?></a>
          </li>
        </ul>
      </div>

      <div class="col-sm-9">

        <ul class="ss_question_menu" id="quesType_<?php echo $key['id'];?>">
          <?php $i = 1;foreach ($all_question[$key['id']] as $row) {
            $color = $row['dictionary_item']?'#ED1C24':'';?>

            <li style="background-color: <?php echo $color; ?><?php if ($i > 10) {
              ?>;display: none;<?php }?>" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>" >
              <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i?></a>
            </li>
            <?php $i++;}?>

            <li class="ss_q_u_d" <?php if ($i < 11) {?>style="display: none;"<?php }?>>
              <a id="upbutton_<?=$key['id']?>" onclick="fn_show_upper(1, <?=$key['id']?>,<?=$i-1?>)">
                <i class="fa fa-caret-up" aria-hidden="true"></i>
              </a>
              <span id="spinner_val_<?=$key['id']?>">1[<?php echo $i-1;?>]</span>
              <a id="downbutton_6" onclick="fn_show_upper(0, <?=$key['id']?>,<?=$i-1?>)">
                <i class="fa fa-caret-down" aria-hidden="true"></i>
              </a>
            </li>
            <?php if ($i > 10) {?>
              <li class="ss_q_last" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>">
                <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i-1?></a>
              </li>
              <li class="ss_q_total">
                <a onclick="lastTenquestion(<?=$key['id']?>,<?=$i-1?>)" >Q<?=$i-1?></a>
              </li>
            <?php }?>

          </ul>


        </div>
      </div>
    <?php }?>
  </div>
</div>

</div>


<script>

  function fn_show_upper(aval, acat, acount){
    var vspinnerval = $("#spinner_val_" + acat +"").html();
    var spinnerval = vspinnerval.substr(0, vspinnerval.indexOf('['));

    var vinterval = acount / 10;
    vinterval = Math.round(vinterval);

    var vmod = acount % 10;

    if (aval == 1) {
      spinnerval++;
    } else {
      spinnerval--;
    }
    if (spinnerval < 1) {
      spinnerval = 1;
    }
    if (spinnerval > 500) {
      spinnerval = 500;
    }

    var vr = Math.round(10 / 10);
    var vd = 10 % 10;

        //alert('div:' + vr + ' mod:' + vd + ' inter:' + vinterval);

        if (vmod == 0){
          vinterval = vinterval;
        } else {
          if (vmod >= 5){
            vinterval = vinterval;
          } else {
            vinterval = vinterval + 1;
          }
        }
        if (spinnerval > vinterval) {
          spinnerval = vinterval;
        }

        //alert(vmod);

        $("#spinner_val_" + acat +"").html(spinnerval + '[' + acount + ']');

        for (var i=1;i <= acount;i++) {
          $("#q_" + i + "_" + acat).hide();
        }

        if (spinnerval == 1) {
          for (var i=1;i <= 10;i++){
            $("#q_" + i + "_" + acat).show();
          }
        } else {
          var vstart = 10 * spinnerval;
          vstart = (vstart - 10) + 1;

          for (var i = vstart;i <= (10 * spinnerval);i++) {
            $("#q_" + i + "_" + acat).show();
          }
        }
      }

      function lastTenquestion(acat, acount){
        var vinterval = acount / 10;
        vinterval = Math.ceil(vinterval) - 1;
        $("#spinner_val_" + acat +"").html(vinterval + '[' + acount + ']');
        fn_show_upper(1,acat, acount);
      }
    </script>

    <script>
      /*context menu (right click on question menu)*/
      $(function(){
        $('#quesType_1').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){
              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
            }/*else if(key='edit'){
                window.location.href = "question_edit/"+qType+"/"+qId;    
              }*/
            },
            items: {
              "preview": {name: "Preview", icon: "fa-eye"},
              "delete": {name: "Delete", icon: "cut"},
              "duplicate": {name: "Duplicate", icon: "copy"},
            }

          });
      });

      $(function(){
        $('#quesType_2').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

      $(function(){
        $('#quesType_3').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

      $(function(){
        $('#quesType_4').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });
      $(function(){
        $('#quesType_5').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

      $(function(){
        $('#quesType_6').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

      $(function(){
        $('#quesType_7').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

      $(function(){
        $('#quesType_8').contextMenu({
         selector: 'li', 
         callback: function(key, options) {
          var li_item = $(this);
          var qType_qId = $(this).attr('data-id');
          temp = qType_qId.split('_');
          qId = temp[1];
          qType = temp[0]
          if(key=='preview'){
            window.location.href = "question_preview/"+qType+"/"+qId;
          }else if(key=='delete'){

            $.ajax({
             url: "question_delete/"+qId,
             method : 'POST',
             success: function(data){
               if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
               else{ alert('Somethings wrong.'); }
             }
           })

          }else if(key='duplicate'){
           $.ajax({
            url: "question_duplicate/"+qId,
            method : 'POST',
            success: function(data){
             if(data=='true'){ 
              alert('Question duplicated successfully.'); 
              location.reload();
            } else{ 
              alert('Somethings wrong.'); 
            }
          }
        })
         }
       },
       items: {
         "preview": {name: "Preview", icon: "fa-eye"},
         "delete": {name: "Delete", icon: "cut"},
         "duplicate": {name: "Duplicate", icon: "copy"},
       }

     });
      });


      $(function(){
        $('#quesType_9').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });


      $(function(){ //workout quiz
        $('#quesType_12').contextMenu({
          selector: 'li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
            temp = qType_qId.split('_');
            qId = temp[1];
            qType = temp[0]
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
             $.ajax({
              url: "question_duplicate/"+qId,
              method : 'POST',
              success: function(data){
                if(data=='true'){ alert('Question duplicated successfully.'); location.reload();}
                else{ alert('Somethings wrong.'); }
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          "delete": {name: "Delete", icon: "cut"},
          "duplicate": {name: "Duplicate", icon: "copy"},
        }
        
      });
      });

    </script>