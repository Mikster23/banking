<?php  $this->view('partials/admin_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');
?>
<?php echo form_open('account/create'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Example DataTables Card-->
        <div class="card mb-3" style="margin-top:0.5vw;">
          <div class="card-header">
            <i class="fa fa-user"></i><b> Add User</b></div>
            <div class="card-body">
              <div class="container">
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">First Name: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="mfname" name="m_fname" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Last Name: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="mlname" name="m_lname" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Address: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="meadd" name="m_address" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Email: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="meemail" name="m_email" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Birthday: </label>
                    </div>
                    <div class="col-75">
                      <input type="date" id="mebday" name="m_bday" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Age: </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="meage" name="m_age" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Mobile No.: </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="memobile" name="m_mobile" style="background:white;" value="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Password: * </label>
                    </div>
                    <div class="col-75">
                      <input type="password" id="mpass" name="m_pass" style="background:white;" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mpenaltys">Account Type: *</label>
                    </div>
                    <div class="col-75">
                      <div class="form-group">
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
                      <label for="mpenaltys">User Type: *</label>
                      <select id="type" name="m_type" value="--Select user type">

                           <option value="1" selected>User</option>
                            <option value="2" >Teller</option>
                            <option value="3">Administrator</option>






                      </select>
                    </div>

                  </div>
              </div>
            </div>
          <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>
            <button class="button button2" type="submit" name="addMem" id="catID">Add</button>
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
              <a class="btn btn-primary" href="<?php echo base_url('account/logout');?>">Logout</a>
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
        document.location.href = 'members.php';
        });
      </script>

    </div>
  </body>
  </html>
