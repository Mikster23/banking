<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</title>
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <?php // $this->view('partials/teller_sidebar.php');?>
  <body>


  <div class="container">
    <h1>Manage User Accounts</h1>
</center>
    <h3>User List</h3>
    <br />
    <button class="btn btn-success" onclick="add_human()"><i class="glyphicon glyphicon-plus"></i> Add User</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Account Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
          <th>Address</th>
					<th>User Type</th>
        	<th>Account Type</th>
					<th>Balance</th>

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($person as $human){
        $check = (int)$human->user_type;
        if($check ==1){
          ?>

             <tr>
                 <td><?php echo $human->accountnum;?></td>
				         <td><?php echo $human->firstname;?></td>
				         <td><?php echo $human->lastname;?></td>
                 <td><?php echo $human->email;?></td>
                 <td><?php echo $human->address;?></td>


								<td>
                <?php
                $temp = (int)$human->user_type;

                if($temp ==1){
                 echo "user";
                }
                else if($temp ==2){
                  echo "teller";
                }
                ?>

                </td>
                	<td><?php
                  /*
                    $tempacct = (int)$human->account_type;
                    $tempacctname = "";
                    for($i = 0 ; $i<sizeof($account_type) ; $i++){

                      if($temptacct == $)
                    }*/

                 echo $human->account_type;
                 ?></td>
                	<td><?php echo $human->balance;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_human(<?php echo $human->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_human(<?php echo $human->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


								</td>
				      </tr>

				     <?php
           }
           else{

           }
           }?>



      </tbody>

      <tfoot>
        <tr>
          <th>Accountnumber</th>
          <th>Firstnam</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Address</th>
          <th>User_type</th>
          <th>Account_type</th>
          <th>Balance</th>

          <th>Action</th>
        </tr>
      </tfoot>
    </table>

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

  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_human()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_human(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('manage/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_accountnum"]').val(data.accountnum);
            $('[name="user_firstname"]').val(data.firstname);
            $('[name="user_lastname"]').val(data.lastname);
            $('[name="user_address"]').val(data.address);
            $('[name="user_email"]').val(data.email);
            $('[name="user_password"]').val(data.password);
            $('[name="user_birthday"]').val(data.birthday);
            $('[name="user_age"]').val(data.age);
            $('[name="user_mobile"]').val(data.mobile);
            $('[name="user_balance"]').val(data.balance);
            $('[name="user_accounttype"]').val(data.accttype);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Human'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo base_url('manage/manage_add')?>";
      }
      else
      {
        url = "<?php echo base_url('manage/manage_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               alert(' success');
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_human(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo base_url('manage/manage_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
              alert('user has been deleted');
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">User Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-vertical">
          <input type="hidden" value="" name="user_accountnum"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">First Name</label>
              <div class="col-md-9">
                <input name="user_firstname" placeholder="Firstname" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Lastname</label>
              <div class="col-md-9">
                <input name="user_lastname" placeholder="Lastname" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Address</label>
              <div class="col-md-9">
								<input name="user_address" placeholder="Addressr" class="form-control" type="text">

              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<input name="user_email" placeholder="Email" class="form-control" type="text">

							</div>
						</div>

            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input name="user_password" placeholder="Password" class="form-control" type="password">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Birthday</label>
              <div class="col-md-9">
                <input name="user_birthday" placeholder="Birthday" class="form-control" type="date">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Age</label>
              <div class="col-md-9">
                <input name="user_age" placeholder="Age" class="form-control" type="number">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Mobile No.</label>
              <div class="col-md-9">
                <input name="user_mobile" placeholder="Mobile" class="form-control" type="number">


            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Balance.</label>
              <div class="col-md-9">
                <input name="user_balance" placeholder="Balance" class="form-control" type="number">


            </div>


          <div class="form-group">
                <label class="control-label col-md-3">Select Account Type.</label>
                  <div class="col-md-9">
                <select name ="user_accttype" id='sel_acct'>
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
<!--
          <div class="form-group">
                <label class="control-label col-md-3">Select User Type.</label>
                  <div class="col-md-9">
                <select name ="user_accttype" id='sel_acct'>
                  <option>-- Select Account Type --</option>
                  <?php/*

                  foreach($user_type as $acct2){
                     echo ' hi '.$acct2;
                    echo "<option value='".$acct2['id']."'>".$acct2['name']."</option>";
                  }*/
                  ?>
               </select>
                 </div>
          </div> !-->

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  </body>
</html>
