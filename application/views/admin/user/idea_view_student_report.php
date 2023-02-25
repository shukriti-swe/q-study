<div class="" style="margin-left: 15px;">
    <div class="text-center">
    	<a href="#" class="btn btn-primary">Report</a>
    </div>
    <div class="report_menu_top">
    	<div class="gread_box" >
    		<img src="assets/images/grade.png">
    	</div>
    	<div class="idea_menu">
    		
    		<!-- <a href="#">Idea 13</a>
    		<a href="#">Idea 15</a>
    		<a href="#">Idea 18</a> -->
            <?php
            $i=1;
            foreach($all_ideas as $ideas){
                if($ideas['student_id']==$student_id){
                ?>
             <a href="javascript:;" class="active ideas" data-index="<?=$ideas['student_id']?>" data-value="<?=$ideas['idea_id']?>">Idea <?=$i;?></a>
                <?php }else{?>
                  <a href="javascript:;" class="ideas" type="button" data-index="<?=$ideas['student_id']?>" data-value="<?=$ideas['idea_id']?>">Idea <?=$i;?></a>
            <?php } $i++;}
            ?>
    	</div>
    	<div class="gread_search_menu">
    		<a href="#"><img src="assets/images/icon_s_student.png"></a>
    		<a href="#"><img src="assets/images/icon_s_teacher.png"></a>
    		<a href="#"><img src="assets/images/icon_a_left.png"></a>
    		<a href="#"><img src="assets/images/icon_a_right.png"></a>
    	</div>
    	<a href="javascript:;"  data-toggle="modal" data-target="#tutor_checks">Teacher’s Corrections</a>
    	<a href="javascript:;"  data-toggle="modal" data-target="#teacherscommentss" >Teacher’s Comment</a>
    	<div class="idea_point">
    		Points
    		<button><?php if($tutor_correction[0]['total_point']){ ?><?=$tutor_correction[0]['total_point'];?><?php }?></button>
    	</div>
    </div>
   <br>
   <br>

  
</div>

