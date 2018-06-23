<?php
$user_id=$this->session->userdata('user_id');
$user_balance=$this->session->userdata('user_balance');
$user_pin=$this->session->userdata('user_pin');
$user_acctnum=$this->session->userdata('user_acctnum');

if(!$user_id){
 redirect('/user/loadlogin');
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
  <?php  $this->view('partials/user_sidebar.php');
    $error_msg= $this->session->flashdata('error_msg');
    $success_msg= $this->session->flashdata('success_msg');
  ?>

<div width = "50%">
<div class="content-wrapper">
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
    <h1> Transfer Funds </h1>
    <form role="form" method="post" action="<?php echo base_url('index.php/transfer/maketransfer'); ?>">
      <div class="form-group">
        <label for="exampleInputPin">Transfer this amount :</label>
        <input class="form-control" name="user_amount" type="number"  placeholder="Enter Amount">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">To this Account Number : </label>
        <input class="form-control" name="user_acctnum" type="number" placeholder="Enter AccountNumber">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">Remarks : </label>
        <input class="form-control" name="user_remarks" type="text" >
      </div>
      <input class="btn btn-primary btn-block" type="submit" value="Transfer" name="transfer" >

    </form>


  </div>
</div>
</body>

</html>
