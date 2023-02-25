<section>
    <div class="container" style="padding: 0px;margin: 0px;width: 100%">
        <div class="row">
            <div class="col-md-2 text-center" id="show-product-details">
                
            </div>
            <div class="col-md-10">
                <div class="product-section">
                    <div class="row" style="margin-left:0">
                        <div class="col-md-10 point-details" style="padding: 0">
                            <?php if ($lessTarget <= $productPoint->recent_point || $UpTarget >= $productPoint->recent_point){ ?>
                                <label><span class="title">Recent Point</span> <span class="point"><?= ($productPoint->recent_point)?$productPoint->recent_point:0; ?></span></label>
                            <?php }else{ ?>
                                <label><span class="title">Recent Point</span> <span class="point">0</span></label>
                            <?php } ?>
                            <label><span class="title1">Bonus Point</span>  <span class="point"><?= ($productPoint->bonus_point)?$productPoint->bonus_point:0; ?></span></label>
                            <label>
                                 <span class="title"><button data-toggle="modal" data-target="#referralModal" class="referral-button"><i class="fa fa-question-circle" style="color: orange;"></i></button> Referral Point</span> <span class="point"><?=( $productPoint->referral_point )?$productPoint->referral_point:0;?></span>
                            </label>
                            <?php if ($lessTarget <= $productPoint->recent_point || $UpTarget >= $productPoint->recent_point){ ?>
                                <label>
                                    <span class="title">Total Point</span> <span class="point"><?=( $productPoint->total_point )?$productPoint->total_point:0;?></span>
                                </label>
                            <?php }else{ ?>
                                <label>
                                    <span class="title">Total Point</span> <span class="point">0</span>
                                </label>
                            <?php } ?>
                            <label>
                                <span class="creative">Creative Point</span> <span class="point"><?php if(!empty($creative_point['student_point'])){echo $creative_point['student_point'];} ?></span>
                            </label>
                        </div>
                        <!--<div class="col-md-2" style="padding: 0">-->
                        <!--</div>-->
                        <!--<div class="col-md-3" style="padding: 0">-->
                        <!--</div>-->
                        <!--<div class="col-md-2" style="padding: 0">-->
                        <!--</div>-->
                        <div class="col-md-2 text-center"     style="padding-left: 28px;">
                            <a style="color: red;font-weight: bold;" href="" data-toggle="modal" data-target="#myModal"> <u> Your Address</u></a>
                        </div>
                    </div>
                    <br>

                    <div class="row seven-cols" style="padding:10px" id="product_list_id">
                        <!--<?php foreach ($products as $key => $value): ?>-->
                        <!--    <div class="col-md-1 product-img">-->
                        <!--        <button class="product_price_button" value="<?= $value['id'];?>">-->
                        <!--            <img src="<?= base_url()?>img/product/<?= $value['image'] ?>" style="">-->
                        <!--        </button>-->
                        <!--    </div>-->
                        <!--<?php endforeach ?>-->
                    </div>
                    <div class="product_submit_button">
                        <button class="btn btn-sm save_product_prize" product-id="<?= $product->id?>" product-point="<?= $product->product_point ?>" disabled>Submit</button>
                    </div>
                </div>
                <div class="form-group row text-right" style="margin-right: 0;">
                	<!--<button class="btn btn-default" id="preview-button" value=""><i class="fa fa-arrow-circle-left"></i></i> Preview</button>-->
                	<!--<button class="btn btn-default" id="next-button" value="14">Next <i class="fa fa-arrow-circle-right"></i></button>-->
                	<div id="pager">
                          <ul id="pagination" class="pagination-sm"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <div class="row">
                <div class="col-md-10">
                    <h6 class="modal-title">Fill your address here.</h6>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-default btn-sm" id="edit_user_address">Edit</button>
                </div>
            </div>
        </div>
        <form id="user-address-form">
        <!-- Modal body -->
        <div class="modal-body">
          <div class="modal-body">
            <div class="form-froup m-10">
                <label>Name</label>
                <input class="form-control" type="text" name="name" id="name" value="<?=($userAddress->name)?$userAddress->name:$parentInfo->name?>">
            </div><br>
            <div class="form-froup m-10">
                <label>Address</label>
                <textarea class="form-control" name="address" id="address" rows="2"><?=($userAddress->address)?$userAddress->address:''?></textarea>
            </div><br>
            <div class="form-froup m-10">
                <label>Suburb/City/Town</label>
                <input class="form-control" type="text" name="sub_city_town" id="sub_city_town"  value="<?=($userAddress->sub_city_town)?$userAddress->sub_city_town:''?>">
            </div><br>
            <div class="form-froup m-10">
                <label>State/Province</label>
                <input class="form-control" type="text" name="state" id="state" value="<?=($userAddress->state)?$userAddress->state:''?>">
            </div><br>
            <div class="form-froup m-10">
                <label>Country</label>
                <input class="form-control" type="text" name="country" id="country" value="<?=($userAddress->country)?$userAddress->country:$country->countryName ?>">
            </div><br>
            <div class="form-froup m-10">
                <label>Email</label>
                <input class="form-control" type="text" name="email" id="email" value="<?=($userAddress->email)?$userAddress->email:$parentInfo->user_email?>">
            </div><br>
            <div class="form-group">
                <label>Mobile No</label><br>
                <input class="form-control" type="tel" id="mobile" name="mobile" style="width: 209%" value="<?=($userAddress->mobile)?$userAddress->mobile:$parentInfo->user_mobile?>">
                <!-- <input type="hidden" id="full_number" name="full_number"> -->
            </div><br>
            <div class="form-froup m-10" style="color:red">
                <label style="margin-bottom: 8px;">Optional Note (additional address detail)</label>
                <textarea class="form-control" name="optional_note" id="optional_note" rows="3"><?=($userAddress->optional_note)?$userAddress->optional_note:''?></textarea>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Save</button>
        </div>
        </form>
      </div>
    </div>
