<?php
include("db_conn.php");
include("session.php");
//to get the value from the manage_account page;
$access_new = $_POST['id'];
$account_change = $_POST['change'];
$account_delete = $_POST['delete'];
echo $access_new;
echo $account_change;
echo $account_delete;
//to validate if the manager want to carry out operation of delete;
// if ture, the program will delete the relevant account;
//if false, the protam will carry out operation of change;
if($account_delete == "Delete")
    {
        $sql_delete = "DELETE FROM `account` WHERE `id`='$access_new'";
        $mysqli ->query($sql_delete);
    
        header('Location:./manage_account.php?error=Account has been deleted');
    }
    else{//to carry out the operation of change;
    $query_change = "SELECT * FROM `account` WHERE `id`='$access_new';";
    $result_change = $mysqli->query($query_change);
    $data_change = $result_change->fetch_assoc();
    $original_access = $data_change['access'];
     
    if($original_access == 1){
        $query_new = "UPDATE `account` SET `access`= '2' WHERE `id`= '$access_new';";
        $mysqli->query($query_new); 
        header('Location: ./manage_account.php?error=Access has been changed1');     
    }
    if($original_access != 1)
    {$query_new = "UPDATE `account` SET `access`= '1' WHERE `id`= '$access_new';";
    $mysqli->query($query_new);
    header('Location: ./manage_account.php?error=Access has been changed2');
    }
    if($access_new=="")
    {
    header('Location: ./manage_account.php');
    } 
     }  
    

?>