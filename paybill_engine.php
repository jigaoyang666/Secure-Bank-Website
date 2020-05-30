<?php
include("db_conn.php");
include("session.php");
//to get the value from the paybill page
$account_pay= $_POST['account_pay'];
$amount_pay= $_POST['amount_pay'];
$water=$_POST['water'];
$electricity=$_POST['electricity'];
$telephone=$_POST['telephone'];

$nbn=$_POST['nbn'];
$reference = rand(10000,99999);
//
if($water!="" || $electricity!="" || $telephone!="" || $nbn!=""){//to validate if the user have choose the bill that he wants to pay;
if($water!=""){//to accomplish the operation of paying water bill;
    $query_water="SELECT * FROM `company` WHERE `username`= '$water'";
    $result_water= $mysqli->query($query_water);
    $data_water= $result_water->fetch_assoc();
    $water_bill= $data_water['funds'] + $amount_pay;
    $water_number = $data_water['number'];
    $query_bill="SELECT * FROM `account` WHERE `id`= '$account_pay'";
    $result_ower = $mysqli->query($query_bill);
    $data_ower = $result_ower->fetch_assoc();
    $ower_pay = $data_ower['funds'] - $amount_pay;
   // $ower_id = $data_ower['id'];
    if($data_ower['funds'] < $amount_pay){
        header('Location: ./paybill.php?error=Not have enough money in your account');
    }
    else{//to accomplish the account funds change;
        $sql_water = "UPDATE `company` SET `funds`='$water_bill' WHERE `username`= '$water';";
        $sql_ower = "UPDATE `account` SET `funds`= '$ower_pay' WHERE `id` = '$account_pay';";
        $mysqli->query($sql_water);
        $mysqli->query($sql_ower);
        $bill_type = "water bill";
        //to insert the paying history in the database
        $sql_billcomments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$water', '$amount_pay', '$bill_type' )";
        $sql_waterbill = "INSERT INTO `".$account_pay."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$water', '$amount_pay', '$bill_type','-$amount_pay' )";
        $sql_income = "INSERT INTO `".$water_number."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$water', '$amount_pay', '$bill_type', '$amount_pay' )";
        $mysqli->query($sql_billcomments);
        $mysqli->query($sql_waterbill);
        $mysqli->query($sql_income);
        header('Location: ./paybill.php?error=Pay successfully');
    }
}
if($electricity!=""){//to accomplish the operation of paying power bill;
    $query_water="SELECT * FROM `company` WHERE `username`= '$electricity'";
    $result_water= $mysqli->query($query_water);
    $data_water= $result_water->fetch_assoc();
    $water_bill= $data_water['funds'] + $amount_pay;
    $water_number = $data_water['number'];
    $query_bill="SELECT * FROM `account` WHERE `id`= '$account_pay'";
    $result_ower = $mysqli->query($query_bill);
    $data_ower = $result_ower->fetch_assoc();
    $ower_pay = $data_ower['funds'] - $amount_pay;
   // $ower_id = $data_ower['id'];
    if($data_ower['funds'] < $amount_pay){
        header('Location: ./paybill.php?error=Not have enough money in your account');
    }
    else{//to accomplish the account funds change;
        $sql_water = "UPDATE `company` SET `funds`='$water_bill' WHERE `username`= '$electricity';";
        $sql_ower = "UPDATE `account` SET `funds`= '$ower_pay' WHERE `id` = '$account_pay';";
        $mysqli->query($sql_water);
        $mysqli->query($sql_ower);
        $bill_type = "electricity bill";
        //to insert the paying history in the database
        $sql_billcomments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$electricity', '$amount_pay', '$bill_type' )";
        $sql_waterbill = "INSERT INTO `".$account_pay."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$electricity', '$amount_pay', '$bill_type','-$amount_pay' )";
        $sql_income = "INSERT INTO `".$water_number."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$electricity', '$amount_pay', '$bill_type','$amount_pay' )";
        $mysqli->query($sql_billcomments);
        $mysqli->query($sql_waterbill);
        $mysqli->query($sql_income);
        header('Location: ./paybill.php?error=Pay successfully');
    }

}
if($telephone!=""){//to accomplish the operation of paying phone bill;
    $query_water="SELECT * FROM `company` WHERE `username`= '$telephone'";
    $result_water= $mysqli->query($query_water);
    $data_water= $result_water->fetch_assoc();
    $water_bill= $data_water['funds'] + $amount_pay;
    $water_number = $data_water['number'];
    $query_bill="SELECT * FROM `account` WHERE `id`= '$account_pay'";
    $result_ower = $mysqli->query($query_bill);
    $data_ower = $result_ower->fetch_assoc();
    $ower_pay = $data_ower['funds'] - $amount_pay;
   // $ower_id = $data_ower['id'];
    if($data_ower['funds'] < $amount_pay){
        header('Location: ./paybill.php?error=Not have enough money in your account');
    }
    else{//to accomplish the account funds change;
        $sql_water = "UPDATE `company` SET `funds`='$water_bill' WHERE `username`= '$telephone';";
        $sql_ower = "UPDATE `account` SET `funds`= '$ower_pay' WHERE `id` = '$account_pay';";
        $mysqli->query($sql_water);
        $mysqli->query($sql_ower);
        $bill_type = "telephone bill";
        //to insert the paying history in the database
        $sql_billcomments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$telephone', '$amount_pay', '$bill_type' )";
        $sql_waterbill = "INSERT INTO `".$account_pay."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$telephone', '$amount_pay', '$bill_type','-$amount_pay' )";
        $sql_income = "INSERT INTO `".$water_number."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$telephone', '$amount_pay', '$bill_type','$amount_pay' )";
        $mysqli->query($sql_billcomments);
        $mysqli->query($sql_waterbill);
        $mysqli->query($sql_income);
        header('Location: ./paybill.php?error=Pay successfully');
    }

}
if($nbn!=""){//to accomplish the operation of paying nerwork bill;
    $query_water="SELECT * FROM `company` WHERE `username`= '$nbn'";
    $result_water= $mysqli->query($query_water);
    $data_water= $result_water->fetch_assoc();
    $water_bill= $data_water['funds'] + $amount_pay;
    $water_number = $data_water['number'];
    $query_bill="SELECT * FROM `account` WHERE `id`= '$account_pay'";
    $result_ower = $mysqli->query($query_bill);
    $data_ower = $result_ower->fetch_assoc();
    $ower_pay = $data_ower['funds'] - $amount_pay;
   // $ower_id = $data_ower['id'];
    if($data_ower['funds'] < $amount_pay){
        header('Location: ./paybill.php?error=Not have enough money in your account');
    }
    else{//to accomplish the account funds change;
        $sql_water = "UPDATE `company` SET `funds`='$water_bill' WHERE `username`= '$nbn';";
        $sql_ower = "UPDATE `account` SET `funds`= '$ower_pay' WHERE `id` = '$account_pay';";
        $mysqli->query($sql_water);
        $mysqli->query($sql_ower);
        $bill_type = "network bill";
        //to insert the paying history in the database
        $sql_billcomments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$nbn', '$amount_pay', '$bill_type' )";
        $sql_waterbill = "INSERT INTO `".$account_pay."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$nbn', '$amount_pay', '$bill_type','-$amount_pay' )";
        $sql_income = "INSERT INTO `".$water_number."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`,`balance`) 
        VALUES ('$reference', '$account_pay', '$water_number', '$session_user', '$nbn', '$amount_pay', '$bill_type','$amount_pay' )";
        $mysqli->query($sql_billcomments);
        $mysqli->query($sql_waterbill);
        $mysqli->query($sql_income);
        header('Location: ./paybill.php?error=Pay successfully');
    }

}
}
else{
    header('Location: ./paybill.php?error=Please select the type');
}
?>