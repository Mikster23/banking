
<?php  $this->view('partials/user_sidebar.php');
  $error_msg= $this->session->flashdata('error_msg');
  $success_msg= $this->session->flashdata('success_msg');
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
<div width = "50%">

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
<div class="content-wrapper">
  <div class="container box">
           <h3 align="center"><?php echo "Transfer Fund History"; ?></h3><br />
           <div class="table-responsive">
                <br />
                <table id="trans" class="table table-bordered table-striped">
                     <thead>
                          <tr>

                               <th width="35%">From AccountNumber</th>
                               <th width="35%">Action</th>
                               <th width="10%">Amount</th>
                               <th width="10%">Remarks</th>
                               <th width="10%">To AccountNumber</th>
                               <th width="10%">Date</th>
                          </tr>
                     </thead>
                </table>
           </div>
      </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>
<?php// echo site_url("/user/transhistory") ?>
<script>
$(document).ready(function () {

    $('#transthead th').each( function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search '+title+'" />');
    });

    var table = $('#trans').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                 url:"<?php echo base_url("index.php/user/transferhistory"); ?>",
                 type:"POST"
            },

       });
    //  console.log('data');
    table.columns().every( function () {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });

       });
</script>
</body>

</html>
