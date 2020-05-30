<?php
//database connection
include("db_conn.php");
/*if(isset($_POST['submit'])){*/
    $title=$_POST['title'];
    $surname=$_POST['surname'];
    $givenname=$_POST['givenname'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $certification=$_POST['certification'];
    $dob=$_POST['birth'];
    $email=$_POST['email'];
    $mobile=$_POST["mobile"];
    $access = $_POST["access"];
    $ac_type = $_POST['ac_type'];
    //setting the error message
    $error="";
    $query_register = "SELECT * FROM `registration` WHERE `username`='$username';";
    $result_register = $mysqli->query($query_register);
    $row = $result_register->num_rows;
    //title validation
    if($title==""){
    	$error.="* Please type your title"."<br>";
    }
    //surname validation
    if($surname==""){
        $error.="* Please type your surname"."<br>";
    }
    //givenname validation
    if($givenname==""){
        $error.="* Please type your givenname"."<br>";
    }
    //username validation
    if($username==""){
        $error.="Please type your username"."<br>";
    }
    elseif($row > 0){
        //the usrname has exited
        $error.="Your username has been registed"."<br>";
    }
     //password validation
     if($password==""){
    	$error.="* Please type the password"."<br>";
    }
    elseif(strlen($password)<8 || strlen($password)>12){
    	//if the password is under 8 and over 12 characters
    	$error.="* The password must be 8-12 characters"."<br>";
    }
    elseif(!preg_match("#[0-9]+#", $password)){
    	//if the password does not include any number
    	$error.="* Password must include at least one number!<br>";
	}
 	elseif(!preg_match("#[a-z]+#", $password)){
 		//if the password does not include any letter
		$error.="* Password must include at least one lowercase letter!<br>";
	}
 	elseif(!preg_match("#[A-Z]+#", $password)){
 		//if the password does not include any uppercase letter
		$error.="* Password must include at least one uppercase letter!<br>";
    }
     elseif(!preg_match("/[~!#$]+/", $password)){
        //if the password does not include any symbol
		$error.="* Password must include at least one symbol!<br>";
    }

	//email validation
	if($email==""){
        $error.="* Please type your email address"."<br>";
	}elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
		//if the email is not proper in format
		$error.="* Please type the correct format of email address"."<br>";
    }
    //comment validation
    if($mobile==""){
    	$error.="* Please type the mobile"."<br>";
    }
echo $error;
if($error==""){
	//encrypt password
	$password_encrypt=MD5($password);
    //Escapes special characters in a string for use in an SQL statement
    //$comments=$mysqli->real_escape_string($comments);
    //query for inserting
    $insertquery="INSERT INTO `registration` (`title`, `givenname`, `surname`, `username`, `password`, `certification`, `birth`, `email`, `access`, `mobile`) 
    VALUES ('$title','$givenname','$surname','$username','$password_encrypt','$certification','$dob','$email','$access','$mobile')";
    $query_account="INSERT INTO `account` (`username`, `ac_type`, `access`) VALUES ('$username', '$ac_type', '$access')";
    
    // 	//execute the insert query
    $mysqli->query($insertquery);
    $mysqli->query($query_account);
    echo $username;
    $query_find = "SELECT * FROM `account` WHERE `username`= '$username'";
    $result_find = $mysqli->query($query_find);
    
    $data_find = $result_find->fetch_assoc();
    //$data_find = mysqli_fetch_array($result_find);
    echo $data_find['id'];
    $account_find = $data_find['id'];
    echo $account_find;
    // to create an indivadual saving account table to store the transaction history;
    $query_create = "CREATE TABLE `"
    .$account_find
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
       
    $mysqli->query($query_create);
    // 	//automatically go to home_page.php
    header('Location: ./Home_page.php');
}
else{
    $message = "Location: ./register.php?error=" .$error; 
    header($message);
    //header('Location: ./register.php?error=invalid_details');
}

?>