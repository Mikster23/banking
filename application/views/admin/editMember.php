<?php  $this->view('partials/admin_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');

?>
<?php echo form_open('cruduser/edit/'.$news_item['id']); ?>
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
                      <label for="mdays">First Name: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="mfname" name="m_fname" style="background:white;" value="<?php echo $news_item['firstname']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Last Name: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="mlname" name="m_lname" style="background:white;" value="<?php echo $news_item['lastname']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Address: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="meadd" name="m_address" style="background:white;" value="<?php echo $news_item['address']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Email: </label>
                    </div>
                    <div class="col-75">
                      <input type="text" id="meemail" name="m_email" style="background:white;" value="<?php echo $news_item['email']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Birthday: </label>
                    </div>
                    <div class="col-75">
                      <input type="date" id="mebday" name="m_bday" style="background:white;" value="<?php echo $news_item['birthday']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Age: </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="meage" name="m_age" style="background:white;" value="<?php echo $news_item['age']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Mobile No.: </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="memobile" name="m_mobile" style="background:white;" value="<?php echo $news_item['mobile']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Account No.: </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="meaccnt" name="m_accnt" style="background:white;" value="<?php echo $news_item['accountnum']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Pin No.: </label>
                    </div>
                    <div class="col-75">
                      <input type="password" id="mepin" name="m_pin" style="background:white;" value="<?php echo $news_item['pin']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-25">
                      <label for="mdays">Password: * </label>
                    </div>
                    <div class="col-75">
                      <input type="password" id="mpass" name="m_pass" style="background:white;" value="<?php echo $news_item['password']; ?>">
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="col-25">
                      <label for="mpenaltys">User Type: *</label>
                    </div>
                    <div class="col-75">
                      <select id="type" name="m_type" value="<?php echo $news_item['user_type']; ?>">
                        <?php if($news_item['user_type'] == 1){
                          ?>
                           <option value="1" selected>User</option>
                            <option value="2" >Teller</option>
                            <option value="3">Administrator</option>
                           <?php
                        } else if ($news_item['user_type'] == 2){
                          ?>   <option value="2" selected>Teller</option>
                          <option value="3">Administrator</option>
                          <option value="1" >User</option>

                          <?php
                        }   else if( $news_item['user_type'] == 3){

                            ?>
                              <option value="3" selected>Administrator</option>
                            <option value="2">Teller</option>

                            <option value="1">User</option>
                        <?php

                        }


                        ?>
                      </select>
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
