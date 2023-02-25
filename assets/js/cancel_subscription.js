
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
