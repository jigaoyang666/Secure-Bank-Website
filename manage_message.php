<?php
include ("db_conn.php");
include ("session.php");

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
                        
                        <th>Reference</th>
                        <th>From Account</th>
                        <th>To account</th>
                        <th>From User</th>
                        <th>To User</th>
                        <th>Funds</th>
                        <th>Purpose</th>
                        <th>Approve</th>
                        
                <?php
                
                //echo "step0";
                $query_change ="SELECT * FROM `message_bus`";
                $result_change = $mysqli->query($query_change);
                
                $i = 0;
                while ($row_change = $result_change->fetch_assoc()){
                   /*  $reference = $row_change['reference']; */
                    $status = $row_change['status'];
                    if($status == 0){
                    ?>
                        <tr >
                            
                            <td><?php echo $row_change['reference'];?></td>
                            <td><?php echo $row_change['from_ac'];?></td>
                            <td><?php echo $row_change['to_ac'];?></td>
                            <td><?php echo $row_change['from_user'];?></td>
                            <td><?php echo $row_change['to_user'];?></td>
                            <td><?php echo $row_change['funds'];?></td>
                            <td><?php echo $row_change['purpose'];?></td>
                            <td>
                            <form action="./approve_engine.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row_change['reference'];?>">
                             <input type="submit" name="change" value="Approve"/>
                             </form>
                            </td>
                            
                        </tr>
                <?php } ?>       
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