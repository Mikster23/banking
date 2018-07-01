<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrationn</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">


  </head>
  <body>

<span style="background-color:red;">
  <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Registration</h3>
                  </div>
                  <div class="panel-body">
                    <?php
                      $error_msg= $this->session->flashdata('error_msg');
                      $success_msg= $this->session->flashdata('success_msg');
                    ?>


                    <?php
                    if($error_msg){
                      ?>
                      <div class="alert alert-danger">
                        <?php echo $error_msg; ?>
                      </div>
                      <?php
                    }?>

                    <?php
                    if($success_msg){
                      ?>
                      <div class="alert alert-success">
                        <?php echo $success_msg; ?>
                      </div>
                    <?php
                    }?>
                  <?php
                /*  $error_msg=$this->session->flashdata('error_msg');
                  if($error_msg){
                    echo $error_msg;
                  }*/
                   ?>

                      <form role="form" method="post" action="<?php echo base_url('user/register_user'); ?>">
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="FirstName" name="user_firstname" type="text" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="LastName" name="user_lastname" type="text" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Address" name="user_address" type="text" autofocus>
                              </div>

                              <div class="form-group">
                                  <input class="form-control" placeholder="Email" name="user_email" type="email" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Password" name="user_password" type="password" value="">
                              </div>

                              <div class="form-group">
                                  <input class="form-control" placeholder="Birthday" name="user_birthday" type="date" value="">
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Age" name="user_age" type="number" value="">
                              </div>

                                  <div class="form-group">
                                      <select name ="user_accttype" id='sel_acct' required >
                                        <option>-- Select Account Type --</option>
                                        <?php

                                        foreach($account_type as $acct){
                                           echo ' hi '.$acct;
                                          echo "<option value='".$acct['id']."'>".$acct['name']."</option>";
                                        }
                                        ?>
                                     </select>
                                </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Mobile No" name="user_mobile" type="number" value="">
                              </div>

                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >

                          </fieldset>
                      </form>
                      <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('user/loadlogin'); ?>">Login here</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type='text/javascript'>
    // baseURL variable
    var baseURL= "<?php echo base_url();?>";

    $(document).ready(function(){

      // City change
      $('#sel_acct').change(function(){
        var acct = $(this).val();

        // AJAX request
        $.ajax({

          url:   "<?php echo base_url("index.php/user/register_user"); ?>",
          method: 'post',
          data: {acct: acct},
          dataType: 'json',
          success: function(response){

            // Remove options


            // Add options
            $.each(response,function(index,data){
               $('#sel_depart').append('<option value="'+data['id']+'">'+data['depart_name']+'</option>');
            });
          }
       });
     });


</span>




  </body>
</html>
