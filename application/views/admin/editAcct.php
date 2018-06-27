<?php  $this->view('partials/admin_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');

?>
<?php echo form_open('account/edit/'.$news_item['id']); ?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Example DataTables Card-->
        <div class="card mb-3" style="margin-top:0.5vw;">
          <div class="card-header">
            <i class="fa fa-user"></i><b> Edit User</b></div>
            <div class="card-body">
              <div class="container">

                <div class="row">
                  <div class="col-25">
                    <label for="mdays">Account Name: </label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="accname" name="acc_name" style="background:white;" value="<?php echo $news_item['name']?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="mdays">Maintaining Balance: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accmaintain" name="acc_maintain" style="background:white;" value="<?php echo $news_item['minbalance']?>" type = "number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="mdays">Opening Balance: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accopening" name="acc_opening" style="background:white;" value="<?php echo $news_item['opening_balance']?>" type = "number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="mdays">OTC Fee: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accatm" name="acc_otc" style="background:white;" value="<?php echo $news_item['atm_fee']?>" type = "number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="mdays">ATM Fee: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accatm" name="acc_atm" style="background:white;" value="<?php echo $news_item['otc_fee']?>" type = "number">
                  </div>
                </div>



                <div class="row">
                  <div class="col-25">
                    <label for="mdays">Inter Fee: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accinter" name="acc_inter" style="background:white;" value="<?php echo $news_item['inter_fee']?>" type = "number">
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="mdays">Interest: </label>
                  </div>
                  <div class="col-75">
                    <input  id="accinterest" name="acc_interest" style="background:white;" value="<?php echo $news_item['interest']?>" type="number" placeholder="0.00" required name="price" min="0" value="0" step="0.01">
                  </div>
                </div>
              </div>
            </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>
            <button class="button button2" type="submit" name="addMem" id="catID">Save</button>

        <button class="button button2" id="issueBut2">Cancel</button>

      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © The Digital Library 2018</small>
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
        document.location.href = 'addacctypeview';
        });
      </script>

    </div>
