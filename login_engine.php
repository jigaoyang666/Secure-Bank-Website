<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
//receive the username data from the form (in signin_form.php)
$user_login = $_POST['name'];
//receive the password data from the form (in signin_form.php)
$password_login = $_POST['password'];
echo "123";
//query to check whether username is in the table (check whether the user has been signed up)
 $query_login = "SELECT * FROM `registration` WHERE username='$user_login'";
//execute query to the database and retrieve the result ($result)
//$result_login = $mysqli->query($query_login);
$result_login = $mysqli->query($query_login);
//convert the result to array (the key of the array will be the column names of the table)
$row_login= mysqli_fetch_array($result_login,MYSQLI_ASSOC);
echo "step1";
//if the username from the table is not same as the username data from the form(from signin_from.php)
if($row_login['username']!=$user_login || $user_login=="")
{
    //atuomarically go back to home page and pass the error message
    header('Location: ./Home_page.php?error=invalid_username');
}
//if the username is same as the username data from the form(from sign_form.php)
else{
    if($row_login['access']=="2"){
      //if the password from the table is same as the password data from the form(from signin_form.php)
    if($row_login['password']==MD5($password_login)){
        //save the username in the session
        $session_user=$row_login['username'];
        $_SESSION['session_user']=$session_user;
        $session_lasttime=$row_login['last_time'];
        $_SESSION['lasttime']=$session_lasttime;
        //automatically go to signin_success.php
        header('Location: ./manage_viewaccount.php');
    }
    //if the password from table does not match with the password from the signin form
    else{
        //automatically go back to signin_form and pass the error message
        header('Location: ./Home_page.php?error=invalid_password');
    }   
    }
    else{
    //if the password from the table is same as the password data from the form(from signin_form.php)
    if($row_login['password']==MD5($password_login)){
        //save the username in the session
        $session_user=$row_login['username'];
        $_SESSION['session_user']=$session_user;
        $session_lasttime=$row_login['last_time'];
        $_SESSION['lasttime']=$session_lasttime;
        //automatically go to signin_success.php
        header('Location: ./main_page.php');
    }
    //if the password from table does not match with the password from the signin form
    else{
        //automatically go back to signin_form and pass the error message
        header('Location: ./Home_page.php?error=invalid_password');
    } 
}
}
?>