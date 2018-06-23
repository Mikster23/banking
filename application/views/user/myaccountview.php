<?php
$user_id=$this->session->userdata('user_id');

if(!$user_id){
 redirect('/user/loadlogin');
}

 ?>
<!--
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  </head>
  <body>
<!--
<div class="container">
  <div class="row">
    <div class="col-md-4">

      <table class="table table-bordered table-striped">


        <tr>
          <th colspan="2"><h4 class="text-center">User Info</h3></th>

        </tr>
          <tr>
            <td>User id</td>
            <td><?php// echo $this->session->userdata('user_id'); ?></td>
          </tr>
          <tr>
            <td>User Email</td>
            <td><?php //echo $this->session->userdata('user_email');  ?></td>
          </tr>
          <tr>
            <td>User Firstname</td>
            <td><?php// echo $this->session->userdata('user_firstname');  ?></td>
          </tr>
          <tr>
            <td>User Lastname</td>
            <td><?php// echo $this->session->userdata('user_lastname');  ?></td>
          </tr>
          <tr>
            <td>User Age</td>
            <td><?php// echo $this->session->userdata('user_age');  ?></td>
          </tr>
          <tr>
            <td>User Mobile</td>
            <td><?php //echo $this->session->userdata('user_mobile');  ?></td>
          </tr>
          <tr>
            <td>User AccountNumber</td>
            <td><?php// echo $this->session->userdata('user_acctnum');  ?></td>
          </tr>
          <tr>
            <td>User Pin </td>
            <td><?php// echo $this->session->userdata('user_pin');  ?></td>
          </tr>
          <tr>
            <td>User Balance</td>
            <td><?php //echo $this->session->userdata('user_balance');  ?></td>
          </tr>
      </table>


    </div>
  </div>
<a href="<?php //echo base_url('user/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
</div>
!--><!--
</body>
</html> !-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>O. Banking System</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">
</head>

  <?php  $this->view('partials/user_sidebar.php');?>
  <div class="content-wrapper">
      <?php echo "hi"; ?>
      <div class="container">
        <div class="row">
          <div class="col-md-4">

            <table class="table table-bordered table-striped">


              <tr>
                <th colspan="2"><h4 class="text-center">User Info</h3></th>

              </tr>
                <tr>
                  <td>User id</td>
                  <td><?php// echo $this->session->userdata('user_id'); ?></td>
                </tr>
                <tr>
                  <td>User Email</td>
                  <td><?php //echo $this->session->userdata('user_email');  ?></td>
                </tr>
                <tr>
                  <td>User Firstname</td>
                  <td><?php// echo $this->session->userdata('user_firstname');  ?></td>
                </tr>
                <tr>
                  <td>User Lastname</td>
                  <td><?php// echo $this->session->userdata('user_lastname');  ?></td>
                </tr>
                <tr>
                  <td>User Age</td>
                  <td><?php// echo $this->session->userdata('user_age');  ?></td>
                </tr>
                <tr>
                  <td>User Mobile</td>
                  <td><?php //echo $this->session->userdata('user_mobile');  ?></td>
                </tr>
                <tr>
                  <td>User AccountNumber</td>
                  <td><?php// echo $this->session->userdata('user_acctnum');  ?></td>
                </tr>
                <tr>
                  <td>User Pin </td>
                  <td><?php// echo $this->session->userdata('user_pin');  ?></td>
                </tr>
                <tr>
                  <td>User Balance</td>
                  <td><?php //echo $this->session->userdata('user_balance');  ?></td>
                </tr>
            </table>


          </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript"  src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin-datatables.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
