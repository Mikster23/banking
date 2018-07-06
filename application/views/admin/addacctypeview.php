<?php  $this->view('partials/admin_sidebar.php');
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
            <button class="button button2" id="newCat">NEW ACCOUNT TYPE</button>
          </td>

        </tr>
      </table>
      <!-- Example DataTables Card-->
      <div class="card mb-3" style="margin-top:0.5vw;">
        <div class="card-header">
          <i class="fa fa-table"></i> ACCOUNT TYPE LIST</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <th style="text-align:center;">Account Name</th>
                  <th style="text-align:center;">Maintaining Balance</th>
                  <th style="text-align:center;">Minimum Withdrawe.</th>
                  <th style="text-align:center;">Opening Balance</th>
                  <th style="text-align:center;">ATM Fee</th>
                  <th style="text-align:center;">OTC Fee.</th>
                  <th style="text-align:center;">Penalty Fee.</th>
                  <th style="text-align:center;">Deposit through ATM.</th>
                  <th style="text-align:center;">Withdraw through ATM.</th>
                  <th style="text-align:center;">Deposit through Teller.</th>
                  <th style="text-align:center;">Withdraw through Teller.</th>
                      <th style="text-align:center;">Can Make Time Deposit.</th>
                  <th style="text-align:center;">Interest Rate Per Year</th>
                  <th style="text-align:center;">Actions</th>
                </thead>
                <tfoot>
                  <tr>


                    <th style="text-align:center;">Account Name</th>
                    <th style="text-align:center;">Maintaining Balance</th>
                    <th style="text-align:center;">Minimum Withdraw</th>
                    <th style="text-align:center;">Opening Balance</th>
                    <th style="text-align:center;">ATM Fee</th>
                    <th style="text-align:center;">OTC Fee.</th>
                        <th style="text-align:center;">Penalty Fee.</th>
                    <th style="text-align:center;">Deposit through ATM.</th>
                    <th style="text-align:center;">Withdraw through ATM.</th>
                    <th style="text-align:center;">Deposit through Teller.</th>
                    <th style="text-align:center;">Withdraw through Teller.</th>
                    <th style="text-align:center;">Can Make Time Deposit.</th>


                    <th style="text-align:center;">Interest Rate Per Year</th>
                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($acctype as $acc_item): ?>
                    <tr>

                      <td style="text-align:center;"><?php echo $acc_item['name']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['minbalance']; ?></td>
                        <td style="text-align:center;"><?php echo $acc_item['minwith']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['opening_balance']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['atm_fee']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['otc_fee']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['penalty']; ?></td>

                      <td style="text-align:center;"><?php  if( (int)$acc_item['depatm'] == 1){
                        echo "True";
                      }else{
                        echo "False";
                      }; ?></td>
                      <td style="text-align:center;"><?php  if( (int)$acc_item['withatm'] == 1){
                        echo "True";
                      }else{
                        echo "False";
                      }; ?></td>
                      <td style="text-align:center;"><?php  if( (int)$acc_item['deptel'] == 1){
                        echo "True";
                      }else{
                        echo "False";
                      }; ?></td>
                      <td style="text-align:center;"><?php if( (int)$acc_item['withtel'] == 1){
                        echo "True";
                      }else{
                        echo "False";
                      }; ?></td>

                      <td style="text-align:center;"><?php if( (int)$acc_item['timedep'] == 1){
                        echo "True";
                      }else{
                        echo "False";
                      }; ?></td>
                      <td style="text-align:center;"><?php  echo $acc_item['interest']; ?></td>
                      <td style="text-align:center; padding:1%;">
                        <a name="editMem" href="<?php echo site_url('account/edit/'.$acc_item['id']); ?>"><i class="fa fa-pencil"></i></a> |
                        <!--  <a href="<?php //echo site_url('cruduser/delete/'.$acc_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a> !-->
                      </td>
                    </tr>
                  <?php endforeach; ?>
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
