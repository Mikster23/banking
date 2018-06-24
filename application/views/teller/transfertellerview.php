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
  <div class="container box">
           <h3 align="center"><?php echo "Transfer Funds"; ?></h3><br />

    <form role="form" method="post" action="<?php echo base_url('index.php/tellertransfer/maketransfer'); ?>">
      <div class="form-group">
        <label for="exampleInputPin">Transfer this amount :</label>
        <input class="form-control" name="user_amount" type="number"  placeholder="Enter Amount">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">From this Account Number : </label>
        <input class="form-control" name="user_fromacctnum" type="number" placeholder="Enter Source Account Number">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">To this Account Number : </label>
        <input class="form-control" name="user_toacctnum" type="number" placeholder="Enter Destination Account Number">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">Remarks : </label>
        <input class="form-control" name="user_remarks" type="text" >
      </div>
      <input class="btn btn-primary btn-block" type="submit" value="Transfer" name="transfer" >

    </form>

</div>
  </div>
</div>
</body>

</html>
