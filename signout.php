<?php
include("db_conn.php");
include("session.php");
$query_last ="UPDATE `registration` SET `last_time` = now() WHERE `username`= '$session_user'";
$mysqli->query($query_last);
//destroy the sessions saved before.
session_destroy();
//automatically go back to signin form
header('Location: ./Home_page.php');
?>