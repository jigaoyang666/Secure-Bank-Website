<?php
include("db_conn.php");
include("session.php");
// to get the value from the transfer page;
$account_from = $_POST['fromaccount'];
$account_to = $_POST['toaccount'];
$amount = $_POST['amount_tra'];
$to_user = $_POST['to_user'];
$purpose = $_POST['purpose'];
$usd = $_POST['currencies'];
// to creat a transfer reference number 
$reference = rand(10000,99999);
//to calculate the total transfer money one day
$query_total="SELECT * FROM `".$account_from."` WHERE `from_user`= '$session_user' AND TO_DAYS(NOW() ) - TO_DAYS(`date`) <=1;";
$result_total = $mysqli->query($query_total);
$row_total = $result_total->num_rows;
$total = 0;
for($i=0;$i<$row_total;$i++){
    $query_total = $result_total->fetch_assoc();
    $total += $query_total['funds'];}

    //to get value form account, get funds and account type form the form
$query_transfer = "SELECT * FROM `account` WHERE `id`='$account_from'";
$result_trans = $mysqli->query($query_transfer);
$data_trans = $result_trans->fetch_assoc();
$balance = $data_trans['funds'];
$account_type = $data_trans['ac_type'];

$query_add = "SELECT * FROM `account` WHERE `id`='$account_to'";
$result_add = $mysqli->query($query_add);
$data_add = $result_add->fetch_assoc();
$balance_add = $data_add['funds'];

//to get the rate value from the form currencies
$query_rate="SELECT * FROM `currencies` WHERE `money`= '$usd'";
  $result_rate=$mysqli->query($query_rate);
  $data_rate=$result_rate->fetch_assoc();
  $rate = $data_rate['rate'];
  //to calculate the money the user want to transfer from his/her account;
  $real = $rate * $amount;
  $calculate_bus = $real + $total;
  $funds_minus = $balance - $real;
  $funds_add = $balance_add + $real;
  //to validate if the account has enough money to finish the operation of transcation on not;
  if($balance < $real)
  {
    header('Location:./transfer.php?error=You do not have enough money in your account');
  }
  else
  {//the account has enough money to finish the operation of transcation
   
    if($account_type == "Saving")
    {//to validate the account type
     if($calculate_bus <=10000 && $usd == "aud")
     {// to validate if the saving account has over the transcation limitation;
        $sql_minus = "UPDATE `account` SET `funds`=$funds_minus  WHERE id='$account_from';";     //to accomplish the operation of transcation;
        $sql_add = "UPDATE `account` SET `funds`=$funds_add  WHERE id='$account_to';";           //
        $result_minus = $mysqli->query($sql_minus);
        $result_add = $mysqli->query($sql_add);
        //to record the history of transcation
        $sql_comments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose' )";
        $sql_from = "INSERT INTO `".$account_from."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`, `balance`) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose', '-$real')";
        $sql_to = "INSERT INTO `".$account_to."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose', '$real' )";
        $mysqli->query($sql_comments);
        $mysqli->query($sql_from);
        $mysqli->query($sql_to);
        header('Location: ./main_page.php?error=Transfer successful'); 
     } 
     if($calculate_bus >10000 && $usd == "aud")
     {//to tell the user he/her has over the transaction limitation per day;
        header('Location:./transfer.php?error=You have over the limitation1');  
     }
     if($usd != "aud")
     {//to tell user the saving account do not have the right to transfer currencies;
        header('Location: ./transfer.php?error=This account can not transfer currencies'); 
        
     }
    }
    if($account_type == "Business")
    {//to validate the account type
        if($calculate_bus <= 50000 && $real < 25000)
        {// to validate if the business account has over the transcation limitation;
        $sql_minus = "UPDATE `account` SET `funds`=$funds_minus  WHERE id='$account_from';";     //to accomplish the operation of transcation;
        $sql_add = "UPDATE `account` SET `funds`=$funds_add  WHERE id='$account_to';";           //
        $result_minus = $mysqli->query($sql_minus);
        $result_add = $mysqli->query($sql_add);
        //to record the history of transcation
        $sql_comments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose' )";
        $sql_from = "INSERT INTO `".$account_from."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`, `balance` ) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose', '-$real')";
        $sql_to = "INSERT INTO `".$account_to."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`, `balance`) 
                VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose', '$real' )";
        $mysqli->query($sql_comments);
        $mysqli->query($sql_from);
        $mysqli->query($sql_to);
        header('Location: ./main_page.php?error=Transfer successful');
        }
        if($calculate_bus <= 50000 && $real >= 25000)
        {//when the user transfer over 25000 one time, the operation need to be approve by manager;
         // this program is to send message for the manager and wait he/she approve;
        $sql_message = "INSERT INTO `message_bus` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`, `status`) 
               VALUES ('$reference', '$account_from', '$account_to', '$session_user', '$to_user', '$real', '$purpose', '0')";
        $mysqli->query($sql_message);
        header('Location: ./transfer.php?error=Please waiting bank manager approve');
        }
        if($calculate_bus > 50000)
        {//to tell the user he/her has over the transaction limitation per day;
            header('Location:./transfer.php?error=You have over the limitation2'); 
        }
    }
  }
