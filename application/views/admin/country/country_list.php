<style>
    .panel-title > a {
        text-decoration: none;
        color: #ab8d00 !important;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <div class="col-md-8">
        <div class="button_schedule text-right" >
            <a class="btn btn_next" id="save_country"><i class="fa fa-save"></i> Save</a>
            <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
            <a class="btn btn_next" id="add_theme_row"><i class="fa fa-file"></i> Add New</a>
        </div>

        <div class="sign_up_menu" id="country_div">
            <?php $this->load->view('admin/country/country_div'); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        var addcounter = <?php echo count($all_country);?>;
        $("#add_theme_row").on("click", function () {
            addcounter++;
            var newRow = $('<tr extraattra="'+addcounter+'">');
            var cols = "";

            cols = '<td>'+addcounter+'</td>';
            cols += '<td><input class="form-control" id="countryName" type="text" name="countryName"></td>';
            cols += '<td><input class="form-control" id="countryCode" type="text" name="countryCode"></td>';
            cols += '<td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>';
            cols += '<td><i class="fa fa-times" style="color:#4c8e0c;"></i></td>';
            
            newRow.append(cols);

            $("table#themeTable").append(newRow);

        });
        
        $("#save_country").on("click", function () {
            $.ajax({
                url: '<?php echo site_url('save_country'); ?>',
                type: 'POST',
                data: {
                    countryName: $("#countryName").val(),
                    countryCode: $("#countryCode").val()
                },
                success: function (data) {
                    var res = jQuery.parseJSON(data);
                    $('#country_div').html(res.countryDiv);
                }
            });
        });
    });
    
    function edit_country(country_id){
        $(".target").hide();
        $(".text").show();
        $(".fa-edit").hide();
        $(".fa-pencil").show();
        
        
        $("#name_text"+country_id).hide();
        $("#code_text"+country_id).hide();
        $("#edit_name"+country_id).show();
        $("#edit_code"+country_id).show();
        
        $("#edit"+country_id).hide();
        $("#update"+country_id).show();
    }
    
    function updateCountry(country_id) {
        $.ajax({
            url: '<?php echo site_url('update_country'); ?>',
            type: 'POST',
            data: {
                id: country_id,
                countryName: $("#edit_name"+country_id).val(),
                countryCode: $("#edit_code"+country_id).val()
            },
            success: function (data) {
                var res = jQuery.parseJSON(data);
                $('#country_div').html(res.countryDiv);
            }
        });
    }
    
    function chkDelete(){
        var chk = confirm('Are You Sure To Delete This?');
        if(chk){
            return true;
        }else{
            return false;
        }
    }
    
    
</script>
