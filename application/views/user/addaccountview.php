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
             <h3 align="center"><?php echo "Pay Bill"; ?></h3><br />


    <form role="form" method="post" action="<?php echo base_url('paybill/pay'); ?>">
      <div class="form-group">
        <label for="exampleInputPin">Reference Number</label>
        <input class="form-control" name="user_reference" type="number" value = "<?php echo  mt_rand(100000000, 999999999);?>" placeholder="Reference Num" readonly="readonly" >
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">Amount</label>
        <input class="form-control" name="user_amount" type="number" placeholder="Enter Amount">
      </div>
      <div class="form-group">
        <label for="exampleInputAmount">Merchant</label>
      <select name ="user_merchant" id='sel_merchant'>
        <option>-- Select Merchant --</option>
        <?php

        foreach($merchant as $merch){
           echo ' hi '.$merch;
          echo "<option value='".$merch['name']."'>".$merch['name']."</option>";
        }
        ?>
     </select>
   </div>
      <input class="btn btn-primary btn-block" type="submit" value="PAY" name="deposit" >

    </form>

</div>


</body>

</html>
