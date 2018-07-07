<?php
$user_id=$this->session->userdata('user_id');
$user_balance=$this->session->userdata('user_balance');
$user_pin=$this->session->userdata('user_pin');
$user_acctnum=$this->session->userdata('user_acctnum');

if(!$user_id){
 //redirect('/user/loadlogin');
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
  <?php  $this->view('partials/admin_sidebar.php');
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
<?php echo " <h1> Hello Admin !</h1>" ; ?>
 <?php echo " <h1> Dashboard </h1>" ; ?>

 <br><br>
         <!-- Icon Cards-->

      <div class="card mb-3" style="margin-top:0.5vw;">
          <div class="card-header">
            <i class="fa fa-table"></i> Pending Accounts</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <th style="text-align:center;">First Name</th>
                  <th style="text-align:center;">Last Name</th>
                  <th style="text-align:center;">Email</th>
                  <th style="text-align:center;">Account No.</th>
                  <th style="text-align:center;">Application Date.</th>
                  <th style="text-align:center;">Status.</th>
                  <th style="text-align:center;">Actions</th>
                </thead>
                <tfoot>
                  <tr>

                    <th style="text-align:center;">First Name</th>
                    <th style="text-align:center;">Last Name</th>
                    <th style="text-align:center;">Email</th>
                    <th style="text-align:center;">Account No.</th>
                    <th style="text-align:center;">Application Date.</th>
                    <th style="text-align:center;">Status.</th>
                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($user as $person_item): ?>
                    <tr>

                      <td style="text-align:center;"><?php echo $person_item['firstname']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['lastname']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['email']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['accountnum']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['created_at']; ?></td>
                      <td style="text-align:center;"><?php echo "Not Activated" ?></td>
                      <td style="text-align:center; padding:1%;">
                        <a name="editMem" href="<?php echo site_url('account/accept/'.$person_item['id']); ?>"><i class="fa fa-pencil"></i></a> |
                    <!--    <a href="<?php //echo site_url('cruduser/delete/'.$person_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a> !-->
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>



</body>

</html>
