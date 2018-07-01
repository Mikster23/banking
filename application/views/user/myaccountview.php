<?php  $this->view('partials/user_sidebar.php');
$error_msg= $this->session->flashdata('error_msg');
$success_msg= $this->session->flashdata('success_msg');
?>


<!-- Navigation
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
</nav>-->
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
  <div class="container-fluid">
    <div class="card-header">
      <i class="fa fa-group"></i> <b> ACCOUNT TYPE</b></div>
      <table style="width: 100%">
        <tr>
          <td>
            <button class="button button2" id="newCat">Change Password</button>
          </td>

        </tr>
      </table>


      <div class="card mb-3" style="margin-top:0.5vw;">
        <div class="card-header">
          <i class="fa fa-table"></i> My Account</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <th style="text-align:center;">First Name</th>
                  <th style="text-align:center;">Last Name</th>
                  <th style="text-align:center;">Email</th>
                  <th style="text-align:center;">Address</th>
                  <th style="text-align:center;">Birthday</th>
                  <th style="text-align:center;">PIN</th>
                </thead>
                <tfoot>
                  <tr>


                    <th style="text-align:center;">First Name</th>
                    <th style="text-align:center;">Last Name</th>
                    <th style="text-align:center;">Email</th>
                    <th style="text-align:center;">Address</th>
                    <th style="text-align:center;">Birthday</th>
                    <th style="text-align:center;">PIN</th>


                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($user as $person_item): ?>
                    <tr>

                      <td style="text-align:center;"><?php echo $person_item['firstname']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['lastname']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['email']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['address']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['birthday']; ?></td>
                      <td style="text-align:center;"><?php echo $person_item['pin']; ?></td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>


      <!-- Example DataTables Card-->
      <div class="card mb-3" style="margin-top:0.5vw;">
        <div class="card-header">
          <i class="fa fa-table"></i> ACCOUNT TYPE LIST</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <th style="text-align:center;">Account Type</th>
                  <th style="text-align:center;">Account Number</th>
                  <th style="text-align:center;">Remaining Balance</th>
                      <th style="text-align:center;">Status</th>

                </thead>
                <tfoot>
                  <tr>


                    <th style="text-align:center;">Account Type</th>
                    <th style="text-align:center;">Account Number</th>
                    <th style="text-align:center;">Remaining Balance</th>
                          <th style="text-align:center;">Status</th>


                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($myacct as $acc_item){ ?>
                    <tr>

                      <td style="text-align:center;"><?php


                      foreach($user_acctname as $person_name){
                        $tempacctid1 = (int) $acc_item['account_name'];
                        $tempacctid2 = (int) $person_name['id'];
                        if($tempacctid1 == $tempacctid2){
                          echo $person_name['name'];
                        }
                      }
                    //   echo $acc_item['account_name']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['accountnum']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['balance']; ?></td>
                      <td style="text-align:center;"><?php $check = (int)$acc_item['status'];
                      if($check ==1){

                        echo "Activated";
                      }
                      else{
                        echo "Deactivated";

                      }?></td>

                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>
      </div>
      <!-- Logout Modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?php echo base_url('account/logout')?>">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <script>
      var btn = document.getElementById('newCat');
      btn.addEventListener('click', function() {
        document.location.href = '<?php echo site_url('account/loadnew'); ?>';
      });
      </script>
      <script>
      $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#theadd tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
        dataTable.destroy();
        // DataTable
        var table = $('#dataTable').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
            url:"<?php echo base_url("index.php/cruduser/view"); ?>",
            type:"POST"
          },

        });

        // Apply the search
        table.columns().every( function () {
          var that = this;

          $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
              that
              .search( this.value )
              .draw();
            }
          } );
        } );
      } );
      </script>
