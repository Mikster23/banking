<?php
$user_id=$this->session->userdata('user_id');
$user_balance=$this->session->userdata('user_balance');
$user_pin=$this->session->userdata('user_pin');
$user_acctnum=$this->session->userdata('user_acctnum');
$error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');
if(!$user_id){
redirect('/user/loadlogin');
}
?>
<?php
if($error_msg){
  ?>
  <div class="alert alert-danger">
    <?php echo $error_msg; ?>
  </div>
<?php
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>O. Banking System</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>
    <?php  $this->view('partials/admin_sidebar.php');
    $error_msg= $this->session->flashdata('error_msg');
    $success_msg= $this->session->flashdata('success_msg');
?>
    <div class="content-wrapper">
            <h1>Time Deposit</h1>
            <br>
            <h3>Change Rates</h3>
            <div class="col-md-12 mb-3">
            </div>
            
            <div class="col-md-12 mb-3">
                <br>
                <h3>Time Deposit Table </h3>
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Time Deposit Table</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Days</th>
                                        <th>Rate</th>
                                        <th>Currrency</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Days</th>
                                        <th>Rate</th>
                                        <th>Currrency</th>
                                        <th width="10%"></th>   
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                $curDate = date("Y-m-d");
                        if(isset($getRate)){
                            if ($getRate==NULL){
                                echo 'engk';
                            }
                            else{
                                echo '';
                                $currDate = date("Y-m-d");
                                foreach ($getRate as $value) {
                                    if ($value->id!=71){
                                    echo '
                                    <tr>
                                    <td>'.$value->day.'</td>
                                    <td>'.($value->rates*100).'%</td>
                                    <td>'.$value->currency.'</td>';
                                            echo '<td> <a data-toggle="modal" href="#portfolioModal'.$value->id.'"
                                            data-id="'.$value->id.'" class="
                                            open-AddBookDialog btn btn-primary name="withBtn'.$value->id.'">Edit</button> </td>';
                                    ?>
                                    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-hidden="true"
                                        style="width: 100%; margin: auto;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="close-modal" data-dismiss="modal">
                                                    <div class="lr">
                                                        <div class="rl"></div>
                                                    </div>
                                                </div>
                                                <div class="container" style="width: 100%; margin: auto;">
                                                    <div class="row">
                                                        <div style="width: 100%;">
                                                            <div class="modal-body">
                                                                <!-- Project Details Go Here. -->
                                                                <h2 class="text-uppercase">Change Rate</h2>
                                                                <p class="item-intro text-muted">Day:
                                                                    <?php echo $value->day; ?>
                                                                </p>
                                                                <p class="item-intro text-muted">Currency:
                                                                    <?php echo $value->currency; ?>
                                                                </p>
                                                                    
                                                                <img class="img-fluid d-block mx-auto" src="img/portfolio/01-full.jpg" alt="">

                                                                <form class="needs-validation" role="form" method="post" action="<?php echo base_url('admintimedeposit/updateRate'); ?>">
                                                                <input type="hidden" name="id_stored" value="<?php echo $value->id; ?>" />
                                                                    <label for="id">Change Rate (%) </label>
                                                                    <input type="number" class="form-control" id="ratePlc" step="any" name="ratePlc" required placeholder="Input Rate" value="<?php
                                                                    echo ($value->rates*100); ?>">
                                                                    
                                                                    <br>
                                                                    <br>
                                                                    
                                                                    <input type="submit" name="wSubmit" class="btn btn-primary" value="Submit" />
                                                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                                                        <i class="fa fa-times"></i>
                                                                        Cancel</button>
                                                            </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        
                                            

                                                <?php // end of upper loop
                                                 echo '</tr>';}}}} ?>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>

                    </div>                                 


    </div>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    </div>
</body>

</html>