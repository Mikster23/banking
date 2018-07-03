<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> Login </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
</head>
<body>
  <div class="container" style="margin-top:10vw;">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-success">
          <div class="panel-heading" style="background:GRAY; color: White">
            <h3 class="panel-title" style="text-align:center; font-size:2vw;">FEU TECH BANKING SYSTEM</h3>
          </div>
          <?php
          $success_msg= $this->session->flashdata('success_msg');
          $error_msg= $this->session->flashdata('error_msg');

          if($success_msg){
            ?>
            <div class="alert alert-success">
              <?php echo $success_msg; ?>
            </div>
            <?php
          }
          if($error_msg){
            ?>
            <div class="alert alert-danger">
              <?php echo $error_msg; ?>
            </div>
            <?php
          }
          ?>
          <div class="panel-body">
            <form role="form" method="post" action="<?php echo base_url('index.php/user/login_user'); ?>">
              <fieldset>
                <div class="form-group"  >
                  <input class="form-control" placeholder="Enter your e-mail" name="user_email" type="email" autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Enter your password" name="user_password" type="password" value="">
                </div>
                <input class="btn btn-lg btn-success btn-block" style="background:LightGray; color: black" type="submit" value="Login" name="login" >
              </fieldset>
            </form>
            <center><br><b>Don't have an account?</b> </b><a href="<?php echo base_url('index.php/user'); ?>">Register here</a></center><!--for centered text-->
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
