            <div class="container">
                <div class="row">
                <div class="sign_my_acount">
                <div class="col-md-4 col-md-offset-4">
                    <p class="accordion_new">
                        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-sort-down"></i> My Account</a>
                      </p>
                    <div class="">
                      <div class="col">
                        <div class="collapse multi-collapse accordion_body in" id="multiCollapseExample1">
                          <div class="card card-body">
                            <ul>
                                <li><a href="<?php echo base_url();?>school_info_details">Setting</a></li>
                                <li><a href="<?php echo base_url();?>school_logo">Logo/Photo</a></li>
                                <li><a href="#">Message To Student</a></li>

                                <!-- <li><a href="" onclick="cancelSubscription()">Cancel Subscription</a></li> -->
                                <!---<li><a href="<?php echo base_url();?>u_level_enrollment">Enrollment List</a></li>--->
                            </ul>   
                            </div>
                        </div>
                      </div> 
                    </div>
                </div>
                </div>
             </div>
             </div>
        </div>
</section>
 
 <script>
  function cancelSubscription() {
    event.preventDefault();

    swal("Really want to cancel q-study subscription?", {
    buttons: {
      no: "NO",
      yes: {
        text: "YES",
        value: "yes",
      },
    },
  })
  .then((value) => {
    switch (value) {
   
      case "no":
        swal("Subscription not canceled",'Thanks for being with us!!',  'error');
        break;
   
      case "yes":
        fetch('subscription/cancel')
        swal( "Subscription canceled",'Thanks for being with us!!', "success");
        break;
   
      default:
        swal("Got away safely!");
    }
  });
  } //end function
</script>