</div>
<!-- end modal -->
 <!-- Modal -->
<div class="modal fade" id="addressNullModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <p>Please save your address first and then submit.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- end modal -->
 <!-- Modal -->
<div class="modal fade" id="addressSaveModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <p>Address save successfully.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- end modal -->
 <!-- Modal -->
<div class="modal fade" id="successfullyPrizeTaken" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="width:75%">
        <div class="modal-body">
          <p  style="margin-bottom:4px">Thanks for choosing this price. You will receive the price within 2 weeks.</p>
          <p>Note that we have to ensure that the prize is available in our database. If the selected prize is not available then other prize has to be chosen. For that situation a notification will pop up in your front page.</p>
          <p>Thanks</p>
          <p style="color: red">Q-Study.com</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" id="successfullyPrizeTakenClose">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- end modal -->
 <!-- Modal -->
<div class="modal fade" id="referralModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="width:85%">
        <div class="modal-header">
            <div class="row">
                <div class="col-md-10">
                    <h6 class="modal-title" style="font-weight: bold;">Today referral point : <span style="color: red">"2000"</span> (per person)</h6>
                </div>
            </div>
        </div>
        <div class="modal-body">
          <p>Referral point means the points that you will get for reffering Q-Study to a new user and if the new user register with Q-Study then they will receive same amount of point as you. </p>
          <p>Watch the "help video" for more information.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- end modal -->

<script src="<?php echo base_url();?>assets/js/intlTelInput.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<script>
    $(document).ready(function(){
        var $pagination = $('#pagination'),
        totalRecords = 0,
        records = [],
        displayRecords = [],
        recPerPage = 14,
        page = 1,
        totalPages = 0;
        $.ajax({
              url: "Student/get_all_products",
              async: true,
              dataType: 'json',
              success: function (data) {
                  records = data;
                  console.log(records);
                  totalRecords = records.length;
                  totalPages = Math.ceil(totalRecords / recPerPage);
                  apply_pagination();
              }
        });
        
    
        function generate_table() {
              var html = [];
              $('#product_list_id').html('');
              for (var i = 0; i < displayRecords.length; i++) {
                  
                html += `<div class="col-md-1 product-img">`;
                html += `<button class="product_price_button" value="`+displayRecords[i].id+`">`;
                html +=   `<img src="<?= base_url()?>img/product/`+displayRecords[i].image+`">`;
                html += `</button>`;
                html +=`</div>`;
              }
                $('#product_list_id').html(html);
              
        }
        
        function apply_pagination() {
          $pagination.twbsPagination({
                totalPages: totalPages,
                visiblePages: 6,
                onPageClick: function (event, page) {
                    displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                    endRec = (displayRecordsIndex) + recPerPage;
                    
                    displayRecords = records.slice(displayRecordsIndex, endRec);
                    generate_table();
                }
          });
        }
        
    })
    
