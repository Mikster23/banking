<?php  $this->view('partials/admin_sidebar.php');
$error_msg= $this->session->flashdata('error_msg');
$success_msg= $this->session->flashdata('success_msg');
?>

<!-- Navigation
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
</nav>-->
<div class="content-wrapper">
  <div class="container-fluid">

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
    <div class="card-header">
      <i class="fa fa-group"></i> <b> Pending Additional Account Enroll</b></div>

      <!-- Example DataTables Card-->
      <div class="card mb-3" style="margin-top:0.5vw;">
        <div class="card-header">
          <i class="fa fa-table"></i> Pending Accounts</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>


                  <th style="text-align:center;">Account Number</th>
                  <th style="text-align:center;">Account Type</th>
                  <th style="text-align:center;">Applicant Name</th>
                  <th style="text-align:center;">Application Date.</th>

                  <th style="text-align:center;">Actions</th>
                </thead>
                <tfoot>
                  <tr>
                    <th style="text-align:center;">Account Number</th>
                    <th style="text-align:center;">Account Type</th>
                    <th style="text-align:center;">Applicant Name</th>
                    <th style="text-align:center;">Application Date.</th>

                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach($user_enroll as $person_item) {?>
                    <tr>

                      <td style="text-align:center;"><?php echo $person_item['accountnum']; ?></td>
                      <td style="text-align:center;"><?php

                      foreach($user_acctname as $person_name){
                        $tempacctid1 = (int) $person_name['id'];
                        $tempacctid2 = (int) $person_item['account_name'];
                        if($tempacctid1 == $tempacctid2){
                          echo $person_name['name'];
                        }
                      }

                      ?></td>
                      <td style="text-align:center;"><?php foreach($user_name as $person)
                      {
                        $tempid2 = (int)$person_item['holder_id'];
                        $tempid1 = (int)$person['id'];

                        if($tempid1 == $tempid2){
                          echo $person['lastname'].", ".$person['firstname'];

                        }


                      }

                      ?></td>
                      <td style="text-align:center;"><?php echo $person_item['created_at']; ?></td>

                      <td style="text-align:center; padding:1%;">
                        <a name="editMem" href="<?php echo site_url('account/acceptenroll/'.$person_item['holder_id']); ?>"><i class="fa fa-pencil"></i></a> |
                      <!--  <a name="editMem" href="<?php //echo site_url('account/deactivate/'.$person_item['id']); ?>"><i class="fa fa-pencil"></i></a> | !-->
                        <!--    <a href="<?php //echo site_url('cruduser/delete/'.$person_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a> !-->
                      <?php }?>
                    </td>
                  </tr>
                  <?php ?>
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
              <a class="btn btn-primary" href="<?php echo base_url('account/logout');?>">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <script>
      var btn = document.getElementById('newCat');
      btn.addEventListener('click', function() {
        document.location.href = '<?php echo site_url('cruduser/create'); ?>';
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
