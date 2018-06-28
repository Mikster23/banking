<?php  $this->view('partials/user_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');
?>
<?php echo form_open('user/enrollacct'); ?>

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
        <!-- Example DataTables Card-->
        <div class="card mb-3" style="margin-top:0.5vw;">
          <div class="card-header">
            <i class="fa fa-user"></i><b> Add Account_Type</b></div>
            <div class="card-body">
              <div class="container">
                  <div class="row">
  <label for="mdays">Select Account Type to Enroll: </label>
  <div class ="col-25">
                                                      <div class="form-group" >
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
                                                  </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Enter Account PIN: </label>
                    </div>
                    <div class="col-75">
                      <input  id="accinter" name="user_pin" style="background:white;" value="" type = "number">
                    </div>
                  </div>



                  </div>

              </div>
            </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>
        <button class="button button2" type="submit" name="addMem" id="catID">Enroll</button>
        <button class="button button2" id="issueBut2">Cancel</button>
        <div class="card mb-3" style="margin-top:0.5vw;">
          <div class="card-header">
            <i class="fa fa-table"></i> INFORMATION FOR ACCOUNT TYPE</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <th style="text-align:center;">Account Name</th>
                  <th style="text-align:center;">Maintaining Balance</th>
                  <th style="text-align:center;">Opening Balance</th>
                  <th style="text-align:center;">ATM Charge Fee</th>
                  <th style="text-align:center;">Over The Counter Charge Fee.</th>
                  <th style="text-align:center;">Transfer Balance  Fee.</th>
                  <th style="text-align:center;">Interest Rate Per Year</th>

                </thead>
                <tfoot>
                  <tr>


                                      <th style="text-align:center;">Account Name</th>
                                      <th style="text-align:center;">Maintaining Balance</th>
                                      <th style="text-align:center;">Opening Balance</th>
                                      <th style="text-align:center;">ATM Fee</th>
                                      <th style="text-align:center;">OTC Fee.</th>
                                      <th style="text-align:center;">Transfer Fee.</th>
                                      <th style="text-align:center;">Interest Rate Per Year</th>
                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($acctype as $acc_item): ?>
                    <tr>

                      <td style="text-align:center;"><?php echo $acc_item['name']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['minbalance']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['opening_balance']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['atm_fee']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['otc_fee']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['inter_fee']; ?></td>
                      <td style="text-align:center;"><?php echo $acc_item['interest']; ?></td>


                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>
      </div>



      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © The Feu Banking System 2018</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
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
              <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>
      <!-- Custom scripts for this page-->
      <script src="<?php echo base_url(); ?>assets/js/sb-admin-datatables.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/sb-admin-charts.min.js"></script>
      <script>
        var btn = document.getElementById('issueBut2');
        btn.addEventListener('click', function() {
        document.location.href = 'addacctypeview.php';
        });
      </script>

    </div>
  </body>
  </html>
