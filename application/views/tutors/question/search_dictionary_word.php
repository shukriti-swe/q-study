<style>
   .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
   .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
   .autocomplete-selected { background: #F0F0F0; }
   .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
   .autocomplete-group { padding: 2px 5px; }
   .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>

<input type="hidden" name="" id="uType" value="<?php echo ($this->session->userdata('userType')) &&(($this->session->userdata('userType'))==3)?'tutor':''?>">

<div class="container top100">
    <div id="wordErr" style="color: red; text-align: center; "></div>
    <div class="row">
        <div class="dictionary_serch">
            <div class="col-sm-4"><a id="new_word" >Create a new Word (with visualization)</a></div>
            <div class="col-sm-6 topnav">
                <div class="search-container">

                    <form id="searchWordForm" action="q-dictionary/view" method="POST" >
                        <input type="text" onchange="valueSearch(this)" onclick="onvalue(this)" class="wordSearch" placeholder="Search.." name="word" id="wordSearch">
                        <!-- <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="word">
                        <option value="">search a word</option>
                            <?php foreach ($allWords as $word) : ?>
                                <option value="<?php echo $word; ?>"><?php echo $word; ?></option>
                            <?php endforeach; ?>
                        </select> -->
                        <button id="wordFormSubmit" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-sm-2"> </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="row">
        <div class="top100">
            <a href="#"><img src="assets/images/d_bottom.png" class="img-responsive"></a>
        </div>
    </div>
</div>
</div>
</section>


<!-- Modal -->
<div class="modal ss_modal dictionary_pop" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4> &nbsp; </h4>


            </div>
            <div class="modal-body">
                <img class="pull-left" src="assets/images/icon_info.png">
                <p>Without registration you can’t make word. <br> <span class="pull-right"><a href="signup">Try Registration</a></span> </p>
                <div style="clear: both; margin-top: 20px;"></div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
    <!-- <script src="assets/js/jquery.autocomplete.min.js"></script> -->
    <!-- autocomplete -->
    
    <script type="text/javascript">
       
        $(document).on('click','#wordFormSubmit', function(){
            var word = document.forms["searchWordForm"]["word"].value;
              if (word == "") {
                $("#wordErr").html(" * required");
                return false;
              }else{

                $.ajax({
                    url: '<?php echo site_url('search_dictionary_word'); ?>',
                    type: 'POST',
                    data: {
                        word: word,
                    },
                    success: function (data) {

                        if (data == 0) {
                            $("#wordErr").html(" ''"+word+"'' was not found in this dictionary ");
                            
                            
                        }else{
                            $("#wordErr").html("");
                           $("#searchWordForm").submit();
                        }
                    }
                });


                return false;
                
              }
            
        });

        $(document).on('change','#word', function(){
            var word = $(this).find(':selected').text();
            $('#searchWordForm').attr('action', 'q-dictionary/view/'+word);
        });

    //create word anchor functionality
    $(document).ready(function(){
        var uType = $('#uType').val();
        //console.log(uType);
        if(uType=='tutor'){
            $('#new_word').attr('href', 'q-dictionary/add');
        }else {
         $('#new_word').attr("data-toggle", "modal");
         $('#new_word').attr("data-target", "#exampleModal");
     }
 });

    /*autocomplete*/
    $(document).ready(function(){ 
        $('.wordSearch').devbridgeAutocomplete({
                serviceUrl: 'CommonAccess/ajaxSearchDicWord',
                //lookup: countries,
                onSelect: function (suggestions) {
                //alert('You selected: ' + suggestion.answer);
            }
        });
    })
</script>