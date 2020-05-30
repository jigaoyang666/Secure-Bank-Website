<?php
include ("db_conn.php");
include ("session.php");
//to get the value from the apply page
$type_bus = $_POST['ac_type'];
$abn = $_POST['abn'];
$access_bus = $_POST['access_bus'];
//to validate the if the user have filled the abn in the blank;
// if the black is enpty the page will jump to main page;
// if the blank has filled the program will help user to create a business account.
if($abn==""){
    header('Location:./main_page.php?error=Please type your ABN');
}
else{$query_apply = "INSERT INTO `account` (`username`, `abn`, `ac_type`, `access`) VALUES ('$session_user', '$abn', '$type_bus', '$access_bus')";
$mysqli->query($query_apply);
//$query_search = "SELECT * FROM `account` WHERE `username`= '$username'";
//$result_search = $mysqli->query($query_search);
    
//to create an indivadual business account statement table
$account_search = $mysqli->insert_id;
    //echo $account_search;
    $query_newform = "CREATE TABLE `"
    .$account_search
    ."`  ( `id` INT(32) NULL DEFAULT NULL AUTO_INCREMENT ,
    `reference` INT(32) NULL DEFAULT NULL ,
    `from_ac` INT(32) NULL DEFAULT NULL , 
    `to_ac` INT(32) NULL DEFAULT NULL , 
     `from_user` VARCHAR(128) NULL DEFAULT NULL , 
    `to_user` VARCHAR(128) NULL DEFAULT NULL ,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `funds` VARCHAR(32) NULL DEFAULT NULL ,
     `purpose` VARCHAR(32) NULL DEFAULT NULL ,
    `balance` VARCHAR(32) NULL DEFAULT NULL ,
    `access` INT(32) NULL DEFAULT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
       
    $mysqli->query($query_newform);
header('Location: ./main_page.php?error=Account has been created');
}
?>