<div class="question_grade_mark">
	<div class="significant_box">
   		<div>
   			<label for="significant_checkbox">Significant plagiarism found</label>
   			<input type="checkbox" name="" id="significant_checkbox" <?php if($tutor_correction[0]['significant_checkbox']==1){ ?><?php echo "checked";?><?php }?>>
   		</div>
   </div>
   <br>
   <br>
   <?php 
   if($tutor_correction[0]['significant_checkbox']!=1){
   ?>
   <div class="row" id="result_tables">
   		<div class="col-md-8 col-md-offset-2 table-responsive">
   			<div id="all_checkbox">
               <?php $report = json_decode($tutor_correction[0]['checked_checkbox']);
               
               // print_r($report);
               ?>
              <table class="table">
                      <thead>
                          <tr>               
                              <th></th>
                              <th class="red">Poor</th>
                              <th class="blue">Average</th>
                              <th class="gold">Good</th>
                              <th class="green">Very Good</th>
                              <th class="orange">Excellent!</th>
                          </tr>
                      </thead>
                      <tbody>
                         <?php
                         foreach($report as $relevances){
                           $relevance = explode (",", $relevances);
                           if($relevance[1]=='relevance'){
                         ?> 
                          <tr>
                              <td>Relevance</td>
                              <td>
                                 
                                  <input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor" <?php if($relevance[2]==1){echo "checked";}?>><span id="Rel_poor_span"><?php if($relevance[2]==1){echo 1;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average" <?php if($relevance[2]==2){echo "checked";}?>><span id="Rel_average_span"><?php if($relevance[2]==2){echo 2;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good" <?php if($relevance[2]==3){echo "checked";}?>><span id="Rel_good_span"><?php if($relevance[2]==3){echo 3;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"<?php if($relevance[2]==4){echo "checked";}?>><span id="Rel_very_good_span"><?php if($relevance[2]==4){echo 4;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"<?php if($relevance[2]==5){echo "checked";}?>><span id="Rel_excellent_span"><?php if($relevance[2]==5){echo 5;}?></span>
                              </td>
                          </tr>
                          <?php }}
                         ?> 
                        <?php
                         foreach($report as $creativity){
                           $creative = explode (",", $creativity);
                           if($creative[1]=='creativity'){
                         ?>  
                          <tr>
                              <td>Creativity</td>
                              <td>
                                  <input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor" <?php if($creative[2]==1){echo "checked";}?>><?php if($creative[2]==1){echo 1;}?><span id="cre_poor_span"></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average" <?php if($creative[2]==2){echo "checked";}?>><span id="cre_average_span"><?php if($creative[2]==2){echo 2;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good" <?php if($creative[2]==3){echo "checked";}?>><span id="cre_good_span"><?php if($creative[2]==3){echo 3;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good" <?php if($creative[2]==4){echo "checked";}?>><span id="cre_very_good_span"><?php if($creative[2]==4){echo 4;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent" <?php if($creative[2]==5){echo "checked";}?>><span id="cre_excellent_span"><?php if($creative[2]==5){echo 5;}?></span>
                              </td>
                          </tr>
                          <?php }}
                         ?> 
                         <?php
                         foreach($report as $grammars){
                           $grammar = explode (",", $grammars);
                           if($grammar[1]=='grammar'){
                         ?> 
                          <tr>
                              <td>Grammar/Spelling</td>
                              <td>
                                  <input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor" <?php if($grammar[2]==1){echo "checked";}?>><span id="grammar_poor_span"><?php if($grammar[2]==1){echo 1;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"<?php if($grammar[2]==2){echo "checked";}?>><span id="grammar_average_span"><?php if($grammar[2]==2){echo 2;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good" <?php if($grammar[2]==3){echo "checked";}?>><span id="grammar_good_span"><?php if($grammar[2]==3){echo 3;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" <?php if($grammar[2]==4){echo "checked";}?>><span id="grammar_very_good_span"><?php if($grammar[2]==4){echo 4;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" <?php if($grammar[2]==5){echo "checked";}?>><span id="grammar_excellent_span"><?php if($grammar[2]==5){echo 5;}?></span>
                              </td>
                          </tr>
                          <?php }}
                         ?> 
                         <?php
                         foreach($report as $vocabularies){
                           $vocabulary = explode (",", $vocabularies);
                           if($vocabulary[1]=='vocabulary'){
                         ?> 
                          <tr>
                              <td>Vocabulary</td>
                              <td>
                                  <input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"<?php if($vocabulary[2]==1){echo "checked";}?>><span id="vocabulary_poor_span"><?php if($vocabulary[2]==1){echo 1;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" <?php if($vocabulary[2]==2){echo "checked";}?>><span id="vocabulary_average_span"><?php if($vocabulary[2]==1){echo 2;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" <?php if($vocabulary[2]==3){echo "checked";}?>><span id="vocabulary_good_span"><?php if($vocabulary[2]==3){echo 3;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" <?php if($vocabulary[2]==4){echo "checked";}?>><span id="vocabulary_very_good_span"><?php if($vocabulary[2]==4){echo 4;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"<?php if($vocabulary[2]==5){echo "checked";}?>><span id="vocabulary_excellent_span"><?php if($vocabulary[2]==5){echo 5;}?></span>
                              </td>
                          </tr>
                          <?php }}
                         ?> 
                         <?php
                         foreach($report as $clarities){
                           $clarity = explode (",", $clarities);
                           if($clarity[1]=='clarity'){
                         ?> 
                          <tr>
                              <td>Clarity</td>
                              <td>
                                  <input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" <?php if($clarity[2]==1){echo "checked";}?>><span id="clarity_poor_span"><?php if($clarity[2]==1){echo 1;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"<?php if($clarity[2]==2){echo "checked";}?>><span id="clarity_average_span"><?php if($clarity[2]==2){echo 2;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"<?php if($clarity[2]==3){echo "checked";}?>><span id="clarity_good_span"><?php if($clarity[2]==3){echo 3;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" <?php if($clarity[2]==4){echo "checked";}?>><span id="clarity_very_good_span"><?php if($clarity[2]==4){echo 4;}?></span>
                              </td>
                              <td>
                                  <input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" <?php if($clarity[2]==5){echo "checked";}?>><span id="clarity_excellent_span"><?php if($clarity[2]==5){echo 5;}?></span>
                              </td>
                          </tr>
                          <?php }}
                         ?> 
                      </tbody>
                  </table> 
   			</div>
   		</div>
     </div>
   <?php }?>
</div>

<!-- modal tutor_checks -->
<div  class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="tutor_checks">
  <!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post"> 
         <div class="mclose" data-dismiss="modal">x</div> 
         <div class="btm_word_limt">
            <div class="content_box_word teacher_correction">
               
                     <?php 
                     if($tutor_correction[0]['teacher_correction']){ ?>
                       <img src="<?=$tutor_correction[0]['teacher_correction'];?>">
                    <?php }
                     ?>
            </div>
         </div> 
      </form>
    </div>
  </div> 
</div>

<!-- modal teacher comm -->
<div  class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="teacherscommentss">
  <!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post"> 
         <div class="mclose" data-dismiss="modal">x</div> 
         <div class="btm_word_limt">
            <div class="content_box_word teacher_comment">
                <textarea class="form-control" rows="4"><?php if($tutor_correction[0]['teacher_comment']){ ?><?=$tutor_correction[0]['teacher_comment'];?><?php }?></textarea>
            </div>
         </div> 
      </form>
    </div>
  </div> 
</div>
<style type="text/css">
.gread_box{
	cursor: pointer;
}
#teacherscommentss .btm_word_limt .content_box_word{ 
    border: 0; 
    padding: 20px; 
    box-shadow: none; 
}
.ss_modal .modal-dialog{
	max-width: 100%;
}
.mclose{
   position: absolute;
   right: 10px;
   top: 10px;
   font-size: 20px;
   z-index: 10;
   cursor: pointer;
}
.top_textprev{
   padding-bottom: 20px;
}
.top_textprev h4{
   color: #7f7f7f;
   font-size: 16px;
   font-weight: bold;
}
.top_textprev .btn{
   background: #9c4d9e;
   border-radius: 0;
   border: none;
   color: #fff;
   padding: 8px 20px;
   margin-top: 10px;
   margin-bottom: 20px;
}
.top_textprev h6{
   color: #000;
   font-size: 14px;
   font-weight: bold;
}
.top_word_limt{
	background: #d9edf7;
	padding: 8px 10px;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
}
.report_menu_top{
	display: flex;
	align-items: flex-end;
	justify-content: center;
}
.report_menu_top .gread_box{
     	padding: 10px;
     	background: #00a2e8;
     }
.report_menu_top .gread_box img{
max-width: 100px;
}

.report_menu_top .idea_menu a{
     	margin: 5px 0px 0px 5px;
     	display: inline-block;
     	background: #a349a4;
     	color: #fff;
     	padding: 10px 20px;
     }
     .report_menu_top .idea_menu a:hover, .report_menu_top .idea_menu a.active{ 
     	background: #7092be; 
     }

.report_menu_top .gread_search_menu {
	padding-left: 10px;
	padding-right: 10px;
}
.report_menu_top .gread_search_menu a{
	display: inline-block;
}
.report_menu_top .idea_point{
	text-align: center;
	margin-left: 10px; 
}
.report_menu_top .idea_point button{
border: 0;
display: block;
	background: #e85c00;
	color: #fff;
	padding: 10px;
	margin: auto;
	margin-top: 10px;
}
.report_menu_top > a{
	margin: 0px 10px;
	text-decoration: underline;
}
.m-auto {
    margin-left: auto;
}
.b-btn {
    background: #0079bc;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
}
.btm_word_limt .content_box_word{
	border-radius: 5px;
	border: 1px solid #82bae6;
	margin: 10px 0;
	padding: 10px;
	width: 100%;
	box-shadow: 0px 0px 10px #d9edf7;
  margin-top: 0 !important;
}
.btm_word_limt .content_box_word u{
	color: #888;
}
.btm_word_limt .content_box_word span{
	color: #888;
}
.btm_word_limt .content_box_word p{
	margin-top: 10px;
}  
 .significant_box{
     	text-align: center;
     }
     .significant_box > div{
     	background: #e6eed5;
     	color: #ed1c24;
     	padding: 10px 20px;
     	display: inline-block;
     	margin: auto;
     }
     .significant_box > div input{
     	margin-left: 10px;
     }
     .table-responsive > div{
     	border: 2px solid #e6eed5;
     }
     .table tbody tr{
     	background: #e6eed5; 
     	border-bottom: 20px solid #fff;
     }
     .table-responsive input{
     	margin-bottom: 0;
     }
     .table thead tr > th{ 
     	text-align: center;
     	padding:5px 10px ;
     }
     .table tbody tr > td{ 
     	text-align: center;
     	padding:4px 10px ;
     	color: #ed1c24;
     }
     .table tbody tr > td:first-child{ 
     	text-align: left;
     	color: #76923c;
     	font-weight: bold;
     }
     .table>thead>tr>th { 
	    border-bottom: 2px solid #e6eed5;
	}
	.table .red{
		color: #ff0000;
	}
	.table .blue{
		color: #00b0f0;
	}
	.table .gold{
		color: #e36c09;
	}
	.table .green{
		color: #00b050;
	}
	.table .orange{
		color: #953734;
	}
	.table input[type=checkbox]:focus
		{
		    outline: none;
		}

	.table input[type=checkbox]
	{
	    background-color: #fff;
	    border-radius: 2px;
	    appearance: none;
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    width: 14px;
	    height: 14px;
	    cursor: pointer;
	    position: relative; 
	    border: 1px solid #959595;
	}

	.table input[type=checkbox]:checked
	{
		border: 1px solid #ed1c24;
	    background-color: #ed1c24;
	    background: #ed1c24 url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
	    background-size: 8px;
	}  
</style>
<script type="text/javascript">
	$(".report_box").change( function() {
        var all_class = $(this).attr('class').split(' ');
        var className = all_class[1];

        $(this).removeAttr('checked');
        $('.'+className).each(function(){
         if($(this).is(':checked')) {
            // var name = $( this ).attr('name'); 
            // alert(name);
         var pre_point = $( this ).val(); 
         var total_point = $("#total_point").text();
         var total = parseInt(total_point) - parseInt(pre_point);
         $("#total_point").text(total);
         }
         });


        $('.'+className).removeAttr('checked');
       
        $( this ).attr( 'checked', true );
        var point = $( this ).val();
        $('.span_'+className).remove();
        $(this).after("<span class='span_"+className+"'>"+point+"<span>");

        var total_point = $("#total_point").text();
        var total = parseInt(total_point) + parseInt(point);
        $("#total_point").text(total);

    });

    $(".ideas").click(function(){
       var student_id = $(this).attr("data-index");
       var idea_id    = $(this).attr("data-value");

       

    $.ajax({
    type: 'POST',
    url: 'admin/get_indivisual_idea',
    data: {
    student_id:student_id,idea_id:idea_id
    },
    dataType: 'JSON',
      success: function (results) {
         console.log(results);
         if(results != []){
            console.log(results[0].student_id);

        var relchk1='';
        var relval1='';
        var relchk2='';
        var relval2='';
        var relchk3='';
        var relval3='';
        var relchk4='';
        var relval4='';
        var relchk5='';
        var relval5='';

        var creativechk1='';
        var creativeval1='';
        var creativechk2='';
        var creativeval2='';
        var creativechk3='';
        var creativeval3='';
        var creativechk4='';
        var creativeval4='';
        var creativechk5='';
        var creativeval5='';

        var grammerchk1='';
        var grammerval1='';
        var grammerchk2='';
        var grammerval2='';
        var grammerchk3='';
        var grammerval3='';
        var grammerchk4='';
        var grammerval4='';
        var grammerchk5='';
        var grammerval5='';

        var vocabularychk1='';
        var vocabularyval1='';
        var vocabularychk2='';
        var vocabularyval2='';
        var vocabularychk3='';
        var vocabularyval3='';
        var vocabularychk4='';
        var vocabularyval4='';
        var vocabularychk5='';
        var vocabularyval5='';

        var claritychk1='';
        var clarityval1='';
        var claritychk2='';
        var clarityval2='';
        var claritychk3='';
        var clarityval3='';
        var claritychk4='';
        var clarityval4='';
        var claritychk5='';
        var clarityval5='';

         var relevance = '';
         var creativity = '';
         var grammar = '';
         var vocabulary = '';
         var clarity = '';
         
         var student_id= results[0].student_id;
         var student_ans= results[0].student_ans;
         var idea_id= results[0].idea_id;
         var teacher_correction = results[0].teacher_correction;
         var correction = '<img alt="correction" src="'+teacher_correction+'">';
         var teacher_comment  = '<textarea class="form-control" rows="4">'+results[0].teacher_comment+'</textarea>';
         var reports =JSON.parse(results[0].checked_checkbox);
         var i='';
         for(i=0;i<reports.length;i++){
            var checked= 'checked';
            var report= reports[i].split(',');
            console.log(report);

            if(report[1]=='relevance'){

                if(report[2]==1){
                 var relchk1='checked';
                 var relval1= 1;
                }
                if(report[2]==2){
                 var relchk2='checked';
                 var relval2= 2;
                }
                if(report[2]==3){
                 var relchk3='checked';
                 var relval3= 3;
                }
                if(report[2]==4){
                 var relchk4='checked';
                 var relval4= 4;
                }
                if(report[2]==5){
                 var relchk5='checked';
                 var relval5= 5;
                }
          
            }

            if(report[1]=='creativity'){

              if(report[2]==1){
                 var creativechk1='checked';
                 var creativeval1= 1;
                }
                if(report[2]==2){
                 var creativechk2='checked';
                 var creativeval2= 2;
                }
                if(report[2]==3){
                 var creativechk3='checked';
                 var creativeval3= 3;
                }
                if(report[2]==4){
                 var creativechk4='checked';
                 var creativeval4= 4;
                }
                if(report[2]==5){
                 var creativechk5='checked';
                 var creativeval5= 5;
                }
            }

            if(report[1]=='grammar'){
              
                if(report[2]==1){
                 var grammerchk1='checked';
                 var grammerval1= 1;
                 
                }
                if(report[2]==2){
                 var grammerchk2='checked';
                 var grammerval2= 2;
                }
                if(report[2]==3){
                 var grammerchk3='checked';
                 var grammerval3= 3;
                }
                if(report[2]==4){
                 var grammerchk4='checked';
                 var grammerval4= 4;
                }
                if(report[2]==5){
                 var grammerchk5='checked';
                 var grammerval5= 5;
                }
            }

            if(report[1]=='vocabulary'){

                if(report[2]==1){
                 var vocabularychk1='checked';
                 var vocabularyval1= 1;
                }
                if(report[2]==2){
                 var vocabularychk2='checked';
                 var vocabularyval2= 2;
                }
                if(report[2]==3){
                 var vocabularychk3='checked';
                 var vocabularyval3= 3;
                }
                if(report[2]==4){
                 var vocabularychk4='checked';
                 var vocabularyval4= 4;
                }
                if(report[2]==5){
                 var vocabularychk5='checked';
                 var vocabularyval5= 5;
                }
            }

            if(report[1]=='clarity'){

                if(report[2]==1){
                 var claritychk1='checked';
                 var clarityval1= 1;
                }
                if(report[2]==2){
                 var claritychk2='checked';
                 var clarityval2= 2;
                }
                if(report[2]==3){
                 var claritychk3='checked';
                 var clarityval3= 3;
                }
                if(report[2]==4){
                 var claritychk4='checked';
                 var clarityval4= 4;
                }
                if(report[2]==5){
                 var claritychk5='checked';
                 var clarityval5= 5;
                }

            }
         }

        var final_report = '<table class="table"><thead><tr><th></th><th class="red">Poor</th><th class="blue">Average</th><th class="gold">Good</th><th class="green">Very Good</th><th class="orange">Excellent!</th></tr></thead><tbody><tr><td>Relevance</td><td><input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor"'+relchk1+'><span id="Rel_poor_span">'+relval1+'</span></td><td><input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average"'+relchk2+'><span id="Rel_average_span">'+relval2+'</span></td><td><input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good"'+relchk3+'><span id="Rel_good_span">'+relval3+'</span></td><td><input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"'+relchk4+'><span id="Rel_very_good_span">'+relval4+'</span></td><td><input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"'+relchk5+'><span id="Rel_excellent_span">'+relval5+'</span></td></tr><tr><td>Creativity</td><td><input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor"'+creativechk1+'><span id="cre_poor_span">'+creativeval1+'</span></td><td><input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average"'+creativechk2+'><span id="cre_average_span">'+creativeval2+'</span></td><td><input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good"'+creativechk3+'><span id="cre_good_span">'+creativeval3+'</span></td><td><input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good"'+creativechk4+'><span id="cre_very_good_span">'+creativeval4+'</span></td><td><input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent"'+creativechk5+'><span id="cre_excellent_span">'+creativeval5+'</span></td></tr><tr><td>Grammar/Spelling</td><td><input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor"'+grammerchk1+'><span id="grammar_poor_span">'+grammerval1+'</span></td><td><input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"'+grammerchk2+'><span id="grammar_average_span">'+grammerval2+'</span></td><td><input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good"'+grammerchk3+'><span id="grammar_good_span">'+grammerval3+'</span></td><td><input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" '+grammerchk4+'><span id="grammar_very_good_span">'+grammerval4+'</span></td><td><input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" '+grammerchk5+'><span id="grammar_excellent_span">'+grammerval5+'</span></td></tr><tr><td>Vocabulary</td><td><input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"'+vocabularychk1+'><span id="vocabulary_poor_span">'+vocabularyval1+'</span></td><td><input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" '+vocabularychk2+'><span id="vocabulary_average_span">'+vocabularyval2+'</span></td><td><input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" '+vocabularychk3+'><span id="vocabulary_good_span">'+vocabularyval3+'</span></td><td><input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" '+vocabularychk4+'><span id="vocabulary_very_good_span">'+vocabularyval4+'</span></td><td><input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"'+vocabularychk5+'><span id="vocabulary_excellent_span">'+vocabularyval5+'</span></td></tr><tr><td>Clarity</td><td><input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" '+claritychk1+'><span id="clarity_poor_span">'+clarityval1+'</span></td><td><input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"'+claritychk2+'><span id="clarity_average_span">'+clarityval2+'</span></td><td><input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"'+claritychk3+'><span id="clarity_good_span">'+clarityval3+'</span></td><td><input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" '+claritychk4+'><span id="clarity_very_good_span">'+clarityval4+'</span></td><td><input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" '+claritychk5+'><span id="clarity_excellent_span">'+clarityval5+'</span></td></tr></tbody></table>';
        
         
         $(".teacher_correction").html(correction);
         $(".teacher_comment").html(teacher_comment);
         $("#all_checkbox").html(final_report);
        }else{
         
        var final_report_not = '<p>Teacher Vorrection not Yet !!!</p>'
         $(".teacher_correction").html('');
         $(".teacher_comment").html('');
         $("#all_checkbox").html(final_report);
        }

       }
    });

    });
	 
</script>