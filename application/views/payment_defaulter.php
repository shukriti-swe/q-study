<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suspended</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <main role="main">   
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Payment Defaulter</h1>
                <p class="lead text-muted">Your haven't made payment</p>
            </div>
        </section>    

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Suspended" alt="Suspended [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_165a3691401%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_165a3691401%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                    <div class="card-body">
                       <!-- 1-12 lvl student(type=6) will contact his/her parent for payment -->
                        <?php if ($userType==6) : ?>
                            <p class="card-text">Please contact your parent for q-study payment. Thanks</p>
                        <?php else : ?>
                            <p class="card-text">You haven't made payment yet or your payment expired. Please pay first to access.</p>
                        <?php endif; ?>

                        
                        <a type="button" href="<?php echo base_url('logout'); ?>" class="btn btn-primary">Logout</a>
                        
                        <?php if ($userType==6) : ?>
                        <?php else : ?>
                            <a type="button" href="<?php echo $paymentUrl; ?>" class="btn btn-primary text-right" style="float:right;">Pay</a>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
</body>
</html>
