<?php
    // to connect the database;
    include("db_conn.php");
    //to get the transfer reference number from the message page;
    $status_new = $_POST['id'];
    //when the manager click approve button, the transfer status will change from 0 to 1, it states the tranfer finish.
    $sql_status = " UPDATE `message_bus` SET `status`= '1' WHERE `reference`= '$status_new'";
    $mysqli->query($sql_status);
     header('Location: ./manage_message.php'); 
?>