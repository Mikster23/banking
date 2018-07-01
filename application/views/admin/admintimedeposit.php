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
        <div class="container-fluid">
            <h1>Time Deposit</h1>
            <br>
            <h3>Deposit Money</h3>
            <!-- FORM CHOOSE TIME DEPOSIT // INPUT AMOUNT //TERMS OF PLACEMENT//WHEN TO RELEASE DATE-->
            <form class="needs-validation" role="form" method="post" action="<?php echo base_url('admintimedeposit/maketimedep');?>   ">
                <div class="form-row">
                    <div class="col-md-8 mb-2 float-md-left" style="background-color: #f1f1f1;border-radius: 10px;">
                        <br>
                        <p class="text-justify rounded">
                            Earn higher interest than a regular Peso savings account and schedule the release of your funds on the date you specify.
                        </p>
                    </div>
                    <div class="col-md-6 mb-4 float-md-left">
                        <label for="inlineFormCustomSelectPref">Account Number</label>
                        <input type="number" class="form-control" name="inptAcct" required id="inptAcct" aria-describedby="number" placeholder="Account Number">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="inlineFormCustomSelectPref">Term of Placement</label>
                        <select class="custom-select my-1 mr-sm-2" required id="inlineFormCustomSelectPref" name="tPlacement">
                            <option selected>Choose...</option>
                            <option value="30">30 days</option>
                            <option value="60">60 days</option>
                            <option value="90">90 days</option>
                            <option value="180">180 days</option>
                            <option value="360">360 days</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please choose preferred days for term of placement.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="inputAmount">Amount to Deposit</label>
                        <input type="number" class="form-control" name="amtDept" min="1000" required id="inputAmount" aria-describedby="number" placeholder="Amount to Deposit">
                        <small id="amt1" class="form-text text-muted">Minimum Initial Placement is 1000 php.</small>
                        <div class="invalid-tooltip">
                            Please input an amount greater than 1000.
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inptCurr">Currency</label>
                        <select class="custom-select my-1 mr-sm-2" required id="inlineFormCustomSelectPref" name="curr">
                            <option selected>Choose...</option>
                            <option value="PHP">PHP</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="col-md-1 mb-4">
                        <input type="submit" name="subAmt" class="btn btn-primary" value="Submit" />
                    </div>
            </form>

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
                                        <th>Account Number</th>
                                        <th>Amount</th>
                                        <th>Currrency</th>
                                        <th>Term of Placement</th>
                                        <th>Initial Date</th>
                                        <th>Withdrawal Date</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Account Number</th>
                                        <th>Amount</th>
                                        <th>Currrency</th>
                                        <th>Term of Placement</th>
                                        <th>Initial</th>
                                        <th>Withdrawal Date</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                $curDate = date("Y-m-d");
                        if(isset($view_table)){
                            if ($view_table==NULL){
                                echo 'engk';
                            }
                            else{
                                echo '';
                                $currDate = date("Y-m-d");
                                foreach ($view_table as $value) {
                                    if ($value->amount!=0){
                                    echo '
                                    <tr>
                                    <td>'.$value->acctID.'</td>
                                    <td>'.$value->amount.'</td>
                                    <td>'.$value->currency.'</td>
                                    <td>'.$value->placement.' days</td>
                                    <td>'.$value->intDate.'</td>
                                    <td>'.$value->widthDate.'</td>';
                                        if ($value->widthDate <= $currDate ){
                                            echo '<td> <a data-toggle="modal" href="#portfolioModal'.$value->tdeptID.'"
                                            data-id="'.$value->tdeptID.'" class="
                                            open-AddBookDialog btn btn-primary name="withBtn'.$value->tdeptID.'">Widthraw</button> </td>';
                                            echo '<td> <a data-toggle="modal" href="#portfolioModall'.$value->tdeptID.'"
                                            data-id="'.$value->tdeptID.'" class="
                                            open-AddBookDialog btn btn-primary name="withBtn'.$value->tdeptID.'">Extend</button> </td>';
                                        }
                                        else{
                                            echo '<td> <a data-toggle="modal" href="#portfolioModal'.$value->tdeptID.'"
                                            data-id="'.$value->tdeptID.'" class="
                                            open-AddBookDialog btn btn-primary disabled name="withBtn'.$value->tdeptID.'">Widthraw</button> </td>';
                                            echo '<td> <a data-toggle="modal" href="#portfolioModall'.$value->tdeptID.'"
                                            data-id="'.$value->tdeptID.'" class="
                                            open-AddBookDialog btn btn-primary disabled name="withBtn'.$value->tdeptID.'">Extend</button> </td>';
                                        }?>

                                    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $value->tdeptID; ?>" tabindex="-1" role="dialog" aria-hidden="true"
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
                                                                <!-- Project Details Go Here -->
                                                                <h2 class="text-uppercase">Withdrawal</h2>
                                                                <p class="text-justify rounded">
                                                                    Remaining money will be stored in the same account number
                                                                </p>
                                                                <p class="item-intro text-muted">Account Number:
                                                                    <?php echo $value->acctID; ?>
                                                                </p>
                                                                <p class="item-intro text-muted">Amount:
                                                                    <?php echo $value->amount; ?>
                                                                </p>
                                                                    
                                                                <img class="img-fluid d-block mx-auto" src="img/portfolio/01-full.jpg" alt="">

                                                                <form class="needs-validation" role="form" method="post" action="<?php echo base_url('admintimedeposit/addTransaction');?>   ">
                                                                <input type="hidden" name="id_stored" value="<?php echo $value->tdeptID; ?>"/>
                                                                    <input type="hidden" name="acctnum" value="<?php echo $value->acctID; ?>"/>
                                                                    <input type="hidden" name="hld_curr" value="<?php echo $value->currency; ?>"/>
                                                                    <input type="hidden" name="hld_amt" value="<?php echo $value->amount; ?>"/>
                                                                    <label for="id">Account Number to Transfer</label>
                                                                    <input type="number" class="form-control" name="chooseAcctN1" required id="chooseAcctN1" aria-describedby="number" placeholder="Account Number">
                                                                    <label for="id">Amount of Money to Deposit</label>
                                                                    <input type="number" class="form-control" id="amtDep1" name="amtDep1" max="500000" placeholder="Insert Amount">
                                                                    <!--<label for="id">Choose Currency</label> 
                                            <select class="custom-select my-1 mr-sm-2" required id="inlineFormCustomSelectPref" name="currch">
                                            <option selected>Choose...</option>
                                            <option value="PHP">PHP</option>
                                            <option value="USD">USD</option>
                                        </select>-->
                                                                    <!-- <label for="id">Date to be released</label>
                                        <input type="date" class="form-control" id="wDate1" 
                                        name="wDate1" placeholder="Insert Date" min="<?php echo $value->widthDate; ?>"> -->
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
                        <div class="portfolio-modal modal fade" id="portfolioModall<?php echo $value->tdeptID; ?>" tabindex="-1" role="dialog" aria-hidden="true"
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
                                                    <!-- Project Details Go Here -->
                                                    <h2 class="text-uppercase">Extend</h2>
                                                    <p class="text-justify rounded">
                                                        Remain at least 1000php to extend the time deposit
                                                    </p>
                                                    <p class="item-intro text-muted">Account Number:
                                                        <?php echo $value->acctID; ?>
                                                    </p>
                                                    <p class="item-intro text-muted">Amount:
                                                        <?php echo $value->amount; ?>
                                                    </p>
                                                    <img class="img-fluid d-block mx-auto" src="img/portfolio/01-full.jpg" alt="">

                                                    <form class="needs-validation" role="form" method="post" action="<?php echo base_url('admintimedeposit/extendTD');?>   ">

                                                        <label for="id">Account Number to Transfer</label>
                                                        <input type="number" class="form-control" name="chooseAcctN1" required id="chooseAcctN1" aria-describedby="number" placeholder="Account Number">
                                                                    <label for="id">Amount of Money to Deposit</label>
                                                        <label for="id">Amount of Money to Deposit</label>
                                                        <input type="number" class="form-control" id="amtDep1" name="amtDep1" max="500000" placeholder="Insert Amount">
                                                        <!--<label for="id">Choose Currency</label> 
                                        <select class="custom-select my-1 mr-sm-2" required id="inlineFormCustomSelectPref" name="currch">
                                            <option selected>Choose...</option>
                                            <option value="PHP">PHP</option>
                                            <option value="USD">USD</option>
                                        </select>-->

                                                        <label for="inlineFormCustomSelectPref">Term of Placement</label>
                                                        <select class="custom-select my-1 mr-sm-2" required id="inlineFormCustomSelectPref" name="placement">
                                                            <option selected>Choose...</option>
                                                            <option value="30">30 days</option>
                                                            <option value="60">60 days</option>
                                                            <option value="90">90 days</option>
                                                            <option value="180">180 days</option>
                                                            <option value="360">360 days</option>
                                                        </select>
                                                        <!-- <label for="id">Date to be released</label>
                                        <input type="date" class="form-control" id="wDate1" 
                                        name="wDate1" placeholder="Insert Date" min="<?php echo $value->widthDate; ?>"> -->
                                                        <br>
                                                        <br>
                                                        <input type="hidden" name="id_stored" value="<?php echo $value->tdeptID;?>">
                                                        <input type="hidden" name="acctnum" value="<?php echo $value->acctID;?>">
                                                        <input type="hidden" name="hld_curr" value="<?php echo $value->currency;?>">
                                                        <input type="hidden" name="hld_amt" value="<?php echo $value->amount;?>">
                                                        <input type="submit" name="wSubmit" class="btn btn-primary" value="Submit" data-target="#myModal" />
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
                                                 echo '</tr>';}}}} else{echo 'Input Transaction First';}?>
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