</script>
<script>
    $(document).ready(function(){
        $(document).on('click','.product_price_button',function(){
            var val = $(this).val();
            $.ajax({
                url: 'product/price',
                type: 'POST',
                data: {
                    val:val
                }, 
                success: function (response) {
                    var returnedData = JSON.parse(response);
                    console.log(returnedData.submit);
                    if(returnedData.submit == 1){
                        $('.save_product_prize').prop('disabled',false);
                    }else{
                        $('.save_product_prize').prop('disabled',true);
                    }
                    $('#show-product-details').html(returnedData.html);
                }
            });
        })
        
        
        
        $('#next-button').click(function(){
            var offset = $(this).val();
            $.ajax({
                url: 'Student/product_next_priview',
                type: 'POST',
                data: {
                    offset:offset
                }, 
                success: function (response) {
                    if(response == 'empty'){
                        return;
                    }
	                $('#product_list_id').html(response); 
	                var v = parseInt(offset) + 14;
	                $('#next-button').val(v);
                }
            });
        })
        
        
        
		$('#preview-button').click(function(){
	        var value = $('#next-button').val();   
			var offset = parseInt(value) - 28;
			// var offset = 0;
			$.ajax({
	            url:'Student/product_next_priview',
	            method: 'POST',
	            data:{'offset': offset},
	            success: function(response){
	                $('#product_list_id').html(response); 
	                var v = parseInt(value) - 14;
	                $('#next-button').val(v);   
	            }
			})
		})

   })

    $(document).on('click', '.close_icon', function() {
        $('#show-product-details').empty();
    });


    var iti='';
    $(window).ready(function() {
        var input = document.querySelector("#mobile");

        iti = intlTelInput(input, {
            utilsScript: "<?php echo base_url();?>assets/js/utils.js?1537727621611",
            initialCountry:'AU',
            autoHideDialCode: true,
            autoPlaceholder: "off",
            //defaultCountry: "auto",
            numberType: "MOBILE",
            separateDialCode:true,
        });
    });
    $("#user-address-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $("#user-address-form").serialize();
        console.log(form);
        $.ajax({
           type: "POST",
           url: 'product/get/address',
           data: form, // serializes the form's elements.
           success: function(data)
           {
               if (data == 'success') {
                    $("#myModal").modal("hide");
                    $('#addressSaveModal').modal('show');

               }
           }
        });
    });
    $(document).on('click','.save_product_prize',function(){
        // var productId = $(this).attr('product-id');
        // var productPoint = $(this).attr('product-point');
        var productId = $('#product-id').val();
        var productPoint = $('#product-point').val();

        $.ajax({
            type:"POST",
            url: "product/prize/get",
            data:{productId:productId,productPoint:productPoint},
            success:function(data){
                if (data == 'error') {
                    $('#addressNullModal').modal('show');
                }
                if (data == 'success') {
                    $('#successfullyPrizeTaken').modal('show');
                    //location.reload();
                }

            },
        })
    })
    $(document).on('click','#successfullyPrizeTakenClose',function(){
        $('#successfullyPrizeTaken').modal('hide');
        location.reload();
    })
    
    $('#edit_user_address').click(function(){
        $.ajax({
            type:"POST",
            url: "product/prize/address/edit",
            success:function(data){
                var parsed_data = JSON.parse(data);
                console.log(parsed_data);
                var id      = parsed_data.id;
                var name    = parsed_data.name;
                var address = parsed_data.address;
                var country = parsed_data.country;
                var mobile  = parsed_data.mobile;
                var state   = parsed_data.state;
                var sub_city_town = parsed_data.sub_city_town;
                var user_id = parsed_data.user_id;
                var optional_note = parsed_data.optional_note;


            },
        })        
    })
</script>
<style>
    .point-details label{
        margin-right:3px;
    }
    label span.title{
        background: #00a2e8;
        color: #fff;
        padding: 5px;
    }
    label span.creative{
        background: #18a140;
        color: #fff;
        padding: 5px;
    }
    label span.title1{
        background: #22b14c;
        color: #fff;
        padding: 5px;
    }

    label span.point{
        border: 1px solid #c3c3c3;
        padding: 4px 6px;
    }
    label span.point-final{
        border: 1px solid #c3c3c3;
        background: #22b14c;
        padding: 4px 4px;
    }
    .product-img img{
        height: 150px;
        padding:0px;
        margin:0px;
    }
    .product-point{
        border: 1px solid #c3c3c3;
        padding: 10px;
        border-radius: 5px;
    }
    .products_image{
        border: 1px solid #c3c3c3;
        padding: 15px;
        border-radius: 5px;
        position: relative;
    }
    .close_icon{
        position: absolute;
        top: 0px;
        right: 4px;
        cursor: pointer;
    }
    .product_details{
        border: 1px solid #c3c3c3;
        padding: 5px;
        border-radius: 5px;
    }
    div.product_details_scroll {
      padding: 5px;
      width: 173px;
      height: 150px;
      overflow: scroll;
    }
    .product_details_title{
        padding: 1px 7px;
        background: slategray;
        color: white;
        font-weight: bold;
    }
    .product_point{
        font-size: 14px;
        font-weight: bold;
        color: #4d8888;
        position: relative;
        bottom: 7px;
    }
    .referral-button{
        background: none;
        border: none;
    }
    
    .save_product_prize{
        background: red;
        color: #fff;
    }

</style>
<style>
.product-section{
    border:1px solid #c3c3c3;
    padding:15px;
}


@media (min-width: 768px){
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1  {
    width: 100%;
    *width: 100%;
    padding-right: 5px;
    padding-left: 5px;
    margin-bottom: 15px;
  }
}

@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
    padding-right: 5px;
    padding-left: 5px;
    margin-bottom: 15px;
  }
}

/**
 *  The following is not really needed in this case
 *  Only to demonstrate the usage of @media for large screens
 */    
@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
    padding-right: 5px;
    padding-left: 5px;
    margin-bottom: 15px;
  }
}

.product_price_button{
  border: 1px solid #c3c3c3;
}
.product_submit_button{
    text-align:center;
    padding:8px;
    border-top: 1px solid #c3c3c3;
}

</style>