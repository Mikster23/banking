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
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">FeuTech Banking System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url('user/loaddash');?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Transactions</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="<?php echo base_url('deposit');?>">Deposit</a>
            </li>
            <li>

              <a href="<?php echo base_url('withdraw');?>">Withdraw</a>
            </li>
            <li>
              <a href="<?php echo base_url('transfer'); ?> ">Transfer Fund</a>
            </li>

            <li>
              <a href="<?php echo base_url('timedeposit');?>">Time Deposit</a>
            </li>

            <li>

              <a href="<?php echo base_url('user/loadtransaction');?>">Transaction History</a>
            </li>

          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pay Bills">
          <a class="nav-link" href="<?php echo base_url('user/loadenroll')?>">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Enroll Additional Account</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pay Bills">
          <a class="nav-link" href="<?php echo base_url('paybill')?>">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Pay Bills</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Account">
          <a class="nav-link" href="<?php echo base_url('user/loadmyaccount'); ?>">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">My Account</span>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out" ></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>

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
    <script type="text/javascript"  src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin-datatables.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/sb-admin-charts.min.js"></script>


  </div>

</body>

</html>
