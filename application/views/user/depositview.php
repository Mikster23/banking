<?php
$user_id=$this->session->userdata('user_id');
$user_balance=$this->session->userdata('user_balance');
$user_pin=$this->session->userdata('user_pin');
$user_acctnum=$this->session->userdata('user_acctnum');

if(!$user_id){
 redirect('/user/loadlogin');
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
  <?php  $this->view('partials/user_sidebar.php');
    $error_msg= $this->session->flashdata('error_msg');
    $success_msg= $this->session->flashdata('success_msg');
  ?>


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

    <div class="container box">
             <h3 align="center"><?php echo "Deposit"; ?></h3><br />


    <form role="form" method="post" action="<?php echo base_url('deposit/makedeposit'); ?>">

      <div class="form-group">
          <select name ="user_owned" id='sel_acct' required >
            <option>Select Account to Deposit</option>
            <?php

              $id =  (int) $this->session->userdata('user_id');
            //getyour owned accounts
            $query = $this->db->query('SELECT * FROM accounts WHERE holder_id ='.$id);
            $data  =   array();
            $data2 = array();
            $dataname = array();
            foreach ($query->result_array() as $row):
                      $data[] = $row['holder_id'];
                      $data2[] = $row['account_name'];



            endforeach;




            $query2 = $this->db->query('SELECT * FROM account_type');
            $data3 = array();
            $candepacctnum = array();
            //get account_type with the accountid you owned
            foreach ($query2->result_array() as $row):
                        $data3[] = $row['id'];

                        for($i = 0 ; $i<sizeof($data2) ; $i++){
                            if((int)$data2[$i] == (int)$row['id'])

                            {
                                //check if your owned account can deposit/withdraw through atm
                                if((int)$row['depatm'] ==1){

                                  $candepacctnum[] =$data2[$i];
                                 $dataname[] =  $row['name'];
                                }

                            }

                          echo $data2[$i];
                        }



            endforeach;

            //print_r($candepacctnum);


            $query3 = $this->db->query('SELECT * FROM accounts where holder_id='.$id);
            $data4 = array();

            //get aaccountnumber
            $datafinal= array();
            $datafinal2 = array();
            //print_r($candepacctnum);
            foreach ($query3->result_array() as $row):
            echo '<br>'.$row['account_name'];
            $temp = (int)$row['account_name'];
                    for($i = 0 ; $i<sizeof($candepacctnum) ; $i++){

                         if($temp == $candepacctnum[$i]){

                          //get all account numbers of the account type that can deposit/withdraw
                          echo "true";
                    //       echo $row['account_name'] . "candep : " .$candepacctnum[$i];
                        //   $datafinal[$i]=  (int)$row['accountnum'];


                    /*     $options = array(

                        'accountnum' => (int)$row['accountnum'],
                      );
                      $datafinal['acctnumbers'] = $options;*/

                       $datafinal[$i] = $row['accountnum'];
                       $datafinal2[$i] = $row['balance'];
                         }

                    }



            endforeach;

      //      print_r($datafinal['acctnumbers'][0]);

          for($i = 0 ; $i<sizeof($datafinal) ; $i++){
              // echo ' hi '.$acct;
          //  $temp = 0;
          //  echo "HI".$acct["acctnumbers"];
              echo "<option value='".$datafinal[$i]."'>".$dataname[$i]." | ".$datafinal[$i]." | Balance : ".$datafinal2[$i]."</option>";
              $temp+=1;
            }
            ?>
         </select>
    </div>

      <div class="form-group">
        <label for="exampleInputPin">4 Digit Pin Number</label>
        <input class="form-control" name="user_pin" type="number"  placeholder="Enter Pin">
      </div>


      <div class="form-group">
        <label for="exampleInputAmount">Amount</label>
        <input class="form-control" name="user_amount" type="number" placeholder="Enter Amount">
      </div>
      <input class="btn btn-primary btn-block" type="submit" value="Deposit" name="deposit" >

    </form>

</div>


</body>

</html>
