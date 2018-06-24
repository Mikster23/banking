
<?php  $this->view('partials/teller_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
<div width = "50%">

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
<div class="content-wrapper">
  <div class="container box">
    <div class="container">
      <h1>Manage User Accounts</h1>
  </center>
      <h3>User List</h3>
      <br />

      <br />
      <table id="table_id" class="table table-striped table-bordered" cellspacing="20" width="100%">
        <thead>
          <tr>
            <th>Accountnumber</th>
            <th>Action</th>
            <th>Amounts</th>
            <th>Remarks</th>
            <th>To Accountnumber</th>
            <th>Date</th>



          </tr>
        </thead>
        <tbody>
          <?php foreach($person as $human){
            ?>

               <tr>
                   <td><?php echo $human->accountnum;?></td>
                   <td><?php echo $human->action;?></td>
                   <td><?php echo $human->amount;?></td>
                   <td><?php echo $human->remarks;?></td>
                   <td><?php echo $human->to_accountnum;?></td>
                   <td><?php echo $human->created_at;?></td>




                </tr>

               <?php


             }?>



        </tbody>

        <tfoot>
          <tr>
            <th>Accountnumber</th>
            <th>Firstnam</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Address</th>
            <th>User_type</th>
            <th>Account_type</th>
            <th>Balance</th>

            <th>Action</th>
          </tr>
        </tfoot>
      </table>

    </div>

           </div>
      </div>
  </div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>
<?php// echo site_url("/user/transhistory") ?>
<script>
$(document).ready(function () {

  $(document).ready( function () {
      $('#table_id').DataTable();
  } );

       });
</script>
</body>

</html>
