<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db.conn.php");

if ($session_user=="")
{
    header('Location: ./Home_page.php');
} 
if(isset($_GET['error']))
{
    $errormessage=$_GET['error'];
    //show error message using javascript alert
    echo "<script>alert('$errormessage');</script>";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style_1.css">
</head>
<body>
<header>
    <div class="container">
                    
                    <div class="top">
                    <div class="title">
                        <p>Secure Bank</p>
                    </div>
                    <div class="logo_home">
                            <img class="logo" src="logo1.png" alt="bank" width="60px" height="60px">
                    </div>
                    <div class="navigation">
                            <ul class="nav_home"  align="left" style="float:left">
                                    <li class="menu"><a href="./Home_page.php">Home</a></li>
                                    <li><a href="./manage_viewaccount.php" class="menu">Viewaccounts</a></li>
                                    <li><a href="./manage_account.php" class="menu">Manage</a></li>
                                    <li><a href="man_estatement.php" class="menu">EStatements</a></li>
                                    <li><a href="manage_message.php" class="menu  ">Message</a></li>
                                </ul>
                                <div class="logout">
                                <a href="signout.php">Logout</a>
                                </div>
                    </div>
                     </div>
                     <div class="welcome">
                     <p class="user">Welcome                         <?php echo $session_user;echo " <br>Last login time:".$session_lasttime;?></p>
        </div>
    </header>
    <div class="management">
        <div class="change_access">
                <table>
                    <tr>
                        <th>Account</th>
                        <th>Username</th>
                        <th>Funds</th>
                        <th>Account Type</th>
                        <th>Access</th>
                        <th>Create Time</th>
                        
                <?php
                include ("db_conn.php");
                include ("session.php");
                //echo "step0";
                $query_change ="SELECT * FROM `account`";
                $result_change = $mysqli->query($query_change);
                
                $i = 0;
                while ($row_change = $result_change->fetch_assoc()){
                    
                    $account_change = $row_change['id'];
                    $username_change = $row_change['username'];
                    $funds_change = $row_change['funds'];
                    $type_change = $row_change['ac_type'];
                    $access_change = $row_change['access'];
                    $time_change = $row_change['time_create'];
                    //$i++;
                    ?>
                        <tr >
                            <td><?php echo $account_change;?></td>
                            <td><?php echo $username_change;?></td>
                            <td><?php echo $funds_change;?></td>
                            <td><?php echo $type_change;?></td>
                            <td><?php echo $access_change;?></td>
                            <td><?php echo $time_change;?></td>
                            
                        </tr>
                <?php } ?>
                </table>
                <br>
                <br>
                <!-- <button href="./"></button>   
        </div>  -->
    </div>
    <footer>
        <div  class="footer_home">
                <ul>
                    <li>© 2019 Secure Bank ABN 62 951 159 852;***Student Name:Gaoyang Ji; Student Number:484708</li>
                </ul>
        </div>
</footer>
</body>
</html>