<style>
*{ margin:0px; padding:0px;}
</style>

<div style="padding:0px; margin:0px; font-size:14px; color:#222; line-height:24px; max-width:500px;">
  <div><img src="http://wa.rssoft.win/Q-Study/assets/images/icon_logo_small.png" alt="logo"/> Hello,{{userName}}</div>
  <p>Congratulation for registration with Q-Study.com. Your registration has been completed. </p>
  
  <div style="width:100%; ">
    <p style=" margin-top:20px;">See your details below:</p>
    <div style="overflow:hidden; margin-bottom:20px;">
      <div style="width:70%; float:left;">
        <p>Username</p>
        <p>{{userEmail}}</p>
      </div>
      <div style="width:30%; float:left;">
        <p>Password</p>
        <p>{{userPassword}}</p>
      </div>
    </div>
  </div>

  <?php if (isset($childInfo)) : ?>
    <div style="width:100%; ">
      <p style=" margin-top:20px;">Child info:</p>
        <?php foreach ($childInfo as $child) : ?>
          <div style="overflow:hidden; margin-bottom:20px;">
            <div style="width:40%; float:left;">
              <p>Username</p>
              <p><?php echo $child['childName']; ?></p>
            </div>
            <div style="width:30%; float:left;">
              <p>Password</p>
              <p><?php echo $child['childPass']; ?></p>
            </div>
            <div style="width:30%; float:left;">
              <p>Reference Link</p>
              <p><?php echo $child['refLink']; ?></p>
            </div>

          </div>
        <?php endforeach ?>
    </div>
  <?php endif; ?>
  
  <br/>
  <p>Thank you for using Q-Study</p>
  <br/>
  <p><img src="http://wa.rssoft.win/Q-Study/assets/images/logo_signup.png" alt="logo"/></p>
</div>
