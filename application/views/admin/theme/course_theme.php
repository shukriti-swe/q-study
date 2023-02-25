<div class="container">
    <div class="row">
        <div class="button_schedule text-right" >
            <a class="btn btn_next" id="save_theme"><i class="fa fa-save"></i> Save</a>
            <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
            <a class="btn btn_next" id="add_theme_row"><i class="fa fa-file"></i> Add New</a>
        </div>
        
        <div class="sign_up_menu" id="theme_div">
            <?php $this->load->view('admin/theme/theme_div');?>
        </div>
    </div>
</div>

 
<script>
    $(document).ready(function () {
        var addcounter = <?php echo count($all_theme);?>;
        $("#add_theme_row").on("click", function () {
            addcounter++;
            var newRow = $('<tr extraattra="'+addcounter+'">');
            var cols = "";

            cols = '<td>'+addcounter+'</td>';
            cols += '<td><input class="form-control" id="theme_name" type="text" name="theme_name"></td>';
            cols += '<td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>';
            cols += '<td><i class="fa fa-times" style="color:#4c8e0c;"></i></td>';
            
            newRow.append(cols);

            $("table#themeTable").append(newRow);

        });
        
        $("#save_theme").on("click", function () {
            $.ajax({
                url: '<?php echo site_url('save_theme'); ?>',
                type: 'POST',
                data: {
                    theme_name: $("#theme_name").val()
                },
                success: function (data) {
                    console.log(data);
                    var res = jQuery.parseJSON(data);
                    console.log(res);
                    $('#theme_div').html(res.themeDiv);
                }
            });
        });
    });
    
    
</script>